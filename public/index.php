<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';


require_once '../controllers/AlunoController.php';
require_once '../controllers/NotasController.php';
require_once '../core/Router.php';

$alunoController = new AlunoController();
$notasController = new NotasController();


$router = new Router();

$router->addRoute('GET', '/api/alunos', function () use ($alunoController) {
    $alunoController->getAllAlunos();
});

$router->addRoute('POST', '/api/alunos', function () use ($alunoController) {
    $alunoController->createAluno();
});

$router->addRoute('GET', '/api/alunos/{id}', function ($id) use ($alunoController) {
    $alunoController->getAlunoById($id);
});

$router->addRoute('PUT', '/api/alunos/{id}', function ($id) use ($alunoController) {
    $alunoController->updateAluno($id);
});

$router->addRoute('DELETE', '/api/alunos/{id}', function ($id) use ($alunoController) {
    $alunoController->deleteAluno($id);
});


$router->addRoute('GET', '/api/notas', function () use ($notasController) {
    $notasController->getAllNotas();
});

$router->addRoute('POST', '/api/notas', function () use ($notasController) {
    $notasController->createNota();
});

$router->addRoute('GET', '/api/notas/{id}', function ($id) use ($notasController) {
    $notasController->getNotaById($id);
});

$router->addRoute('PUT', '/api/notas/{id}', function ($id) use ($notasController) {
    $notasController->updateNota($id);
});

$router->addRoute('DELETE', '/api/notas/{id}', function ($id) use ($notasController) {
    $notasController->deleteNota($id);
});


$router->dispatch();
