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
                    <th>Departamento</th>
                    <th>Motivo de visita</th>
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
                        echo "<td>" . $historial['Vi_departamento'] . "</td>";
                        echo "<td>" . $historial['Vi_motivo'] . "</td>";
                        echo "<td>
                                <button class='boton-abrir' onclick='toggleTabla(\"$uniqueId\")'>
                                    <span>➕</span> 
                                </button>
                              </td>";
                        echo "</tr>";
                        echo "
                            <tr>
                                <td colspan='6'>
                                    <div class='tabla-contenedor' id='$uniqueId' style='display: none;'>
                                        <table class='tabla-nueva'>
                                            <thead class='tabla-nueva__encabezado'>
                                                <tr class='tabla-nueva__fila'>
                                                    <th class='tabla-nueva__celda'>Fecha</th>
                                                    <th class='tabla-nueva__celda'>Hora de entrada</th>
                                                    <th class='tabla-nueva__celda'>Hora de salida</th>
                                                </tr>
                                            </thead>
                                            <tbody class='tabla-nueva__cuerpo'>
                                                <tr class='tabla-nueva__fila'>
                                                   <td class='tabla-nueva__celda'>" . $historial['Re_fecha_entrada'] . "</td>
                                                   <td class='tabla-nueva__celda'>" . $historial['Re_hora_entrada'] . "</td>
                                                   <td class='tabla-nueva__celda'>" . $historial['Re_hora_salida'] . "</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>";
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="action-buttons">
        <a href="<?php echo RUTA_URL; ?>/HomeController/admin"><button class="action-btn">Usuarios</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryRecords"><button class="action-btn">Registros</button></a>
        <a href="<?php echo RUTA_URL; ?>/HomeController/HistoryPackages"><button class="action-btn">Paquetes</button></a>
    </div>
</div>
<?php include RUTA_APP . '/views/pages/admin/modalRegistro.php'; ?>

<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>
<script>
    <?php if (isset($datos['messageError'])) { ?>
        error("<?php echo $datos['messageError']; ?>")
    <?php } ?>
</script>