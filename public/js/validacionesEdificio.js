document.addEventListener("DOMContentLoaded", () => {
  const torreForm = document.getElementById("torre");
  const apartamentoForm = document.getElementById("apartamento");
  const inputID = document.getElementById("ID");
  const inputTorre = document.getElementById("torre2");

  // Bloquear letras en el input de ID
  inputID.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");
  });

  inputTorre.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");
  });
  torreForm.addEventListener("submit", function (event) {
    const id = document.getElementById("ID").value.trim();
    const torre = document.getElementById("torre1").value.trim();

    if (id === "" || torre === "") {
      event.preventDefault();
      mostrarAdvertencia("Por favor, complete todos los campos.");
    }
  });

  apartamentoForm.addEventListener("submit", function (event) {
    const torre = document.getElementById("torre").value.trim();
    const apartamento = document.getElementById("torre2").value.trim();

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
