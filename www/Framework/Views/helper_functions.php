<?php
namespace Framework\Views;

require_once BASE_PATH . 'Framework/Views/View.php';

function view(string $view_name, array $data): string
{
    $view = new View();
    return $view->get_view($view_name, $data);
}
