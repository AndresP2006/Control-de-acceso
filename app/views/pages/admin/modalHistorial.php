<!-- Asegúrate de que este modal esté correctamente en la vista -->
<div id="myModalHistorial" class="modal">
    <div style="width: 800px; margin: auto; position: relative; top: 25%; background: #fff; max-height: 500px; overflow-y: auto;">
        <span class="close" id="closeHistorial">&times;</span>
        <table>
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
                <?php if (!empty($datos['historial'])): ?>
                    <?php foreach ($datos['historial'] as $historial): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($historial['Re_fecha_entrada']); ?></td>
                            <td><?php echo htmlspecialchars($historial['Re_hora_entrada']); ?></td>
                            <td><?php echo htmlspecialchars($historial['Re_hora_salida']); ?></td>
                            <td><?php echo htmlspecialchars($historial['Re_motivo']); ?></td>
                            <td><?php echo htmlspecialchars($historial['Vi_departamento']); ?></td>
                            <td><?php echo htmlspecialchars($historial['Pe_id']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay registros disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
