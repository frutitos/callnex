<?php
// admin_usuarios.php

// Conexión a la base de datos (ajusta según tu configuración)
$host = 'localhost';
$db = 'callnex';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Manejar la solicitud de datos de usuarios
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query('SELECT * FROM usuarios');
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($usuarios);
    exit;
}

// Manejar la creación, modificación y eliminación de usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se desea eliminar un usuario
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        echo 'Usuario eliminado correctamente';
        exit;
    }

    // Obtener datos del formulario
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $tipo_usuario_id = $_POST['tipo_usuario_id'];
    $contrasena = $_POST['contrasena'] ?? '';

    // Crear o actualizar usuarios
    if ($id == '') {  // Nuevo usuario
        $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, apellido, email, contrasena, tipo_usuario_id) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$nombre, $apellido, $email, password_hash($contrasena, PASSWORD_BCRYPT), $tipo_usuario_id]);
        echo 'Usuario creado correctamente';
    } else {  // Actualizar usuario existente
        if (!empty($contrasena)) {
            $stmt = $pdo->prepare('UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, contrasena = ?, tipo_usuario_id = ? WHERE id = ?');
            $stmt->execute([$nombre, $apellido, $email, password_hash($contrasena, PASSWORD_BCRYPT), $tipo_usuario_id, $id]);
        } else {
            $stmt = $pdo->prepare('UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, tipo_usuario_id = ? WHERE id = ?');
            $stmt->execute([$nombre, $apellido, $email, $tipo_usuario_id, $id]);
        }
        echo 'Usuario actualizado correctamente';
    }
    exit;
}