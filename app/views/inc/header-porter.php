<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/Visitas.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/adminStyle.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/porter.css">
    <title>Guardia</title>
</head>

<body>
    <div class="content">
        <div class="encabezado">
            <div class="titulo">
                <h1 class="titulo_1">
                    <span class="translatable">Control De Registro</span> <b class="translatable">Entrada y Salida</b>
                </h1>
            </div>
            <div id="popup-cambiar" class="ventana-emergente">
                <div class="ventana-emergente__caja ventana-emergente__caja--opciones">
                </div>
            </div>
            <h3 class="var_sesion translatable">Bienvenido <?= explode(" ", trim($_SESSION['datos']->Us_usuario))[0]; ?></h3>
            <div class="cerrar-sescion">
                <a href="<?php echo RUTA_URL; ?>/HomeController/index">
                    <button class="boton translatable">Cerrar Sesión</button>
                </a>
            </div>
            <div style="position: absolute; top: 10px; right: 20px; z-index: 9999;">
                <select id="language-selector">
                    <option value="es">Español</option>
                    <option value="en">English</option>
                    <option value="fr">Français</option>
                </select>
            </div>
        </div>
        <script src="<?php echo RUTA_URL; ?>/js/translate.js"></script>