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
                <input type="hidden" id="nombre" name="E_id" value="<?= !empty($datos['datos_resident'][0]->nombre) ? $datos['datos_resident'][0]->nombre : "" ?>">
            </h4>

            <hr class="Linea">
            <br>

            <table class="info-table">
                <tr>
                    <td><strong>Cédula</strong></td>
                    <td class="gray-text">
                        <?= $datos['resindents']->Us_id ?>
                        <input type="hidden" id="cedula" value="<?= $datos['resindents']->Us_id ?>">
                    </td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>
                        <p style="font-size: 25px; width:100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php
                            $correo_viejo = $datos['datos_resident'][0]->correo_viejo ?? "";
                            $correo_nuevo = $datos['datos_resident'][0]->correo_nuevo ?? "";

                            if ($correo_viejo && $correo_nuevo && $correo_viejo === $correo_nuevo) {
                                echo '<span style="color: gray;">' . $correo_viejo . '</span>';
                            } elseif ($correo_viejo && $correo_nuevo) {
                                echo '<span style="color: red;">' . $correo_viejo . '</span>';
                                echo '<span style="color: green;"> | ' . $correo_nuevo . '</span>';
                            }
                            ?>
                        </p>
                        <input type="hidden" id="gmail" value="<?= $correo_nuevo ?>">
                    </td>
                </tr>
                <tr>
                    <td><strong>Teléfono</strong></td>
                    <td>
                        <p style="font-size: 25px; width:100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php
                            $telefono_viejo = $datos['resindents']->Pe_telefono ?? "";
                            $telefono_nuevo = $datos['datos_resident'][0]->telefono_nuevo ?? "";

                            if ($telefono_viejo && !$telefono_nuevo) {
                                echo '<span style="color: green;">' . $telefono_viejo . '</span>';
                            } elseif ($telefono_viejo === $telefono_nuevo) {
                                echo '<span style="color: gray;">' . $telefono_viejo . '</span>';
                            } elseif ($telefono_viejo && $telefono_nuevo) {
                                echo '<span style="color: red;">' . $telefono_viejo . '</span>';
                                echo '<span style="color: green;"> | ' . $telefono_nuevo . '</span>';
                            }
                            ?>
                        </p>
                        <input type="hidden" id="telefono" value="<?= $telefono_nuevo ?>">
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
                                <input class="gray-text1" type="text" id="torre" value="<?= $datos['resindents']->To_letra ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Departamento</strong></td>
                            <td class="gray-text">
                                <input class="gray-text1" type="text" id="apartamento" value="<?= $datos['resindents']->Ap_numero ?>" disabled>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="habitantes">
                    <p class="habitantes"><strong>Habitantes</strong></p>
                    <?php if (!empty($datos['people'])): ?>
                        <?php foreach ($datos['people'] as $persona): ?>
                            <p class="gray-text"><?= $persona->Pe_nombre . " " . $persona->Pe_apellidos ?></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="gray-text">Actualmente no cuenta con más habitantes</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <br>

        <!-- Botones Aceptar/Rechazar solo si el estado es pendiente -->
        <?php if (strtolower($datos['datos_resident'][0]->estado ?? '') === 'pendiente'): ?>
            <div class="buttons">
                <button id="acceptBtn" class="btn" onclick="guardarDatos()">Aceptar</button>
                <button id="rejectBtn" class="btn btn-dr">Rechazar</button>
            </div>
        <?php endif; ?>

        <br>

        <!-- Mostrar motivo si ya fue rechazado -->
        <?php if ($datos['datos_resident'][0]->estado === 'rechazada'): ?>
            <div id="rejectReason" style="display: block;">
                <label for="reason"><strong>Motivo del rechazo</strong></label>
                <textarea id="reason" class="form-control" name="reject_reason" rows="3" disabled><?= htmlspecialchars($datos['datos_resident'][0]->razon_rechazo) ?></textarea>
                <br>
            </div>
        <?php else: ?>
            <div id="rejectReason" style="display: none;">
                <label for="reason"><strong>Motivo del rechazo</strong></label>
                <textarea id="reason" class="form-control" name="reject_reason" rows="3"></textarea>
                <br>
                <button id="submitRejection" class="btn btn-primary" onclick="rechazo()">Enviar</button>
                <button id="cancelRejection" class="btn btn-secondary">Cancelar</button>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once RUTA_APP . '/views/inc/footer-admin.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rejectBtn = document.getElementById('rejectBtn');
        const acceptBtn = document.getElementById('acceptBtn');
        const rejectReason = document.getElementById('rejectReason');

        if (rejectBtn) {
            rejectBtn.addEventListener('click', function () {
                rejectReason.style.display = 'block';
                rejectBtn.disabled = true;
                acceptBtn.disabled = true;
            });
        }

        document.getElementById('cancelRejection')?.addEventListener('click', function () {
            rejectReason.style.display = 'none';
            document.getElementById('reason').value = '';
            acceptBtn.disabled = false;
            rejectBtn.disabled = false;
        });
    });

    function guardarDatos() {
        let formData = new FormData();
        formData.append("E_id", document.getElementById("cedula").value);
        formData.append("E_nombre", document.getElementById("nombre").value);
        formData.append("E_Gmail", document.getElementById("gmail").value);
        formData.append("E_Telefono", document.getElementById("telefono").value);
        formData.append("To_id", document.getElementById("torre").value);
        formData.append("Ap_numero", document.getElementById("apartamento").value);

        fetch("<?= RUTA_URL; ?>/UserController/ActualizarResidente", {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                realizado("Dato guardado");
                document.getElementById('acceptBtn').style.display = 'none';
                document.getElementById('rejectBtn').style.display = 'none';
            } else {
                error("Error al actualizar el usuario: " + (data.error || "Inténtalo de nuevo"));
            }
        });
    }

    function rechazo() {
        let formData = new FormData();
        formData.append("E_id", document.getElementById("cedula").value);
        formData.append("M_rechazo", document.getElementById("reason").value);

        fetch("<?= RUTA_URL; ?>/UserController/MotivoRechazo", {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                realizado("Rechazo enviado con éxito.");
                // Ocultar todos los botones tras el rechazo
                document.getElementById('acceptBtn').style.display = 'none';
                document.getElementById('rejectBtn').style.display = 'none';
                document.getElementById('submitRejection').style.display = 'none';
                document.getElementById('cancelRejection').style.display = 'none';
            } else {
                error("Error al rechazar: " + (data.error || "Inténtalo de nuevo"));
            }
        });
    }
</script>
