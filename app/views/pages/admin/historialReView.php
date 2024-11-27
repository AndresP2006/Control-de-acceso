<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>

<div class="table-container">

    <div class="table-wrapper">
        <div class="control-group">
        </div>
        <h1>Historial de visitantes</h1>
        <table>
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $model = new PeopleModel();
                $paquetes = $model->getVisitas();
                if (is_array($paquetes)) {
                    foreach ($paquetes as $historial):
                        $uniqueId = "tabla_" . $historial['Vi_id']; // Generar un ID único
                        echo "<tr>";
                        echo "<td>" . $historial['Vi_id'] . "</td>";
                        echo "<td>" . $historial['Vi_nombres'] . "</td>";
                        echo "<td>" . $historial['Vi_apellidos'] . "</td>";
                        echo "<td>" . $historial['Vi_telefono'] . "</td>";
                        include RUTA_APP . '/views/pages/admin/modalVisitas.php';
                    endforeach;
                }
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

<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>

<script>
    <?php if (isset($datos['messageError'])) { ?>
        error("<?php echo $datos['messageError']; ?>")
    <?php } ?>
</script>