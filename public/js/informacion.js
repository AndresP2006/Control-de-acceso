const conRivera = document.getElementById("img2");

let fotosArray = ["../img/rivera1.jpg", "../img/rivera2.jpg", "../img/rivera3.jpg"];
let fotosPos = 0;

function cambiarFoto(direccion) {
  fotosPos = (fotosPos + direccion + fotosArray.length) % fotosArray.length;
  if (conRivera) {
    // Verifica que conRivera existe antes de usarlo
    conRivera.setAttribute("src", fotosArray[fotosPos]);
  }
}

const btnAtras = document.querySelector("img.atras");
const btnAdelante = document.querySelector("img.adelante");

if (btnAtras) {
  btnAtras.onclick = () => cambiarFoto(-1);
}

if (btnAdelante) {
  btnAdelante.onclick = () => cambiarFoto(1);
}
