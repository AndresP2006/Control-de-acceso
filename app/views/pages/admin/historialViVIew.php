<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>

<h1 class="table-titulo">Lista de visitantes</h1>
<div class="table-container">
    <div class="table-wrapper">
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
                    foreach ($paquetes as $historial) {
                        echo "<tr>";
                        echo "<td>" . $historial['Vi_id'] . "</td>";
                        echo "<td>" . $historial['Vi_nombres'] . "</td>";
                        echo "<td>" . $historial['Vi_apellidos'] . "</td>";
                        echo "<td>" . $historial['Vi_telefono'] . "</td>";
                        // Botón para mostrar detalles

                        echo "
                        <td>
                            <form action='" . RUTA_URL . "/UserController/MostrarHistorial' method='POST'>
                                <input type='hidden' name='historial_id' value='" . htmlspecialchars($historial['Vi_id'] ?? ''). "'>
                                <button class='historial-btn' name='historial-btn'>✏️</button>
                            </form>
                        </td>
                       ";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Esta área se llenará con los datos del registro del visitante -->
        <div id="registro-details" style="display: none;"></div>

    </div>
    <div class="action-buttons">
        <a href="<?php echo RUTA_URL; ?>/HomeController/admin"><button class="action-btn">Usuarios</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryRecords"><button
                class="action-btn">Registros</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryPackages"><button
                class="action-btn">Paquetes</button></a>
    </div>
</div>

<?php include RUTA_APP . '/views/pages/admin/modalHistorial.php'; ?>

<?php include RUTA_APP . '/views/inc/footer-visitante.php'; ?>