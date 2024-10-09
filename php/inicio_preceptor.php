<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Preceptor/Auxiliar - CallNex</title>
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
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
                </ul>
            </nav>
        </div>
    </header>

    <section class="main">
        <div class="container">
            <?php
            include "../modelo/conexion_bd.php";
            $nombre = "SELECT nombre FROM usuarios";
            $query = $conexion->query($nombre);
            $nombre = $query->fetch_array();

            ?>
            <h2>Hola <?php echo $nombre['nombre']; ?>, bienvenido</h2>
            <!-- <div class="availability">
                <span class="availability-label">Estado:</span>
                <button id="availability-btn" class="btn availability"><i class="fas fa-circle"></i> <span id="availability-text">No Disponible</span></button>
            </div> -->
            <div class="functions">
                <!-- <div class="function">
                    <h3>Atender Llamado de Aula</h3>
                    <p>Responde a los llamados de los alumnos que necesitan asistencia.</p>
                    <a href="#" class="btn"><i class="fas fa-headset"></i> <span class="btn-text">Atender Llamado</span></a>
                </div> -->
                <div id="callModal" class="function">
                    <div class="modal-content">
                        <h3>Detalles del Llamado</h3>
                        <ul id="llamadosList"></ul>
                        <!-- <button onclick="aceptarLlamado()">Aceptar</button>
                        <button onclick="rechazarLlamado()">Rechazar</button> -->
                        <button onclick="borrarHistorialLlamados()">Borrar Historial</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="/callnex/js/preceptor.js"></script>
    <script>
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu ul').classList.toggle('active');
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
    <script src="../js/preceptor.js"></script>
</body>

</html>