<?php

namespace Controllers;

use Framework\Controllers\IController;
require_once BASE_PATH . 'Framework/Controllers/IController.php';

use function Framework\Views\view;
require_once BASE_PATH . 'Framework/Views/helper_functions.php';

class TestController2 implements IController{

    function index(){
        return view('Test/index', ['data' => 'Hello World']);
    }

    function header(){
        return ['header_data' => 'This is test data for header'];
    }
}
