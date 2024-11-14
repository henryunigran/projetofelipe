<?php
include '../config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM registro_notas WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($registro ? $registro : ["status" => "erro", "mensagem" => "registro nao encontrado"]);
} else {
    $stmt = $pdo->query("SELECT * FROM registro_notas");
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($registros);
}
?>
