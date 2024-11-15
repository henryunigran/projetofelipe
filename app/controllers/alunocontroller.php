<?php

namespace App\Controllers;

use App\Models\Aluno;
use PDO;

class AlunoController {
    private $aluno;

    public function __construct($db) {
        $this->aluno = new Aluno($db);
    }


    public function createAluno($data) {
        $nome = $data['nome'] ?? '';
        $email = $data['email'] ?? '';
        $data_nascimento = $data['data_nascimento'] ?? '';

        return $this->aluno->create($nome, $email, $data_nascimento);
    }


    public function getAllAlunos() {
        return $this->aluno->readAll();
    }


    public function updateAluno($id, $data) {
        $nome = $data['nome'] ?? '';
        $email = $data['email'] ?? '';
        $data_nascimento = $data['data_nascimento'] ?? '';

        return $this->aluno->update($id, $nome, $email, $data_nascimento);
    }


    public function deleteAluno($id) {
        return $this->aluno->delete($id);
    }
}
