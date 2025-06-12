<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="icon" href="<?php echo RUTA_URL ?>/img/logo.png">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/adminStyle.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/Visitas.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/administracion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header>
        <div class="content_Encabezado">
            <h1 class="content_Encabezado-titulo">
                <span class="translatable">Control De Registro</span>
                <br>
                <samp style="color: red; margin-left: 30px;" class="translatable">Entrada y Salida</samp>
            </h1>
            <div class="logos">
                <h3 class="var_sesion_admin translatable">
                    Bienvenido <?= explode(" ", trim($_SESSION['datos']->Us_usuario))[0]; ?>
                </h3>
                <form action="<?php echo RUTA_URL; ?>/HomeController/notificaciones_admin" method="POST" style="display:inline;">
                    <div class="sistemas">
                        <button type="submit" style="background:none; border:none; cursor:pointer; position: relative;">
                            <span class="icons2" style="font-size: 30px; position: relative; bottom:30px;">🔔</span>
                            <?php if (!empty($_SESSION['notificaciones'])): ?>
                                <span style="position: absolute; top: 0; right: 0; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                                    <?= count($_SESSION['notificaciones']) ?>
                                </span>
                            <?php endif; ?>
                        </button>
                    </div>

                </form>
                <div class="cerrar-sescion">
                    <a href="<?php echo RUTA_URL; ?>/HomeController/index">
                        <button class="boton translatable">Cerrar Sesión</button>
                    </a>
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
    </header>