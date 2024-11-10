function realizado(messaje){
    Swal.fire({
        title: "CONFIRMACION",
        text: messaje,
        icon: "success",
    });
}

function error(mensaje){
    Swal.fire({
        title: "ERROR!",
        text: mensaje,
        icon: "error"
    });
}

function advertencia(mensaje){
    Swal.fire({
        title: "ADVERTENCIA!",
        text: mensaje,
        icon: "warning",
    });
}
