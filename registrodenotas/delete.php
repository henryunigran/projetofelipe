<?php
include '../config.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $id = $data->id;

    $stmt = $pdo->prepare("DELETE FROM registro_notas WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "registro excluido com sucesso"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "erro ao excluir registro"]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "ID e obrigatorio"]);
}
?>
