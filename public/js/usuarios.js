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
    let valorAnterior = $('#R_id').val(); // guardamos el valor inicial

$('#R_id').focus(function () {
  valorAnterior = $(this).val(); // al enfocar, guardamos el valor anterior
});

$('#R_id').change(function () {
  let nuevoValor = $(this).val();

  // Si el valor anterior era 1 (administrador) y se intenta cambiar a otro
  if (tipo_rol == 1 && valorAnterior == 1 && nuevoValor != 1) {
    $.ajax({
      url: RUTA_URL + '/UserController/verifyRol',
      type: 'POST',
      data: {},
      dataType: 'json',
      success: function (respuesta) {
        console.log('Respuesta cruda:', respuesta);

        if (respuesta.length === 1 && respuesta[0].Ro_id == 1) {
          error('Por favor, primero agregue a otro administrador antes de quitar este rol');
          $('#R_id').val(1); // volvemos a Administrador
        } else {
          valorAnterior = nuevoValor; // se permite el cambio
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error('Error en la petición AJAX:', textStatus, errorThrown);
      }
    });
  } else {
    valorAnterior = nuevoValor; // actualización normal
  }
});



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
