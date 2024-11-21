<?php

namespace App\Controllers;

use App\Models\RegistroNota;
use PDO;

class RegistroNotaController {
    private $registroNota;

    public function __construct($db) {
        $this->registroNota = new RegistroNota($db);
    }

    
    public function createRegistro($data) {
        $aluno_id = $data['aluno_id'] ?? '';
        $nota = $data['nota'] ?? '';
        $frequencia = $data['frequencia'] ?? '';

        return $this->registroNota->create($aluno_id, $nota, $frequencia);
    }

    
    public function getAllRegistros() {
        return $this->registroNota->readAll();
    }

  
    public function updateRegistro($id, $data) {
        $nota = $data['nota'] ?? '';
        $frequencia = $data['frequencia'] ?? '';

        return $this->registroNota->update($id, $nota, $frequencia);
    }

   
    public function deleteRegistro($id) {
        return $this->registroNota->delete($id);
    }
}
