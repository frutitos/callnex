<?php
// Iniciamos la sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Destruimos todas las variables de sesión
$_SESSION = array();

// Destruimos la sesión
session_destroy();

// Redireccionamos al usuario a la página de inicio (index.html en este caso)
header("Location: ../index.php");
exit;
?>