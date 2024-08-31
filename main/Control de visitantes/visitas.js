document.addEventListener('DOMContentLoaded', function () {
  var modelo = document.getElementById("modelo");
  var boton = document.querySelector("button.nuevo_registro");
  var cerrar = document.querySelector("span.cerrar");
  var formulario = document.getElementById("Formulario");
  var registrosContainer = document.getElementById("registrosContainer");

  // Muestra el modal al hacer clic en el botón
  boton.onclick = function () {
      modelo.style.display = "block";
  };

  // Cierra el modal al hacer clic en la "x"
  cerrar.onclick = function () {
      modelo.style.display = "none";
  };

  // Cierra el modal si se hace clic fuera del contenido del modal
  window.onclick = function (event) {
      if (event.target === modelo) {
          modelo.style.display = "none";
      }
  };

  // Actualiza el contenedor de registros con el contenido del formulario
  formulario.onsubmit = function (event) {
      event.preventDefault(); // Evita el envío del formulario

      // Limpiar el contenedor de registros antes de agregar el nuevo contenido
      registrosContainer.innerHTML = '';

      // Crear un nuevo contenedor para el nuevo registro
      var nuevoRegistro = document.createElement("div");
      nuevoRegistro.classList.add("registro");

      // Obtener los valores del formulario
      var name = formulario.querySelector('input[name="name"]').value;
      var doc = formulario.querySelector('select[name="doc"]').value;
      var numero = formulario.querySelector('input[name="numero"]').value;
      var departamento = formulario.querySelector('input[name="departamento"]').value;

      // Construir el contenido del nuevo registro
      nuevoRegistro.innerHTML = `
          <p><strong>Nombre y Apellido:</strong> ${name}</p>
          <p><strong>Tipo de Documento:</strong> ${doc}</p>
          <p><strong>Número de Documento:</strong> ${numero}</p>
          <p><strong>Número de Departamento:</strong> ${departamento}</p>
          <hr>
      `;

      // Agregar el nuevo registro al contenedor
      registrosContainer.appendChild(nuevoRegistro);

      // Ocultar el modal y limpiar el formulario
      modelo.style.display = "none";
      formulario.reset();
  };
});
