<?php require_once RUTA_APP . '/views/inc/header-admin.php'; ?>

<div class="controls">
    <div class="control-group">
        <button class="add-btn translatable" id="nuevo_registro">➕ Agregar Nuevo Registro</button>
        <!-- Formulario de Filtro por Rol -->
        <form action="<?php echo RUTA_URL; ?>/UserController/BuscarUsuario" method="POST">
            <select name="select_rol" class="filter-rol translatable" onchange="this.form.submit()">
                <option value="" class="translatable">Todos</option>
                <option value="1" <?php echo isset($datos['filter']) && $datos['filter'] == 1 ? 'selected' : ''; ?> class="translatable">
                    Administrador
                </option>
                <option value="2" <?php echo isset($datos['filter']) && $datos['filter'] == 2 ? 'selected' : ''; ?> class="translatable">
                    Guardia
                </option>
                <option value="3" <?php echo isset($datos['filter']) && $datos['filter'] == 3 ? 'selected' : ''; ?> class="translatable">
                    Residente
                </option>
                <option value="inactivo" <?php echo isset($datos['filter']) && $datos['filter'] == 'inactivo' ? 'selected' : ''; ?> class="translatable">
                    Inactivo
                </option>
            </select>
            <input type="hidden" name="action" value="filter">
        </form>
    </div>

    <div class="control-group">
        <a href="<?php echo RUTA_URL?>/manual/AA3_MANUAL DE USUARIO.pdf" class="manual" target="_blank">
            <button type="button" style="font-size: 30px; background-color: transparent; border: none; cursor: pointer;" title="Manual de Usuario">
            ⬇️
            </button>
        </a>
        <!-- Formulario de Búsqueda por ID -->
        <form class="search-container" action="<?php echo RUTA_URL; ?>/UserController/BuscarUsuario" method="POST">
            <input id="id" type="text" class="buscar_id translatable" name="id_usuario" placeholder="Buscar...">
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
                    <th class="translatable">DOCUMENTO</th>
                    <th class="translatable">NOMBRE</th>
                    <th class="translatable">APELLIDO</th>
                    <th class="translatable">TELEFONO</th>
                    <th class="translatable">CORREO</th>
                    <th class="translatable">APARTAMENTO</th>
                    <th class="translatable">TORRE</th>
                    <th class="translatable">ROL</th>
                    <th class="translatable">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php
                // Verificar si la variable 'usuarios' tiene registros
                if (!empty($datos['usuarios'])) {
                    // Si 'usuarios' es un array de un solo elemento
                    foreach ($datos['usuarios'] as $registro) {
                        if (is_array($registro) || is_object($registro)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($registro['Cedula'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Pe_nombre'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Pe_apellidos'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Pe_telefono'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Us_correo'] ?? '') . "</td>";
                            echo "<td>" . htmlspecialchars($registro['Ap_numero'] ?? '') . "</td>";  // APARTAMENTO
                            echo "<td>" . htmlspecialchars($registro['To_letra'] ?? '') . "</td>";   // TORRE
                            echo "<td>" . htmlspecialchars($registro['Ro_tipo'] ?? '') . "</td>";    // ROL

                            echo "<td>
                                    <button class='edit-btn'
                                        data-id='" . htmlspecialchars($registro['Cedula'] ?? '') . "'
                                        data-nombre='" . htmlspecialchars($registro['Pe_nombre'] ?? '') . "'
                                        data-apellidos='" . htmlspecialchars($registro['Pe_apellidos'] ?? '') . "'
                                        data-telefono='" . htmlspecialchars($registro['Pe_telefono'] ?? '') . "'
                                        data-correo='" . htmlspecialchars($registro['Us_correo'] ?? '') . "'
                                        data-torre='" . htmlspecialchars($registro['To_id'] ?? '') . "'
                                        data-departamento='" . htmlspecialchars($registro['Ap_numero'] ?? '') . "'
                                        data-departamento-id='" . htmlspecialchars($registro['Ap_id'] ?? '') . "'
                                        data-rol='" . htmlspecialchars($registro['Ro_tipo'] ?? '') . "'
                                    >✏️</button>

                                    <input type='hidden' name='delete_id' value='" . htmlspecialchars($registro['Cedula'] ?? '') . "'>

                                    <button 
                                        type='button'
                                        id='delete-btn-admin'
                                        class='delete-btn'
                                        data-id='" . htmlspecialchars($registro['Cedula'] ?? '') . "'
                                        data-rol='" . htmlspecialchars($registro['Ro_tipo'] ?? '') . "'
                                        data-estado='" . htmlspecialchars($registro['Estado'] ?? '') . "'
                                    >
                                        🗑️
                                    </button>
                                </td>";

                            echo "</tr>";
                        } else {
                            echo "<tr><td colspan='9' class='translatable'>Datos incorrectos para este usuario</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='8' class='translatable'>No hay registros disponibles</td></tr>";
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
<?php include RUTA_APP . '/views/pages/admin/modalEditar.php'; ?>

<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>
<script>
    const RUTA_URL = "<?= RUTA_URL ?>";
</script>
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
    <?php if (isset($datos['messageAct'])) { ?>
        realizadoActivar()
    <?php } ?>
    <?php if (isset($datos['estado'])) { ?>
        confirmarRegistro("<?php echo $datos['estado']; ?>", "<?php echo $datos['idUsuario']; ?>")
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

                    let optionSelect = '<option value="0" class="translatable">Apartamento</option>'

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

                    let optionSelect = '<option value="0" class="translatable">Apartamento</option>'

                    for (let item of res)
                        optionSelect += '<option value="' + item.Ap_id + '">' + item.Ap_numero +
                        '</option>'

                    $('#U_Departamento').html(optionSelect)

                }
            })
        })


        $(document).on('click', '.delete-btn', function() {
            const boton = $(this);
            const rolUsuario = boton.data('rol');
            $.ajax({
                url: '<?php echo RUTA_URL ?>/UserController/verifyRol', // Asegúrate de que la ruta es correcta
                type: 'POST',
                data: {},
                dataType: 'json',
                success: function(respuesta) {
                    console.log('Respuesta cruda:', respuesta) // Ver la respuesta antes de procesarla

                    if (respuesta.length === 1 && respuesta[0].Ro_id == 1 && rolUsuario === 'Administrador') {
                        error('Por favor, primero agregue a otro administrador')

                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la petición AJAX:', textStatus, errorThrown)
                }
            })

        })

    });
</script>
<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>