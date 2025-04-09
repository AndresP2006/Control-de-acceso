<?php require_once RUTA_APP . "/views/inc/header-notificacion.php"; ?>
<div class="contenedor">
    <div class="titulo">NOTIFICACIONES
        <a href="<?php echo RUTA_URL; ?>/HomeController/admin" class="enlaces">
            <span class="icons exit">↩️</span>
        </a>
    </div>

    <div class="overflo">
        <?php if (!empty($datos['notificaciones'])): ?>
            <?php foreach ($datos['notificaciones'] as $notificacion): ?>
                <?php if ($notificacion['tipo'] === 'solicitud_actualizacion'): ?>
                    <div class="notificacion">
                        <div class="texto">
                            <p>El residente <strong><?php echo $notificacion['data']->nombre; ?></strong> ha solicitado actualizar su información.</p>
                            <p><strong>Estado:</strong> <?php echo ucfirst($notificacion['data']->estado); ?></p>
                            <!-- Botón que abrirá el modal cargando el contenido desde "modelSolicitud.php" -->
                            <form action="<?php echo RUTA_URL; ?>/HomeController/solicitud_user" method="post">
                                <input type="hidden" name="id_residente" value="<?php echo $notificacion['data']->id_residente; ?>">
                                <input type="hidden" name="id" value="<?php echo $notificacion['data']->id; ?>">
                                <input type="submit"  name="detalles"value="ver detalles">
                            </form>

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

<script>
