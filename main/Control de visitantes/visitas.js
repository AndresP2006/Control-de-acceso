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

document.getElementById("myForm").onsubmit = function (event) {
  event.preventDefault();

  var name = document.getElementById("name").value;
  var documentType = document.getElementById("document").value;
  var numeroDoc = document.getElementById("numero-Doc").value;
  var departamento = document.getElementById("Departamento").value;

  var dataHtml = `
    <p><strong>Nombre y Apellido:</strong> ${name}</p>
    <p><strong>Tipo de documento:</strong> ${documentType}</p>
    <p><strong>Número de Documento:</strong> ${numeroDoc}</p>
    <p><strong>Número de Departamento:</strong> ${departamento}</p>
  `;

  document.getElementById("formData").innerHTML = dataHtml;

  modal.style.display = "none";
};
