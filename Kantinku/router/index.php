<?php

class FileRouter
{
    private $routes = [];

    public function addRoute($method, $url, $callback)
    {
        $this->routes[] = ['method' => $method, 'url' => $url, 'callback' => $callback];
    }

    public function dispatch()
    {
        $requestedMethod = $_SERVER['REQUEST_METHOD'];
        $requestedUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && $route['url'] === $requestedUrl) {
                $GLOBALS['current_route'] = $requestedUrl;
                call_user_func($route['callback']);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
    }
}
?>
