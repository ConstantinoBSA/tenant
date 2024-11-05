<?php

class Router
{
    protected $routes = [];

    public function add($method, $uri, $action)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => trim($uri, '/'),
            'action' => $action
        ];
    }

    public function dispatch($requestUri, $requestMethod)
    {
        $uri = trim(parse_url($requestUri, PHP_URL_PATH), '/');
        $method = strtoupper($requestMethod);

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                if (is_callable($route['action'])) {
                    return call_user_func($route['action']);
                } elseif (is_string($route['action'])) {
                    return $this->executeAction($route['action']);
                }
            }
        }

        http_response_code(404);
        echo "Página não encontrada.";
    }

    protected function executeAction($action)
    {
        list($controller, $method) = explode('@', $action);
        $controller = "App\\Controllers\\{$controller}";
        
        if (class_exists($controller)) {
            $controllerInstance = new $controller();
            if (method_exists($controllerInstance, $method)) {
                return $controllerInstance->$method();
            }
        }

        http_response_code(404);
        echo "Controlador ou método não encontrado.";
    }
}
