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

                    // Verificar si el usuario es el tercero registrado
                    if ($row['tipo_usuario_id'] == 3) {
                        // Redirigir a la vista admin inmediatamente
                        header("Location: /callnex/admin/index.php");
                        exit(); // Asegurarse de que el script se detiene después de la redirección
                    } elseif ($row['tipo_usuario_id'] == 1) {
                        // Redirigir a la vista de preceptor
                        header("Location: /callnex/php/inicio_preceptor.php");
                        exit();
                    } else {
                        // Redirigir a la vista de alumno
                        header("Location: /callnex/php/inicio.php");
                        exit();
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
    <?php if (!empty($error_message)) : ?>
        <p class="error-message"><?php echo $error_message; ?></p>
        <script>
            setTimeout(function() {
                window.location.href = '/callnex/index.php'; // Redirigir después de 1 segundo
            }, 1000);
        </script>
    <?php endif; ?>
    <h2><img src="/callnex/imgs/icono_callnex.png" alt="Logo de CallNex"></h2>
</div>

</body>

</html>
