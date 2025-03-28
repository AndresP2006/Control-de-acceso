<?php require_once RUTA_APP . "/views/inc/header-user.php" ?>

<div class="container">
    <div class="card">
        <div class="header">
            <h1>Bienvenido Residente</h1>
            <hr>
            <div class="icons">
                <form action="<?php echo RUTA_URL; ?>/HomeController/notificaciones" method="POST" style="display: inline;">
                    <input type="hidden" name="Us_usuario" value="<?php echo $datos['resindents'][0]->Pe_nombre; ?>">
                    <button type="submit" class="enlaces" style="background: none; border: none; cursor: pointer;">
                        <span class="icons">🔔</span>
                    </button>
                </form>
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
                        <p class="gray-text">Actualmente no cuenta con mas habitantes</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="footer">
            <button id="edit-btn" onclick="habilitarEdicion()">✏️ Editar</button>
            <button id="save-btn" onclick="guardarDatos()" style="display:none;">✔️ Guardar</button>
            <button id="cancel-btn" onclick="cancelEditing()" style="display:none;">❌ Cancelar</button>
            <p class="access-control">Control de <span class="red-text">Acceso</span></p>
        </div>
    </div>
</div>

<script>
    // Variable global para guardar los valores originales de los inputs
    let valoresOriginales = {};

    // Función para habilitar la edición: guarda los valores originales y habilita los inputs
    function habilitarEdicion() {
        document.getElementById("edit-btn").style.display = "none";
        document.getElementById("cancel-btn").style.display = "inline-block";
        document.getElementById("save-btn").style.display = "inline-block";

        // Lista de campos editables
        const camposEditables = ["gmail", "telefono", "torre", "apartamento"];

        // Guardar valores originales antes de habilitar y habilitar cada input
        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                valoresOriginales[id] = input.value; // Guardamos el valor original
                input.removeAttribute("disabled");
                input.style.backgroundColor = "white";
                input.style.border = "1px solid #ccc";
            }
        });
    }

    // Función para cancelar la edición: revierte los cambios a los valores originales y deshabilita los inputs
    function cancelEditing() {
        document.getElementById("edit-btn").style.display = "inline-block";
        document.getElementById("cancel-btn").style.display = "none";
        document.getElementById("save-btn").style.display = "none";

        // Lista de campos editables
        const camposEditables = ["gmail", "telefono", "torre", "apartamento"];

        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                // Restaurar el valor original
                input.value = valoresOriginales[id];
                input.setAttribute("disabled", "true");
                input.style.backgroundColor = "transparent";
                input.style.border = "none";
            }
        });
    }

    // Función para finalizar la edición: deshabilita los inputs y mantiene los valores guardados (actualizados)
    function finalizarEdicion() {
        document.getElementById("edit-btn").style.display = "inline-block";
        document.getElementById("cancel-btn").style.display = "none";
        document.getElementById("save-btn").style.display = "none";

        // Lista de campos editables
        const camposEditables = ["gmail", "telefono", "torre", "apartamento"];

        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                // Deshabilitar el input y aplicar estilos de desactivado
                input.setAttribute("disabled", "true");
                input.style.backgroundColor = "transparent";
                input.style.border = "none";
                // Actualizamos los valores originales con los nuevos (guardados)
                valoresOriginales[id] = input.value;
            }
        });
    }

    // Función para guardar los datos (envío mediante FormData sin usar JSON)
    function guardarDatos() {
        // Crear objeto FormData y adjuntar los datos
        let formData = new FormData();
        formData.append("E_id", document.getElementById("cedula").value); // Cédula
        formData.append("E_Gmail", document.getElementById("gmail").value); // Correo
        formData.append("E_Telefono", document.getElementById("telefono").value); // Teléfono
        formData.append("To_id", document.getElementById("torre").value); // Torre
        formData.append("Ap_numero", document.getElementById("apartamento").value); // Apartamento

        // Depuración: mostrar en consola los datos enviados
        for (let [key, val] of formData.entries()) {
            console.log(key, ":", val);
        }

        // Enviar la solicitud con fetch() usando FormData (sin establecer Content-Type)
        fetch("<?= RUTA_URL; ?>/UserController/ActualizarUsuario", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
                if (data.success) {
                    alert("Usuario actualizado correctamente");
                    // Finalizamos la edición dejando visibles los nuevos datos
                    finalizarEdicion();
                } else {
                    alert("Error al actualizar el usuario: " + (data.error || "Inténtalo de nuevo"));
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error de conexión con el servidor");
            });
    }
</script>