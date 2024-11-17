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



