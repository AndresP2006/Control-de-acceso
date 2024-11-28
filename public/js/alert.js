function realizado(mensaje){
    Swal.fire({
        title: "CONFIRMACION",
        text: mensaje,
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

// function comprobar(mensaje, formId) {
//     const swalWithBootstrapButtons = Swal.mixin({
//         customClass: {
//             confirmButton: "btn btn-success",
//             cancelButton: "btn btn-danger"
//         },
//         buttonsStyling: false
//     });

//     swalWithBootstrapButtons.fire({
//         title: "¿Está seguro?",
//         text: mensaje,
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Sí, eliminar",
//         cancelButtonText: "No, cancelar",
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.getElementById("deleteForm_" + formId).submit();
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//             swalWithBootstrapButtons.fire({
//                 title: "Cancelado",
//                 text: "La acción ha sido cancelada.",
//                 icon: "error"
//             });
//         }
//     });
// }

