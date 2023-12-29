<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

require BASE_PATH .'/vendor/autoload.php';

use Phalcon\Config;
use josegonzalez\Dotenv\Loader;

$loader = (new josegonzalez\Dotenv\Loader(BASE_PATH . '/.env'))
    ->parse()
    ->toEnv(true);

$modConfig = new \Phalcon\Config([
    'app_date' => ($_ENV['APP_DATE'])?:date('Y'),
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => $_ENV['DB_HOST'],
        'username'    => $_ENV['DB_USERNAME'],
        'password'    => $_ENV['DB_PASSWORD'],
        'dbname'      => 'test',
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
    ]
]);

return $modConfig;