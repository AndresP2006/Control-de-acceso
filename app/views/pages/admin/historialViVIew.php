<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>
<div class="select">
    <h1 class="table-titulo2 translatable">Lista de visitantes</h1>
    <form method="POST" action="<?php echo RUTA_URL; ?>/UserController/VisitantesPorFecha">
        <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($_POST['fecha'] ?? ''); ?>">
        <button type="submit" class="btn translatable" style="position: relative; left:266px;">Filtrar</button>
    </form>
</div>
<div class="table-container">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th class="translatable">DOCUMENTO</th>
                    <th class="translatable">NOMBRE</th>
                    <th class="translatable">APELLIDO</th>
                    <th class="translatable">TELEFONO</th>
                    <th class="translatable">REGISTRO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($datos['visitors']) && is_array($datos['visitors']) && count($datos['visitors']) > 0) {
                    foreach ($datos['visitors'] as $historial) {
                        echo "<tr>";
                        echo "<td>" . (empty($historial['Vi_id']) ? '-' : $historial['Vi_id']) . "</td>";
                        echo "<td>" . (empty($historial['Vi_nombres']) ? '-' : $historial['Vi_nombres']) . "</td>";
                        echo "<td>" . (empty($historial['Vi_apellidos']) ? '-' : $historial['Vi_apellidos']) . "</td>";
                        echo "<td>" . (empty($historial['Vi_telefono']) ? '-' : $historial['Vi_telefono']) . "</td>";

                        // Botón para mostrar detalles
                        echo "
                        <td>
                            <form id='historial-form' action='" . RUTA_URL . "/UserController/MostrarHistorial' method='POST'>
                                <input type='hidden' name='historial_id' value='" . htmlspecialchars($historial['Vi_id'] ?? '') . "'>
                                <input type='hidden' name='fecha' value='" . htmlspecialchars($_POST['fecha'] ?? '') . "'>
                                <button class='historial-btn translatable' name='historial-btn'>✏️</button>
                            </form>
                        </td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='translatable'>No hubo visitas en la fecha seleccionada.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Esta área se llenará con los datos del registro del visitante -->
        <div id="registro-details" style="display: none;"></div>

    </div>
    <div class="action-buttons">
        <a href="<?php echo RUTA_URL; ?>/HomeController/admin"><button class="action-btn translatable">Usuarios</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryRecords"><button class="action-btn translatable">Registros</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryPackages"><button class="action-btn translatable">Paquetes</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/Edificios"><button class="action-btn translatable">Edificio</button></a>
    </div>
</div>

<?php include RUTA_APP . '/views/pages/admin/modalHistorial.php'; ?>
<?php include RUTA_APP . '/views/inc/footer-visitante.php'; ?>
<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>