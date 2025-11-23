<?php

namespace Controllers;

use Framework\Controllers\IController;
require_once BASE_PATH . 'Framework/Controllers/IController.php';

use function Framework\Views\view;
require_once BASE_PATH . 'Framework/Views/helper_functions.php';

class TestController implements IController{

    function index(){
        return view('Test/index', ['data' => 'Hello World']);
    }
}
