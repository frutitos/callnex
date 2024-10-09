<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - CallNex</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/callnex/css/registro.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Registro</h1>
        
        <?php
            // Verificar si se ha enviado el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Procesar los datos del formulario
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "callnex";

                $conn = mysqli_connect($servername, $username, $password, $database);

                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }

                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $email = $_POST["email"];
                $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT); // Hashear la contraseña
                $tipo_usuario_id = 2; // "alumno"

                // Verificar si el email ya está registrado
                $sql = "SELECT id FROM usuarios WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<p class='error'>El correo electrónico ya está registrado.</p>";
                } else {
                    // Insertar nuevo usuario en la base de datos
                    $sql = "INSERT INTO usuarios (nombre, apellido, email, contrasena, tipo_usuario_id) VALUES ('$nombre', '$apellido', '$email', '$contrasena', '$tipo_usuario_id')";
                    
                    if (mysqli_query($conn, $sql)) {
                        echo "<p class='success-message' id='success-message'>Registro exitoso. Redirigiendo al inicio...</p>";
                        echo "<script>
                                document.getElementById('success-message').style.display = 'block';
                                setTimeout(function(){
                                    window.location.href = 'inicio.php';
                                }, 3000); // 3 segundos de espera
                            </script>";
                    } else {
                        echo "Error al registrar usuario: " . mysqli_error($conn);
                    }
                }

                mysqli_close($conn);
            }
            ?>

        <!-- Formulario de registro -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="input-field" required>

            <label for="nombre">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="input-field" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="input-field" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" class="input-field" required>

            <button type="submit" class="register-button">Registrarse</button>
        </form>

        <a href="/callnex/index.php" class="login-link">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</body>
</html>
