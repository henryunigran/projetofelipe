<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

require_once '../controllers/AlunoController.php';
require_once '../controllers/NotasController.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$requestUri = explode('?', $requestUri)[0];

$alunoController = new AlunoController();
$notasController = new NotasController();

switch (true) {

    case $requestUri === '/api/alunos' && $requestMethod === 'GET':
        $alunoController->getAllAlunos();
        break;

    case $requestUri === '/api/alunos' && $requestMethod === 'POST':
        $alunoController->createAluno();
        break;

    case preg_match('/\/api\/alunos\/(\d+)/', $requestUri, $matches) && $requestMethod === 'GET':
        $id = $matches[1];
        $alunoController->getAlunoById($id);
        break;

    case preg_match('/\/api\/alunos\/(\d+)/', $requestUri, $matches) && $requestMethod === 'PUT':
        $id = $matches[1];
        $alunoController->updateAluno($id);
        break;

    case preg_match('/\/api\/alunos\/(\d+)/', $requestUri, $matches) && $requestMethod === 'DELETE':
        $id = $matches[1];
        $alunoController->deleteAluno($id);
        break;


    case $requestUri === '/api/notas' && $requestMethod === 'GET':
        $notasController->getAllNotas();
        break;

    case $requestUri === '/api/notas' && $requestMethod === 'POST':
        $notasController->createNota();
        break;

    case preg_match('/\/api\/notas\/(\d+)/', $requestUri, $matches) && $requestMethod === 'GET':
        $id = $matches[1];
        $notasController->getNotaById($id);
        break;

    case preg_match('/\/api\/notas\/(\d+)/', $requestUri, $matches) && $requestMethod === 'PUT':
        $id = $matches[1];
        $notasController->updateNota($id);
        break;

    case preg_match('/\/api\/notas\/(\d+)/', $requestUri, $matches) && $requestMethod === 'DELETE':
        $id = $matches[1];
        $notasController->deleteNota($id);
        break;


    default:
        header("HTTP/1.0 404 Not Found");
        echo json_encode(["message" => "Rota não encontrada"]);
        break;
}
