document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("myForm");

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
    console.log("Formulario enviado");
  });
});
document.addEventListener("DOMContentLoaded", () => {
  const editarPersonas = document.getElementsByClassName("editarForm");

  for (let i = 0; i < editarPersonas.length; i++) {
    editarPersonas[i].addEventListener("submit", (e) => {
      const errores = []; // Declara errores dentro del listener de cada formulario

      const idE = document.getElementById("E_id").value.trim();
      const nombreE = document.getElementById("E_Nombre").value.trim();
      const apellidoE = document.getElementById("E_Apellido").value.trim();
      const telefonoE = document.getElementById("E_Telefono").value.trim();
      const correoE = document.getElementById("E_Gmail").value.trim();
      const torreE = document.getElementById("select_torre").value.trim();
      const departamentoE = document
        .getElementById("E_Departamento")
        .value.trim();
      const rolE = document.getElementById("R_id").value.trim();

      if (idE && isNaN(idE)) {
        errores.push("El Documento debe ser un número.");
      }
      if (telefonoE && isNaN(telefonoE)) {
        errores.push("El Teléfono debe ser un número.");
      }
      const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (correoE && !regexCorreo.test(correoE)) {
        errores.push("El Correo no es válido.");
      }
      if (
        !idE ||
        !nombreE ||
        !apellidoE ||
        !telefonoE ||
        !correoE ||
        !torreE ||
        !departamentoE ||
        !rolE
      ) {
        errores.push("Por favor, complete todos los campos.");
      }

      if (errores.length > 0) {
        e.preventDefault(); // Previene el envío SOLO si hay errores
        mostrarAdvertencia(errores.join("\n"));
      } else {
        // Si no hay errores, el formulario se enviará normalmente
        // No necesitas llamar a submit() explícitamente a menos que estés usando AJAX
        // editarPersonas[i].submit(); // Esto es innecesario para envíos tradicionales
        console.log("Formulario válido, enviando..."); // Para depuración
      }
    });
  }
});
function mostrarAdvertencia(mensaje) {
  Swal.fire({
    title: "ADVERTENCIA",
    text: mensaje,
    icon: "warning",
  });
}
