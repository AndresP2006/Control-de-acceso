document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("myForm");
  const formularioPaquetes = document.getElementById("packageForm");
  // Formularo de ingreso de visitas
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

  //Formulario de paquetes
  formularioPaquetes.addEventListener("submit", (e) => {
    const descriptionPaquetes = document
      .getElementById("Pa_Descripcion")
      .value.trim();
    const fechaPaquetes = document.getElementById("Pa_Fecha").value.trim();
    const Firma = document.getElementById("Pa_Firma").value.trim();
    const torrePaquetes = document
      .getElementById("select_torre_p")
      .value.trim();
    const apartamentoPaquetes = document
      .getElementById("select_apartamento_p")
      .value.trim();
    const destinatario = document
      .getElementById("select_personas_p")
      .value.trim();

    let errores = [];

    if (
      !descriptionPaquetes ||
      !fechaPaquetes ||
      !Firma ||
      !torrePaquetes ||
      apartamentoPaquetes === "0" ||
      destinatario === "0"
    ) {
      errores.push("Por favor, complete todos los campos.");
    }

    if (errores.length > 0) {
      e.preventDefault(); // ❗ Solo se bloquea si hay errores
      advertencia(errores.join(" / "));
    }

    console.log(errores);
  });

  //Formulario de personas de admin
});

function advertencia(mensaje) {
  Swal.fire({
    title: "ADVERTENCIA",
    text: mensaje,
    icon: "warning",
  });
}
