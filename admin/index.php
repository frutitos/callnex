<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/callnex/css/inicio.css">
    <title>Administración de Usuarios</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Deshabilitar el formulario de edición al iniciar
            document.getElementById('edit-form').querySelectorAll('input, select, button').forEach(element => {
                element.disabled = true;
            });

            // Cargar usuarios al iniciar la página
            fetch('admin_usuarios.php')
                .then(response => response.json())
                .then(data => {
                    let selectUsuarios = document.getElementById('select-usuarios');
                    if (data.length === 0) {
                        selectUsuarios.innerHTML = '<option>No hay usuarios disponibles</option>';
                    } else {
                        data.forEach(user => {
                            let option = `<option value="${user.id}" data-nombre="${user.nombre}" data-apellido="${user.apellido}" data-email="${user.email}" data-tipo="${user.tipo_usuario_id}">${user.nombre} ${user.apellido}</option>`;
                            selectUsuarios.innerHTML += option;
                        });
                    }
                });

            // Habilitar formulario y cargar datos al seleccionar un usuario
            document.getElementById('select-usuarios').addEventListener('change', function() {
                let selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value !== "") {
                    // Habilitar el formulario de edición
                    document.getElementById('edit-form').querySelectorAll('input, select, button').forEach(element => {
                        element.disabled = false;
                    });

                    // Cargar los datos del usuario en el formulario
                    document.getElementById('edit-id').value = selectedOption.value;
                    document.getElementById('edit-nombre').value = selectedOption.getAttribute('data-nombre');
                    document.getElementById('edit-apellido').value = selectedOption.getAttribute('data-apellido');
                    document.getElementById('edit-email').value = selectedOption.getAttribute('data-email');
                    document.getElementById('edit-tipo_usuario_id').value = selectedOption.getAttribute('data-tipo');
                } else {
                    // Deshabilitar el formulario si no se selecciona un usuario válido
                    document.getElementById('edit-form').querySelectorAll('input, select, button').forEach(element => {
                        element.disabled = true;
                    });
                }
            });

            // Guardar cambios de usuario existente
            document.getElementById('edit-form').addEventListener('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                fetch('admin_usuarios.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert('Usuario actualizado correctamente');
                    window.location.reload();
                });
            });

            // Eliminar usuario con confirmación
            document.getElementById('delete-user-btn').addEventListener('click', function() {
                if (confirm('¿Usted está seguro de querer eliminar el siguiente usuario?')) {
                    let userId = document.getElementById('edit-id').value;
                    fetch('admin_usuarios.php', {
                        method: 'POST',
                        body: new URLSearchParams({ 'delete': userId })
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert('Usuario eliminado correctamente');
                        window.location.reload();
                    });
                }
            });

            // Guardar nuevo usuario
            document.getElementById('create-form').addEventListener('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                fetch('admin_usuarios.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert('Usuario creado correctamente');
                    window.location.reload();
                });
            });
        });
    </script>
</head>
<body>
<header>
    <div class="container menu">
        <div class="logo">
            <img src="/callnex/imgs/icono_callnex_vacio.png" alt="Logo de CallNex">
        </div>
        <button class="navbar-toggle"><i class="fas fa-bars"></i></button>
        <nav class="navbar-menu">
            <ul>
                <li><a href="/callnex/php/inicio.php"><i class="fas fa-home"></i><span class="nav-text">Inicio profesor</span></a></li>
                <li><a href="/callnex/php/inicio_preceptor.php"><i class="fas fa-home"></i><span class="nav-text">Inicio preceptor</span></a></li>
            </ul>
        </nav>
    </div>
</header>
    <h1>Administrar Usuarios</h1>

    <h2>Seleccionar Usuario para Modificar</h2>
    <select id="select-usuarios">
        <option value="">Seleccione un usuario</option>
    </select>
<br>
    <h2>Modificar Usuario</h2>
    <form id="edit-form">
        <input type="hidden" id="edit-id" name="id">

        <label for="edit-nombre">Nombre:</label>
        <input type="text" id="edit-nombre" name="nombre" required><br>

        <label for="edit-apellido">Apellido:</label>
        <input type="text" id="edit-apellido" name="apellido" required><br>

        <label for="edit-email">Email:</label>
        <input type="email" id="edit-email" name="email" required><br>

        <label for="edit-tipo_usuario_id">Tipo de Usuario:</label>
        <select id="edit-tipo_usuario_id" name="tipo_usuario_id">
            <option value="1">Preceptor</option>
            <option value="2">Alumno</option>
        </select><br>

        <label for="edit-contrasena">Nueva Contraseña (opcional):</label>
        <input type="password" id="edit-contrasena" name="contrasena"><br>

        <button type="submit">Guardar Cambios</button>
        <button type="button" id="delete-user-btn">Eliminar Usuario</button>
    </form>
<br>
    <h2>Crear Nuevo Usuario</h2>
    <form id="create-form">
        <label for="create-nombre">Nombre:</label>
        <input type="text" id="create-nombre" name="nombre" required><br>

        <label for="create-apellido">Apellido:</label>
        <input type="text" id="create-apellido" name="apellido" required><br>

        <label for="create-email">Email:</label>
        <input type="email" id="create-email" name="email" required><br>

        <label for="create-tipo_usuario_id">Tipo de Usuario:</label>
        <select id="create-tipo_usuario_id" name="tipo_usuario_id">
            <option value="1">Preceptor</option>
            <option value="2">Alumno</option>
        </select><br>

        <label for="create-contrasena">Contraseña:</label>
        <input type="password" id="create-contrasena" name="contrasena" required><br>

        <button type="submit">Crear Usuario</button>
    </form>
</body>
</html>
