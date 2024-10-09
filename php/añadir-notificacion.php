<?php

session_start()

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $mensaje = $_POST['mensaje'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO notificaciones (titulo, mensaje, fecha) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdii", $titulo, $mensaje, $fecha);

    if ($stmt->execute()) {
        echo "Notificacion enviada";
    } else {
        echo "Error al enviar notificacion: " . $stmt->error;
    }
        
    $stmt->close();
    $stmt->close();
}

?>