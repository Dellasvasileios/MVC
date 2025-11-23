<?php

use Framework\Routing\Router;

require_once BASE_PATH . "Framework/Routing/Router.php";
require_once BASE_PATH . "Controllers/TestController.php";

$router = new Router();

$router->add('GET', '/', 'Controllers\TestController', 'index');

echo $router->dispatch('GET', URL_PATH);


