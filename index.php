<?php
require 'routes/router.php';


route('/', function() {
    echo "bem-vindo a pagina inicial";
});

route('/sobre', function() {
    echo "esta e a pagina sobre.";
});

route('/contato', function() {
    echo "pagina de contato.";
});


$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


dispatch($requestedPath);