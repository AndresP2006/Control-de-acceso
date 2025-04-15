<?php require_once RUTA_APP . '/views/inc/header-user.php'; ?>

<?php
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
                    <button type="submit" class="enlaces" style="background:none; border:none; cursor:pointer; position: relative;">
                        <span class="icons2" style="font-size: 30px; position:relative;left:200px;">🔔</span>
                        <?php if (!empty($datos['paquets']) || !empty($datos['visitante']) || !empty($datos['rechazo'])): ?>
                            <span style="position: relative; top: 0; right: 0; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; left: 175px;">
                                <?= count($datos['paquets'] + $datos['visitante'] + $datos['rechazo']) ?>
                            </span>
                        <?php endif; ?>
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
                    <td>
                        <input class="gray-text" type="text" id="cedula" name="E_id" value="<?php echo $datos['resindents'][0]->Us_id; ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>
                        <input class="gray-text1" type="text" id="gmail" name="E_Gmail"
                            value="<?php echo $datos['resindents'][0]->Us_correo; ?>" disabled style="width:500px;">
                        <input class="gray-text1" type="hidden" id="gmailV" name="E_GmailV"
                            value="<?php echo $datos['resindents'][0]->Us_correo; ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td><strong>Teléfono</strong></td>
                    <td>
                        <input class="gray-text1" type="text" id="telefono" name="E_Telefono"
                            value="<?php echo $datos['resindents'][0]->Pe_telefono; ?>" disabled>
                        <input class="gray-text1" type="hidden" id="telefonoV" name="E_TelefonoV"
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
                    <p class="habitantes-title"><strong>Habitantes</strong></p>
                    <?php if (!empty($datos['people'])): ?>
                        <?php foreach ($datos['people'] as $persona): ?>
                            <p class="gray-text habitante-item"
                                data-id="<?php echo $persona->id_habitante; ?>"
                                data-nombre="<?php echo $persona->Pe_nombre . ' ' . $persona->Pe_apellidos; ?>"
                                data-gmail="<?php echo $persona->Us_correo; ?>"
                                data-telefono="<?php echo $persona->Pe_telefono; ?>"
                                style="cursor:pointer;">
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
            <button id="edit-btn" onclick="habilitarEdicion()" style="display:none;">✏️ Editar</button>
            <button id="save-btn" onclick="guardarDatos()" style="display:none;">✔️ Guardar</button>
            <button id="cancel-btn" onclick="cancelEditing()" style="display:none;">❌ Cancelar</button>
            <p id="status-msg" class="access-control"><?= ($pendiente ? "Tu solicitud está en proceso, por favor espera..." : "") ?></p>
        </div>
    </div>
</div>

