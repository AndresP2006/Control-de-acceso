

var ModalHistorial = document.getElementById("myModalHistorial");
var CloseBtnHistorial = document.getElementById("closeHistorial");

// Verificamos el estado del modal al cargar la página
window.onload = function() {
    const modalState = sessionStorage.getItem('modalState');  // Verificar si el modal estuvo abierto
    if (modalState === 'open') {
        ModalHistorial.style.display = "block";  // Abrir el modal si estuvo abierto
    }
};

// Escuchar clics en los botones de editar solo para 'myModal-Udate'
document.querySelectorAll('.historial-btn').forEach(function(button) {
    button.onclick = function() {
        // Mostrar el modal de edición
        ModalHistorial.style.display = "block";
        // Guardamos el estado del modal como 'open' en sessionStorage
        sessionStorage.setItem('modalState', 'open');
    };
});

// Cerrar el modal cuando el usuario haga clic en la "X" o fuera del modal de edición
CloseBtnHistorial.onclick = function() {
    ModalHistorial.style.display = "none";
    // Guardamos el estado del modal como 'closed' en sessionStorage
    sessionStorage.setItem('modalState', 'closed');
};

// Cerrar el modal si el usuario hace clic fuera del modal de edición
window.onclick = function(event) {
    if (event.target == ModalHistorial) {
        ModalHistorial.style.display = "none";
        // Guardamos el estado del modal como 'closed' en sessionStorage
        sessionStorage.setItem('modalState', 'closed');
    }
};


