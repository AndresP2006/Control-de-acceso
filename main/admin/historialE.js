var modal = document.getElementById("modalOverlay");
var span = document.getElementsByClassName("modal-close")[0];

document.getElementById('showFormButton').addEventListener('click', function() {
    modal.style.display = 'block';
});

span.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};
var model = document.getElementById("myModal");
var boton = document.getElementById("openModalBtn");
var cerrar = document.getElementsByClassName("close")[0];


boton.onclick = function() {
    model.style.display = "block";
}


cerrar.onclick = function() {
    model.style.display = "none";
}


window.onclick = function(event) {
    if (event.target == model) {
        model.style.display = "none";
    }
};