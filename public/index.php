<?php

use Phalcon\Mvc\Micro;

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

    include APP_PATH . "/vendor/autoload.php";

    /**
     * Read the configuration
     */
    $config = new \Phalcon\Config\Adapter\Ini(__DIR__ . "/../config/config.ini");

    /** 
     * Error level control.
     */
    $const_error_level = $config->env->debug ? E_ALL : E_ALL &~ E_NOTICE;
    error_reporting($const_error_level);

    /**
     * Include Services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Router Handle.
     */
    $router = $di['router'];
    $router->handle();

    /**
     * Starting Yar Server.
     */
    $servable = include APP_PATH . '/config/regist_service.php';

    $module = $router->getControllerName();

    if ( in_array( $module, array_keys($servable) ) ) {

        $accessable = array_keys($servable[$module]);
        $serv = $router->getActionName();
        
        if ( in_array( $serv, $accessable ) ) {
            $yar = new Yar_Server( new $servable[$module][$serv] );
            $yar->handle();
        } else {
            $notice = "Serv: {$serv} not exists!";
        }
    } else {
        $notice = "Module: {$module} not exists!";
    }

    if ( isset($notice) ) {
        echo $notice;
    }

} catch (\Exception $e) {

    $formatter = new \Phalcon\Logger\Formatter\Line("[%date%][%type%][%message%]", "Y-m-d H:i:s");
    $base_dir = APP_PATH . '/' . trim($config->application->logsDir, '/') . '/';
    if (! is_dir($base_dir)) {
        mkdir($base_dir);
    }
    $file = $base_dir . 'exception.log';
    $logger = new \Phalcon\Logger\Adapter\File($file);
    $logger->setFormatter($formatter);
    $logger->error($e->getMessage());
    $logger->error($e->getTraceAsString() );

    if (! $config->env->debug) {
        (new \Phalcon\Http\Response())->setJsonContent([
            'data' => '',
            'status' => 500,
            'msg' => $e->getMessage(),
        ])->send();
    } else {
        echo $e->getMessage() . '<br>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    }
}
