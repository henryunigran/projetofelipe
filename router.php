<?php

$routes = [];

function route($path, $callback) {
    global $routes;
    $routes[$path] = $callback;
}

function dispatch($requestedPath) {
    global $routes;

    if (array_key_exists($requestedPath, $routes)) {
        $routes[$requestedPath](); 
    } else {
        echo "404 - pagina nao encontrada";
    }
}