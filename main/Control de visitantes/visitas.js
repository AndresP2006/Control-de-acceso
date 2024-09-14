// Modal de visitante
var visitorModal = document.getElementById("myModal");
var newVisitorBtn = document.getElementById("nuevo_registro");
var visitorCloseBtn = document.getElementsByClassName("close")[0];

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

document.getElementById("myForm").onsubmit = function (event) {
  event.preventDefault();

  var U_Id = document.getElementById("u_id").value;
  var U_Nombre = document.getElementById("U_Nombre").value;
  var U_Apellido = document.getElementById("U_Apellido").value;
  var U_Telefono = document.getElementById("U_Telefono").value;
  var U_Motivo = document.getElementById("U_Motivo").value;
  var U_Paquete = document.getElementById("U_Paquete").value;

  // Asignar los valores a los inputs del formulario de visualización
  document.getElementById("displayU_Id").value = U_Id;
  document.getElementById("displayU_Nombre").value = U_Nombre;
  document.getElementById("displayU_Apellido").value = U_Apellido;
  document.getElementById("displayU_Telefono").value = U_Telefono;
  document.getElementById("displayu_motivo").value = U_Motivo;
  document.getElementById("displayU_Paquete").value = U_Paquete;

  // Mostrar el formulario de visualización
  document.getElementById("displayForm").style.display = "block";

  // Ocultar el formulario modal
  visitorModal.style.display = "none";
};


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
  if (event.target == packageModal) {
    packageModal.style.display = "none";
  }
};
 // Administrador
 var popupAdmin = document.getElementById("popup-administracion");
 var btnAdmin = document.getElementById("boton-administracion");
 var cerrarAdmin = document.getElementById("cerrar-administracion");

 btnAdmin.onclick = function () {
   popupAdmin.style.display = "block";
 };

 cerrarAdmin.onclick = function () {
   popupAdmin.style.display = "none";
 };

 window.onclick = function (event) {
   if (event.target == popupAdmin) {
     popupAdmin.style.display = "none";
   }
 };

 // Guardia
 var popupSeguridad = document.getElementById("popup-seguridad");
 var btnSeguridad = document.getElementById("boton-seguridad");
 var cerrarSeguridad = document.getElementById("cerrar-seguridad");

 btnSeguridad.onclick = function () {
   popupSeguridad.style.display = "block";
 };

 cerrarSeguridad.onclick = function () {
   popupSeguridad.style.display = "none";
 };

 window.onclick = function (event) {
   if (event.target == popupSeguridad) {
     popupSeguridad.style.display = "none";
   }
 };

 // Cambiar usuario
 var popupCambiar = document.getElementById("popup-cambiar");
 var btnCambiarUsuario = document.getElementById("cambiar-usuario");
 var cerrarPopup = document.getElementById("cerrar-popup");

 btnCambiarUsuario.onclick = function () {
   popupCambiar.style.display = "block";
 };

 cerrarPopup.onclick = function () {
   popupCambiar.style.display = "none";
 };

 window.onclick = function (event) {
   if (event.target == popupCambiar) {
     popupCambiar.style.display = "none";
   }
 };

