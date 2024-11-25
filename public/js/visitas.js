// Modal de visitante
var visitorModal = document.getElementById("VisitasModal");
var newVisitorBtn = document.getElementById("nuevo_registro");
var visitorCloseBtn = document.getElementById("close");

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

// Modal de paquetes
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
  if (event.target == visitorModal) {
    visitorModal.style.display = "none";
  } else if (event.target == packageModal) {
    packageModal.style.display = "none";
  }
};

const abrirTablaFlotante = document.getElementById("abrirTablaFlotante");
const tablaFlotante = document.getElementById("tablaFlotante");

abrirTablaFlotante.addEventListener("click", () => {
  tablaFlotante.style.display = "flex";
});
window.addEventListener("click", (e) => {
  if (e.target === tablaFlotante) {
    tablaFlotante.style.display = "none";
  }
});
