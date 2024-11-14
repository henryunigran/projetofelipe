<?php
include '../config.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->nome) && isset($data->data_nascimento)) {
    $nome = $data->nome;
    $data_nascimento = $data->data_nascimento;
    $turma = $data->turma ?? null;

    $stmt = $pdo->prepare("INSERT INTO alunos (nome, data_nascimento, turma) VALUES (:nome, :data_nascimento, :turma)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':turma', $turma);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "aluno criado com sucesso"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "erro ao criar aluno"]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "nome e data de nascimento sao obrigatorios"]);
}
?>
