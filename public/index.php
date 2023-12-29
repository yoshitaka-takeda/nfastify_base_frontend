<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream as LogStream;
use Phalcon\Logger\Formatter\Line;
use Phalcon\Logger\Exception as LogException;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';

    $response=new Phalcon\Http\Response();

    echo "<pre>";
    //print_r($response);
    // print_r($_SERVER['HTTP_HOST']);
    // print_r($_SERVER);
    //$_SERVER['REQUEST_URI']=$_SERVER['HTTP_REFERER'];
    //print_r($response->redirect());

    $session = new Phalcon\Session\Manager();
    $files = new Phalcon\Session\Adapter\Stream([
        'savePath' => BASE_PATH . '/tmp/sessions/',
    ]);
    $session->setAdapter($files);
    $session->start();
    $_SESSION['route_not_found']=$_SERVER['REQUEST_URI'].' reached <strong>404</strong> miles';

    // print_r($_SESSION);
    echo "</pre>";

    $formatter = new Line();
    $formatter->setDateFormat('Y-m-d H:i:s O');
    $log_file = BASE_PATH . '/tmp/logs/exception.log';

    if(!is_file($log_file)){
        //Some simple example content.
        $contents = '';
        //Save our content to the file.
        file_put_contents($log_file, $contents);
    }

    $adapter = new LogStream($log_file);
    $adapter->setFormatter($formatter);

    $elogger  = new Logger(
        'messages',
        [
            'main' => $adapter,
        ]
    );

    $elogger->log(Logger::CRITICAL,$e);

    $response->redirect('/', true, 301)->send();
}
