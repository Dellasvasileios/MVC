<?php

use function Framework\Views\render_layout;

render_layout('/layout/header', [] , 'Controllers\TestController2' , 'header');


echo "<h1>$data</h1>";

render_layout('/layout/footer', []);
