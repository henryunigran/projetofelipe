<?php
include '../config.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id) && isset($data->disciplina) && isset($data->nota) && isset($data->frequencia)) {
    $id = $data->id;
    $disciplina = $data->disciplina;
    $nota = $data->nota;
    $frequencia = $data->frequencia;

    $stmt = $pdo->prepare("UPDATE registro_notas SET disciplina = :disciplina, nota = :nota, frequencia = :frequencia WHERE id = :id");
    $stmt->bindParam(':disciplina', $disciplina);
    $stmt->bindParam(':nota', $nota);
    $stmt->bindParam(':frequencia', $frequencia);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Registro atualizado com sucesso"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "erro ao atualizar registro"]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "ID, disciplina, nota e frequência sao obrigatorios"]);
}
?>
