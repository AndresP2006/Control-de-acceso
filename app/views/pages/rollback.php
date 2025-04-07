<?


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$phpMailerPath = dirname(__DIR__, 2) . '/PHPMailer/';

// Verificar si los archivos de PHPMailer existen
$files = ['Exception.php', 'PHPMailer.php', 'SMTP.php'];

foreach ($files as $file) {
    if (!file_exists($phpMailerPath . $file)) {
        die("ERROR: Archivo no encontrado: " . $phpMailerPath . $file);
    }
}

// Si todos los archivos existen, proceder con require_once
require_once $phpMailerPath . 'Exception.php';
require_once $phpMailerPath . 'PHPMailer.php';
require_once $phpMailerPath . 'SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'villarica1malambo@gmail.com';
    $mail->Password   = 'qhtphlizpqffcwnu';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Desactivar depuración
    $mail->SMTPDebug = 0; // Desactiva la depuración para evitar errores de debug
    //Recipients
    $mail->setFrom('villarica1malambo@gmail.com', 'Control De Acceso');
    $mail->addAddress('jcharryme@gmail.com', 'Joe User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Cambio de clave';
    $mail->Body    = 'Ha solicitado un cambio de clave   .<br><br> <b>Si no es usted, ignore este mensaje!</b><br>Su nueva clave es 12345, para que no se le olvide';
    $mail->AltBody = 'Su nueva clave es 12345, para que no se le olvide';

    $mail->send();
    echo 'Mensaje enviado con exito';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}