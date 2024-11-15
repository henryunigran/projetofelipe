<?php

namespace App\Models;

use PDO;
use PDOException;

class Aluno {
    private $conn;
    private $table = 'alunos';

    public function __construct($db) {
        $this->conn = $db;
    }


    public function create($nome, $email, $data_nascimento) {
        $query = "INSERT INTO {$this->table} (nome, email, data_nascimento) VALUES (:nome, :email, :data_nascimento)";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao criar aluno: " . $e->getMessage();
            return false;
        }
    }


    public function readAll() {
        $query = "SELECT * FROM {$this->table}";
        
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function update($id, $nome, $email, $data_nascimento) {
        $query = "UPDATE {$this->table} SET nome = :nome, email = :email, data_nascimento = :data_nascimento WHERE id = :id";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar aluno: " . $e->getMessage();
            return false;
        }
    }


    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao excluir aluno: " . $e->getMessage();
            return false;
        }
    }
}
