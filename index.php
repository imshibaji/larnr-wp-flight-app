<?php
require __DIR__ . '/vendor/autoload.php';

// Application bootstrap
require __DIR__ . '/app/configs/config.php';
require __DIR__ . '/app/configs/routes.php';
require __DIR__ . '/app/configs/debug.php';


// Start the app
Flight::start();