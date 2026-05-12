<?php
use flight\Cache;

/**********************************************
 *         Application Environment            *
 **********************************************/
// Set your timezone (e.g., 'America/New_York', 'UTC')
date_default_timezone_set('Asia/Kolkata');

// Error reporting level (E_ALL recommended for development)
error_reporting(E_ALL);

// Character encoding
if (function_exists('mb_internal_encoding') === true) {
	mb_internal_encoding('UTF-8');
}

// Default Locale Change as needed or feel free to remove.
if (function_exists('setlocale') === true) {
	setlocale(LC_ALL, 'en_US.UTF-8');
}

/**********************************************
 *           FlightPHP Core Settings          *
 **********************************************/

// Get the $app var to use below
if (empty($app) === true) {
	$app = Flight::app();
}

// Refer to this constant to get the project root directory
define('PROJECT_ROOT', __DIR__ . '/../..');

// This autoloads your code in the app directory so you don't have to require_once everything
// You'll need to namespace your classes with "app\folder\" to include them properly
$app->path(PROJECT_ROOT);

// You pass the directory the cache will be stored in into the constructor
$app->register('cache', Cache::class, [ __DIR__ . '/../cache/' ], function(Cache $cache) {

    // This ensures that the cache is only used when in production mode
    // ENVIRONMENT is a constant that is set in your bootstrap file or elsewhere in your app
    $cache->setDevMode(ENVIRONMENT === 'development');
});

// 1. Register Plates as the template engine
// We use the instance $app to keep everything scoped correctly
$app->register('view', 'League\Plates\Engine', [__DIR__ . '/../views']);

// 2. Map the render method to use Plates
// Overriding the default render with the Plates engine
$app->map('render', function($template, $data = []) use ($app) {
    echo $app->view()->render($template, $data);
});

// 3. Map the notFound method
$app->map('notFound', function() use ($app) {
  // Display custom 404 page
  $app->render('errors/404');
});

// 4. Map the error method
$app->map('error', function(Throwable $ex) use ($app) {
    $app->log()->error($ex->getMessage());
    // Display custom error page
    $app->render('errors/500');
});

// 5. Map the exception method
$app->map('exception', function(Throwable $ex) use ($app) {
    $app->log()->error($ex->getMessage());
    // Display custom error page
    $app->render('errors/500');
});

// 6. Map the notAllowed method
$app->map('notAllowed', function() use ($app) {
    // Display custom error page
    $app->render('errors/403');
});

$app->set('flight.base_url', '/');
$app->set('flight.case_sensitive', false);
$app->set('flight.log_errors', true);
$app->set('flight.handle_errors', false);
$app->set('flight.views.path', __DIR__ . '/../views');
$app->set('flight.views.extension', '.php');
$app->set('flight.content_length', false);
$app->set('csp_nonce', bin2hex(random_bytes(16)));
$app->set('flight.debug', true);


return [
    'runway' => [
        'app_root' => 'app/',
        'public_root' => '/',
    ],
];