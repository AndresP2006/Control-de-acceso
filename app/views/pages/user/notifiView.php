<?php require_once RUTA_APP . "/views/inc/header-notificacion.php" ?>

<div class="contenedor">
    <div class="titulo">NOTIFICACIONES
        <a href="<?php echo RUTA_URL; ?>/HomeController/resident" class="enlaces">
            <span class="icons exit">↩️</span>
        </a>
    </div>

    <div class="overflo">
        <?php if (!empty($datos['notificaciones'])): ?>
            <?php foreach ($datos['notificaciones'] as $notificacion): ?>
                <?php if ($notificacion['tipo'] === 'visita'): ?>
                    <div class="notificacion">
                        <div class="texto">
                            <p>Se ha registrado la persona <strong><?php echo $notificacion['data']->Vi_nombres . " " . $notificacion['data']->Vi_apellidos; ?></strong> para usted en la entrada del edificio.</p>
                            <p><strong>Fecha de entrada:</strong> <?php echo $notificacion['data']->Re_fecha_entrada; ?> | <strong>Hora de entrada:</strong> <?php echo $notificacion['data']->Re_hora_entrada; ?></p>
                            <p><strong>Motivo:</strong> <?php echo $notificacion['data']->Re_motivo; ?></p>
                        </div>
                    </div>
                <?php elseif ($notificacion['tipo'] === 'paquete'): ?>
                    <div class="notificacion">
                        <div class="texto">
                            <p>¡Tienes un nuevo paquete en recepción!</p>
                            <p><strong>Descripción:</strong> <?php echo $notificacion['data']->Pa_descripcion; ?></p>
                            <p><strong>Fecha de llegada:</strong> <?php echo $notificacion['data']->Pa_fecha; ?></p>
                            <p><strong>Estado:</strong> <?php echo $notificacion['data']->Pa_estado; ?></p>
                            <p><strong>Responsable:</strong> <?php echo $notificacion['data']->Pa_responsable; ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="notificacion">
                <div class="texto">
                    <p>No hay notificaciones disponibles.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="acciones">
        <div class="control">Control de <span style="color: black;">Acceso</span></div>
    </div>
</div>
<?php require_once RUTA_APP . "/views/inc/footer-user.php" ?>