let rivera = document.querySelector("img.contenido__imagenes-1");

let fotosArray = [
  "/img/rivera1.jpg",
  "/img/rivera2.jpg",
  "/img/rivera3.jpg",
];

let fotosPos = 0;

function canbiarFoto(direccion) {
  fotosPos = (fotosPos + direccion + fotosArray.length) % fotosArray.length;
  rivera.setAttribute("src", fotosArray[fotosPos]);
}

document.querySelector("img.atras").onclick = () => canbiarFoto(-1);
document.querySelector("img.adelante").onclick = () => canbiarFoto(1);

