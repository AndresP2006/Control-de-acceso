var modal = document.getElementById("modalOverlay");
var span = document.getElementsByClassName("modal-close")[0];

document.getElementById('showFormButton').addEventListener('click', function() {
    modal.style.display = 'block';
});

span.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};
var model = document.getElementById("myModal");
var boton = document.getElementById("openModalBtn");
var cerrar = document.getElementsByClassName("close")[0];


boton.onclick = function() {
    model.style.display = "block";
}


cerrar.onclick = function() {
    model.style.display = "none";
}


window.onclick = function(event) {
    if (event.target == model) {
        model.style.display = "none";
    }
};
var visitorModal = document.getElementById("Modal");
var newVisitorBtn = document.getElementById("NuevoUsuaro");
var visitorCloseBtn = document.getElementsByClassName("closes")[0];

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

