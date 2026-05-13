<?php
namespace App\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class WpApi {
    private static ?WpApi $instance = null;
    protected static string $url = 'https://larnr.com';
    protected Client $client;

    // Core REST endpoints configuration
    private static array $allowedEndpoints = [
        'posts'      => 'wp-json/wp/v2/posts',
        'pages'      => 'wp-json/wp/v2/pages',
        'comments'   => 'wp-json/wp/v2/comments',
        'categories' => 'wp-json/wp/v2/categories',
        'tags'       => 'wp-json/wp/v2/tags',
        'users'      => 'wp-json/wp/v2/users',
        'media'      => 'wp-json/wp/v2/media'
    ];

    // Shared storage container for registered Custom Post Types
    private static array $customEndpoints = [];

    public function __construct(?string $customUrl = null) {
        $baseUrl = $customUrl ?? self::$url;
        $this->client = new Client([
            'base_uri' => rtrim($baseUrl, '/') . '/',
            'timeout'  => 10.0,
        ]);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Global cache cleaning triggers via GET parameters
        if (isset($_GET['clear_all']) || (isset($_GET['flush']) && $_GET['flush'] == '1')) {
            $this->flushCache();
        }
    }

    /**
     * Singleton Instance Initializer for Static Routing Contexts
     */
    public static function init(): self {
        return self::getInstance();
    }

    /**
     * Singleton Instance Getter for Static Routing Contexts
     */
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Register a new Custom Post Type endpoint (Static & Dynamic compatible)
     */
    public static function registerCustomPostType(string $pluralName, string $restBase) {
        $key = strtolower($pluralName);
        self::$customEndpoints[$key] = 'wp-json/' . ltrim($restBase, '/');
    }

    // ==========================================
    // CORE AUTHENTICATION MANAGEMENT
    // ==========================================

    /**
     * Authenticates a user against JWT Auth and saves token to cache.
     */
    public function login(string $username, string $password) {
        try {
            $response = $this->client->post('wp-json/jwt-auth/v1/token', [
                'json' => [
                    'username' => $username,
                    'password' => $password
                ]
            ]);
            
            $data = json_decode($response->getBody()->getContents());
            
            if (isset($data->token)) {
                $this->setCache('user_token', $data->token);
            }
            
            return $data;
        } catch (RequestException $e) {
            return $e->hasResponse() ? json_decode($e->getResponse()->getBody()->getContents()) : null;
        }
    }

    /**
     * Validates if the active cached token or an explicitly passed token is authentic.
     */
    public function validateToken(?string $token = null) {
        $targetToken = $token ?? $this->getCache('user_token');
        if (!$targetToken) {
            return false;
        }

        try {
            $response = $this->client->post('wp-json/jwt-auth/v1/token/validate', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $targetToken
                ]
            ]);
            $data = json_decode($response->getBody()->getContents());
            
