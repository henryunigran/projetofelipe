<?php

use App\controllers\alunoController;
use App\controllers\registronotaController;


$alunoController = new AlunoController();
$registronotaController = new RegistronotaController();

$router->addRoute('GET', '/api/alunos', [$alunoController, 'index']);

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


$router->addRoute('GET', '/api/notas', function () use ($registronotaController) {
    $registronotaController->getAllNotas();
});

$router->addRoute('POST', '/api/notas', function () use ($registronotaController) {
    $registronotaController->createNota();
});

$router->addRoute('GET', '/api/notas/{id}', function ($id) use ($registronotaController) {
    $registronotaController->getNotaById($id);
});

$router->addRoute('PUT', '/api/notas/{id}', function ($id) use ($registronotaController) {
    $registronotaController->updateNota($id);
});

$router->addRoute('DELETE', '/api/notas/{id}', function ($id) use ($registronotaController) {
    $registronotaController->deleteNota($id);
});
