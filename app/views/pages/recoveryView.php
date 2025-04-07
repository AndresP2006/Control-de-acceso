<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
require_once RUTA_APP . '/views/inc/header-home.php';


?>
<!DOCTYPE html>
<html lang="en">
<header class="cabeza">
    <h1 class="title">Control de <b>Acceso</b></h1>
    <nav class="menu">
        <ul>
            <li class="menu__lista">
                <a class="menu__lista-a" href="<?php echo RUTA_URL; ?>/HomeController/index">Inicio</a>
            </li>
            <li class="menu__lista">
        </ul>
    </nav>

    <div id="loading" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; text-align: center;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 20px;">
            <p>Enviando correo...</p>
            <img src="https://i.gifer.com/ZKZg.gif" width="50" alt="Cargando...">
        </div>
    </div>


</header>

<style>
    .Formulario {
        display: flex;
    }

    .newpassdiv {
        display: none;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 300px;
        text-align: center;
        border-radius: 10px;
    }

    .close {
        float: right;
        cursor: pointer;
    }

    .miModal--activo {
        display: flex;
    }

    .miModal--oculto {
        display: none;
    }
</style>

<!-- Formulario de cambiar contraseña  -->

<div class="newpassdiv Formulario " id="myModalnewpass">
    <h1 id="Bienvenida"></h1>
    <h3>Por favor digite su nueva contraseña</h3>
    <input class="Formulario__titulo-input" type="text" name="newpassinput" id="newPassInput" placeholder="      Nueva contraseña" required>
    <input class="Formulario__titulo-input" type="text" name="newpassinput" id="newPassInputC" placeholder="      Confirmar contraseña" required>
    <button id="newpassbuton" class="Formulario__boton">
        Cambiar
    </button>
</div>


<!-- formulario ingresar el correo-->

<div class="Formulario" id="myModalBase">
    <h1 class="">Recuperar Contraseña</h1>
    <input class="Formulario__titulo-input" name="correo" id="correo" type="email" placeholder="     Correo electronico" required />
    <button id="openModal" name="ingresar" class="Formulario__boton">
        Enviar codigo
    </button>
</div>

<!-- Modal del ingreso de codigo -->

<div id="myModal" class="modal">
    <div class="modal-content">
        <button class="close" id="close" type="button">&times;</button>
        <h2>Ingrese el Código</h2>
        <input type="number" id="codeInput" placeholder="Escriba el código" inputmode="numeric" pattern="\d*">
        <br><br>
        <button id="codeSenden">Enviar</button>
    </div>
</div>

<?php require_once RUTA_APP . '/views/inc/footer-home.php'; ?>
<script>
    $(document).ready(function() {
        var resp = null;
        $('#openModal').click(function() {
            let correo = $('#correo').val();

            if (correo) {
                // Deshabilitar el botón y mostrar un loader
                $('#openModal').prop('disabled', true).text('Enviando...');
                $('#loading').show(); // Muestra el loader

                $.ajax({
                    url: '<?php echo RUTA_URL; ?>/RecoveryController/recovery', //de donde recibe la informacion
                    type: 'POST', //de que manera lo recibe
                    dataType: 'json',
                    data: {
                        correo: correo
                    },
                    success: function(respuesta) {
                        // resp = JSON.parse(respuesta);
                        resp = respuesta;
                        if (resp.resul && resp.resul !== false && resp.resul !== 'false' &&
                            (typeof resp.resul === 'string' ? resp.resul.trim() !== '' : true)) {

                            $('#myModal').addClass('miModal--activo');
                        } else if (resp.messageError) {
                            error(resp.messageError);
                        }
                    },
                    error: function() {
                        $('#respuesta').html('Error al procesar la solicitud.');
                    },
                    complete: function() {
                        // Habilitar el botón nuevamente después de completar la solicitud
                        $('#openModal').prop('disabled', false).text('Enviar Código');
                        $('#loading').hide(); // Oculta el loader
                    }

                });
            }
        });
        $('#codeSenden').click(function() {
            let code = $('#codeInput').val();

            if (resp.codigo === Number(code)) {
                $('#myModal').removeClass('miModal--activo');
                $('#myModalBase').addClass('miModal--oculto');
                $('#myModalnewpass').addClass('miModal--activo');
                $('#Bienvenida').html('Bienvenid@ ' + resp.resul.Us_usuario + ' !');
            } else {
                error('Por favor verifique su código');
            }

        });
        $('#newpassbuton').click(function() {
            let newpass = $('#newPassInput').val();
            let newpassc = $('#newPassInputC').val();
            let correo = $('#correo').val();

            if (newpass === newpassc) {
                $.ajax({
                    url: '<?php echo RUTA_URL; ?>/RecoveryController/newPass', //de donde recibe la informacion
                    type: 'POST', //de que manera lo recibe
                    data: {
                        newpass: newpass,
                        correo: correo
                    },
                    success: function(respuesta) {
                        // resp = JSON.parse(respuesta);
                        var resp = respuesta;

                        if (resp) {
                            realizado(resp.messageInfo);
                            setTimeout(() => {
                                window.location.href = "<?php echo RUTA_URL; ?>/HomeController/index";
                            }, "5000");
                        } else {
                            error(resp.messageError);
                        }
                    },
                    error: function() {
                        $('#respuesta').html('Error al procesar la solicitud.');
                    }
                });
            } else {
                let messageError = 'Por favor verifique su contraseña';
                error(messageError);
            }
        });


        $('#close').click(() => {
            $('#myModal').removeClass('miModal--activo');
        })


    });


    <?php if (isset($datos['messageError']) && $datos['messageError'] != null) { ?>
        error("<?php echo htmlspecialchars($datos['messageError']); ?>");
    <?php } elseif (isset($datos['messageInfo']) && $datos['messageInfo'] != null) { ?>
        realizado("<?php echo htmlspecialchars($datos['messageInfo']); ?>");
    <?php } ?>
</script>