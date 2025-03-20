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
            <h4 class="nombre"><?= $datos['resindents'][0]->Pe_nombre ." ". $datos['resindents'][0]->Pe_apellidos ?></h4>

            <hr class="Linea">
            <br>

            <table class="info-table">
                <tr>
                    <td><strong>Cédula</strong></td>
                    <td class="gray-text1">
                        <?php echo "<script>console.log(" . json_encode($datos) . ");</script>"; ?>
                        <?php echo $datos['resindents'][0]->Us_id; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td class="gray-text1">
                        <?php echo $datos['resindents'][0]->Us_correo; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Teléfono</strong></td>
                    <td class="gray-text1">
                        <?php echo $datos['resindents'][0]->Pe_telefono; ?>
                    </td>
                </tr>
            </table>
            <hr>
            <div class="details">
                <div>
                    <table class="info-table">
                        <tr>
                            <td><strong>Torre</strong></td>
                            <td class="gray-text1">
                                <?php echo $datos['resindents'][0]->To_letra; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Departamento</strong></td>
                            <td class="gray-text1">
                            <?php echo $datos['resindents'][0]->Ap_numero; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="habitantes">
                    <p class="habitantes"><strong>Habitantes</strong></p>
                    <p class="gray-text">Juan David Rua Porta</p>
                    <p class="gray-text">Luis Adriano Padilla Cardales</p>
                    <p class="gray-text">Stiven Dario Catalan Silgado</p>
                </div>
            </div>
        </div>


        <br>
        <br>
        <br>

        <div class="footer"> <button class="edit-btn">✏️</button>

            <p class="access-control">Control de <span class="red-text">Acceso</span></p>
        </div>
    </div>
</div>

</div>