<?php


function route($path, $callback)
{
    global $routes; 
    $routes[$path] = $callback;
}


function dispatch($path)
{
    global $routes;

    if (isset($routes[$path])) {

        $routes[$path]();
    } else {

        http_response_code(404);
        echo "Página não encontrada!";
    }
}


$routes = [];


route('/', function() {
    echo "Bem-vindo ao site!";
});

route('/gerenciamento', function() {
    include "index.html";
});

route('/registro', function() {
    include 'registro_notas.html'; 
});

$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


dispatch($requestedPath);
