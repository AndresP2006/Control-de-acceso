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
             <div class="">
             <h1>
            <span class="titulo_1 translatable">Control de</span> <samp style="color:#f00;" class="translatable">Acceso</samp>
        </h1>
            </div>
            <div class="logos">
                <h3 class="var_sesion translatable">Bienvenido <?= $_SESSION['datos']->Us_usuario ?></h3>
            </div>
    
            <div style="display: flex; padding: 10px; align-items: center; justify-content: space-between;margin-right: 20px;">
                <div class="cerrar-sescion">
                    <a href="<?php echo RUTA_URL; ?>/HomeController/index"><button class="boton translatable">Cerrar Sesión</button></a>
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
            </div>
        </div>
        <script src="<?php echo RUTA_URL; ?>/js/translate.js"></script>