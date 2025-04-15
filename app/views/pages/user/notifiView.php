<?php require_once RUTA_APP . "/views/inc/header-notificacion.php" ?>

<?php
// Ordenar las notificaciones por timestamp descendente
date_default_timezone_set("America/Bogota");

usort($datos['notificaciones'], function($a, $b) {
    $fechaA = 0;
    $fechaB = 0;

    if ($a['tipo'] === 'visita') {
        $fechaA = strtotime($a['data']->Re_fecha_entrada . ' ' . $a['data']->Re_hora_entrada);
    } elseif ($a['tipo'] === 'paquete') {
        $fechaA = strtotime($a['data']->Pa_fecha);
    } elseif ($a['tipo'] === 'rechazo') {
        $fechaA = strtotime($a['data']->fecha_solicitud);
    }

    if ($b['tipo'] === 'visita') {
        $fechaB = strtotime($b['data']->Re_fecha_entrada . ' ' . $b['data']->Re_hora_entrada);
    } elseif ($b['tipo'] === 'paquete') {
        $fechaB = strtotime($b['data']->Pa_fecha);
    } elseif ($b['tipo'] === 'rechazo') {
        $fechaB = strtotime($b['data']->fecha_solicitud);
    }

    return $fechaB - $fechaA; // Orden descendente (más reciente primero)
});
?>

<div class="contenedor">
    <div class="titulo">NOTIFICACIONES
        <a href="<?php echo RUTA_URL; ?>/HomeController/resident" class="enlaces">
            <span class="icons exit">↩️</span>
        </a>
    </div>

    <div class="overflo">
        <?php if (!empty($datos['notificaciones'])): ?>
            <?php foreach ($datos['notificaciones'] as $notificacion): ?>
                <?php
                $timestamp = 0;

                if ($notificacion['tipo'] === 'visita') {
                    $fechaOriginal = $notificacion['data']->Re_fecha_entrada . ' ' . $notificacion['data']->Re_hora_entrada;
                    $timestamp = strtotime($fechaOriginal);
                } elseif ($notificacion['tipo'] === 'paquete') {
                    $fechaOriginal = $notificacion['data']->Pa_fecha;
                    $timestamp = strtotime($fechaOriginal);
                } elseif ($notificacion['tipo'] === 'rechazo') {
                    $fechaOriginal = $notificacion['data']->fecha_solicitud;
                    $timestamp = strtotime($fechaOriginal);
                }

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
                ?>

                <?php if ($notificacion['tipo'] === 'visita'): ?>
                    <div class="notificacion">
                        <div class="contenido-notificacion">
                            <div class="texto">
                                <p>Se ha registrado la persona <strong><?php echo $notificacion['data']->Vi_nombres . " " . $notificacion['data']->Vi_apellidos; ?></strong> para usted en la entrada del edificio.</p>
                                <p><strong>Motivo:</strong> <?php echo $notificacion['data']->Re_motivo; ?></p>
                            </div>
                            <div class="fecha"><?php echo $fechaFormateada; ?></div>
                        </div>
                    </div>
                <?php elseif ($notificacion['tipo'] === 'paquete'): ?>
                    <div class="notificacion">
                        <div class="contenido-notificacion">
                            <div class="texto">
                                <p>¡Tienes un nuevo paquete en recepción!</p>
                                <p><strong>Descripción:</strong> <?php echo $notificacion['data']->Pa_descripcion; ?></p>
                                <p><strong>Estado:</strong> <?php echo $notificacion['data']->Pa_estado; ?></p>
                                <p><strong>Responsable:</strong> <?php echo $notificacion['data']->Pa_responsable; ?></p>
                            </div>
                            <div class="fecha"><?php echo $fechaFormateada; ?></div>
                        </div>
                    </div>
                <?php elseif ($notificacion['tipo'] === 'rechazo'): ?>
                    <div class="notificacion">
                        <div class="contenido-notificacion">
                            <div class="texto">
                                <p>La solicitud de cambio de información ha sido rechazada.</p>
                                <p><strong>Motivo del rechazo:</strong> <?php echo $notificacion['data']->razon_rechazo; ?></p>
                            </div>
                            <div class="fecha"><?php echo $fechaFormateada; ?></div>
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
        <div class="control">
            <span style="color: black !important;">Control de </span> <span style="color: red;">Acceso</span>
        </div>
    </div>
</div>

<?php require_once RUTA_APP . "/views/inc/footer-user.php" ?>
