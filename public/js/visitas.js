// Modal de visitante
var visitorModal = document.getElementById("VisitasModal");
var newVisitorBtn = document.getElementById("nuevo_registro");
var visitorCloseBtn = document.getElementById("close");

newVisitorBtn.onclick = function () {
  visitorModal.style.display = "block";
};

visitorCloseBtn.onclick = function () {
  visitorModal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == visitorModal) {
    visitorModal.style.display = "none";
  }
};

// Modal de paquetes
var packageModal = document.getElementById("packageModal");
var newPackageBtn = document.getElementById("openModalBtn");
var packageCloseBtn = document.getElementById("closeModal");

newPackageBtn.onclick = function () {
  packageModal.style.display = "block";
};

packageCloseBtn.onclick = function () {
  packageModal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == visitorModal) {
    visitorModal.style.display = "none";
  } else if (event.target == packageModal) {
    packageModal.style.display = "none";
  }
};

const abrirTablaFlotante = document.getElementById("abrirTablaFlotante");
const tablaFlotante = document.getElementById("tablaFlotante");

abrirTablaFlotante.addEventListener("click", () => {
  tablaFlotante.style.display = "flex";
});
window.addEventListener("click", (e) => {
  if (e.target === tablaFlotante) {
    tablaFlotante.style.display = "none";
  }
});

let ultimoBotonSeleccionado = null;
let ultimoInputOculto = null;

document.addEventListener("click", function (e) {
  const tablaFlotante = document.getElementById("tablaFlotantePersona");

  // Abrir la tabla flotante al hacer clic en 👤➕
  if (e.target.classList.contains("btnSeleccionarPersona")) {
    tablaFlotante.style.display = "flex";
    ultimoBotonSeleccionado = e.target;

    // Buscar el input oculto hermano
    const parent = e.target.parentNode;
    ultimoInputOculto = parent.querySelector('.persona-id-seleccionada');
  }

  // Cerrar al hacer clic fuera del modal
  if (e.target === tablaFlotante) {
    tablaFlotante.style.display = "none";
  }
});

// Confirmar selección
document.getElementById("btnConfirmarSeleccion_r").addEventListener("click", function () {
  const selectPersona = document.getElementById("select_personas_r");
  const personaId = selectPersona.value;

  if (personaId === "0") {
    alert("Por favor selecciona una persona válida.");
    return;
  }

  // Guardar el ID en el input oculto
  if (ultimoInputOculto) {
    ultimoInputOculto.value = personaId;
  }

  // Cambiar el ícono del botón
  if (ultimoBotonSeleccionado) {
    ultimoBotonSeleccionado.innerText = "👤✔️";
    ultimoBotonSeleccionado.disabled = true;
  }

  // Cerrar el modal
  document.getElementById("tablaFlotantePersona").style.display = "none";

  // Resetear select
  selectPersona.value = "0";
});





function buscarVisitante() {
  const cedula = document.getElementById('u_id').value;

  fetch('<?php echo RUTA_URL; ?>/PorterController/searchGuest', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `u_id=${cedula}`
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          document.getElementById('U_Nombre').value = data.visitante.Vi_nombre;
          document.getElementById('U_Apellido').value = data.visitante.Vi_apellido;
          document.getElementById('U_Telefono').value = data.visitante.Vi_telefono;
          document.getElementById('U_Motivo').value = data.visitante.Vi_motivo;
      } else {
          alert('No se encontró el visitante.');
      }
  })
  .catch(error => console.error('Error:', error));
}

// control de fechas de paquetes
const campoFecha = document.getElementById('Pa_Fecha');

campoFecha.addEventListener('change', function () {
  const inputDate = new Date(this.value);
  const now = new Date();

  // Redondear ambas fechas al minuto (quitamos segundos y milisegundos)
  inputDate.setSeconds(0, 0);
  now.setSeconds(0, 0);

  if (inputDate.getTime() > now.getTime()) {
    error('No puedes seleccionar una fecha y hora posterior al minuto actual');
    this.value = '';
  }
});

// Validar también si se selecciona "Hoy" desde el calendario
campoFecha.addEventListener('focus', function () {
  const previousValue = this.value;
  setTimeout(() => {
    if (this.value !== previousValue) {
      this.dispatchEvent(new Event('change'));
    }
  }, 100);
});

// Mensaje de error
function error(mensaje) {
  Swal.fire({
    title: 'ERROR',
    text: mensaje,
    icon: 'error'
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const campoFecha = document.getElementById("Pa_Fecha");

  // Función para obtener la fecha y hora actual en formato compatible con input datetime-local
  function getFechaActualFormateada() {
    const ahora = new Date();
    ahora.setSeconds(0, 0); // quitar segundos y milisegundos

    const año = ahora.getFullYear();
    const mes = String(ahora.getMonth() + 1).padStart(2, "0");
    const dia = String(ahora.getDate()).padStart(2, "0");
    const horas = String(ahora.getHours()).padStart(2, "0");
    const minutos = String(ahora.getMinutes()).padStart(2, "0");

    return `${año}-${mes}-${dia}T${horas}:${minutos}`;
  }

  // Establece la fecha al cargar el formulario
  campoFecha.value = getFechaActualFormateada();
});

