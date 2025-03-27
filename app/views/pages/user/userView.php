<?php require_once RUTA_APP . "/views/inc/header-user.php" ?>

<div class="container">
    <div class="card">
        <div class="header">
            <h1>Bienvenido Residente</h1>
            <hr>
            <div class="icons">
                <a href="<?php echo RUTA_URL; ?>/HomeController/notificaciones" class="enlaces">
                    <span class="icons">🔔</span>
                </a>
                <a href="<?php echo RUTA_URL; ?>/HomeController/index" class="enlaces">
                    <span class="icons">↩️</span>
                </a>
            </div>
        </div>
        <br>
        <div class="content">
            <h4 class="nombre"><?= $datos['resindents'][0]->Pe_nombre . " " . $datos['resindents'][0]->Pe_apellidos ?></h4>

            <hr class="Linea">
            <br>

            <table class="info-table">
                <tr>
                    <td><strong>Cédula</strong></td>
                    <td class="gray-text">
                        <?php echo $datos['resindents'][0]->Us_id; ?>
                        <input type="hidden" id="cedula" name="E_id" value="<?php echo $datos['resindents'][0]->Us_id; ?>">
                    </td>

                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>
                        <input class="gray-text1" type="text" id="gmail" name="E_Gmail" value="<?php echo $datos['resindents'][0]->Us_correo; ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td><strong>Teléfono</strong></td>
                    <td>
                        <input class="gray-text1" type="text" id="telefono" name="E_Telefono" value="<?php echo $datos['resindents'][0]->Pe_telefono; ?>" disabled>
                    </td>
                </tr>
            </table>
            <hr>
            <div class="details">
                <div>
                    <table class="info-table">
                        <tr>
                            <td><strong>Torre</strong></td>
                            <td class="gray-text">
                                <input class="gray-text1" type="text" id="torre" name="To_id" value="<?php echo $datos['resindents'][0]->To_letra; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Departamento</strong></td>
                            <td class="gray-text">
                                <input class="gray-text1" type="text" id="apartamento" name="Ap_numero" value="<?php echo $datos['resindents'][0]->Ap_numero; ?>" disabled>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="habitantes">
                    <p class="habitantes"><strong>Habitantes</strong></p>

                    <?php if (!empty($datos['people'])): ?>
                        <?php foreach ($datos['people'] as $persona): ?>
                            <p class="gray-text">
                                <?php echo $persona->Pe_nombre . " " . $persona->Pe_apellidos; ?>
                            </p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="gray-text">No mani porque tan solo.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <br>
        <br>
        <br>

        <div class="footer"> <button id="edit-btn" onclick="habilitarEdicion()">✏️ Editar</button>
            <button id="save-btn" onclick="guardarDatos()" style="display:none;">✔️ Guardar</button>
            <button id="cancel-btn" onclick="cancelEditing()" style="display:none;">❌ Cancelar</button>

            <p class="access-control">Control de <span class="red-text">Acceso</span></p>
        </div>
    </div>
</div>

</div>
<script>
    function habilitarEdicion() {
        document.getElementById("edit-btn").style.display = "none";
        document.getElementById("cancel-btn").style.display = "inline-block";
        document.getElementById("save-btn").style.display = "inline-block";

        // Solo habilitar los campos permitidos
        const camposEditables = ["gmail", "telefono", "torre", "apartamento"];
        camposEditables.forEach(id => {
            let input = document.getElementById(id);
            if (input) {
                input.removeAttribute("disabled");
                input.style.backgroundColor = "white";
                input.style.border = "1px solid #ccc";
            }
        });
    }

    function cancelEditing() {
        document.getElementById("edit-btn").style.display = "inline-block";
        document.getElementById("cancel-btn").style.display = "none";
        document.getElementById("save-btn").style.display = "none";

        // Volver a deshabilitar los campos editables
        const camposEditables = ["gmail", "telefono", "torre", "apartamento"];
        camposEditables.forEach(id => {
            let input = document.getElementById(id);
            if (input) {
                input.setAttribute("disabled", "true");
                input.style.backgroundColor = "transparent";
                input.style.border = "none";
            }
        });
    }

    function guardarDatos() {
        let formData = {
            E_id: $("#cedula").val(), // Cédula
            E_Gmail: $("#gmail").val(), // Correo
            E_Telefono: $("#telefono").val(), // Teléfono
            To_id: '1', // Torre
            Ap_numero: $("#apartamento").val() // Apartamento
        };
        
        console.log("Datos enviados:", formData); // Depuración en consola

        $.ajax({
            url: "<?= RUTA_URL; ?>/UserController/ActualizarUsuario",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    alert("Usuario actualizado correctamente");
                    cancelEditing();
                } else {
                    alert("Error al actualizar el usuario: " + (response.error || "Inténtalo de nuevo"));
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", xhr.responseText);
                alert("Error de conexión con el servidor");
            }
        });
    }
</script>