function realizado(mensaje) {
  Swal.fire({
    title: "CONFIRMACION",
    text: mensaje,
    icon: "success",
  });
}

function realizadoDelet(){
  Swal.fire({
    title: "¡Eliminado!",
    text: "Tu archivo ha sido eliminado.",
    icon: "success"
});
}
function realizadoActivar() {
  Swal.fire({
    title: "¡Activado!",
    text: "El usuario ha sido activado correctamente.",
    icon: "success"
  });
}

function error(mensaje) {
  Swal.fire({
    title: "ERROR!",
    text: mensaje,
    icon: "error"
  });
}

function advertencia(mensaje) {
  Swal.fire({
    title: "ADVERTENCIA!",
    text: mensaje,
    icon: "warning",
  });
}

//---------Delete User-----------


  document.querySelectorAll('.delete-btn').forEach(button => {
    const estado = button.getAttribute('data-estado');

    // Si el usuario está inactivo, cambiamos el botón a "activar"
    if (estado === 'inactivo') {
      button.innerText = '✅'; // Cambia el icono
      button.style.backgroundColor = 'green'; // Cambia el color
      button.title = 'Activar usuario';
    }

    button.addEventListener('click', async function () {
      const deleteId = this.getAttribute('data-id');
      const estadoActual = this.getAttribute('data-estado');

      if (estadoActual === 'inactivo') {
        // Confirmar activación
        const result = await Swal.fire({
          title: "¿Deseas activar este usuario?",
          text: "El usuario volverá a estar activo",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#28a745",
          cancelButtonColor: "#d33",
          confirmButtonText: "¡Sí, activarlo!"
        });

        if (result.isConfirmed) {
          // Crear formulario para eliminar usuario
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = RUTA_URL + '/UserController/ActivarUsuario';

          const inputId = document.createElement('input');
          inputId.type = 'hidden';
          inputId.name = 'registro_id';
          inputId.value = deleteId;

          const inputBtn = document.createElement('input');
          inputBtn.type = 'hidden';
          inputBtn.name = 'deletebtn';
          inputBtn.value = '1';

          form.appendChild(inputId);
          form.appendChild(inputBtn);
          document.body.appendChild(form);
          form.submit();
        }
      } else {
        // Confirmar eliminación
        const result = await Swal.fire({
          title: "¿Estás seguro?",
          text: "¡No podrás revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "¡Sí, eliminarlo!"
        });

        if (result.isConfirmed) {
          // Crear formulario para eliminar usuario
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = RUTA_URL + '/UserController/DeleteUser';

          const inputId = document.createElement('input');
          inputId.type = 'hidden';
          inputId.name = 'delete_id';
          inputId.value = deleteId;

          const inputBtn = document.createElement('input');
          inputBtn.type = 'hidden';
          inputBtn.name = 'deletebtn';
          inputBtn.value = '1';

          form.appendChild(inputId);
          form.appendChild(inputBtn);
          document.body.appendChild(form);
          form.submit();
        }
      }
    });
  });



//----- Confirmar registro ----------
//Este codigo esta para activar los usuarios cuando estas registrando 
function confirmarRegistro(estadoRegistro, idRegistro) {
  if (estadoRegistro === "inactivo") {
    Swal.fire({
      title: "Registro inactivo",
      text: "Este registro ya existe y está inactivo. ¿Deseas activarlo?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#28a745",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, activarlo",
      cancelButtonText: "Cancelar",
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = RUTA_URL + '/UserController/ActivarUsuario';

        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'registro_id';
        inputId.value = idRegistro;

        const inputBtn = document.createElement('input');
        inputBtn.type = 'hidden';
        inputBtn.name = 'activar_btn';
        inputBtn.value = '1';

        form.appendChild(inputId);
        form.appendChild(inputBtn);
        document.body.appendChild(form);
        form.submit();
      }
    });
  }
}








