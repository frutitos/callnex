let llamado = null;
let notificaciones = [];

// Cargar notificaciones guardadas en localStorage
function cargarNotificaciones() {
    const notificacionesGuardadas = JSON.parse(localStorage.getItem('notificaciones'));
    if (notificacionesGuardadas) {
        notificaciones = notificacionesGuardadas;
        mostrarNotificaciones();  // Mostrar las notificaciones al cargar la página
        console.log('Notificaciones cargadas:', notificaciones); // Agregado para depuración
    }
}

document.addEventListener('DOMContentLoaded', () => {
    cargarNotificaciones(); // Cargar notificaciones al iniciar

    // Evento para el botón de ver/ocultar notificaciones
    document.getElementById('btn-ver-notificaciones').addEventListener('click', function() {
        const contenedorNotificaciones = document.getElementById('contenedor-notificaciones');
        // Cambiar el estilo de visualización
        contenedorNotificaciones.style.display = (contenedorNotificaciones.style.display === 'none' || contenedorNotificaciones.style.display === '') ? 'block' : 'none';
    });

    // Evento para el botón de borrar notificaciones
    document.getElementById('btn-borrar-notificaciones').addEventListener('click', borrarNotificaciones);
});

// Función para hacer el llamado
function hacerLlamado() {
    const cursoDiv = document.getElementById('curso_division');
    const grupo = document.getElementById('grupo'); // Grupo seleccionado

    // Obtener el texto del curso y división
    const cursoSeleccionado = cursoDiv.options[cursoDiv.selectedIndex].text;
    
    // Obtener el texto del grupo seleccionado
    const grupoSeleccionado = grupo.options[grupo.selectedIndex].text;

    // Crear el objeto de llamado
    llamado = {
        id: Date.now(),
        estado: 'pendiente',
        curso: cursoSeleccionado,
        grupo: grupoSeleccionado,
        mensaje: `Te llama el curso ${cursoSeleccionado} y ${grupoSeleccionado}`
    };

    // Guardar el llamado en localStorage
    localStorage.setItem('llamado', JSON.stringify(llamado));

    // Crear la notificación y agregarla
    const mensajeNotificacion = `Llamada realizada: Curso ${cursoSeleccionado}, Grupo ${grupoSeleccionado}`;
    agregarNotificacion(mensajeNotificacion);

    // Enviar la llamada al preceptor
    enviarLlamadoAPreceptor(cursoSeleccionado, grupoSeleccionado);
    
    // Deshabilitar el botón de "Realizar Llamado" hasta que llegue el preceptor
    document.querySelector('.btn').disabled = true;
}

// Función para agregar notificaciones
function agregarNotificacion(mensaje) {
    // Verificar si la notificación ya existe antes de agregarla
    const notificacionExistente = notificaciones.find(notificacion => notificacion === mensaje);

    if (!notificacionExistente) {
        notificaciones.push(mensaje);
        localStorage.setItem('notificaciones', JSON.stringify(notificaciones));
        guardarNotificacionEnDB(mensaje); // Guardar en la base de datos
        mostrarNotificaciones(); // Actualizar la vista de notificaciones
    }
}

// Función para mostrar las notificaciones en la interfaz
function mostrarNotificaciones() {
    const notificacionDiv = document.getElementById('contenedor-notificaciones');
    notificacionDiv.innerHTML = ''; // Limpiar el contenido existente

    if (notificaciones.length === 0) {
        notificacionDiv.innerHTML = '<p>No hay notificaciones.</p>';
    } else {
        // Mostrar todas las notificaciones sin duplicarlas (se evitó en agregarNotificacion)
        notificaciones.forEach(mensaje => {
            const notificationElement = document.createElement('div');
            notificationElement.className = 'notification';
            notificationElement.innerText = mensaje;
            notificacionDiv.appendChild(notificationElement);
        });
    }
}

// Enviar llamado al preceptor
function enviarLlamadoAPreceptor(curso, grupo) {
    fetch('inicio_preceptor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ curso, grupo }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Llamado enviado correctamente al preceptor');
            agregarNotificacion('Mensaje enviado al preceptor.');
        } else {
            console.error('Error al enviar el llamado al preceptor');
            agregarNotificacion('Error al enviar el llamado al preceptor.');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Función para manejar la aceptación del preceptor
function aceptarLlamado(motivo) {
    const mensaje = `El preceptor ha aceptado el llamado. Motivo: ${motivo}`;
    agregarNotificacion(mensaje);
    console.log(mensaje);
}

// Función para manejar el rechazo del preceptor
function rechazarLlamado(motivo) {
    const mensaje = `El preceptor ha rechazado el llamado. Motivo: ${motivo}`;
    agregarNotificacion(mensaje);
    console.log(mensaje);
}

// Guardar notificación en la base de datos
function guardarNotificacionEnDB(mensaje) {
    const usuario_id = sessionStorage.getItem('id'); // Obtener ID del usuario

    fetch('guardar_notificacion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ usuario_id, mensaje }),
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error('Error al guardar la notificación en la base de datos');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Cancelar llamado
function cancelarLlamado() {
    const mensaje = "El preceptor ha llegado al salón.";
    fetch('inicio_preceptor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ mensaje }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Mensaje de llegada enviado al preceptor');
            document.querySelector('.btn').disabled = false; // Habilitar el botón de "Realizar Llamado"
            localStorage.removeItem('llamado');
            llamado = null;
        } else {
            console.error('Error al enviar el mensaje de llegada al preceptor');
        }
    })
    .catch(error => console.error('Error:', error));
}

function borrarNotificaciones() {
    // Verificar si hay notificaciones guardadas en localStorage
    const notificacionesGuardadas = localStorage.getItem('notificaciones');

    if (!notificacionesGuardadas) {
        alert("No hay notificaciones que borrar.");
        return;
    }

    // Borrar las notificaciones de localStorage
    localStorage.removeItem('notificaciones');

    // Vaciar el array de notificaciones en memoria
    notificaciones = [];

    // Actualizar la interfaz para reflejar que no hay notificaciones
    mostrarNotificaciones();

    console.log("Todas las notificaciones se han borrado.");
}
