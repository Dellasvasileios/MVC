<?php

use Framework\Routing\Router;

$router = new Router();

$router->add('GET', '/', 'Controllers\TestController', 'index');

$router->dispatch('GET', URL_PATH);


