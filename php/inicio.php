<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - CallNex</title>
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/callnex/css/inicio.css">
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
                    <li><a href="inicio.php"><i class="fas fa-home"></i><span class="nav-text">Inicio</span></a></li>
                    <li><a href="noti.php"><i class="fas fa-bell"></i><span class="nav-text">Notificaciones</span></a></li>
                    <li><a href="config.php"><i class="fas fa-gear"></i><span class="nav-text">Configuración</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="main">
        <div class="container">
            <h2>Bienvenido a CallNex</h2>
            <div class="functions">
                <div class="function">
                    <h3>Realizar Llamado</h3>
                    <p>Seleccione el curso, división y grupo para realizar el llamado:</p>
                    
                    <!-- PHP para llenar el select de cursos y divisiones -->
                    <?php
                    // Conectar a la base de datos
                    $conexion = new mysqli("localhost", "root", "", "callnex");

                    // Verificar conexión
                    if ($conexion->connect_error) {
                        die("Error de conexión: " . $conexion->connect_error);
                    }

                    // Consulta para obtener cursos y divisiones
                    $sql_cursos = "SELECT id, curso, division FROM cursos";
                    $resultado_cursos = $conexion->query($sql_cursos);

                    // Consulta para obtener grupos
                    $sql_grupo = "SELECT id, grupo FROM grupo";
                    $resultado_grupo = $conexion->query($sql_grupo);
                    ?>

                    <!-- Desplegable de Curso y División -->
                    <label for="curso_division">Curso y División:</label>
                    <select id="curso_division" name="curso_division">
                        <?php
                        if ($resultado_cursos->num_rows > 0) {
                            while ($fila = $resultado_cursos->fetch_assoc()) {
                                echo "<option value='" . $fila['id'] . "'>" . $fila['curso'] . " - " . $fila['division'] . "</option>";
                            }
                        } else {
                            echo "<option>No hay cursos disponibles</option>";
                        }
                        ?>
                    </select>

                    <!-- Desplegable de Grupo -->
                    <label for="grupo">Grupo:</label>
                    <select id="grupo" name="grupo">
                        <?php
                        if ($resultado_grupo->num_rows > 0) {
                            while ($fila = $resultado_grupo->fetch_assoc()) {
                                echo "<option value='" . $fila['id'] . "'>" . $fila['grupo'] . "</option>";
                            }
                        } else {
                            echo "<option>No hay grupos disponibles</option>";
                        }
                        ?>
                    </select>
                    <button class="btn" onclick="hacerLlamado()"><i class="fas fa-phone"></i> <span class="btn-text">Llamar</span></button>
                    <br>
                    <button class="btn" onclick="cancelarLlamado()"><i class="fas fa-times"></i> <span class="btn-text">Llegada</span></button>
                </div>
            </div>
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
