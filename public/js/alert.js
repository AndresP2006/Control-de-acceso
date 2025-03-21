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
  button.addEventListener('click', async function() {
    const deleteId = this.getAttribute('data-id'); // Obtener el ID del usuario

    // Confirmación de la eliminación
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
      // Crear el formulario para eliminar el registro
      let form = document.createElement('form');
      form.method = 'POST';
      form.action = 'http://localhost/Control-de-acceso/UserController/DeleteUser';  // Cambiar la URL de acuerdo con tu ruta

      // Crear el campo para el ID de eliminación
      let deleteInput = document.createElement('input');
      deleteInput.type = 'hidden';
      deleteInput.name = 'delete_id';  // El nombre del campo
      deleteInput.value = deleteId;  // Asignar el ID del usuario
      form.appendChild(deleteInput);

      // Crear el campo para confirmar el botón de eliminación
      let deleteBtnInput = document.createElement('input');
      deleteBtnInput.type = 'hidden';
      deleteBtnInput.name = 'deletebtn'; // El nombre del botón de confirmación
      deleteBtnInput.value = '1';
      form.appendChild(deleteBtnInput);

      // Añadir el formulario al cuerpo del documento
      document.body.appendChild(form);

      // Enviar el formulario para realizar la eliminación
      form.submit();  
    }
  });
});

//----- Paquete----------






