<?php
//cargamos la LIBRERIA de 
require_once 'configurations/config.php';




//require_once 'librerias/Base.php';
//require_once 'librerias/Controlador.php'; 
//require_once 'librerias/Core.php';

//Autoload de php
spl_autoload_register(function ($nombreClase) {
    require_once 'utils/' . $nombreClase . '.php';
});
