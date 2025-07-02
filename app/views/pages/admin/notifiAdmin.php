<?php require_once RUTA_APP . "/views/inc/header-notificacion.php"; ?>
<?php date_default_timezone_set("America/Bogota"); ?>
<div class="contenedor">
    <div class="titulo">
        <h1 class="titulo_1 translatable">NOTIFICACIONES</h1>
        <a href="<?php echo RUTA_URL; ?>/HomeController/admin" class="enlaces">
            <span class="icons exit translatable" style="top:20px; font-size: 40px;">↩️</span>
        </a>
    </div>

    <div class="overflo">
        <?php if (!empty($datos['notificaciones'])): ?>
            <?php foreach ($datos['notificaciones'] as $index => $notificacion): ?>
                <?php if ($notificacion['tipo'] === 'solicitud_actualizacion'): ?>
                    <?php
                    $fechaOriginal = $notificacion['data']->fecha_solicitud;
                    $timestamp = strtotime($fechaOriginal);

                    $fechaHoy = date("Y-m-d");
                    $fechaNotificacion = date("Y-m-d", $timestamp);

                    if ($fechaNotificacion === $fechaHoy) {
                        $fechaFormateada = date("g:i a", $timestamp);
                    } else {
                        $meses = ["ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic"];
                        $dia = date("j", $timestamp);
                        $mes = $meses[date("n", $timestamp) - 1];
                        $fechaFormateada = $dia . " " . $mes;
                    }

                    $formId = "form_" . $index;
                    ?>
                    <!-- Formulario oculto para enviar datos por POST -->
                    <form id="<?php echo $formId; ?>" action="<?php echo RUTA_URL; ?>/HomeController/solicitud_user" method="post"
                        style="display: none;">
                        <input type="hidden" name="id_residente" value="<?php echo $notificacion['data']->id_residente; ?>">
                        <input type="hidden" name="id" value="<?php echo $notificacion['data']->id; ?>">
                        <input type="hidden" name="detalles" value="1">
                    </form>

                    <!-- Div notificación clickeable -->
                    <div class="notificacion" onclick="document.getElementById('<?php echo $formId; ?>').submit();"
                        style="cursor: pointer;">
                        <div class="contenido-notificacion">
                            <div class="texto">
                                <span class="translatable">
                                    Se ha recibido una solicitud de actualización por parte del residente
                                </span>
                                <strong><?php echo $notificacion['data']->nombre; ?></strong>
                                <br>
                                <span class="translatable">Estado:</span>
                                <strong class="translatable"><?php echo ucfirst($notificacion['data']->estado); ?></strong>
                            </div>
                            <div class="fecha">
                                <?php echo $fechaFormateada; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="notificacion">
                <div class="texto">
                    <p class="translatable">No hay notificaciones disponibles.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>