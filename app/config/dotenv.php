<?php
/**
 * Start loader configuration
 */

// Use composer autoloader to load vendor classes
require_once BASE_PATH . '/vendor/autoload.php';

/**
 * Environment variables
 */
$dotenv = (new josegonzalez\Dotenv\Loader(BASE_PATH . '/.env'))
    ->parse()
    ->toEnv();

/**
 * Include helpers
 */
include_once BASE_PATH . '/helpers.php';

/*
 * Debug
 */
if (env('APP_ENV') == 'dev') {
    $debug = new \Phalcon\Debug();
    $debug->listen();
}