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
<div class="main-wrapper">
    <header>
        <div class="content_Encabezado">
            <h1 class="content_Encabezado-titulo">Control De Registro <br><samp
                    style="color: red; margin-left: 30px;">Entrada y Salida</samp>
            </h1>
            <div class="logos">
    
                <h3 class="var_sesion_admin">Bienvenido <?= $_SESSION['datos']->Us_usuario ?></h3>
                <form action="<?php echo RUTA_URL; ?>/HomeController/notificaciones_admin" method="POST" style="display:inline;">

                    <div class="sistemas">
                    <button type="submit" style="background:none; border:none; cursor:pointer; position: relative;">
                        <span class="icons2" style=" font-size: 30px;position: relative;bottom:10px;">🔔</span>
                        <?php if (!empty($_SESSION['notificaciones'])): ?>
                            <span style="position: absolute; top: 0; right: 0; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                                <?= count($_SESSION['notificaciones']) ?>
                            </span>
                        <?php endif; ?>
                    </button>
                
                    <div class="cerrar-sescion">
                        <a href="<?php echo RUTA_URL; ?>/HomeController/index"><button class="boton">Cerrar Sesión</button></a>
                    </div>
                    </div>
            </div>
            </form>
            
        </div>
    </header>

    <body>