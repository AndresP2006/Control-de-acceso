<?php require_once RUTA_APP . '/views/inc/header-user.php'; ?>

<?php
// Verificar si el usuario actual tiene una solicitud pendiente.
// Se asume que $datos['datos_resident'] contiene únicamente las solicitudes del usuario actual.
$pendiente = false;
if (isset($datos['datos_resident']) && is_array($datos['datos_resident']) && count($datos['datos_resident']) > 0) {
    foreach ($datos['datos_resident'] as $solicitud) {
        if ((is_object($solicitud) && isset($solicitud->estado) && strtolower($solicitud->estado) === 'pendiente') ||
            (is_array($solicitud) && isset($solicitud['estado']) && strtolower($solicitud['estado']) === 'pendiente')
        ) {
            $pendiente = true;
            break;
        }
    }
}
?>
<style>
    #edit-btn {
        visibility: hidden;
    }
</style>

<div class="container">
    <div class="card">
        <div class="header">
            <h1>Informacion de los Residentes</h1>
            <form action="<?php echo RUTA_URL; ?>/HomeController/notificaciones" method="POST" style="display:inline;">
                <div class="logos">
                    <button type="submit" class="enlaces" style="background:none; border:none; cursor:pointer;">
                        <span class="icons">🔔</span>
                        <input type="hidden" name="Us_usuario" value="<?php echo $datos['resindents'][0]->Pe_nombre; ?>">
                    <input type="hidden" name="Us_id" value="<?php echo $datos['resindents'][0]->Us_id; ?>">
                    </button>
                </div>
            </form>
            <hr>
        </div>
        <br>
        <div class="content">
            <h4 class="nombre">
                <input class="gray-text1" type="text" id="nombre" name="E_Telefono"
                    value="<?= $datos['resindents'][0]->Pe_nombre . " " . $datos['resindents'][0]->Pe_apellidos ?>" disabled>
            </h4>
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
                        <input class="gray-text1" type="text" id="gmail" name="E_Gmail"
                            value="<?php echo $datos['resindents'][0]->Us_correo; ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td><strong>Teléfono</strong></td>
                    <td>
                        <input class="gray-text1" type="text" id="telefono" name="E_Telefono"
                            value="<?php echo $datos['resindents'][0]->Pe_telefono; ?>" disabled>
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
                                <input class="gray-text1" type="text" id="torre" name="To_id"
                                    value="<?php echo $datos['resindents'][0]->To_letra; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Departamento</strong></td>
                            <td class="gray-text">
                                <input class="gray-text1" type="text" id="apartamento" name="Ap_numero"
                                    value="<?php echo $datos['resindents'][0]->Ap_numero; ?>" disabled>
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
                        <p class="gray-text">Actualmente no cuenta con más habitantes</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="footer">
            <?php if ($pendiente): ?>
                <!-- Si existe solicitud pendiente para este usuario, se muestra el mensaje -->
                <p id="status-msg" class="access-control">Tu solicitud está en proceso, por favor espera...</p>
            <?php else: ?>
                <!-- Si NO existe solicitud pendiente, se muestra el botón de editar -->
                <button id="edit-btn" onclick="habilitarEdicion()">✏️ Editar</button>
                <button id="save-btn" onclick="guardarDatos()" style="display:none;">✔️ Guardar</button>
                <button id="cancel-btn" onclick="cancelEditing()" style="display:none;">❌ Cancelar</button>

            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Si no hay solicitud pendiente, se muestra el botón de editar.
        <?php if (!$pendiente): ?>
            document.getElementById("edit-btn").style.visibility = "visible";
        <?php endif; ?>

    });

    // Variable global para guardar los valores originales de los inputs
    let valoresOriginales = {};

    function habilitarEdicion() {
        document.getElementById("edit-btn").style.display = "none";
        document.getElementById("cancel-btn").style.display = "inline-block";
        document.getElementById("save-btn").style.display = "inline-block";
        document.getElementById("status-msg").innerText = "Control de Acceso";

        const camposEditables = ["gmail", "telefono", "torre", "apartamento"];
        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                valoresOriginales[id] = input.value;
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
        document.getElementById("status-msg").innerText = "Control de Acceso";

        const camposEditables = ["gmail", "telefono", "torre", "apartamento"];
        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                input.value = valoresOriginales[id];
                input.setAttribute("disabled", "true");
                input.style.backgroundColor = "transparent";
                input.style.border = "none";
            }
        });
    }

    function setWaitingState() {
        document.getElementById("edit-btn").style.display = "none";
        document.getElementById("status-msg").innerText = "Tu solicitud está en proceso, por favor espera...";
        // Aquí se actualizaría el estado en la base de datos vía controlador si es necesario.
    }

    function guardarDatos() {
        let formData = new FormData();
        const camposEditables = ["gmail", "telefono", "torre", "apartamento"];
        let cambiosRealizados = false;

        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                // Comparar valores ignorando espacios al inicio y al final
                if (input.value.trim() !== valoresOriginales[id].trim()) {
                    cambiosRealizados = true;
                }
                formData.append(input.name, input.value.trim());
            }
        });

        if (!cambiosRealizados) {
            alert("No se han realizado cambios en los datos.");
            return;
        }

        formData.append("E_id", document.getElementById("cedula").value);
        formData.append("E_nombre", document.getElementById("nombre").value);

        fetch("<?= RUTA_URL; ?>/UserController/ActualizarUsuario", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
                if (data.success) {
                    setWaitingState();
                } else {
                    alert("Error al actualizar el usuario: " + (data.error || "Inténtalo de nuevo"));
                    document.getElementById("edit-btn").style.display = "inline-block";
                }
                document.getElementById("save-btn").style.display = "none";
                document.getElementById("cancel-btn").style.display = "none";

                camposEditables.forEach(function(id) {
                    let input = document.getElementById(id);
                    if (input) {
                        input.setAttribute("disabled", "true");
                        input.style.backgroundColor = "transparent";
                        input.style.border = "none";
                    }
                });
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error de conexión con el servidor");
            });
    }
</script>
<?php require_once RUTA_APP . '/views/inc/footer-user.php'; ?>