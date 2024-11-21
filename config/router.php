<?php

class Router
{
    private $routes = [];

    public function addRoute(string $method, string $path, callable $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }


    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = explode('?', $_SERVER['REQUEST_URI'])[0];

        foreach ($this->routes as $route) {
            $pathPattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route['path']);
            $pathPattern = str_replace('/', '\/', $pathPattern);

            if ($route['method'] === $requestMethod && preg_match('/^' . $pathPattern . '$/', $requestUri, $matches)) {
                array_shift($matches); 
                return call_user_func_array($route['handler'], $matches);
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo json_encode(["message" => "Rota não encontrada"]);
        exit();
    }
}
