<?php 
require_once RUTA_APP . '/views/inc/header-home.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require  __DIR__.'/../../../PHPMailer/Exception.php';
require __DIR__.'/../../../PHPMailer/PHPMailer.php';
require __DIR__.'/../../../PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp-mail.outlook.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'jcharryme@gmail.com';                     
    $mail->Password   = 'juancm12345';                               
    $mail->Port       = 465;       

    //Recipients
    $mail->setFrom('jcharryme@gmail.com', 'Juan');
    $mail->addAddress('jcharryme1@gmail.com', 'Joe User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recuperacion de contraseña';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

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

</header>

    <!-- formulario -->
    <div class="">
        <form action="<?php echo RUTA_URL; ?>/RecoveryController/recovery" method="post">
            <div class="Formulario">
                <h1 class="">Recuperar Contraseña</h1>
                <input class="Formulario__titulo-input" name="correo" type="email" placeholder="     Correo electronico" required />
                
                <button type="submit" name="ingresar" class="Formulario__boton">
                    Enviar codigo
                </button>
                <a href="" class="Contraseña"></a>
            </div>

        </form>
    </div>



<?php require_once RUTA_APP . '/views/inc/footer-home.php'; ?>
<script>
    <?php if (isset($datos['messageError'])) { ?>
        error("<?php echo $datos['messageError']; ?>")
    <?php } ?>
</script>