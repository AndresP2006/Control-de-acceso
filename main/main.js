
let fotos = document.querySelector("img.foto1");

let fotosArray = [
  "../imagenes_logos/departamento1-inicio.jpg",
  "../imagenes_logos/departamento2-inicio.jpg",
  "../imagenes_logos/departamento3-inicio.jpg",
];

let fotoIndex = 0;

function cambiarFoto(direccion) {
  // Calcula el nuevo índice de la foto
  fotoIndex = (fotoIndex + direccion + fotosArray.length) % fotosArray.length;
  fotos.setAttribute("src", fotosArray[fotoIndex]);
}

document.querySelector("img.atras").onclick = () => cambiarFoto(-1);
document.querySelector("img.adelante").onclick = () => cambiarFoto(1);

// informacion pagina

