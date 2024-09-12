var modal = document.getElementById("myModal");
var btn = document.getElementById("nuevo_registro");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
  modal.style.display = "block";
};

span.onclick = function () {
  modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

document.getElementById("myForm").onsubmit = function(event) {
  event.preventDefault();

  var U_Id = document.getElementById("U_Id").value;
  var U_Apellido = document.getElementById("U_Apellido").value;
  var U_Fotografia = document.getElementById("U_Fotografia").value;
  var U_Nombre = document.getElementById("U_Nombre").value;
  var U_Telefono = document.getElementById("U_Telefono").value;

  // Asignar los valores a los inputs del formulario de visualización
  document.getElementById("displayU_Id").value = U_Id;
  document.getElementById("displayU_Apellido").value = U_Apellido;
  document.getElementById("displayU_Fotografia").value = U_Fotografia;
  document.getElementById("displayU_Nombre").value = U_Nombre;
  document.getElementById("displayU_Telefono").value = U_Telefono;

  // Mostrar el formulario de visualización
  document.getElementById("displayForm").style.display = "block";

  // Ocultar el formulario modal
  modal.style.display = "none";
};
