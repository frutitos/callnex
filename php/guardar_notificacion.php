<?php
session_start();
include '../modelo/conexion_bd.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$usuario_id = $data['usuario_id'];
$mensaje = $data['mensaje'];

// Consulta para insertar la notificación
$query = "INSERT INTO notificaciones (usuario_id, mensaje, fecha) VALUES (?, ?, NOW())";
$stmt = $conexion->prepare($query);
$stmt->bind_param("is", $usuario_id, $mensaje);
$success = $stmt->execute();

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conexion->close();
?>
