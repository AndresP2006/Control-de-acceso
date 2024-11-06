// Modal de visitante
var visitorModal = document.getElementById("myModal");
var newVisitorBtn = document.getElementById("nuevo_registro");
var visitorCloseBtn = document.getElementsByClassName("close")[0];

newVisitorBtn.onclick = function () {
  visitorModal.style.display = "block";
};

visitorCloseBtn.onclick = function () {
  visitorModal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == visitorModal) {
    visitorModal.style.display = "none";
  }
};

var packageModal = document.getElementById("packageModal");
var newPackageBtn = document.getElementById("openModalBtn");
var packageCloseBtn = document.getElementById("closeModal");

newPackageBtn.onclick = function () {
  packageModal.style.display = "block";
};

packageCloseBtn.onclick = function () {
  packageModal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == packageModal) {
    packageModal.style.display = "none";
  }
};

// mostrar datos
const botonMostrar = document.getElementById("Actualizar");
const overlay = document.getElementById("overlay");
const botonCerrar = document.getElementById("cerrar");

// botonMostrar.onclick = function () {
//   overlay.style.display = "block";
// };
function motrar(){
  overlay.style.display = "block";
}
botonCerrar.onclick = function () {
  overlay.style.display = "none";
  window.location.href="http://localhost/andres/Control-de-acceso-main/paginas/Guardia/index.php";
};

overlay.onclick = function (event) {
  if (event.target === overlay) {
    overlay.style.display = "none";
    window.location.href="http://localhost/andres/Control-de-acceso-main/paginas/Guardia/index.php";
  }
};
