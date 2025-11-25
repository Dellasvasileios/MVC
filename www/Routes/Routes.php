<?php

use Framework\Routing\Router;
use Controllers\TestController;

$router = new Router();

$router->add('GET', '/', TestController::class, 'index');

$router->dispatch('GET', URL_PATH);


