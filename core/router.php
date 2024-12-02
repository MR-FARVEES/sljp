<?php
require_once __DIR__ ."/request.php";
require_once __DIR__ ."/error.php";

class Router {
    private $routes = [];
    private $middlewares = [];

    public function addRoute($method, $path, $callback, $middleware = null) {
        $this->routes[strtolower($method)][$path] = $callback;
        if ($middleware !== null) {
            $this->middlewares[strtolower($method)][$path] = $middleware;
        }
    }

    public function resolveRoute(Request $request) {
        $method = $request->getMethod();
        $path = $request->getPath();
        $error = new ErrorHandler();

        if (isset($this->routes[$method][$path])) {
            if (isset($this->middlewares[$method][$path])) {
                $middleware = $this->middlewares[$method][$path];
                $mclass = new $middleware[0]();
                $mmethod = $middleware[1];
                call_user_func([$mclass, $mmethod]);
            }

            $callback = $this->routes[$method][$path];
            $class = new $callback[0]();
            $method = $callback[1];
            return call_user_func([$class, $method]);
        } else {
            $error->handle(404);
        }
    }
}