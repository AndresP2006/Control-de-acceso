<?php require_once RUTA_APP . "/views/inc/header-user.php" ?>

<div class="container">
    <div class="card">
        <div class="header">
            <h1>Residente</h1>
            <hr>
            <div class="icons">
                <form action="<?php echo RUTA_URL; ?>/HomeController/notificaciones" method="POST" style="display:inline;">
                    <a href="<?php echo RUTA_URL; ?>/HomeController/notificaciones_admin" class="enlaces" style="text-decoration: none;">
                        <span class="icons">↩️</span>
                    </a>
                </form>
            </div>
        </div>
        <br>
        <div class="content">
            <h4 class="nombre">
                <?= $datos['resindents']->Pe_nombre . " " . $datos['resindents']->Pe_apellidos ?>
                <input type="hidden" id="nombre" name="E_id" value="<?php echo isset($datos['datos_resident'][0]->correo_nuevo) && !empty($datos['datos_resident'][0]->nombre) ? $datos['datos_resident'][0]->nombre : ""; ?>">
            </h4>
            <hr class="Linea">
            <br>
            <table class="info-table">
                <tr>
                    <td><strong>Cédula</strong></td>
                    <td class="gray-text">
                        <?php echo $datos['resindents']->Us_id; ?>
                        <input type="hidden" id="cedula" name="E_id" value="<?php echo $datos['resindents']->Us_id; ?>">
                    </td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>
                        <p style="font-size: 25px; width:100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php
                            $correo_viejo = isset($datos['resindents']->Us_correo) ? $datos['resindents']->Us_correo : "";
                            $correo_nuevo = isset($datos['datos_resident'][0]->correo_nuevo) ? $datos['datos_resident'][0]->correo_nuevo : "";

                            // Caso 1: Solo existe correo viejo, mostrarlo en verde
                            if (!empty($correo_viejo) && empty($correo_nuevo)) {
                                echo '<span style="color: gray;" name="E_Gmail">' . $correo_viejo . '</span>';
                            }
                            // Caso 2: Ambos existen y son iguales, mostrar uno solo en verde
                            elseif (!empty($correo_viejo) && !empty($correo_nuevo) && $correo_viejo === $correo_nuevo) {
                                echo '<span style="color: gray;" name="E_Gmail">' . $correo_viejo . '</span>';
                            }
                            // Caso 3: Ambos existen y son diferentes, mostrar los dos con colores distintos
                            elseif (!empty($correo_viejo) && !empty($correo_nuevo)) {
                                echo '<span style="color: red;" name="E_Gmail">' . $correo_viejo . '</span>';
                                echo '<span style="color: green;" name="E_Gmail"> | ' . $correo_nuevo . '</span>';
                            }
                            ?>


                        </p>
                        <input type="hidden" id="gmail" name="E_id" value="<?php echo isset($datos['datos_resident'][0]->correo_nuevo) && !empty($datos['datos_resident'][0]->correo_nuevo) ? $datos['datos_resident'][0]->correo_nuevo : ""; ?>">
                    </td>
                </tr>
                <tr>
                    <td><strong>Teléfono</strong></td>
                    <td>
                        <p style="font-size: 25px; width:100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php
                            $telefono_viejo = isset($datos['resindents']->Pe_telefono) ? $datos['resindents']->Pe_telefono : "";
                            $telefono_nuevo = isset($datos['datos_resident'][0]->telefono_nuevo) ? $datos['datos_resident'][0]->telefono_nuevo : "";

                            if (!empty($telefono_viejo) && empty($telefono_nuevo)) {
                                // Solo teléfono viejo
                                echo '<span style="color: green; display: inline;" name="E_Gmail">' . $telefono_viejo . '</span>';
                            } elseif (!empty($telefono_viejo) && !empty($telefono_nuevo) && $telefono_viejo === $telefono_nuevo) {
                                // Son iguales
                                echo '<span style="color: gray; display: inline;" name="E_Gmail">' . $telefono_viejo . '</span>';
                            } elseif (!empty($telefono_viejo) && !empty($telefono_nuevo)) {
                                // Son distintos
                                echo '<span style="color: red; display: inline;" name="E_Gmail">' . $telefono_viejo . '</span>';
                                echo '<span style="color: green; display: inline;" name="E_Gmail"> | ' . $telefono_nuevo . '</span>';
                            }
                            ?>
                        </p>

                        <input type="hidden" id="telefono" name="E_telefono" value="<?php echo isset($datos['datos_resident'][0]->telefono_nuevo) && !empty($datos['datos_resident'][0]->telefono_nuevo) ? $datos['datos_resident'][0]->telefono_nuevo : ""; ?>">
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
                                <input class="gray-text1" type="text" id="torre" name="To_id" value="<?php echo $datos['resindents']->To_letra; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Departamento</strong></td>
                            <td class="gray-text">
                                <input class="gray-text1" type="text" id="apartamento" name="Ap_numero" value="<?php echo $datos['resindents']->Ap_numero; ?>" disabled>
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
        <br>
        <div class="buttons">
            <button id="acceptBtn" class="btn" onclick="guardarDatos()">Aceptar</button>
            <button id="rejectBtn" class="btn btn-dr" onclick="rechazo()">Rechazar</button>
        </div>
        <br>
        <div id="rejectReason" style="display: none;">
            <label for="reason">Motivo del rechazo:</label>
            <textarea id="reason" class="form-control" name="reject_reason" rows="3"></textarea>
            <br>
            <button id="submitRejection" class="btn btn-primary" onclick="rechazo_enviar()">Enviar</button>
            <button id="cancelRejection" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</div>
