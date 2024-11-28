<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>
<div class="table-container tabla-especifica">
    <div class="contenidoedificios">
        <!-- Primer Bloque -->
        <div class="block">
            <div class="container">
                <!-- Tabla -->
                <div class="table-wrapper">
                    <table class="styled-table">
                        <thead class="table-head">
                            <tr class="table-row">
                                <th class="table-header">NUMERO</th>
                                <th class="table-header">TORRE</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                        <?php
                            $model = new PeopleModel();
                            $torre = $model->torres();
                            if (is_array($torre)) {
                                foreach ($torre as $historial):
                                    echo "<tr>";
                                    echo "<td>" . $historial['To_id'] . "</td>";
                                    echo "<td>" . $historial['To_letra'] . "</td>";
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Formulario de torres -->
                <div class="form-wrapper">
                    <h3>Ingresar Torre</h3>
                    <form class="dataForm" action="<?php echo RUTA_URL;?>/UserController/Torre" method="POST">
                        <div class="form-group">
                            <label for="departamento1">ID de Torre</label>
                            <input type="text" id="ID" name="id" placeholder="Numero de Torre" required>
                        </div>
                        <div class="form-group">
                            <label for="torre1">Torre</label>
                            <input type="text" id="torre1" name="torre" placeholder="Ingrese la torre" required>
                        </div>
                        <div class="accion">
                            <button type="submit" name="guardar" class="submit-btn">Guardar</button>
                            <button type="submit" name="borrar" class="submit-btn">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Segundo Bloque -->
        <div class="block">
            <div class="container">
                <!-- Tabla -->
                <div class="table-wrapper">
                    <table class="styled-table">
                        <thead class="table-head">
                            <tr class="table-row">
                                <th class="table-header">TORRE</th>
                                <th class="table-header">APARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                        <?php
                            $model = new PeopleModel();
                            $torre = $model->apartamentos();
                            if (is_array($torre)) {
                                foreach ($torre as $historial):
                                    echo "<tr>";
                                    echo "<td>" . $historial['To_letra'] . "</td>";
                                    echo "<td>" . $historial['Ap_numero'] . "</td>";
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Formulario de apartamento -->
                <div class="form-wrapper">
                    <h3>Ingresar Apartamento</h3>
                    <form class="dataForm" action="<?php echo RUTA_URL;?>/UserController/Apartamento" method="POST">
                        <div class="form-group">
                            <label for="departamento2">Torre</label>
                            <input type="text" id="torre" name="torre" placeholder="Numero de Torre" required>
                        </div>
                        <div class="form-group">
                            <label for="torre2">Apartamento</label>
                            <input type="text" id="torre2" name="apartamento" placeholder="Ingrese el Apartamento" required>
                        </div>
                        <div class="accion">
                            <button type="submit" name="guardar" class="submit-btn">Guardar</button>
                            <button type="submit" name="borrar" class="submit-btn">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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