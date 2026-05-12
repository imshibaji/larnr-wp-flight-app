<?php
function view($name, $data = []) {
    $templates = new League\Plates\Engine(__DIR__ . '/../views');
    echo $templates->render($name, $data);
}

function url($path) {
    // Determine scheme (http or https)
    $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    
    // Get host (domain.com)
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    // Ensure path doesn't have a leading slash to avoid double slashes //
    $path = ltrim($path, '/');

    return "{$scheme}://{$host}/{$path}";
}

function asset($path, $assetPath = 'assets') {
    // Determine scheme (http or https)
    $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    
    // Get host (domain.com)
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    // Ensure path doesn't have a leading slash to avoid double slashes //
    $path = ltrim($path, '/');

    return "{$scheme}://{$host}/{$assetPath}/{$path}";
}

function css($path, $assetPath = 'assets') {
    return '<link rel="stylesheet" type="text/css" href="' . asset($path, $assetPath) . '">';
}

function js($path, $assetPath = 'assets') {
    return '<script src="' . asset($path, $assetPath) . '"></script>';
}

function fonts($path, $assetPath = 'assets') {
    return '<link rel="stylesheet" type="text/css" href="' . asset($path, $assetPath) . '">';
}

function image($path, $attrs=[], $assetPath = 'assets') {
    $attr = '';
    foreach ($attrs as $key => $value) {
        $attr .= ' ' . $key . '="' . $value . '"';
    }
    return '<img src="' . asset($path, $assetPath) . '"' . $attr . '>';
}

function csrf_field() {
    return '<input type="hidden" name="_token" value="' . csrf_token() . '">';
}

function active_url($path, $activeClass = 'active') {
    return (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $path) ? $activeClass : '';
}

function dd($data) {
    dump($data);
    exit;
}

function flash($name, $message) {
    if (isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
    }
    $_SESSION[$name] = $message;
}

function old($name) {
    return $_SESSION[$name] ?? null;
}

function error($name) {
    return $_SESSION[$name] ?? null;
}

function redirect($url, $refresh = false) {
    $url = url($url).($refresh ? '?refresh=1' : '');
    header('Location: ' . $url);
    exit;
}

function csrf_token() {
    return bin2hex(random_bytes(16));
}

function begin_session() {
    // Auto-start session if not already active
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // If ?clear_all=1 is passed, wipe all WP cache keys
    if (isset($_GET['clear_all'])) {
        foreach ($_SESSION as $key => $value) {
            if (strpos($key, 'cache_') === 0) unset($_SESSION[$key]);
        }
    }
}

function remember($key, $callback, $ref=false, $ttl = 3600) {
    $now = time();
    $cacheKey = 'cache_' . $key;

    // Check if ?refresh=1 is in the URL to bypass cache
    $forceRefresh = isset($_GET['refresh']) && $_GET['refresh'] == '1';

    // Check if ?flush=1 is in the URL to flush cache
    if (isset($_GET['flush']) && $_GET['flush'] == '1') {
        flushCache();
    }

    // If not forcing refresh, check if session exists and is valid (1 hour)
    if (!$forceRefresh && isset($_SESSION[$cacheKey])) {
        $cache = $_SESSION[$cacheKey];
        if (($now - $cache['created_at']) < $ttl) {
            // FIX: Respect $ref even when returning from cache
            return $ref ? (object) $cache : $cache['data'];
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

    return $ref ? (object) $cacheData : $data;
}

function flushCache() {
    foreach ($_SESSION as $key => $value) {
        if (strpos($key, 'cache_') === 0) {
            unset($_SESSION[$key]);
        }
    }
}