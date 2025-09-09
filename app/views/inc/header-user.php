<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/usuario.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/footer-vistas.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Residente</title>
</head>

<body>
    <div class="content">
        <div class="encabezado">
            <div class="titulo">
                <h1 class="titulo_1 translatable">Control De Acceso</b> </h1>
            </div>

            <!-- <h3 class="var_sesion">Bienvenido <?= $_SESSION['datos']->Us_usuario ?></h3> -->
            <div class="cerrar-sescion">
                <a href="<?php echo RUTA_URL; ?>/HomeController/index"><button class="boton  translatable">Cerrar Sesión</button></a>
            </div>
            <div style="position: absolute; top: 10px; right: 20px; z-index: 9999;">
                <div class="language-wrapper">
                    <span class="language-icon">🌐</span>
                    <select id="language-selector" class="language-select">
                        <option value="es">Español</option>
                        <option value="en">English</option>
                        <option value="fr">Français</option>
                        <option value="pt">Português</option>
                        <option value="ja">Japones</option>
                        <option value="zh">Chino</option>
                        <option value="ru">Ruso</option>
                    </select>
                </div>
            </div>
            <script src="<?php echo RUTA_URL; ?>/js/translate.js"></script>

        </div>