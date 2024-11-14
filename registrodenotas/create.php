<?php
include '../config.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->aluno_id) && isset($data->disciplina) && isset($data->nota) && isset($data->frequencia)) {
    $aluno_id = $data->aluno_id;
    $disciplina = $data->disciplina;
    $nota = $data->nota;
    $frequencia = $data->frequencia;

    $stmt = $pdo->prepare("INSERT INTO registro_notas (aluno_id, disciplina, nota, frequencia) VALUES (:aluno_id, :disciplina, :nota, :frequencia)");
    $stmt->bindParam(':aluno_id', $aluno_id);
    $stmt->bindParam(':disciplina', $disciplina);
    $stmt->bindParam(':nota', $nota);
    $stmt->bindParam(':frequencia', $frequencia);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "registro de notas criado com sucesso"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "erro ao criar registro"]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "aluno, disciplina, nota e frequência sao obrigatorios"]);
}
?>
