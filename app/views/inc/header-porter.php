<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/Visitas.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/adminStyle.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/porter.css">
    <title>Guardia</title>
</head>
<div class="content">
    <div class="encabezado">
        <div class="titulo">
            <h1 class="titulo_1">Control De Registro <b>Entrada y Salida</b></h1>
        </div>
        <div id="popup-cambiar" class="ventana-emergente">
            <div class="ventana-emergente__caja ventana-emergente__caja--opciones">
            </div>
        </div>
        <h3 class="var_sesion">Bienvenido <?= $_SESSION['datos']->Us_usuario ?></h3>
        <div class="cerrar-sescion">
            <a href="<?php echo RUTA_URL; ?>/HomeController/index"><button class="boton">Cerrar Sesión</button></a>
        </div>
    </div>

    <body>