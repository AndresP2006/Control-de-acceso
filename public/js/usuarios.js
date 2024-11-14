// Modal de usuario
var visitorUsuModal = document.getElementById("Modal");
var newVisitorUsuBtn = document.getElementById("NuevoUsuaro");
var visitorUsuCloseBtn = document.getElementsByClassName("closes")[0];


newVisitorUsuBtn.onclick = function () {
  visitorUsuModal.style.display = "block";
};

visitorUsuCloseBtn.onclick = function () {
  visitorUsuModal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == visitorUsuModal) {
      visitorUsuModal.style.display = "none";
  }
};