<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>
<script>
    document.getElementById('rejectBtn').addEventListener('click', function() {
        document.getElementById('rejectReason').style.display = 'block';
    });

    document.getElementById('cancelRejection').addEventListener('click', function() {
        document.getElementById('rejectReason').style.display = 'none';
        document.getElementById('reason').value = '';
    });

    function guardarDatos() {
        let formData = new FormData();
        formData.append("E_id", document.getElementById("cedula").value);
        formData.append("E_nombre", document.getElementById("nombre").value);
        formData.append("E_Gmail", document.getElementById("gmail").value);
        formData.append("E_Telefono", document.getElementById("telefono").value);
        formData.append("To_id", document.getElementById("torre").value);
        formData.append("Ap_numero", document.getElementById("apartamento").value);

        for (let [key, val] of formData.entries()) {
            console.log(key, ":", val);
        }

        fetch("<?= RUTA_URL; ?>/UserController/ActualizarResidente", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
                if (data.success) {
                    realizado("Dato guardado");
                } else {
                    // Si no es exitoso, se ejecuta una alerta de error genérica:
                    error("Error al actualizar el usuario: " + (data.error || "Inténtalo de nuevo"));
                    document.getElementById("edit-btn").style.display = "inline-block";
                }

                const camposEditables = ["gmail", "telefono", "torre", "apartamento"];
                camposEditables.forEach(function(id) {
                    let input = document.getElementById(id);
                    if (input) {
                        input.setAttribute("disabled", "true");
                        input.style.backgroundColor = "transparent";
                        input.style.border = "none";
                    }
                });
            })

    }

    function rechazo() {
        document.getElementById('acceptBtn').addEventListener('click', function() {
            document.getElementById('acceptBtn').style.display = 'none';
        });

        document.getElementById('rejectBtn').addEventListener('click', function() {
            document.getElementById('rejectBtn').style.display = 'none';
        });
    }

    function rechazo_enviar() {
        document.getElementById('rejectBtn').addEventListener('click', function() {
            document.getElementById('rejectReason').style.display = 'block';
        });

        document.getElementById('cancelRejection').addEventListener('click', function() {
            document.getElementById('rejectReason').style.display = 'none';
            document.getElementById('reason').value = '';
        });

        let formData = new FormData();
        formData.append("E_id", document.getElementById("cedula").value);
        formData.append("M_rechazo", document.getElementById("reason").value);

        for (let [key, val] of formData.entries()) {
            console.log(key, ":", val);
        }

        fetch("<?= RUTA_URL; ?>/UserController/MotivoRechazo", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
                if (data.success) {
                    realizado("Dato guardado");
                } else {
                    // Si no es exitoso, se ejecuta una alerta de error genérica:
                    error("Error al actualizar el usuario: " + (data.error || "Inténtalo de nuevo"));
                    document.getElementById("edit-btn").style.display = "inline-block";
                }

                const camposEditables = ["gmail", "telefono", "torre", "apartamento"];
                camposEditables.forEach(function(id) {
                    let input = document.getElementById(id);
                    if (input) {
                        input.setAttribute("disabled", "true");
                        input.style.backgroundColor = "transparent";
                        input.style.border = "none";
                    }
                });
            })
    }
</script>