            // JWT Auth standard response for validation returns code "jwt_auth_valid_token"
            return isset($data->code) && $data->code === 'jwt_auth_valid_token';
        } catch (RequestException $e) {
            return false;
        }
    }

    /**
     * Retrieves the profile schema data of the currently authenticated user session.
     */
    public function me(?string $token = null) {
        // WordPress edit context allows access to non-public profile configuration details
        return $this->request('GET', 'wp-json/wp/v2/users/me?context=edit', [], $token);
    }

    /**
     * Clears authentication values out of the cache layer completely.
     */
    public function logout() {
        $this->deleteCache('user_token');
        return true;
    }

    // ==========================================
    // CORE NATIVE EXTENSION ENDPOINTS
    // ==========================================

    public function graphql(string $query, bool $obj = false, int $ttl = 3600) {
        return $this->remember('gql_' . md5($query), function() use ($query) {
            try {
                $response = $this->client->post('graphql', ['json' => ['query' => $query]]);
                return json_decode($response->getBody()->getContents());
            } catch (RequestException $e) {
                return $e->hasResponse() ? json_decode($e->getResponse()->getBody()->getContents()) : null;
            }
        }, $obj, $ttl);
    }

    public function getRankMathData(string $link, bool $obj = false, int $ttl = 3600) {
        return $this->remember('rank_math_data-' . md5($link), function() use ($link) {
            try {
                $response = $this->client->get('wp-json/rankmath/v1/getHead', ['query' => ['url' => $link]]);
                return json_decode($response->getBody()->getContents());
            } catch (RequestException $e) {
                return $e->hasResponse() ? json_decode($e->getResponse()->getBody()->getContents()) : null;
            }
        }, $obj, $ttl);
    }

    // ==========================================
    // CACHE INFRASTRUCTURE LAYER
    // ==========================================
    protected function remember($key, $callback, $obj = false, $ttl = 3600) {
        $now = time();
        $cacheKey = 'wp_api_' . $key;
        $forceRefresh = isset($_GET['refresh']) && $_GET['refresh'] == '1';

        if (!$forceRefresh && isset($_SESSION[$cacheKey])) {
            $cache = $_SESSION[$cacheKey];
            if (($now - $cache['created_at']) < $ttl) {
                return $obj ? (object) $cache : $cache['data'];
            }
        }

        $data = $callback();
        $cacheData = ['created_at' => $now, 'data' => $data];
        $_SESSION[$cacheKey] = $cacheData;

        return $obj ? (object) $cacheData : $data;
    }

    public function flushCache() {
        foreach ($_SESSION as $key => $value) {
            if (strpos($key, 'wp_api_') === 0) {
                unset($_SESSION[$key]);
            }
        }
    }

    public function clearCache() {
        $this->flushCache();
    }

    protected function getCache($key) {
        return $_SESSION['wp_api_' . $key] ?? null;
    }

    protected function setCache($key, $value) {
        $_SESSION['wp_api_' . $key] = $value;
    }

    protected function deleteCache($key) {
        unset($_SESSION['wp_api_' . $key]);
    }

    // ==========================================
    // MAGIC CORE ROUTERS
    // ==========================================

    public function __call(string $name, array $arguments) {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }
        return $this->executeRoutedRequest($name, $arguments);
    }

    public static function __callStatic(string $name, array $arguments) {
        $instance = self::getInstance();
        if (method_exists($instance, $name)) {
            return call_user_func_array([$instance, $name], $arguments);
        }
        return $instance->executeRoutedRequest($name, $arguments);
    }

    private function request(string $method, string $endpoint, array $options = [], ?string $token = null) {
        $bearerToken = $token ?? $this->getCache('user_token');
        if ($bearerToken) {
            $options['headers']['Authorization'] = 'Bearer ' . $bearerToken;
        }

        try {
            // Guzzle automatically calculates boundary strings if 'multipart' is active.
            // Do NOT manually define Content-Type headers when running multipart file pushes.
            $response = $this->client->request($method, $endpoint, $options);
            return json_decode($response->getBody()->getContents(), false) ?? (object)[];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return json_decode($e->getResponse()->getBody()->getContents(), false) ?? (object)[];
            }
            return (object)[];
        }
    }

    /**
     * Automated Cache Eviction Engine
     * Selectively purges transient lists and single entry keys related to the modified resource type.
     */
    private function invalidateResourceCache(string $resource, $id = null): void {
        foreach ($_SESSION as $key => $value) {
            // Target only cache elements generated by the active class
            if (str_starts_with($key, 'wp_api_')) {
                
                // 1. Purge general index lists and search query batches for this resource type
                // Triggers on patterns matching: wp_api_pages_list or wp_api_media_list_xyz
                if (str_contains($key, 'wp_api_' . $resource . '_list') || $key === 'wp_api_' . $resource) {
                    unset($_SESSION[$key]);
                }

                // 2. Target and purge single record items if a specific ID string was manipulated
                // Triggers on patterns matching: wp_api_pages_42 or wp_api_media_108
                if ($id !== null && str_contains($key, 'wp_api_' . $resource . '_' . $id)) {
                    unset($_SESSION[$key]);
                }
                
                // 3. Purge related slug index states for consistency if metadata edits occurred
                if (str_contains($key, 'wp_api_' . $resource . '_slug_')) {
                    unset($_SESSION[$key]);
                }
            }
        }
    }

    private function executeRoutedRequest(string $name, array $arguments) {
        // 1. Check if the method explicitly requests a slug extraction (e.g., getPostBySlug)
        $isSlugMethod = false;
        if (preg_match('/^(get)(.+)BySlug$/i', $name, $matches)) {
            $action = 'get';
            $requestedResource = strtolower($matches[2]); // Extracts "post" or "page"
            $isSlugMethod = true;
        } else {
            // Default split configuration for normal get, create, update, delete methods
            if (!preg_match('/^(get|create|update|delete)(.+)$/i', $name, $matches)) {
                throw new \BadMethodCallException("Method {$name} does not exist in class " . __CLASS__);
            }
            $action = strtolower($matches[1]);
            $requestedResource = strtolower($matches[2]);
        }

        // 2. Fetch all registered plural array keys
        $allPluralKeys = array_merge(array_keys(self::$allowedEndpoints), array_keys(self::$customEndpoints));
        $resource = null;

        // 3. Match the requested string against your dictionary keys (supporting both singular & plural inputs)
        foreach ($allPluralKeys as $pluralKey) {
            $singularKey = $this->getSingularMapping($pluralKey);
            
            if ($requestedResource === $pluralKey || $requestedResource === $singularKey) {
                $resource = $pluralKey;
                break;
            }
        }

        // If the resource cannot be found anywhere in your registered arrays, throw the exception
        if (!$resource) {
            throw new \BadMethodCallException("Method {$name} does not exist in class " . __CLASS__);
        }

        $endpoint = self::$allowedEndpoints[$resource] ?? self::$customEndpoints[$resource];

        // 4. Extract call parameters safely from the indexed array
        $param1 = $arguments[0] ?? null; 
        $param2 = $arguments[1] ?? null; 
        $param3 = $arguments[2] ?? null; 

        switch ($action) {
            case 'get':
                // Route A: Explicit BySlug execution or dynamic string passing
                if ($isSlugMethod || (is_string($param1) && !is_numeric($param1))) {
                    $slugString = (string)$param1;
                    $cacheKey = $resource . '_slug_' . md5($slugString);
                    
                    // Re-align array param assignments since ID index is skipped
                    $obj = is_bool($param2) ? $param2 : false;
                    $ttl = is_int($param3) ? $param3 : 3600;

                    return $this->remember($cacheKey, function() use ($endpoint, $slugString) {
                        return $this->request('GET', $endpoint, ['query' => ['slug' => $slugString]]);
                    }, $obj, $ttl);
                }

                // Route B: Single Item Lookup by numeric database ID (e.g., getPage(12))
                if ($param1 && (is_int($param1) || is_numeric($param1))) {
                    $cacheKey = $resource . '_' . $param1;
                    $obj = is_bool($param2) ? $param2 : false;
                    $ttl = is_int($param3) ? $param3 : 3600;

                    return $this->remember($cacheKey, function() use ($endpoint, $param1) {
                        return $this->request('GET', "{$endpoint}/{$param1}");
                    }, $obj, $ttl);
                }

                // Route C: Batch List Requests (e.g., getPages(true))
                $queryParams = is_array($param1) ? $param1 : [];
                $obj = is_array($param1) ? (is_bool($param2) ? $param2 : false) : (is_bool($param1) ? $param1 : false);
                $ttl = is_array($param1) ? (is_int($param3) ? $param3 : 3600) : (is_int($param2) ? $param2 : 3600);
                $cacheKey = $resource . '_list_' . md5(json_encode($queryParams));

                return $this->remember($cacheKey, function() use ($endpoint, $queryParams) {
                    return $this->request('GET', $endpoint, ['query' => $queryParams]);
                }, $obj, $ttl);

            case 'create':
                if (is_array($param1) && isset($param1['file_path'])) {
                    $filePath = $param1['file_path'];
                    $filename = $param1['file_name'] ?? basename($filePath);
                    $mimeType = $param1['file_type'] ?? mime_content_type($filePath);

                    if (!file_exists($filePath)) {
                        throw new \InvalidArgumentException("The target upload file does not exist: {$filePath}");
                    }

                    $multipartOptions = [
                        'multipart' => [
                            [
                                'name'     => 'file',
                                'contents' => fopen($filePath, 'r'),
                                'filename' => $filename,
                                'headers'  => ['Content-Type' => $mimeType]
                            ]
                        ]
                    ];

                    foreach ($param1 as $key => $value) {
                        if (in_array($key, ['file_path', 'file_name', 'file_type'])) {
                            continue;
                        }
                        $multipartOptions['multipart'][] = [
                            'name'     => $key,
                            'contents' => $value
                        ];
                    }

                    $response = $this->request('POST', $endpoint, $multipartOptions, $param2);
                    $this->invalidateResourceCache($resource);
                    return $response;
                }

                $response = $this->request('POST', $endpoint, ['json' => is_array($param1) ? $param1 : []], $param2);
                $this->invalidateResourceCache($resource);
                return $response;

            case 'update':
                $response = $this->request('PUT', "{$endpoint}/{$param1}", ['json' => is_array($param2) ? $param2 : []], $param3);
                $this->invalidateResourceCache($resource, $param1);
                return $response;

            case 'delete':
                $deleteOptions = [];
                if (is_array($param2)) {
                    $deleteOptions['query'] = $param2;
                }
                
                $tokenOverride = is_string($param2) ? $param2 : (is_string($param3) ? $param3 : null);

                $response = $this->request('DELETE', "{$endpoint}/{$param1}", $deleteOptions, $tokenOverride);
                $this->invalidateResourceCache($resource, $param1);
                return $response;
        }
    }

    /**
     * Polymorphic helper to fetch drafts for any resource type with pagination.
     * Usage example: WpApi::getDrafts('posts', 1, 10);
     */
    public function getDrafts(string $resourceType, int $page = 1, int $perPage = 20, bool $obj = false, int $ttl = 5) {
        $resource = $this->resolveResourceKey($resourceType);
        $methodName = 'get' . ucfirst($resource);

        return $this->executeRoutedRequest($methodName, [
            ['status' => 'draft', 'page' => $page, 'per_page' => $perPage], 
            $obj, 
            $ttl
        ]);
    }

    /**
     * Polymorphic helper to fetch trashed items for any resource type with pagination.
     * Usage example: WpApi::getTrash('pages', 2, 15);
     */
    public function getTrash(string $resourceType, int $page = 1, int $perPage = 20, bool $obj = false, int $ttl = 5) {
        $resource = $this->resolveResourceKey($resourceType);
        $methodName = 'get' . ucfirst($resource);

        return $this->executeRoutedRequest($methodName, [
            ['status' => 'trash', 'page' => $page, 'per_page' => $perPage], 
            $obj, 
            $ttl
        ]);
    }

    /**
     * Loops through all items currently in the trash for a resource type 
     * and permanently deletes them, bypassing the recycle bin constraint.
     */
    public function emptyTrash(string $resourceType): array {
        $resource = $this->resolveResourceKey($resourceType);
        $deleteMethod = 'delete' . ucfirst($this->singularize($resource));
        
        $results = [
            'success' => true,
            'deleted_ids' => [],
            'errors' => []
        ];

        // Fetch up to 100 items from the trash to process in this batch cycle
        $trashedItems = $this->getTrash($resource, 1, 100);

        if (empty($trashedItems) || !is_array($trashedItems)) {
            return $results;
        }

        foreach ($trashedItems as $item) {
            if (!isset($item->id)) {
                continue;
            }

            // Force permanent deletion by routing through your dynamic 'delete' block
            $response = $this->executeRoutedRequest($deleteMethod, [$item->id, ['force' => true]]);

            if ($response && isset($response->deleted) && $response->deleted === true) {
                $results['deleted_ids'][] = $item->id;
            } else {
                $results['success'] = false;
                $results['errors'][] = [
                    'id' => $item->id,
                    'message' => $response->message ?? 'Unknown permanent deletion error'
                ];
            }
        }

        return $results;
    }

    /**
     * Internal structural normalization helper to isolate mapping dictionary keys.
     */
    private function resolveResourceKey(string $resourceType): string {
        $resource = strtolower($resourceType);
        if (!isset(self::$allowedEndpoints[$resource]) && !isset(self::$customEndpoints[$resource])) {
            $resource = $this->pluralize($resource);
        }
        return $resource;
    }

    /**
     * Internal strict dictionary helper mapping your specific plural keys back to singular terms.
     */
    private function getSingularMapping(string $pluralWord): string {
        return $this->singularize($pluralWord);
    }

    /**
     * Advanced singularization helper addressing 'es' suffix conversions safely.
     */
    protected function singularize(string $word): string {
        $word = strtolower($word);
        if (str_ends_with($word, 'addresses')) return 'address';
        if (str_ends_with($word, 'categories')) return 'category';
        if (str_ends_with($word, 'ies')) return substr($word, 0, -3) . 'y';
        if (str_ends_with($word, 'es') && !str_ends_with($word, 'pages')) return substr($word, 0, -2);
        if (str_ends_with($word, 's') && !str_ends_with($word, 'ss')) return substr($word, 0, -1);
        return $word;
    }

    /**
     * Advanced pluralization mapping helper.
     */
    protected function pluralize(string $word): string {
        $word = strtolower($word);
        if ($word === 'address') return 'addresses';
        if ($word === 'category') return 'categories';
        if (str_ends_with($word, 'y')) return substr($word, 0, -1) . 'ies';
        if (str_ends_with($word, 's') || str_ends_with($word, 'ch') || str_ends_with($word, 'sh')) return $word . 'es';
        return $word . 's';
    }
}
