<?php
include '../config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Aluno excluído com sucesso"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao excluir aluno"]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "ID é obrigatório"]);
}
?>
