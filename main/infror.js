let rivera = document.querySelector("img.contenido__imagenes-1");

let fotosArray = [
  "../imagenes_logos/rivera1.jpg",
  "../imagenes_logos/rivera2.jpg",
  "../imagenes_logos/rivera3.jpg",
];

let fotosPos = 0;

function canbiarFoto(direccion) {
  fotosPos = (fotosPos + direccion + fotosArray.length) % fotosArray.length;
  rivera.setAttribute("src", fotosArray[fotosPos]);
}

document.querySelector("img.atras").onclick = () => canbiarFoto(-1);
document.querySelector("img.adelante").onclick = () => canbiarFoto(1);

