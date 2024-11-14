<?php
include '../config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "aluno excluído com sucesso"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "erro ao excluir aluno"]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "ID e obrigatorio"]);
}
?>
