<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - CallNex</title>
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/callnex/css/config.css">
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
            <h2>Configuración</h2>
            <div class="config-options">
                <div class="option">
                    <a href="perfil.php"><i class="fas fa-user"></i> <span class="option-text">Perfil</span></a>
                </div>
                <!-- <div class="option">
                    <a href="ayuda.html"><i class="fas fa-question"></i> <span class="option-text">Ayuda</span></a>
                </div> -->
                <div class="option">
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span class="option-text">Cerrar sesión</span></a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 CallNex. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu ul').classList.toggle('active');
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
</body>
</html>
