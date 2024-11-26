
// Modal nuevo registro
var visitorModal = document.getElementById("myModal");
var newVisitorBtn = document.getElementById("nuevo_registro");
var visitorCloseBtn = document.getElementsByClassName("close")[0];
var categoriaInput = document.getElementById("U_id");
var passwordInput = document.getElementById("U_password");
var passwordLabel = document.getElementById("passwordLabel");

// Abrir el modal
newVisitorBtn.onclick = function () {
    visitorModal.style.display = "block";
    passwordInput.style.display = "none";
    passwordLabel.style.display = "none";
};

// Cerrar el modal
visitorCloseBtn.onclick = function () {
    visitorModal.style.display = "none";
};

// Cerrar el modal si se hace clic fuera de él
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

// Mantener o cambiar el filtro después de un registro
document.getElementById("myForm").onsubmit = function () {
    var selectedRole = categoriaInput.value;
    
    // Si es guardia (R_id = 2) y estás en la categoría de residente (R_id = 3), cambiar el filtro
    if (selectedRole === "2" && document.getElementById("R_id").value == "3") {
        // Actualizar el filtro a "Guardia" automáticamente
        document.querySelector('input[name="filter"]').value = "2";
    } else if (selectedRole === "3" && document.getElementById("R_id").value != "3") {
        // Mantener el filtro si es Residente
        document.querySelector('input[name="filter"]').value = "3";
    }
};

//------------Fin modal registro--------------


// Obtener el modal de edición y el botón de cerrar
// Modal de edición - solo afecta al modal 'myModal-Udate'
// Modal de edición - solo afecta al modal 'myModal-Udate'
var visitorModalEdit = document.getElementById("myModal-Udate");
var visitorCloseBtnEdit = document.getElementsByClassName("close")[1]; // Asegúrate de que esta clase es única para el modal de edición

// Escuchar clics en los botones de editar solo para 'myModal-Udate'
document.querySelectorAll('.edit-btn').forEach(function(button) {
    button.onclick = function() {
        // Obtenemos los datos del botón usando getAttribute
        var id = this.getAttribute('data-id');
        var nombre = this.getAttribute('data-nombre');
        var apellidos = this.getAttribute('data-apellidos');
        var telefono = this.getAttribute('data-telefono');
        var correo = this.getAttribute('data-correo');
        var departamento = this.getAttribute('data-departamento');
        var rol = this.getAttribute('data-rol'); // Obtener el valor del rol (por ejemplo, "1" para Administrador)
        var pass = this.getAttribute('data-contrasena');
        // Asignamos esos valores a los campos del formulario de edición
        document.getElementById('E_id').value = id;
        document.getElementById('E_Nombre').value = nombre;
        document.getElementById('E_Apellido').value = apellidos;
        document.getElementById('E_Telefono').value = telefono;
        document.getElementById('E_Gmail').value = correo;
        document.getElementById('E_Departamento').value = departamento;
        document.getElementById('E_Departamento2').value = departamento;
        var tipo_rol;
      if(rol == 'Administrador'){
        tipo_rol=1;
      } else if(rol == 'Guardia'){
        tipo_rol=2;
      }else{
        tipo_rol=3;
      }
        // Asignamos el valor seleccionado del 'select' para el rol
        var rolSelect = document.getElementById('R_id');
        for (var i = 0; i < rolSelect.options.length; i++) {
            if (rolSelect.options[i].value == tipo_rol) {
                rolSelect.selectedIndex = i;
                break;
            }
        }
        // Mostrar u ocultar el campo de contraseña basado en `data-contrasena`
        var passwordLabel = document.getElementById('E_passwordl');
        var passwordInput = document.getElementById('E_password');

        if (pass) {
            passwordLabel.style.display = "block"; // Mostrar si hay contraseña
            passwordInput.style.display = "block";
            passwordInput.value = pass;
        } else {
            passwordLabel.style.display = "none"; // Ocultar si no hay contraseña
            passwordInput.style.display = "none";
            passwordInput.value = ""; // Asegurarse de limpiar el valor del campo
        }

        // Mostrar el modal de edición
        visitorModalEdit.style.display = "block";
    };
});

// Cerrar el modal cuando el usuario haga clic en la "X" o fuera del modal de edición
visitorCloseBtnEdit.onclick = function() {
    visitorModalEdit.style.display = "none";
};

// Cerrar el modal si el usuario hace clic fuera del modal de edición
window.onclick = function(event) {
    if (event.target == visitorModalEdit) {
        visitorModalEdit.style.display = "none";
    }
};

function abrirModal(id) {
    document.getElementById(id).style.display = "block";
}

function cerrarModal(id) {
    document.getElementById(id).style.display = "none";
}
