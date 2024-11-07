<?php
require 'routes/router.php';


route('/', function() {
    echo "Bem-vindo à página inicial!";
});

route('/sobre', function() {
    echo "Esta é a página sobre.";
});

route('/contato', function() {
    echo "Página de contato.";
});


$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


dispatch($requestedPath);