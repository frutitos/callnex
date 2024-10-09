<?php
include '../modelo/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el usuario_id del cuerpo del request
    $data = json_decode(file_get_contents('php://input'), true);
    $usuario_id = $data['usuario_id'];

    if ($usuario_id) {
        // Borrar todas las notificaciones del usuario en la base de datos
        $query = "DELETE FROM notificaciones WHERE usuario_id = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, 'i', $usuario_id);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al borrar las notificaciones en la base de datos.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID de usuario no válido.']);
    }
}
?>
