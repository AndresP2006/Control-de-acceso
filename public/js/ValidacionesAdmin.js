document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("myForm");
  const editarPersona = document.getElementById("myFomr");

  formulario.addEventListener("submit", (e) => {
    const id = document.getElementById("u_id").value.trim();
    const nombre = document.getElementById("U_Nombre").value.trim();
    const apellido = document.getElementById("U_Apellido").value.trim();
    const telefono = document.getElementById("U_Telefono").value.trim();
    const correo = document.getElementById("U_Gmail").value.trim();
    const torre = document.getElementById("select_torre2").value.trim();
    const apartamento = document.getElementById("U_Departamento").value.trim();
    const rol = document.getElementById("U_id").value.trim();
    const contrasena = document.getElementById("U_password").value.trim();

    let errores = [];

    // Validar campos vacíos
    if (
      !id ||
      !nombre ||
      !apellido ||
      !telefono ||
      !correo ||
      !torre ||
      !apartamento ||
      !rol ||
      !contrasena
    ) {
      errores.push("Por favor, complete todos los campos.");
    }

    // Validar que documento y teléfono sean números
    if (id && isNaN(id)) {
      errores.push("El Documento debe ser un número.");
    }
    if (telefono && isNaN(telefono)) {
      errores.push("El Teléfono debe ser un número.");
    }

    // Validar correo
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (correo && !regexCorreo.test(correo)) {
      errores.push("El Correo no es válido.");
    }

    if (errores.length > 0) {
      e.preventDefault();
      mostrarAdvertencia(errores.join("\n"));
    }
  });
});

function mostrarAdvertencia(mensaje) {
  Swal.fire({
    title: "ADVERTENCIA",
    text: mensaje,
    icon: "warning",
  });
}
