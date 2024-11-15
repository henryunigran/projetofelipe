<?php
require 'routes/router.php';


route('/', function() {
    echo "bem-vindo";
});

route('/gerenciamento', function() {
    include "index.html";
});

route('/registro', function() {
    include 'registro_notas.html';
});


$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


dispatch($requestedPath);