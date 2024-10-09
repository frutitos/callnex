<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/callnex/imgs/logo.png" type="image/x-icon">
    <title>Login - CallNex</title>
    <link rel="stylesheet" href="/callnex/css/login.css">
</head>

<body>
    <?php
        session_start();

        // Datos de conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "callnex";

        // Conexión a la base de datos
        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Inicializar variables para manejar mensajes
        $login_success = false;
        $error_message = "";

        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $contrasena = $_POST["password"];

            // Consultar la base de datos para verificar el usuario y obtener el tipo de usuario
            $sql = "SELECT id, nombre, apellido, contrasena, tipo_usuario_id FROM usuarios WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);

                // Verificar la contraseña hasheada
                if (password_verify($contrasena, $row['contrasena'])) {
                    $_SESSION['email'] = $email;
                    $_SESSION['usuario_id'] = $row['id'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['apellido'] = $row['apellido'];
                    $_SESSION['tipo_usuario_id'] = $row['tipo_usuario_id'];

                    $login_success = true;

                    // Redirigir según el tipo de usuario
                    if ($row['tipo_usuario_id'] == 1) {
                        $redirect_url = '/callnex/php/inicio_preceptor.php'; // Preceptor
                    } else {
                        $redirect_url = '/callnex/php/inicio.php'; // Alumno
                    }
                } else {
                    $error_message = "Correo electrónico o contraseña incorrectos.";
                }
            } else {
                $error_message = "Correo electrónico o contraseña incorrectos.";
            }
        }

        mysqli_close($conn);
    ?>

<div class="login-container">
    <h2><img src="/callnex/imgs/icono_callnex.png" alt="Logo de CallNex"></h2>
    <?php if ($login_success) : ?>
        <p class="success-message">Inicio de sesión exitoso. Redirigiendo...</p>
        <script>
            setTimeout(function() {
                window.location.href = '<?php echo $redirect_url; ?>'; // Redirigir a la página correspondiente
            }, 3000); // Redirigir después de 3 segundos
        </script>
    <?php else : ?>
        <p class="error-message">ERROR, VOLVIENDO AL LOGUEO</p>
        <script>
            setTimeout(function() {
                window.location.href = '/callnex/index.php'; // Redirigir después de 1 segundo
            }, 1000); // Redirigir después de 1 segundo
        </script>
    <?php endif; ?>
</div>

</body>

</html>