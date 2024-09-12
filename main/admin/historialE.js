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
}