<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit();
}

include '../modelo/conexion_bd.php';

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
    <link rel="stylesheet" href="/callnex/css/inicio.css">
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
                    <li><a href="inicio.php"><i class="fas fa-home"></i><span class="nav-text">Inicio</span></a></li>
                    <li><a href="noti.php"><i class="fas fa-bell"></i><span class="nav-text">Notificaciones</span></a></li>
                    <li><a href="config.php"><i class="fas fa-gear"></i><span class="nav-text">Configuración</span></a></li>
                    <li><a href="ayuda.php"><i class="fas fa-question-circle"></i><span class="nav-text">Ayuda</span></a></li> <!-- Nueva opción de Ayuda -->
                </ul>
            </nav>
        </div>
    </header>

    <section class="main">
        <h2>Notificaciones</h2>
        <!-- Botón para ver/ocultar notificaciones -->
        <button id="btn-ver-notificaciones" class="btn-notificaciones">
            <i class="fas fa-bell"></i> Ver Notificaciones
        </button>

        <!-- Botón para borrar notificaciones -->
        <button id="btn-borrar-notificaciones" class="btn-borrar">
            <i class="fas fa-trash"></i> Borrar Todas las Notificaciones
        </button>

        <!-- Contenedor donde se mostrarán las notificaciones -->
        <div id="contenedor-notificaciones" class="notifications" style="display: none;">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="notification">
                        <?php echo $row['mensaje']; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay notificaciones.</p>
                <?php error_log("No se encontraron notificaciones para el usuario_id: " . $usuario_id); ?>
            <?php endif; ?>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="../js/inicio.js"></script>
    <script>
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu ul').classList.toggle('active');
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
</body>
</html>
