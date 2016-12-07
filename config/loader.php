<?php

/**
 * Registering an autoloader
 *
 * namespace:首字母均大写.
 */
$loader = new \Phalcon\Loader();

$loader->registerNamespaces([
    "Labor\Serv\Share" => $config->application->modelsDir . 'share',
    "Labor\Serv\Bbs" => $config->application->modelsDir . 'bbs',
])->register();
