<?php
namespace Framework\Views;

// Helper functions for rendering views
// Usage: view('view_name', ['data_key' => 'data_value']);
// works the same as IView->get_view('view_name', ['data_key' => 'data_value']);
function view(string $view_name, array $data)
{
    $view = new View();
    echo $view->get_view($view_name, $data);
}

/* Renders a layout with optional direct pass of data as an associative array and
 * optional execution of a specified controller class, with its action method and parameters
 * as an associative array
 *
 * @param string $layout_name The name of the layout to render can contain subfolders using / notation
 * @param array $data  optional Data to be passed to the layout
 * @param string $controller Optional controller class name TestController::class
 * @param string $action Optional action method name
 * @param array $params Optional parameters to pass to the action method as associative array
 * the result of the controller execution is expected to be an associative array that will be merged with $data the second parameter
 * be carefully the data to be merged should have different keys to avoid overwriting
 */
function render_layout(string $layout_name, array $data=[] , $controller = '' , $action = '' , $params = [])
{
    if (!empty($controller) && !empty($action)) {
        $controllerClass = ltrim($controller, '\\');

        try {
            if (class_exists($controllerClass)) {
                $ctrl = new $controllerClass();

                if (method_exists($ctrl, $action)) {

                    if(is_array($params) && !empty($params)){
                        $result = $ctrl->{$action}($params);
                    }
                    else{
                        $result = $ctrl->{$action}();
                    }

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

