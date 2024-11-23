
//Modal nuevo registro
var visitorModal = document.getElementById("myModal");
var newVisitorBtn = document.getElementById("nuevo_registro");
var visitorCloseBtn = document.getElementsByClassName("close")[0];
var categoriaInput = document.getElementById("R_id");
var passwordInput = document.getElementById("U_password");
var passwordLabel = document.getElementById("passwordLabel");

newVisitorBtn.onclick = function () {
    visitorModal.style.display = "block";
    passwordInput.style.display = "none";
    passwordLabel.style.display = "none";
};

visitorCloseBtn.onclick = function () {
    visitorModal.style.display = "none";

};

window.onclick = function (event) {
    if (event.target == visitorModal) {
        visitorModal.style.display = "none";
    }
};

// Mostrar el campo de contraseña según el valor de categoría
categoriaInput.addEventListener("input", function () {
  if (categoriaInput.value === "1" || categoriaInput.value === "2") {
      passwordLabel.style.display = "block";
      passwordInput.style.display = "block";
  } else {
      passwordLabel.style.display = "none";
      passwordInput.style.display = "none";
  }
});

//------------Fin modal registro--------------



//Modal nuevo editar
var visitorModal = document.getElementById("myModal");
var newVisitorBtn = document.getElementById("nuevo_registro");
var visitorCloseBtn = document.getElementsByClassName("close")[0];
var categoriaInput = document.getElementById("R_id");
var passwordInput = document.getElementById("U_password");
var passwordLabel = document.getElementById("passwordLabel");

newVisitorBtn.onclick = function () {
    visitorModal.style.display = "block";
    passwordInput.style.display = "none";
    passwordLabel.style.display = "none";
};

visitorCloseBtn.onclick = function () {
    visitorModal.style.display = "none";

};

window.onclick = function (event) {
    if (event.target == visitorModal) {
        visitorModal.style.display = "none";
    }
};

// Mostrar el campo de contraseña según el valor de categoría
categoriaInput.addEventListener("input", function () {
  if (categoriaInput.value === "1" || categoriaInput.value === "2") {
      passwordLabel.style.display = "block";
      passwordInput.style.display = "block";
  } else {
      passwordLabel.style.display = "none";
      passwordInput.style.display = "none";
  }
});

//Fin modal registro


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

 function toggleTabla(id) {
  const tabla = document.getElementById(id); // Seleccionar la tabla específica por su ID único
  if (tabla.style.display === 'none' || tabla.style.display === '') {
      tabla.style.display = 'block'; // Muestra la tabla
  } else {
      tabla.style.display = 'none'; // Oculta la tabla
  }
}
