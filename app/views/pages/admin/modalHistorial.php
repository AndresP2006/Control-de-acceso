<div id="myModalHistorial" class="modal">
    <div style=" width: 800px; margin: auto; position: relative; top: 25%; background: #fff; max-height: 500px; overflow-y: auto;">
        <span class="close" id="closeHistorial">&times;</span>
        <table >
            <thead>
                <tr>
                    <th>Fecha de Entrada</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Motivo</th>
                    <th>Departamento</th>
                    <th>Residente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($datos['historial'])) {
                    foreach ($datos['historial'] as $historial) {
                        echo "<tr>";
                        echo "<td>" . $historial['Re_fecha_entrada'] . "</td>";
                        echo "<td>" . $historial['Re_hora_entrada'] . "</td>";
                        echo "<td>" . $historial['Re_hora_salida'] . "</td>";
                        echo "<td>" . $historial['Re_motivo'] . "</td>";
                        echo "<td>" . $historial['Vi_departamento'] . "</td>";
                        echo "<td>" . $historial['Pe_id'] . "</td>";   
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>