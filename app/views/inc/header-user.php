<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/usuario.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/footer-vistas.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Residente</title>
</head>

<body>
    <div class="content">
        <div class="encabezado">
            <div class="titulo">
                <h1 class="titulo_1">Control De <b>Acceso</b> </h1>
            </div>

            <h3 class="var_sesion">Bienvenido <?= $_SESSION['datos']->Us_usuario ?></h3>
            <div class="cerrar-sescion">
                <a href="<?php echo RUTA_URL; ?>/HomeController/index"><button class="boton">Cerrar Sesión</button></a>
            </div>
        </div>