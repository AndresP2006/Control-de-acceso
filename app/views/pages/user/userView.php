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

    #save-btn {
        background-color: #008E4B;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        min-width: 130px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 0 20px;
        overflow: hidden;
    }

    #save-btn:disabled {
        background-color: #008E4B;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .spinner {
        width: 24px;
        height: 24px;
        border: 4px solid #fff;
        border-top: 4px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;

        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
    }

    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    #save-text {
        z-index: 1;
    }

    input[type="text"] {
        font-size: 20px;
        transition: all 0.3s ease;
        outline: none;
        width: 100%;
        box-sizing: border-box;
    }

    input[type="text"]:focus {
        border-color: #008E4B;
        box-shadow: 0 0 0 3px rgba(0, 142, 75, 0.2);
    }
    strong{
        font-size: 20px;
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

            <button
                id="save-btn"
                onclick="guardarDatos()"
                style="display: none; min-width: 130px; position: relative; padding: 10px 20px;">
                <span
                    id="spinner"
                    class="spinner"
                    style="display: none;"></span>
                <span id="save-text">✔️ Guardar</span>
            </button>





            <button id="cancel-btn" onclick="cancelEditing()" style="display:none;">❌ Cancelar</button>

            <p id="status-msg" class="access-control">
                <?= ($pendiente ? "Tu solicitud está en proceso, por favor espera..." : "") ?>
            </p>
        </div>

    </div>
</div>

<script>
    // ————— Validadores puros —————
    function esTelefonoValido(telefono) {
        // Sólo dígitos, entre 8 y 15 caracteres
        return /^\d{8,15}$/.test(telefono);
    }

    function esCorreoValido(correo) {
        const regex = /^[^\s@]+@[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,}$/i;
        return regex.test(correo);
    }

    // ————— Valida ambos campos y actúa sobre el botón —————
    function validarCampos() {
        const telInput   = document.getElementById("telefono");
        const mailInput  = document.getElementById("gmail");
        const saveBtn    = document.getElementById("save-btn");

        const telValido   = esTelefonoValido( telInput.value.trim() );
        const mailValido  = esCorreoValido( mailInput.value.trim() );

        // Pintar bordes
        telInput.style.border  = telValido  ? "" : "2px solid red";
        mailInput.style.border = mailValido ? "" : "2px solid red";

        // Mensajes de validación nativa
        telInput.setCustomValidity(  telValido  ? "" : "Sólo números (8–15 dígitos)" );
        mailInput.setCustomValidity( mailValido ? "" : "Formato de correo inválido" );

        // Habilita sólo si ambos son válidos
        saveBtn.disabled = !(telValido && mailValido);
    }

    // ————— Tu función existente —————
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
            .catch(err => console.error("Error consultando estado:", err));
    }

    // ————— Variables globales —————
    let valoresOriginales = {};
    let editando = false;

    document.addEventListener("DOMContentLoaded", function() {
        // Asociar validación a teléfono y correo
        const tel = document.getElementById("telefono");
        const mail = document.getElementById("gmail");
        tel.addEventListener("blur", validarCampos);
        tel.addEventListener("input", validarCampos);
        mail.addEventListener("blur", validarCampos);
        mail.addEventListener("input", validarCampos);

        // Estado inicial del botón
        validarCampos();

        // Mostrar/ocultar botón editar según pendiente
        let pendiente = <?php echo json_encode($pendiente); ?>;
        if (!pendiente) {
            document.getElementById("status-msg").innerText = "";
            const editBtn = document.getElementById("edit-btn");
            editBtn.style.display = "inline-block";
            editBtn.style.visibility = "visible";
        }

        // Click en habitantes
        document.querySelectorAll(".habitante-item").forEach(item =>
            item.addEventListener("click", () => cambiarHabitante(item))
        );

        // Si hay pendiente, consulta su estado
        if (pendiente) {
            consultarEstadoSolicitud(document.getElementById("cedula").value);
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
        const campos = ["gmail", "telefono", "gmailV", "telefonoV"];
        let cambios = false;

        campos.forEach(id => {
            const inp = document.getElementById(id);
            if (inp && inp.value.trim() !== valoresOriginales[id].trim()) {
                cambios = true;
            }
        });

        if (!cambios) {
            if (typeof callback === "function") callback();
            return;
        }

        const btn = document.getElementById("save-btn");
        const spinner = document.getElementById("spinner");
        const txt = document.getElementById("save-text");
        const cancelBtn = document.getElementById("cancel-btn");

        // Mostrar spinner y bloquear botones
        spinner.style.display = "block";
        txt.style.visibility = "hidden"; // mantiene el espacio del texto
        btn.disabled = true;
        cancelBtn.disabled = true;

        setTimeout(() => {
            const formData = new FormData();
            campos.forEach(id => {
                const inp = document.getElementById(id);
                if (inp) formData.append(inp.name, inp.value.trim());
            });
            formData.append("E_id", document.getElementById("cedula").value);
            formData.append("E_nombre", document.getElementById("nombre").value);

            fetch("<?= RUTA_URL; ?>/UserController/ActualizarUsuario", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        editando = false;
                        realizado("Tu solicitud está en proceso, por favor espera.");
                    } else {
                        error("Error al actualizar: " + (data.error || "Inténtalo de nuevo"));
                    }

                    // Desactivar campos y ocultar botones
                    campos.forEach(id => {
                        const inp = document.getElementById(id);
                        if (inp) {
                            inp.disabled = true;
                            inp.style.backgroundColor = "transparent";
                            inp.style.border = "none";
                        }
                    });

                    btn.style.display = "none";
                    cancelBtn.style.display = "none";
                    document.getElementById("edit-btn").style.display = "none";
                    document.getElementById("status-msg").innerText =
                        "Tu solicitud está en proceso, por favor espera...";
                })
                .catch(e => {
                    console.error(e);
                    alert("Error de conexión con el servidor");
                })
                .finally(() => {
                    // Restaurar botón
                    spinner.style.display = "none";
                    txt.style.visibility = "visible";
                    btn.disabled = false;
                    cancelBtn.disabled = false;

                    if (typeof callback === "function") callback();
                });
        }, 1000);
    }


    async function cambiarHabitante(elemento) {
        if (editando) {
            const confirmar = await advertencia("Tienes cambios sin guardar. Por favor guarda o cancela antes de cambiar de habitante.");
            if (!confirmar) return;

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
        const idHabitante = elemento.getAttribute("data-id");
        const nombreHabit = elemento.getAttribute("data-nombre");
        const gmailHabit = elemento.getAttribute("data-gmail");
        const telefonoHabit = elemento.getAttribute("data-telefono");

        document.getElementById("cedula").value = idHabitante;
        document.getElementById("nombre").value = nombreHabit;
        document.getElementById("gmail").value = gmailHabit;
        document.getElementById("gmailV").value = gmailHabit;
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