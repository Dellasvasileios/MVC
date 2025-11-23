<?php
namespace Framework\Routing;

require_once BASE_PATH . 'Framework/Routing/IRouter.php';
use Framework\Routing\IRouter;

class Router implements IRouter
{
    private array $routes = [];


    public function add(string $method, string $route, string $controllerClass, string $action): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'route' => $route,
            'controller' => $controllerClass,
            'action' => $action
        ];
    }


    public function dispatch(string $method, string $url): string
    {
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            $params = $this->matchRoute($url, $route['route']);

            if ($params !== null) {
                $controllerClass = $route['controller'];
                $controller = new $controllerClass();
                $action = $route['action'];

                if (!empty($params)) {
                    return $controller->{$action}($params);
                }

                return $controller->{$action}();
            }
        }

         throw new \RuntimeException("No route found for METHOD: {$method} and URL: {$url}");

    }

    private function matchRoute(string $url, string $route): ?array
    {
        $pattern = $this->buildPattern($route);
        $paramNames = $this->extractParamNames($route);

        // for this caes /test/{id?} i want to return [id = null] if url is /test
        // e.g #^/posts(?:/([^/]+))?$#

        if (!preg_match($pattern, $url, $matches)) {
            return null;
        }

        array_shift($matches); // remove full match

        // normalize matches: empty string -> null
        $values = array_map(function ($m) {
            return $m === '' ? null : $m;
        }, $matches);

        // pad values if some optional groups were not present
        while (count($values) < count($paramNames)) {
            $values[] = null;
        }

        if (empty($paramNames)) {
            return [];
        }

        return array_combine($paramNames, $values) ?: [];
    }

    // php
    private function buildPattern(string $route): string
    {
        // handle segments like /{name?} -> required slash, optional capturing
        $pattern = preg_replace_callback(
            '/\/\{([a-zA-Z_][a-zA-Z0-9_]*)(\?)?\}/',
            function ($m) {
                $optional = isset($m[2]) && $m[2] === '?';
                // For optional params: require the leading slash, make the value optional
                return $optional ? '/(?:([^/]+))?' : '/([^/]+)';
            },
            $route
        );

        // handle leading parameter without slash: {name?} or {name}
        $pattern = preg_replace_callback(
            '/^\{([a-zA-Z_][a-zA-Z0-9_]*)(\?)?\}/',
            function ($m) {
                $optional = isset($m[2]) && $m[2] === '?';
                return $optional ? '(?:([^/]+))?' : '([^/]+)';
            },
            $pattern
        );
        return '#^' . $pattern . '$#';
    }




    private function extractParamNames(string $route): array
    {
        preg_match_all('/\{([a-zA-Z_][a-zA-Z0-9_]*)(\?)?\}/', $route, $matches);
        return $matches[1];
    }

}