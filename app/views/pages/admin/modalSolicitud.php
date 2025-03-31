<?php require_once RUTA_APP . "/views/inc/header-user.php" ?>


<div class="container">
    <div class="card">
        <div class="header">
            <h1>Residente</h1>
            <hr>
            <div class="icons">
                <form action="<?php echo RUTA_URL; ?>/HomeController/notificaciones" method="POST" style="display:inline;">
                    <a href="<?php echo RUTA_URL; ?>/HomeController/notificaciones_admin" class="enlaces">
                        <span class="icons">↩️</span>
                    </a>
                </form>
            </div>
        </div>
        <br>
        <div class="content">
            <h4 class="nombre">
                <?= $datos['resindents']->Pe_nombre . " " . $datos['resindents']->Pe_apellidos ?>
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
                        <p style="font-size: 25px;">
                            <span style="color: red;">
                                <?php echo $datos['resindents']->Us_correo; ?>
                            </span> /
                            <span style="color: green;">
                                <?php echo !empty($datos['datos_resident'][0]->correo_nuevo) ? $datos['datos_resident'][0]->correo_nuevo : 'No disponible'; ?>
                            </span>
                        </p>

                    </td>
                </tr>
                <tr>



                    <td><strong>Teléfono</strong></td>
                    <td>
                        <input class="gray-text1" type="text" id="telefono" name="E_Telefono"
                            value="<?php echo $datos['resindents']->Pe_telefono; ?>" disabled>
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
                                    value="<?php echo $datos['resindents']->To_letra; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Departamento</strong></td>
                            <td class="gray-text">
                                <input class="gray-text1" type="text" id="apartamento" name="Ap_numero"
                                    value="<?php echo $datos['resindents']->Ap_numero; ?>" disabled>
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
    </div>
</div>