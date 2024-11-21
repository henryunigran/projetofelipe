<?php

namespace App\Models;

use PDO;
use PDOException;

class RegistroNota {
    private $conn;
    private $table = 'registro_notas';

    public function __construct($db) {
        $this->conn = $db;
    }


    public function create($aluno_id, $nota, $frequencia) {
        $query = "INSERT INTO {$this->table} (aluno_id, nota, frequencia) VALUES (:aluno_id, :nota, :frequencia)";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':aluno_id', $aluno_id);
            $stmt->bindParam(':nota', $nota);
            $stmt->bindParam(':frequencia', $frequencia);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao criar registro: " . $e->getMessage();
            return false;
        }
    }


    public function readAll() {
        $query = "SELECT * FROM {$this->table}";
        
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function update($id, $nota, $frequencia) {
        $query = "UPDATE {$this->table} SET nota = :nota, frequencia = :frequencia WHERE id = :id";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nota', $nota);
            $stmt->bindParam(':frequencia', $frequencia);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar registro: " . $e->getMessage();
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
            echo "Erro ao excluir registro: " . $e->getMessage();
            return false;
        }
    }
}
