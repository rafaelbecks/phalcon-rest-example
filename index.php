<?php

/*
REST API con Phalcon PHP
 */

use Phalcon\Mvc\Micro;
use \Phalcon\Http;

// Carga de clases

$loader = new \Phalcon\Loader();

$loader->registerDirs(array(
        'models',
        'controllers',
        "routes",
        "auth",
        "config"
        ));

$loader->register();

//Inyector de dependencias

$di = Configuracion::getDI();

$app = new \Phalcon\Mvc\Micro($di);

// Definición de rutas

$app->get('/', function () {
    echo "API REST";
});

$publicaciones = new PublicacionesRoutes($app);

$app->handle();

?>