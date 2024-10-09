let llamados = JSON.parse(localStorage.getItem('llamados')) || [];

function aceptarLlamado(id) {
    const llamado = llamados.find(ll => ll.id === id);
    if (llamado) {
        // Verificar si el mensaje fue seleccionado desde el desplegable
        const mensajeSeleccionado = llamado.mensaje || 'En seguida voy'; // Valor por defecto si no se seleccionó

        llamado.estado = 'en camino'; // Cambiar el estado a 'en camino'
        llamado.mensaje = mensajeSeleccionado;
        actualizarLlamados();
        guardarLlamados();

        // Agregar notificación de aceptación al localStorage
        agregarNotificacion(`Llamado aceptado: ${llamado.mensaje}`);

        enviarNotificacionAlumno(llamado);
    }
}

function rechazarLlamado(id) {
    const llamado = llamados.find(ll => ll.id === id);
    if (llamado) {
        // Verificar si el mensaje fue seleccionado desde el desplegable
        const mensajeSeleccionado = llamado.mensaje || 'No puedo'; // Valor por defecto si no se seleccionó

        llamado.estado = 'rechazado';
        llamado.mensaje = mensajeSeleccionado;
        actualizarLlamados();
        guardarLlamados();

        // Agregar notificación de rechazo al localStorage
        agregarNotificacion(`Llamado rechazado: ${llamado.mensaje}`);

        enviarNotificacionAlumno(llamado);
    }
}

function cambiarMensaje(id, mensaje) {
    const llamado = llamados.find(ll => ll.id === id);
    if (llamado) {
        llamado.mensaje = mensaje; // Actualizar el mensaje con el seleccionado
        guardarLlamados();
        actualizarLlamados(); // Actualizar la UI para reflejar el mensaje seleccionado
    }
}

function llegadaPreceptor(id) {
    const llamado = llamados.find(ll => ll.id === id);
    if (llamado) {
        llamado.estado = 'llegado'; // Estado de llegada
        llamado.mensaje = 'El preceptor ha llegado al salón.';
        actualizarLlamados();
        guardarLlamados();

        // Enviar notificación al alumno de que el preceptor ha llegado
        enviarNotificacionAlumno(llamado);

        // Eliminar el llamado después de la llegada
        const index = llamados.findIndex(ll => ll.id === id);
        if (index > -1) {
            llamados.splice(index, 1);
        }
        actualizarLlamados();
        guardarLlamados();
    }
}

function actualizarLlamados() {
    const list = document.getElementById('llamadosList');
    list.innerHTML = '';
    llamados.forEach(llamado => {
        const item = document.createElement('li');
        item.innerHTML = `
            <strong>${llamado.mensaje}</strong> - Estado: ${llamado.estado} <br>
            <button onclick="aceptarLlamado(${llamado.id})">Aceptar</button>
            <button onclick="rechazarLlamado(${llamado.id})">Rechazar</button>
            <button onclick="llegadaPreceptor(${llamado.id})">Llegada</button>
            <select onchange="cambiarMensaje(${llamado.id}, this.value)">
                <option value="">Seleccionar mensaje</option>
                <option value="En seguida voy">En seguida voy</option>
                <option value="Estoy yendo">Estoy yendo</option>
                <option value="No puedo">No puedo</option>
                <option value="No puedo, va un reemplazo">No puedo, va un reemplazo</option>
            </select>
        `;
        list.appendChild(item);
    });
}

function cambiarMensaje(id, mensaje) {
    const llamado = llamados.find(ll => ll.id === id);
    if (llamado) {
        llamado.mensaje = mensaje;
        guardarLlamados();
    }
}

function guardarLlamados() {
    localStorage.setItem('llamados', JSON.stringify(llamados));
}

function enviarNotificacionAlumno(llamado) {
    localStorage.setItem('llamado', JSON.stringify(llamado));
}

function verificarCancelacion() {
    const cancelado = JSON.parse(localStorage.getItem('cancelado'));
    if (cancelado) {
        const index = llamados.findIndex(ll => ll.id === cancelado.id);
        if (index > -1) {
            llamados.splice(index, 1);
            actualizarLlamados();
            guardarLlamados();
        }
        localStorage.removeItem('cancelado');
    }
}

function borrarHistorialLlamados() {
    llamados = [];
    localStorage.removeItem('llamados');
    actualizarLlamados();
}

// Simulación de recepción de llamado
setInterval(() => {
    const llamado = JSON.parse(localStorage.getItem('llamado'));
    if (llamado && !llamados.find(ll => ll.id === llamado.id)) {
        llamados.push(llamado);
        actualizarLlamados();
        guardarLlamados();
    }
}, 1000);

setInterval(verificarCancelacion, 1000);

document.addEventListener('DOMContentLoaded', actualizarLlamados);
function agregarNotificacion(mensaje) {
    const notificacionesGuardadas = JSON.parse(localStorage.getItem('notificaciones')) || [];
    notificacionesGuardadas.push(mensaje);
    localStorage.setItem('notificaciones', JSON.stringify(notificacionesGuardadas));
}