document.getElementById("u_id").addEventListener("blur", function () {
  let cedula = this.value.trim();

  if (cedula.length > 0) {
    fetch(RUTA_URL + "/PorterController/BuscarVisitante", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "u_id=" + encodeURIComponent(cedula),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data && data.nombre) {
          document.getElementById("U_Nombre").value = data.nombre;
          document.getElementById("U_Apellido").value = data.apellido;
          document.getElementById("U_Telefono").value = data.telefono;
        } else {
          document.getElementById("U_Nombre").value = "";
          document.getElementById("U_Apellido").value = "";
          document.getElementById("U_Telefono").value = "";
        }
      });
  }
});
