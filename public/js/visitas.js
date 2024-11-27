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
document.getElementById('Pa_Fecha').addEventListener('change', function() {
  const inputDate = new Date(this.value); 
  const today = new Date(); 
  today.setHours(0, 0, 0, 0); 

  if (inputDate > today) {
      alert('No puedes seleccionar una fecha posterior al día de hoy.');
      this.value = ''; 
  }
});