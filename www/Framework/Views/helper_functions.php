<?php
namespace Framework\Views;

function view(string $view_name, array $data)
{
    $view = new View();
    echo $view->get_view($view_name, $data);
}

function render_layout(string $layout_name, array $data , $controller = '' , $action = '')
{
    if (!empty($controller) && !empty($action)) {
        $controllerClass = ltrim($controller, '\\');

        try {
            if (class_exists($controllerClass)) {
                $ctrl = new $controllerClass();

                if (method_exists($ctrl, $action)) {
                    $result = $ctrl->{$action}();

                    if (is_array($result)) {
                        $data = array_merge($data, $result);
                    }
                }

            }
        } catch (\Throwable $e) {
        }
    }
    $view = new View();
    echo $view->get_view($layout_name, $data);
}

