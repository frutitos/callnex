<?php
// Inicia sesión
session_start();

// Comprueba si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit();
}

// Conexión a la base de datos
include '../modelo/conexion_bd.php';

// Obtiene las notificaciones del usuario
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT * FROM notificaciones WHERE usuario_id = $usuario_id ORDER BY fecha DESC";
$result = mysqli_query($conexion, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones - CallNex</title>
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/callnex/css/noti.css">
    <link rel="stylesheet" href="/callnex/css/inicio_preceptor.css">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
    <div class="container menu">
            <div class="logo">
                <img src="/callnex/imgs/icono_callnex.png" alt="Logo de CallNex">
            </div>
            <button class="navbar-toggle"><i class="fas fa-bars"></i></button>
            <nav class="navbar-menu">
                <ul>
                    <li><a href="inicio_preceptor.php"><i class="fas fa-home"></i><span class="nav-text">Inicio</span></a></li>
                    <!-- <li><a href="noti_preceptor.php"><i class="fas fa-phone"></i><span class="nav-text">Historial de llamados</span></a></li> -->
                    <li><a href="config_preceptor.php"><i class="fas fa-gear"></i><span class="nav-text">Configuración</span></a></li>
                    <li><a href="ayuda_preceptor.php"><i class="fas fa-question-circle"></i><span class="nav-text">Ayuda</span></a></li> <!-- Nueva opción de Ayuda -->
                </ul>
            </nav>
        </div>
        </div>
    </header>

    <section class="main">
    <div class="function">
                    <h3>Notificaciones</h3>
                    <button class="btn" onclick="verNotificaciones()"><i class="fas fa-bell"></i> <span class="btn-text">Ver Notificaciones</span></button>
                    <button class="btn" onclick="borrarNotificaciones()"><i class="fas fa-trash"></i> <span class="btn-text">Borrar Historial</span></button>
                </div>
            </div>
            <div id="notificacion"></div>
        </div>
        </div>
    </section>
    <script>
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu ul').classList.toggle('active');
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
    <script src="/callnex/js/preceptor.js"></script>
    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>