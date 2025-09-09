document.addEventListener("DOMContentLoaded", () => {
  const torreForm = document.getElementById("torre");
  const apartamentoForm = document.getElementById("apartamento");
  const inputID = document.getElementById("ID");
  const inputTorre = document.getElementById("torre2");

  // Bloquear letras en el input de ID
  inputID.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");
  });

  // Bloquear números en el input de departamento
  inputTorre.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");
  });

  // Validación para el formulario de torre
  torreForm.addEventListener("submit", function (event) {
    const id = document.getElementById("ID").value.trim();
    const torre = document.getElementById("torre1").value.trim();
    if (id === "" && torre === "") {
      event.preventDefault();
      mostrarAdvertencia("Por favor, complete todos los campos.");
    }
  });

  // Validación para el formulario de apartamento
  apartamentoForm.addEventListener("submit", function (event) {
    
    // console.log("Formulario de apartamento enviado");
    
    const torre = document.getElementById("torre").value;
    // console.log("Formulario de apartamento enviado");
    const apartamento = document.getElementById("torre2").value;
    
    if (torre === "" || apartamento === "") {
      event.preventDefault();
      mostrarAdvertencia("Por favor, complete todos los campos.");
    } 
  });

  function mostrarAdvertencia(mensaje) {
    Swal.fire({
      icon: "warning",
      title: "ADVERTENCIA",
      text: mensaje,
    });
  }
});
