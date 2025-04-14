// Modal nuevo registro
var visitorModal = document.getElementById("myModal");
var newVisitorBtn = document.getElementById("nuevo_registro");
var visitorCloseBtn = document.getElementsByClassName("close")[0];
var categoriaInput = document.getElementById("U_id");
var passwordInput = document.getElementById("U_password");
var passwordLabel = document.getElementById("passwordLabel");

if (newVisitorBtn) {
  newVisitorBtn.onclick = function () {
    visitorModal.style.display = "block";
    passwordInput.style.display = "none";
    passwordLabel.style.display = "none";
  };
}

if (visitorCloseBtn) {
  // Cerrar el modal
  visitorCloseBtn.onclick = function () {
    visitorModal.style.display = "none";
  };
}


// Cerrar el modal si se hace clic fuera de él
window.onclick = function (event) {
  if (event.target == visitorModal) {
    visitorModal.style.display = "none";
  }
};

// Mostrar el campo de contraseña según el valor de categoría
if (categoriaInput && passwordInput && passwordLabel) {
  categoriaInput.addEventListener("input", function () {
    if (
      categoriaInput.value === "1" ||
      categoriaInput.value === "2" ||
      categoriaInput.value === "3"
    ) {
      passwordLabel.style.display = "block";
      passwordInput.style.display = "block";
    } else {
      passwordLabel.style.display = "none";
      passwordInput.style.display = "none";
    }
  });
}

// Mantener o cambiar el filtro después de un registro
var form = document.getElementById("myForm");
if (form && categoriaInput && document.getElementById("R_id")) {
  form.onsubmit = function () {
    var selectedRole = categoriaInput.value;

    if (selectedRole === "2" && document.getElementById("R_id").value == "3") {
      document.querySelector('input[name="filter"]').value = "2";
    } else if (
      selectedRole === "3" &&
      document.getElementById("R_id").value != "3"
    ) {
      document.querySelector('input[name="filter"]').value = "3";
    }
  };
}

//------------Fin modal registro--------------

var visitorModalEdit = document.getElementById("myModal-Udate");
var visitorCloseBtnEdit = document.getElementsByClassName("close")[1]; // Asegúrate de que esta clase es única para el modal de edición

document.querySelectorAll(".edit-btn").forEach(function (button) {
  button.onclick = function () {
    // Obtenemos los datos del botón usando getAttribute
    var id = this.getAttribute("data-id");
    var nombre = this.getAttribute("data-nombre");
    var apellidos = this.getAttribute("data-apellidos");
    var telefono = this.getAttribute("data-telefono");
    var correo = this.getAttribute("data-correo");
    var departamento = this.getAttribute("data-departamento");
    var departamentoId = this.getAttribute("data-departamento-id");
    var torre = this.getAttribute("data-torre");
    var rol = this.getAttribute("data-rol"); // Obtener el valor del rol (por ejemplo, "1" para Administrador)
    var pass = this.getAttribute("data-contrasena");


    // Asignamos esos valores a los campos del formulario de edición
    document.getElementById("E_id").value = id;
    document.getElementById("E_Nombre").value = nombre;
    document.getElementById("E_Apellido").value = apellidos;
    document.getElementById("E_Telefono").value = telefono;
    document.getElementById("E_Gmail").value = correo;
    document.getElementById("E_Departamento").value = departamentoId;
    // Seleccionar la torre
    document.getElementById("select_torre").value = torre;

    var selectDepartamento = document.getElementById("E_Departamento");
    var found = false;

    for (let i = 0; i < selectDepartamento.options.length; i++) {
      if (selectDepartamento.options[i].value === departamentoId) {
        found = true;
        break;
      }
    }

    if (!found && departamentoId) {
      let nuevaOpcion = document.createElement("option");
      nuevaOpcion.value = departamentoId;
      nuevaOpcion.textContent = departamento; // Texto visible, puedes poner aquí el número del apartamento
      selectDepartamento.appendChild(nuevaOpcion);
    }

    selectDepartamento.value = departamentoId;

    // Convertir el texto del rol a número
    var tipo_rol = rol === "Administrador" ? 1 : rol === "Guardia" ? 2 : 3;
    // Seleccionar el rol en el select
    var rolSelect = document.getElementById("R_id");
    for (var i = 0; i < rolSelect.options.length; i++) {
      if (rolSelect.options[i].value == tipo_rol) {
        rolSelect.selectedIndex = i;
        break;
      }
    }
    $('#R_id').change(function () {
      if (tipo_rol == 1) {
        let ValueRol = $('#R_id').val()
        if (ValueRol != 1) {

          $.ajax({
            url: 'http://localhost:8080/UserController/verifyRol', // Asegúrate de que la ruta es correcta
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (respuesta) {
              console.log('Respuesta cruda:', respuesta) // Ver la respuesta antes de procesarla

              if (respuesta.length === 1 && respuesta[0].Ro_id == 1) {
                error('Por favor, primero agregue a otro administrador')
                $('#R_id').val(1).change();
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.error('Error en la petición AJAX:', textStatus, errorThrown)
            }
          })
        }
      }

    })

    // Mostrar u ocultar el campo de contraseña
    var passwordLabel = document.getElementById("E_passwordl");
    var passwordInput = document.getElementById("E_password");

    if (pass) {
      passwordLabel.style.display = "block";
      passwordInput.style.display = "block";
      passwordInput.value = pass;
    } else {
      passwordLabel.style.display = "none";
      passwordInput.style.display = "none";
      passwordInput.value = "";
    }

    // Mostrar el modal de edición
    document.getElementById("myModal-Udate").style.display = "block";
  };
});
if (visitorCloseBtnEdit) {
  // Cerrar el modal cuando el usuario haga clic en la "X" o fuera del modal de edición
  visitorCloseBtnEdit.onclick = function () {
    visitorModalEdit.style.display = "none";
  };
}


// Cerrar el modal si el usuario hace clic fuera del modal de edición
window.onclick = function (event) {
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

// -------- Modal historial de visitantes-------
