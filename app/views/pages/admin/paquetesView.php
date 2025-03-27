<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>

<div class="table-container">
    <div class="table-wrapper">
        <h1>Historial de Paquetes</h1>
        <table>
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Destinatario</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Recibidor</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($datos['paquets'])) {
                    foreach ($datos['paquets'] as $historial):
                        echo "<tr>";
                        echo "<td>" . $historial['Pe_id'] . "</td>";
                        echo "<td>" . $historial['Pe_nombre'] . "</td>";
                        echo "<td>" . $historial['Pa_estado'] . "</td>";
                        echo "<td>" . $historial['Pa_fecha'] . "</td>";
                        echo "<td>" . $historial['Pa_descripcion'] . "</td>";
                        echo "<td>" . $historial['Pa_responsable'] . "</td>";

                        echo "<td>
                            <form action='" . RUTA_URL . "/UserController/DeletePaquete' method='POST' style='display:inline;'>
                                <input type='hidden' name='delete_pid' value='" . htmlspecialchars($historial['Pa_id'] ?? '') . "'>
                                <button type='submit' name='deletePaquetes' class='delete-btn-pq'>🗑️</button>
                            </form>
                            </td>";
                        echo "</tr>";
                    endforeach;
                };

                ?>
            </tbody>
        </table>
    </div>
    <div class="action-buttons">
        <a href="<?php echo RUTA_URL; ?>/HomeController/admin"><button class="action-btn">Usuarios</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryRecords"><button
                class="action-btn">Registros</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryPackages"><button
                class="action-btn">Paquetes</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/Edificios"><button class="action-btn">Edificio</button></a>
    </div>
</div>
<?php include RUTA_APP . '/views/pages/admin/modalRegistro.php'; ?>

<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>
<script>
        <?php if (isset($datos['messageError'])) { ?>
error("<?php echo $datos['messageError']; ?>")
<?php } ?>
<?php if (isset($datos['messageInfo'])) { ?>
realizado("<?php echo $datos['messageInfo']; ?>")
<?php } ?>
</script>