<script>
    // Función para consultar el estado de la solicitud
    function consultarEstadoSolicitud(idUsuario) {
        fetch(`<?= RUTA_URL; ?>/UserController/estadoSolicitud/${idUsuario}`)
            .then(response => response.json())
            .then(data => {
                const editBtn = document.getElementById("edit-btn");
                const statusMsg = document.getElementById("status-msg");
                if (data.estado === 'pendiente') {
                    statusMsg.innerText = "Tu solicitud está en proceso, por favor espera...";
                    editBtn.style.display = "none";
                    editBtn.style.visibility = "hidden";
                } else if (data.estado === 'aceptada') {
                    statusMsg.innerText = "Tu solicitud ha sido aceptada ✅";
                    editBtn.style.display = "inline-block";
                    editBtn.style.visibility = "visible";
                } else if (data.estado === 'rechazada') {
                    statusMsg.innerText = "Tu solicitud fue rechazada ❌";
                    editBtn.style.display = "inline-block";
                    editBtn.style.visibility = "visible";
                } else {
                    statusMsg.innerText = "";
                    editBtn.style.display = "inline-block";
                    editBtn.style.visibility = "visible";
                }
            })
            .catch(err => {
                console.error("Error consultando estado:", err);
            });
    }

    // Variables globales
    let valoresOriginales = {};
    let editando = false; // Bandera para saber si el usuario está en modo edición

    document.addEventListener("DOMContentLoaded", function() {
        let pendiente = <?php echo json_encode($pendiente); ?>;
        // Si no hay solicitud pendiente, se limpia el mensaje y se muestra el botón de editar
        if (!pendiente) {
            document.getElementById("status-msg").innerText = "";
            let editBtn = document.getElementById("edit-btn");
            editBtn.style.display = "inline-block";
            editBtn.style.visibility = "visible";
        }
        // Si hay solicitud pendiente, se deja lo que imprimió PHP

        // Asignar manejador de eventos a cada habitante
        const habitantes = document.querySelectorAll(".habitante-item");
        habitantes.forEach(function(item) {
            item.addEventListener("click", function() {
                cambiarHabitante(this);
            });
        });

        // Consultar el estado del usuario principal si hay solicitud pendiente
        const idUsuarioInicial = document.getElementById("cedula").value;
        if (pendiente) {
            consultarEstadoSolicitud(idUsuarioInicial);
        }
    });

    function habilitarEdicion() {
        editando = true;
        document.getElementById("edit-btn").style.display = "none";
        document.getElementById("cancel-btn").style.display = "inline-block";
        document.getElementById("save-btn").style.display = "inline-block";

        const camposEditables = ["gmail", "telefono", "gmailV", "telefonoV"];
        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                valoresOriginales[id] = input.value;
                input.removeAttribute("disabled");
                input.style.backgroundColor = "white";
                input.style.border = "1px solid #ccc";
            }
        });
        const soloLectura = ["torre", "apartamento", "nombre"];
        soloLectura.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                valoresOriginales[id] = input.value;
            }
        });
    }

    function cancelEditing() {
        editando = false;
        document.getElementById("edit-btn").style.display = "inline-block";
        document.getElementById("cancel-btn").style.display = "none";
        document.getElementById("save-btn").style.display = "none";

        const camposEditables = ["gmail", "telefono", "gmailV", "telefonoV"];
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

    function guardarDatos(callback) {
        let cambiosRealizados = false;
        const camposEditables = ["gmail", "telefono", "gmailV", "telefonoV"];
        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input && input.value.trim() !== valoresOriginales[id].trim()) {
                cambiosRealizados = true;
            }
        });

        let formData = new FormData();
        camposEditables.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                formData.append(input.name, input.value.trim());
            }
        });

        formData.append("E_id", document.getElementById("cedula").value);
        formData.append("E_nombre", document.getElementById("nombre").value);

        if (!cambiosRealizados) {
            if (typeof callback === "function") {
                callback();
            }
            return;
        }

        fetch("<?= RUTA_URL; ?>/UserController/ActualizarUsuario", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
                if (data.success) {
                    editando = false;
                } else {
                    alert("Error al actualizar el usuario: " + (data.error || "Inténtalo de nuevo"));
                }

                camposEditables.forEach(function(id) {
                    let input = document.getElementById(id);
                    if (input) {
                        input.setAttribute("disabled", "true");
                        input.style.backgroundColor = "transparent";
                        input.style.border = "none";
                    }
                });

                document.getElementById("save-btn").style.display = "none";
                document.getElementById("cancel-btn").style.display = "none";

                const editBtn = document.getElementById("edit-btn");
                editBtn.style.display = "none";
                editBtn.style.visibility = "hidden";

                const statusMsg = document.getElementById("status-msg");
                statusMsg.innerText = "Tu solicitud está en proceso, por favor espera...";

                if (typeof callback === "function") {
                    callback();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error de conexión con el servidor");
                if (typeof callback === "function") {
                    callback();
                }
            });
    }

    function cambiarHabitante(elemento) {
        if (editando) {
            if (!confirm("Tienes cambios sin guardar. ¿Deseas guardarlos antes de cambiar de habitante?")) {
                return;
            }
            guardarDatos(() => manejarCambio(elemento));
        } else {
            manejarCambio(elemento);
        }
    }

    function manejarCambio(nuevoElemento) {
        const listaHabitantes = document.querySelector(".habitantes");

        const idActual = document.getElementById("cedula").value;
        const nombreActual = document.getElementById("nombre").value;
        const gmailActual = document.getElementById("gmail").value;
        const telefonoActual = document.getElementById("telefono").value;

        const idNuevo = nuevoElemento.getAttribute("data-id");

        const nuevoEnLista = listaHabitantes.querySelector(`.habitante-item[data-id="${idNuevo}"]`);
        if (nuevoEnLista) {
            nuevoEnLista.remove();
        }

        const yaExiste = listaHabitantes.querySelector(`.habitante-item[data-id="${idActual}"]`);
        if (!yaExiste && idActual !== "") {
            const nuevoItem = document.createElement("p");
            nuevoItem.className = "gray-text habitante-item";
            nuevoItem.setAttribute("data-id", idActual);
            nuevoItem.setAttribute("data-nombre", nombreActual);
            nuevoItem.setAttribute("data-gmail", gmailActual);
            nuevoItem.setAttribute("data-telefono", telefonoActual);
            nuevoItem.style.cursor = "pointer";
            nuevoItem.innerText = nombreActual;
            nuevoItem.addEventListener("click", function() {
                cambiarHabitante(this);
            });

            const titulo = listaHabitantes.querySelector(".habitantes-title");
            if (titulo && titulo.nextSibling) {
                listaHabitantes.insertBefore(nuevoItem, titulo.nextSibling);
            } else {
                listaHabitantes.appendChild(nuevoItem);
            }
        }

        cargarHabitante(nuevoElemento);
    }

    function cargarHabitante(elemento) {
        const idHabitante   = elemento.getAttribute("data-id");
        const nombreHabit   = elemento.getAttribute("data-nombre");
        const gmailHabit    = elemento.getAttribute("data-gmail");
        const telefonoHabit = elemento.getAttribute("data-telefono");

        document.getElementById("cedula").value   = idHabitante;
        document.getElementById("nombre").value   = nombreHabit;
        document.getElementById("gmail").value    = gmailHabit;
        document.getElementById("gmailV").value   = gmailHabit;
        document.getElementById("telefono").value = telefonoHabit;
        document.getElementById("telefonoV").value = telefonoHabit;

        const campos = ["nombre", "gmail", "telefono", "gmailV", "telefonoV"];
        campos.forEach(function(id) {
            let input = document.getElementById(id);
            if (input) {
                valoresOriginales[id] = input.value;
            }
        });

        editando = false;

        const editBtn = document.getElementById("edit-btn");
        const cancelBtn = document.getElementById("cancel-btn");
        const saveBtn = document.getElementById("save-btn");
        const statusMsg = document.getElementById("status-msg");

        editBtn.style.display = "none";
        editBtn.style.visibility = "hidden";
        cancelBtn.style.display = "none";
        saveBtn.style.display = "none";

        statusMsg.innerText = "";

        fetch(`<?= RUTA_URL; ?>/UserController/estadoSolicitud/${idHabitante}`)
            .then(response => response.json())
            .then(data => {
                if (data.estado === 'pendiente') {
                    statusMsg.innerText = "Tu solicitud está en proceso, por favor espera...";
                    editBtn.style.display = "none";
                    editBtn.style.visibility = "hidden";
                } else if (data.estado === 'aceptada') {
                    statusMsg.innerText = "Tu solicitud ha sido aceptada ✅";
                    editBtn.style.display = "inline-block";
                    editBtn.style.visibility = "visible";
                } else {
                    statusMsg.innerText = "";
                    editBtn.style.display = "inline-block";
                    editBtn.style.visibility = "visible";
                }
            })
            .catch(error => {
                console.error("Error al obtener el estado:", error);
                statusMsg.innerText = "Error al consultar estado de solicitud.";
            });
    }
</script>


<?php require_once RUTA_APP . '/views/inc/footer-user.php'; ?>