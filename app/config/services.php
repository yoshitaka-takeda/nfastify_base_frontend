<?php
declare(strict_types=1);

use Phalcon\Escaper;
use Phalcon\Flash\Session as Flash;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;
use Phalcon\Url as UrlResolver;

use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;

use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream as LogStream;
use Phalcon\Logger\Formatter\Line;
use Phalcon\Logger\Exception as LogException;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'path' => $config->application->cacheDir,
                'separator' => '_'
            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    return new $class($params);
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    $session = new SessionManager();
    $files = new SessionAdapter(
        [
            // 'savePath' => sys_get_temp_dir(),
            'savePath' => BASE_PATH . '/tmp/',
        ]
    );
    $session->setAdapter($files);
    
    $escaper = new Escaper();
    $flash = new Flash($escaper,$session);
    // $flash->setImplicitFlush(false);
    // $flash->setCssClasses([
    //     'error'   => 'alert alert-danger',
    //     'success' => 'alert alert-success',
    //     'notice'  => 'alert alert-info',
    //     'warning' => 'alert alert-warning'
    // ]);

    return $flash;
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionManager();

    $files = new SessionAdapter([
        'savePath' => BASE_PATH . '/tmp/sessions/',
    ]);
    $session->setAdapter($files);
    $session->start();

    return $session;
});

$di->set('dispatcher',
    function () {
        // Create an event manager
        $eventsManager = new EventsManager();

        // Attach a listener for type 'dispatch'
        $eventsManager->attach(
            'dispatch:beforeExecuteRoute',
            function (Event $event, $dispatcher) {
                // ...
                // echo "<pre>";
                // print_r($this->getShared('session'));
                // echo "</pre>";
                // $__session=$this;
                // $__session->getShared('session')->setName('bmm_auction');
                // echo "<pre>";
                // print_r($__session->getShared('session')->status());
                // echo "</pre>";
                // echo "<pre>";
                // print_r($_SESSION);
                // echo "</pre>";echo "<pre>";
                // print_r($__session->getShared('session')->getName());
                // echo "</pre>";
                // die;
            }
        );

        $eventsManager->attach(
            'dispatch:beforeDispatch',
            function (Event $event, $dispatcher) {
                $controller = $dispatcher->getActiveController();
            }
        );

        $eventsManager->attach(
            'dispatch:beforeException',
            function (Event $event, $dispatcher, $exception) {

                echo "<pre>";
                print_r($exception);
                echo "</pre>";

                if ($exception instanceof DispatchException) {
                    // $dispatcher->forward(
                    //     [
                    //         'controller' => 'index',
                    //         'action'     => 'fourOhFour',
                    //     ]
                    // );

                    // return false;
                    echo "Whoops";
                    die;
                    return false;
                }
            }
        );

        $dispatcher = new MvcDispatcher();

        // Bind the eventsManager to the view component
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    },
    true
);

$di->set('logger', function () {
    $formatter = new Line();
    $formatter->setDateFormat('Y-m-d H:i:s O');
    $log_file = BASE_PATH . '/tmp/logs/main.log';

    if(!is_file($log_file)){
        //Some simple example content.
        $contents = '';
        //Save our content to the file.
        file_put_contents($log_file, $contents);
    }

    $adapter = new LogStream($log_file);
    $adapter->setFormatter($formatter);

    $logger  = new Logger(
        'messages',
        [
            'main' => $adapter,
        ]
    );

    return $logger;
});


$di->set('exception_logger', function () {
    $formatter = new Line();
    $formatter->setDateFormat('Y-m-d H:i:s O');
    $log_file = BASE_PATH . '/tmp/logs/mexception.log';

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

    return $elogger;
},true);
