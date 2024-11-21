<?php
    $hostname = '127.0.0.1';
    $bancodedados = 'gerenciador';
    $usuario = 'root';
    $senha = '';

    $mysqli = new mysqli ("$hostname", "$usuario", "$senha", "$bancodedados");
    if($mysqli ->connect_error){
        echo "falha ao conectar:(" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
    }
    else
        echo "Conectado ao banco de dados";
?>