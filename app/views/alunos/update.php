<?php
include '../config.php';

$data = json_decode(file_get_contents("php://input"));
$id = $_GET['id'] ?? null;

if ($id && isset($data->nome) && isset($data->data_nascimento)) {
    $stmt = $pdo->prepare("UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, turma = :turma WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $data->nome);
    $stmt->bindParam(':data_nascimento', $data->data_nascimento);
    $stmt->bindParam(':turma', $data->turma);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "aluno atualizado com sucesso"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "erro ao atualizar aluno"]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "ID, nome e data de nascimento sao obrigatorios"]);
}
?>
