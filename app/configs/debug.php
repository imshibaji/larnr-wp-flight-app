<?php

use Tracy\Debugger;
use flight\debug\tracy\TracyExtensionLoader;

// Enable Tracy
Debugger::enable();
// Debugger::enable(Debugger::DEVELOPMENT) // sometimes you have to be explicit (also Debugger::PRODUCTION)
// Debugger::enable('23.75.345.200'); // you can also provide an array of IP addresses

// This where errors and exceptions will be logged. Make sure this directory exists and is writable.
Debugger::$logDirectory = __DIR__ . '/../log/';
Debugger::$strictMode = true; // display all errors
// Debugger::$strictMode = E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED; // all errors except deprecated notices
if (Debugger::$showBar) {
    $app->set('flight.content_length', false); // if Debugger bar is visible, then content-length can not be set by Flight

    // This is specific to the Tracy Extension for Flight if you've included that
    // otherwise comment this out.
    new TracyExtensionLoader($app);
}