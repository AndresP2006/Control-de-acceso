<?php require_once RUTA_APP . "/views/inc/header-notificacion.php" ?>
<div class="contenedor">
    <div class="titulo">NOTIFICACIONES<a href="<?php echo RUTA_URL; ?>/HomeController/resident" class="enlaces">
            <span class="icons  exit">↩️</span>
        </a>
    </div>

    <div class="overflo">
        <div class="notificacion">
            <div class="texto">
                <strong>¡Tienes un nuevo paquete en recepción!</strong>
                <p>Hemos recibido un paquete a tu nombre.<br>Hora de llegada: 10:00 am | Fecha de llegada: 13/julio/2025</p>
            </div>
            <div class="icono"><a href=""><span>🗑️</span></a></div>
        </div>

        <div class="notificacion">
            <div class="texto">
                <strong>¡Tienes un nuevo paquete en recepción!</strong>
                <p>Hemos recibido un paquete a tu nombre.<br>Hora de llegada: 5:00 pm | Fecha de llegada: 13/julio/2025</p>
            </div>
            <div class="icono"><a href=""><span>🗑️</span></a></div>
        </div>
        <?php if (!empty($datos['notificaciones'])): ?>
            <div class="notificacion">
            <div class="texto">
            <p>Se ha registrado la persona <?php echo $datos['notificaciones']->Vi_nombres . " " . $datos['notificaciones']->Vi_apellidos; ?> para usted en la entrada del edificio.</p>
            </div>
            <div class="icono"><a href=""><span>🗑️</span></a></div>
        </div>
        <?php else: ?>
            <li>No hay notificaciones disponibles.</li>
        <?php endif; ?>
       
        <div class="notificacion">
            <div class="texto">
                <strong>¡Tienes un nuevo paquete en recepción!</strong>
                <p>Hemos recibido un paquete a tu nombre.<br>Hora de llegada: 2:00 pm | Fecha de llegada: 13/julio/2025</p>
            </div>
            <div class="icono"><a href=""><span>🗑️</span></a></div>
        </div>
        <div class="notificacion">
            <div class="texto">
                <strong>¡Tienes un nuevo paquete en recepción!</strong>
                <p>Hemos recibido un paquete a tu nombre.<br>Hora de llegada: 2:00 pm | Fecha de llegada: 13/julio/2025</p>
            </div>
            <div class="icono"><a href=""><span>🗑️</span></a></div>
        </div>

    </div>

    <div class="acciones">
        <div class="eliminar">Eliminar todo 🗑️</div>
        <div class="control">Control de <span style="color: black;">Acceso</span></div>
    </div>

    <?php echo "<script>console.log(" . json_encode($datos) . ");</script>"; ?>
</div>





<!-- <div class="container">
    <h1>Notificaciones</h1>
    <ul>
       
    </ul>
    <a href="<?php echo RUTA_URL; ?>/HomeController/resident" class="enlaces">↩️ Volver</a>
</div> -->
