<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda - Usuario Normal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/callnex/css/inicio.css">
    <link rel="stylesheet" href="/callnex/css/ayuda.css">
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
                    <li><a href="ayuda.php"><i class="fas fa-question-circle"></i><span class="nav-text">Ayuda</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="download-section">
            <h3>Descargar Manual de usuario para profesor</h3>
            <p>Descarga el PDF con toda la información de ayuda aquí:</p>
            <a href="/callnex/php/pdf/Manual.pdf" class="download-btn" download="Manual.pdf">Descargar PDF</a>
    </div>

        <section>
            <h3>Creado por:</h3>
            <p>Axel Albarenque </p>
            <p>Santiago Frutos </p> 
            <p>Nazareno Salas</p>
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
