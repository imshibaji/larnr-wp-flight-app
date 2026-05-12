<?php
namespace App\Utils;

use GuzzleHttp\Client;

class WpApi {
    private static $instance = null;
    protected String $url = 'https://larnr.com';
    protected Client $client;
    public function __construct() {
        $this->client = new Client();
        // Auto-start session if not already active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // If ?clear_all=1 is passed, wipe all WP cache keys
        if (isset($_GET['clear_all'])) {
            foreach ($_SESSION as $key => $value) {
                if (strpos($key, 'wp_api_') === 0) unset($_SESSION[$key]);
            }
        }
    }

    protected function tokenVerify($token) {
        $response = $this->client->post($this->url.'/wp-json/jwt-auth/v1/token/validate', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ]
        ]);
        $token = json_decode($response->getBody()->getContents());
        return $token;
    }

    protected function login($username, $password) {
        $response = $this->client->post($this->url.'/wp-json/jwt-auth/v1/token', [
            'form_params' => [
                'username' => $username,
                'password' => $password
            ]
        ]);
        $token = json_decode($response->getBody()->getContents());
        return $token;
    }

    protected function me($token) {
        $response = $this->client->get($this->url.'/wp-json/wp/v2/users/me?context=edit', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ]
        ]);
        $user = json_decode($response->getBody()->getContents());
        return $user;
    }

    protected function register($username, $email, $password, $role) {
        $response = $this->client->post($this->url.'/wp-json/wp/v2/users', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
            'form_params' => [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role ?? 'subscriber',
            ]
        ]);
        $token = json_decode($response->getBody()->getContents());
        return $token;
    }

    protected function getPages($obj=false, $ttl=3600) {
        return $this->remember('pages', function() {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/pages');
            $pages = json_decode($response->getBody()->getContents());
            return $pages;
        }, $obj, $ttl);
    }

    protected function getPage($id, $obj=false, $ttl=3600) {
        return $this->remember('page_'.$id, function() use ($id) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/pages/'.$id);
            $page = json_decode($response->getBody()->getContents());
            return $page;
        }, $obj, $ttl);
    }

    protected function getPageBySlug($slug, $obj=false, $ttl=3600) {
        return $this->remember('page_slug_'.$slug, function() use ($slug) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/pages?slug='.$slug);
            $page = json_decode($response->getBody()->getContents());
            return $page;
        }, $obj, $ttl);
    }

    protected function createPage($data) {
        $response = $this->client->post($this->url.'/wp-json/wp/v2/pages', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
            'form_params' => $data
        ]);
        $page = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $page;
    }

    protected function updatePage($id, $data) {
        $response = $this->client->put($this->url.'/wp-json/wp/v2/pages/'.$id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
            'form_params' => $data
        ]);
        $page = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $page;
    }

    protected function deletePage($id) {
        $response = $this->client->delete($this->url.'/wp-json/wp/v2/pages/'.$id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ]
        ]);
        $page = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $page;
    }

    protected function getCategories($obj=false, $ttl=3600) {
        return $this->remember('categories', function() {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/categories');
            $categories = json_decode($response->getBody()->getContents());
            return $categories;
        }, $obj, $ttl);
    }

    protected function getCategory($id, $obj=false, $ttl=3600) {
        return $this->remember('category_'.$id, function() use ($id) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/categories/'.$id);
            $category = json_decode($response->getBody()->getContents());
            return $category;
        }, $obj, $ttl);
    }

    protected function getCategoriesBySlug($slug, $obj=false, $ttl=3600) {
        return $this->remember('category_slug_'.$slug, function() use ($slug) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/categories?slug='.$slug);
            $category = json_decode($response->getBody()->getContents());
            return $category;
        }, $obj, $ttl);
    }

    protected function createCategory($data) {
        $response = $this->client->post($this->url.'/wp-json/wp/v2/categories', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
            'form_params' => $data
        ]);
        $category = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $category;
    }

    protected function updateCategory($id, $data) {
        $response = $this->client->put($this->url.'/wp-json/wp/v2/categories/'.$id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
            'form_params' => $data
        ]);
        $category = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $category;
    }

    protected function deleteCategory($id) {
        $response = $this->client->delete($this->url.'/wp-json/wp/v2/categories/'.$id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ]
        ]);
        $category = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $category;
    }

    protected function getTags($obj=false, $ttl=3600) {
        return $this->remember('tags', function() {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/tags');
            $tags = json_decode($response->getBody()->getContents());
            return $tags;
        }, $obj, $ttl);
    }

    protected function getTag($id, $obj=false, $ttl=3600) {
        return $this->remember('tag_'.$id, function() use ($id) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/tags/'.$id);
            $tag = json_decode($response->getBody()->getContents());
            return $tag;
        }, $obj, $ttl);
    }

    protected function getTagsBySlug($slug, $obj=false, $ttl=3600) {
        return $this->remember('tag_slug_'.$slug, function() use ($slug) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/tags?slug='.$slug);
            $tag = json_decode($response->getBody()->getContents());
            return $tag;
        }, $obj, $ttl);
    }

    protected function createTag($data) {
        $response = $this->client->post($this->url.'/wp-json/wp/v2/tags', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
            'form_params' => $data
        ]);
        $tag = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $tag;
    }

    protected function updateTag($id, $data) {
        $response = $this->client->put($this->url.'/wp-json/wp/v2/tags/'.$id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
            'form_params' => $data
        ]);
        $tag = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $tag;
    }

    protected function deleteTag($id) {
        $response = $this->client->delete($this->url.'/wp-json/wp/v2/tags/'.$id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ]
        ]);
        $tag = json_decode($response->getBody()->getContents());
        $this->flushCache();
        return $tag;
    }

    protected function getPosts($obj=false, $ttl=3600) {
        return $this->remember('posts', function() {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/posts');
            $posts = json_decode($response->getBody()->getContents());
            return $posts;
        }, $obj, $ttl);
    }

    protected function getPost($id, $obj=false, $ttl=3600) {
        return $this->remember('post_'.$id, function() use ($id) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/posts/'.$id);
            $post = json_decode($response->getBody()->getContents());
            return $post;
        }, $obj, $ttl);
    }

    protected function getPostBySlug($slug, $obj=false, $ttl=3600) {
        return $this->remember('post_slug_'.$slug, function() use ($slug) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/posts?slug='.$slug);
            $post = json_decode($response->getBody()->getContents());
            return $post;
        }, $obj, $ttl);
    }

    protected function getComments($id, $obj=false, $ttl=3600) {
        return $this->remember('comments_'.$id, function() use ($id) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/posts/'.$id.'/comments');
            $comments = json_decode($response->getBody()->getContents());
            return $comments;
        }, $obj, $ttl);
    }

    protected function getUsers($obj=false, $ttl=3600) {
        return $this->remember('users', function() {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/users');
            $users = json_decode($response->getBody()->getContents());
            return $users;
        }, $obj, $ttl);
    }

    protected function getUser($id, $obj=false, $ttl=3600) {
        return $this->remember('user_'.$id, function() use ($id) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/users/'.$id);
            $user = json_decode($response->getBody()->getContents());
            return $user;
        }, $obj, $ttl);
    }

    protected function getUserBySlug($slug, $obj=false, $ttl=3600) {
        return $this->remember('user_slug_'.$slug, function() use ($slug) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/users?slug='.$slug);
            $user = json_decode($response->getBody()->getContents());
            return $user;
        });
    }

    protected function getCustomPosts($type, $obj=false, $ttl=3600) {
        return $this->remember('custom_posts_'.$type, function() use ($type) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/'.$type);
            $posts = json_decode($response->getBody()->getContents());
            return $posts;
        }, $obj, $ttl);
    }

    protected function getCustomPost($type, $id='', $obj=false, $ttl=3600) {
        return $this->remember('custom_post_'.$type.'_'.$id, function() use ($type) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/'.$type.'/'.$id);
            $posts = json_decode($response->getBody()->getContents());
            return $posts;
        }, $obj, $ttl);
    }

    protected function getAddresses($obj = false, $ttl = 3600) {
        return $this->remember('addresses', function() {
            $response = $this->client->get($this->url.'/wp-json/app/v1/address');
            $address = json_decode($response->getBody()->getContents());
            return $address;
        }, $obj, $ttl);
    }

    protected function getAddress($id, $obj=false, $ttl=3600) {
        return $this->remember('address_'.$id, function() use ($id) {
            $response = $this->client->get($this->url.'/wp-json/app/v1/address/'.$id);
            $address = json_decode($response->getBody()->getContents());
            return $address;
        }, $obj, $ttl);
    }

    protected function graphql($query, $obj=false, $ttl=3600) {
        // Use a hash of the query as the cache key
        return $this->remember('gql_' . md5($query), function() use ($query) {
            $response = $this->client->post($this->url.'/graphql', [
                'json' => ['query' => $query]
            ]);
            return json_decode($response->getBody()->getContents());
        }, $obj, $ttl);
    }

    protected function getMedia($id, $obj=false, $ttl=3600) {
        return $this->remember('media_'.$id, function() use ($id) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/media/'.$id);
            $media = json_decode($response->getBody()->getContents());
            return $media;
        }, $obj, $ttl);
    }

    protected function getMediaBySlug($slug, $obj=false, $ttl=3600) {
        return $this->remember('media_slug_'.$slug, function() use ($slug) {
            $response = $this->client->get($this->url.'/wp-json/wp/v2/media?slug='.$slug);
            $media = json_decode($response->getBody()->getContents());
            return $media;
        }, $obj, $ttl);
    }

    protected function getRankMathData($link, $obj=false, $ttl=3600) {
        return $this->remember('rank_math_data-'.$link, function() use ($link) {
            $response = $this->client->get($this->url . '/wp-json/rankmath/v1/getHead', [
                'query' => ['url' => $link]
            ]);
        
            // Correct way to get the string content before decoding
            $body = $response->getBody()->getContents();
            return json_decode($body);
        }, $obj, $ttl);
    }

    protected function fetch($url, $args = [
        'method' => 'GET',
        'body' => null,
        'headers' => [],
        'query' => [],
        'params' => [],
        'files' => []
    ], $obj=false, $ttl=3600) {
        return $this->remember('fetch_'.$url, function() use ($url, $args) {
            $response = $this->client->request($method, $url, [
                'query' => $args['query'],
                'body' => $args['body'],
                'headers' => $args['headers'],
                'form_params' => $args['params'],
                'multipart' => $args['files']
            ]);
            $data = json_decode($response->getBody()->getContents());
            return $data;
        }, $obj, $ttl);
    }

    // This handles: WpApi::fetchData('...')
    public static function __callStatic($name, $arguments) {
        $instance = self::init();
        return $instance->$name(...$arguments);
    }

    // This handles: $wpApi->fetchData('...')
    public function __call($name, $arguments) {
        return $this->$name(...$arguments);
    }

    public static function init() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Cache logic using PHP Sessions
     */
    private function remember($key, $callback, $obj=false, $ttl = 3600) {
        $now = time();
        $cacheKey = 'wp_api_' . $key;

        // Check if ?refresh=1 is in the URL to bypass cache
        $forceRefresh = isset($_GET['refresh']) && $_GET['refresh'] == '1';

        // Check if ?flush=1 is in the URL to flush cache
        if (isset($_GET['flush']) && $_GET['flush'] == '1') {
            $this->flushCache();
        }

        // If not forcing refresh, check if session exists and is valid (1 hour)
        if (!$forceRefresh && isset($_SESSION[$cacheKey])) {
            $cache = $_SESSION[$cacheKey];
            if (($now - $cache['created_at']) < $ttl) {
                // FIX: Respect $ref even when returning from cache
                return $obj ? (object) $cache : $cache['data'];
            }
        }

        // Fetch fresh data
        $data = $callback();

        // Store data + timestamp in session
        $cacheData = [
            'created_at' => $now,
            'data' => $data
        ];
        $_SESSION[$cacheKey] = $cacheData;

        return $obj ? (object) $cacheData : $data;
    }

    protected function flushCache() {
        foreach ($_SESSION as $key => $value) {
            if (strpos($key, 'wp_api_') === 0) {
                unset($_SESSION[$key]);
            }
        }
    }
}