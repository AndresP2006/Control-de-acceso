<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>

<div class="table-container">
    <div class="table-wrapper">
        <h1>Historial de Paquetes</h1>
        <form action="<?php echo RUTA_URL; ?>/HomeController/BuscarPaquetes" method="POST" class="formFiltro">
            <label for=" fecha_inicio"> Fecha inicio:</label>
            <input type="date" name="fecha_inicio"
                value="<?php echo isset($datos['fecha_inicio']) ? $datos['fecha_inicio'] : ''; ?>" >

            <label for="fecha_fin"> Fecha final:</label>
            <input type="date" name="fecha_fin" value="<?php echo isset($datos['fecha_fin']) ? $datos['fecha_fin'] : ''; ?>"
                >

            <button class="btn" type="submit">Filtrar por Fecha</button>
        </form>
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
                if (!empty($datos['paquets'])) {
                    foreach ($datos['paquets'] as $historial) {
                        if (is_object($historial)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($historial->Pe_id ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($historial->Pe_nombre ?? '') . " " . htmlspecialchars($historial->Pe_apellidos ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($historial->Pa_estado ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($historial->Pa_fecha ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($historial->Pa_descripcion ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($historial->Pa_responsable ?? '') . "</td>";
                            echo "<td>
                    <form action='" . RUTA_URL . "/HomeController/DeletePaquete' method='POST' style='display:inline;'>
                        <input type='hidden' name='delete_pid' value='" . htmlspecialchars($historial->Pa_id ?? '') . "'>
                        <input type='hidden' name='fecha_inicio' value='" . htmlspecialchars($datos['fecha_inicio'] ?? '') . "'>
                        <input type='hidden' name='fecha_fin' value='" . htmlspecialchars($datos['fecha_fin'] ?? '') . "'>
                        <button type='submit' name='deletePaquetes' class='delete-btn-pq'>🗑️</button>
                    </form>
                </td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='7'>No se encontraron paquetes para este rango de fechas.</td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="action-buttons">
        <a href="<?php echo RUTA_URL; ?>/HomeController/admin"><button class="action-btn">Usuarios</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryRecords"><button class="action-btn">Registros</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryPackages"><button class="action-btn">Paquetes</button></a>
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