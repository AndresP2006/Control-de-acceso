const openModalBtn = document.getElementById("openModalBtn");
const modal = document.getElementById("myModal");
const closeModal = document.getElementById("closeModal");

// Mostrar el modal cuando se hace clic en el botón
openModalBtn.addEventListener("click", function() {
    modal.style.display = "block";
});

// Cerrar el modal cuando se hace clic en la 'X'
closeModal.addEventListener("click", function() {
    modal.style.display = "none";
});

// Cerrar el modal si se hace clic fuera del contenido
window.addEventListener("click", function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});