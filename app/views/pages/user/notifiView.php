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
        <?php if (!empty($datos['notificacion'])): ?>
            <p>Nombre: <?php echo $datos['notificacion']->Vi_nombres; ?></p>
            <p>Apellido: <?php echo $datos['notificacion']->Vi_apellidos; ?></p>
            <p>Fecha de entrada: <?php echo $datos['notificacion']->Re_fecha_entrada; ?></p>
            <p>Hora de entrada: <?php echo $datos['notificacion']->Re_hora_entrada; ?></p>
            <p>Motivo: <?php echo $datos['notificacion']->Re_motivo; ?></p>
        <?php else: ?>
            <p>No hay notificaciones disponibles.</p>
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

        <?php var_dump($datos) ?>
    </div>

    <div class="acciones">
        <div class="eliminar">Eliminar todo 🗑️</div>
        <div class="control">Control de <span style="color: black;">Acceso</span></div>
    </div>

    <?php echo "<script>console.log(" . json_encode($datos) . ");</script>"; ?>
</div>