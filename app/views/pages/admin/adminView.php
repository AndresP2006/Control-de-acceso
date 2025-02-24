<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>

<div class="controls">
    <div class="control-group">
        <button class="add-btn" id="nuevo_registro">➕ Agregar Nuevo Registro</button>
        <!-- Formulario de Filtro por Rol -->
        <form action="<?php echo RUTA_URL; ?>/UserController/BuscarUsuario" method="POST">
            <select name="select_rol" class="filter-rol" onchange="this.form.submit()">
                <option value="">Todos</option>
                <option value="1" <?php echo isset($datos['filter']) && $datos['filter'] == 1 ? 'selected' : ''; ?>>
                    Administrador
                </option>
                <option value="2" <?php echo isset($datos['filter']) && $datos['filter'] == 2 ? 'selected' : ''; ?>>
                    Guardia
                </option>
                <option value="3" <?php echo isset($datos['filter']) && $datos['filter'] == 3 ? 'selected' : ''; ?>>
                    Residente
                </option>
            </select>
            <input type="hidden" name="action" value="filter">

        </form>
    </div>

    <div class="control-group">
        <!-- Formulario de Búsqueda por ID -->
        <form class="search-container" action="<?php echo RUTA_URL; ?>/UserController/BuscarUsuario" method="POST">
            <input id="id" type="text" name="id_usuario" placeholder="Buscar...">
            <input type="hidden" name="action" value="search">
            <button type="submit" name="buscar">
                <img style="width:20px; height:20px;" src="<?php echo RUTA_URL; ?>/img/lupa.png" alt="Icono Buscar">
            </button>
        </form>
    </div>

</div>

<div class="table-container tabla-especifica">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Contraseña</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Departamento</th>
                    <th>Torre</th>
                    <th>Tipo de usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar si la variable 'usuarios' tiene registros
                if (!empty($datos['usuarios'])) {
                    // Si 'usuarios' es un array de un solo elemento
                    foreach ($datos['usuarios'] as $registro) {
                        if (is_array($registro) || is_object($registro)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($registro['Cedula'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Pe_nombre'] ?? '') . " " . htmlspecialchars($registro['Pe_apellidos'] ?? '') . "</td>";
                            echo "<td>*****</td>"; // Campo oculto para la contraseña
                            echo "<td>" . htmlspecialchars($registro['Pe_telefono'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Us_correo'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Ap_numero'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['To_letra'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Ro_tipo'] ?? '') . "</td>";
                            echo "<td>
                                <button class='edit-btn' data-id='" . htmlspecialchars($registro['Cedula'] ?? '') . "' 
                                data-nombre='" . htmlspecialchars($registro['Pe_nombre'] ?? '') . "'
                                data-apellidos='" . htmlspecialchars($registro['Pe_apellidos'] ?? '') . "'
                                data-telefono='" . htmlspecialchars($registro['Pe_telefono'] ?? '') . "'
                                data-correo='" . htmlspecialchars($registro['Us_correo'] ?? '') . "'
                                data-departamento='" . htmlspecialchars($registro['Ap_numero'] ?? '') . "'
                                data-rol='" . htmlspecialchars($registro['Ro_tipo'] ?? '') .
                                "'
                                data-contrasena='" . htmlspecialchars($registro['Us_contrasena'] ?? '') . "'
                                >✏️</button>
                                <form action='" . RUTA_URL . "/UserController/DeleteUser' method='POST' style='display:inline;'>
                                    <input type='hidden' name='delete_id' value='" . htmlspecialchars($registro['Cedula'] ?? '') . "'>
                                    <button type='button' class='delete-btn' data-id='" . $registro['Cedula'] . "'>🗑️</button>
                                </form>
                            </td>";
                            echo "</tr>";
                        } else {
                            echo "<tr><td colspan='8'>Datos incorrectos para este usuario</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='8'>No hay registros disponibles</td></tr>";
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
<?php include RUTA_APP . '/views/pages/admin/modalRegistro.php'; ?>
<?php include RUTA_APP . '/views/pages/admin/modalEditar.php'; ?>

<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>
<script>
    <?php if (isset($datos['messageError'])) { ?>
error("<?php echo $datos['messageError']; ?>")
<?php } ?>
<?php if (isset($datos['messageInfo'])) { ?>
realizado("<?php echo $datos['messageInfo']; ?>")
<?php } ?>
<?php if (isset($datos['messageDelet'])) { ?>
realizadoDelet()
<?php } ?>

    $(document).ready(function() {


        $('#select_torre').change(function() {
            let ValueTower = $('#select_torre').val();
            $.ajax({
                url: '<?php echo RUTA_URL ?>/ApartamentController/getApartamentByTower',
                type: 'POST',
                data: {
                    TowerId: ValueTower
                },
                success: function(respuesta) {
                    const res = JSON.parse(respuesta)

                    let optionSelect = '<option value="0">Apartamento</option>'

                    for (let item of res)
                        optionSelect += '<option value="' + item.Ap_id + '">' + item.Ap_numero +
                        '</option>'

                    $('#E_Departamento').html(optionSelect)

                }
            })
        })

        $('#select_torre2').change(function() {
            let ValueTower = $('#select_torre2').val();
            $.ajax({
                url: '<?php echo RUTA_URL ?>/ApartamentController/getApartamentByTower',
                type: 'POST',
                data: {
                    TowerId: ValueTower
                },
                success: function(respuesta) {
                    const res = JSON.parse(respuesta)

                    let optionSelect = '<option value="0">Apartamento</option>'

                    for (let item of res)
                        optionSelect += '<option value="' + item.Ap_id + '">' + item.Ap_numero +
                        '</option>'

                    $('#U_Departamento').html(optionSelect)

                }
            })
        })
    });
</script>