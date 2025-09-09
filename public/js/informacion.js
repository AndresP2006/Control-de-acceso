const conRivera = document.getElementById("img2");

let fotosArray = [
  "../img/rivera1.jpg",
  "../img/rivera2.jpg",
  "../img/rivera3.jpg",
];
let fotosPos = 0;

function cambiarFoto(direccion = 1) {
  fotosPos = (fotosPos + direccion + fotosArray.length) % fotosArray.length;
  if (conRivera) {
    conRivera.setAttribute("src", fotosArray[fotosPos]);
  }
}

// Cambia la foto automáticamente cada 2 segundos
setInterval(() => cambiarFoto(1), 2000);

// Opcional: muestra la primera imagen al cargar
if (conRivera) {
  conRivera.setAttribute("src", fotosArray[fotosPos]);
}
