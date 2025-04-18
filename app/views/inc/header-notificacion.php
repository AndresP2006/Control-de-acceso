<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTIFICACIONES</title>
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/notificacion.css">

</head>

<body>
    <div class="content">
        <div class="encabezado">
            <div class="titulo">
                <h1 class="titulo_1">Control De <b>Acceso</b> </h1>
            </div>

            <div class="logos">
                <h3 class="var_sesion">Bienvenido <?= $_SESSION['datos']->Us_usuario ?></h3>
            </div>
            <div class="cerrar-sescion">
                <a href="<?php echo RUTA_URL; ?>/HomeController/index"><button class="boton">Cerrar Sesión</button></a>
            </div>
        </div>