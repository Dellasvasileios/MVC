<?php

define('BASE_PATH', __DIR__ . '/');

define('URL_PATH', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


require_once __DIR__ . '/Routes/Routes.php';


