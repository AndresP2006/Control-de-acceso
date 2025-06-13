<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>
<div class="select2">
    <h1 class="table-titulo translatable">Historial de Paquetes</h1>
    <form action="<?php echo RUTA_URL; ?>/HomeController/BuscarPaquetes" method="POST" class="table-titulo">
        <label for="fecha_inicio" class="translatable">Fecha inicio:</label>
        <input type="date" name="fecha_inicio"
            value="<?php echo isset($datos['fecha_inicio']) ? $datos['fecha_inicio'] : ''; ?>">

        <label for="fecha_fin" class="translatable">Fecha final:</label>
        <input type="date" name="fecha_fin" value="<?php echo isset($datos['fecha_fin']) ? $datos['fecha_fin'] : ''; ?>">

        <button class="btn translatable" type="submit">Filtrar</button>
    </form>
</div>
<div class="buscarId">
<form action="<?php echo RUTA_URL; ?>/PaqueteIdController/buscarPorId" method="post">
<div>
<input type="text" name="id_persona" id="buscar_input" placeholder="Documento de la Persona" class="translatable">
</div>
<div>
<button class="Buscar translatable" type="submit">Buscar</button>
</div>
</form>
</div>

<div class="table-container">

    <div class="table-wrapper">

        <table>
            <thead>
                <tr>
                    <th class="translatable">DOCUMENTO</th>
                    <th class="translatable">DESTINATARIO</th>
                    <th class="translatable">ESTADO</th>
                    <th class="translatable">FECHA</th>
                    <th class="translatable">DESCRIPCION</th>
                    <th class="translatable">RECIBIDOR</th>
                    <th class="translatable">ACCION</th>
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
                        <button type='submit' name='deletePaquetes' class='delete-btn-pq translatable'>🗑️</button>
                    </form>
                </td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='7' class='translatable'>No se encontraron paquetes registrados.</td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="action-buttons">
        <a href="<?php echo RUTA_URL; ?>/HomeController/admin"><button class="action-btn translatable">Usuarios</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryRecords"><button class="action-btn translatable">Registros</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryPackages"><button class="action-btn translatable">Paquetes</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/Edificios"><button class="action-btn translatable">Edificio</button></a>
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