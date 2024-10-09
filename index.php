<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - CallNex</title>
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/callnex/css/login.css">
</head>
<body>
    <div class="login-container">
        <img src="/callnex/imgs/callnex_logo.png" alt="CallNex Logo" class="logo">
        <h2>Inicio de sesión</h2>
        <form id="loginForm" action="/callnex/php/procesar_login.php" method="post">
            <div class="input-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Iniciar sesión</button>
            <p>No tienes una cuenta? <a href="/callnex/php/registro.php">Regístrate aquí</a></p>           
        </form>
    </div>
</body>
</html>
