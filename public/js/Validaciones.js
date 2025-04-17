document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("myForm");

  formulario.addEventListener("submit", (e) => {
    const idV = document.getElementById("u_id").value.trim();
    const nombreV = document.getElementById("U_Nombre").value.trim();
    const apellidoV = document.getElementById("U_Apellido").value.trim();
    const telefonoV = document.getElementById("U_Telefono").value.trim();
    const motivoV = document.getElementById("U_Motivo").value.trim();
    const torreV = document.getElementById("select_torre").value.trim();
    const apartamentoV = document
      .getElementById("select_apartamento")
      .value.trim();
    const personaV = document.getElementById("select_personas").value.trim();

    let errores = [];

    if (
      !idV ||
      !nombreV ||
      !apellidoV ||
      !telefonoV ||
      !motivoV ||
      !torreV ||
      apartamentoV === "0" ||
      personaV === "0"
    ) {
      errores.push("Por favor, complete todos los campos.");
    }

    if (idV && isNaN(idV)) {
      errores.push("El Documento debe ser un número.");
    }

    if (telefonoV && isNaN(telefonoV)) {
      errores.push("El Teléfono debe ser un número.");
    }

    if (errores.length > 0) {
      e.preventDefault(); // ❗ Solo se bloquea si hay errores
      advertencia(errores.join(" / "));
    }

    // Si no hay errores, el formulario se enviará automáticamente al PHP
    console.log(errores);
  });
});

function advertencia(mensaje) {
  Swal.fire({
    title: "ADVERTENCIA",
    text: mensaje,
    icon: "warning",
  });
}
