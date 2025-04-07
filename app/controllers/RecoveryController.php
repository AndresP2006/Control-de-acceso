<?php

// Declaraciones "use" deben estar después de require_once
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class RecoveryController extends Controlador
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->modelo('UserModel');
        //echo 'Controlador paginas cargado';
    }

    public function index()
    {
        header('location:' . RUTA_URL . '/HomeController/recovery');
    }

    public function recovery()
    {
        $correo = $_POST['correo'];
        $resul = $this->userModel->getUserByEmail($correo);
        $codigo = random_int(100000, 999999);

        if (!empty($resul)) {
            require_once __DIR__ . '/../PHPMailer/PHPMailer.php';
            require_once __DIR__ . '/../PHPMailer/SMTP.php';
            require_once __DIR__ . '/../PHPMailer/Exception.php';

            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jcharryme@gmail.com';
            $mail->Password   = 'ppmazohkrjofijlr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Desactivar depuración
            $mail->SMTPDebug = 0;

            // Recipients
            $mail->setFrom('jcharryme@gmail.com', 'Control De Acceso');
            $mail->addReplyTo('jcharryme@gmail.com', 'Soporte');
            $mail->addAddress($correo);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Importante: Actividad en su cuenta';
            $mail->Body    = '
                <p>Estimado usuario,</p>
                <p>Hemos detectado actividad reciente en su cuenta. Si usted ha realizado esta acción, no es necesario hacer nada.</p>
                <p>Si no reconoce esta solicitud, por favor contacte con nuestro equipo de soporte.</p>
                <p>Código de confirmación: <b>' . htmlspecialchars($codigo) . '</b></p>
                <p>Atentamente,<br>Soporte Técnico</p>
                <p><a href="https://ControlDeAcceso.com/contacto">Contactar soporte</a></p>
            ';
            $mail->AltBody = 'Estimado usuario,
            Hemos detectado actividad en su cuenta. Si reconoce esta acción, no es necesario hacer nada. 
            Si no la reconoce, contacte con nuestro equipo de soporte.
            Código de confirmación: ' . $codigo . '
            Atentamente, Soporte Técnico.
            Contacto: https://.com/contacto';


            $mail->send();

            $message = null;
        } else {
            $message = "Digite un correo electronico valido";
        }

        $datos = [
            'codigo' => $codigo,
            'resul' => $resul,
            'messageError' => $message
        ];

        header('Content-Type: application/json');
        echo json_encode($datos);
    }

    public function newPass()
    {

        $newpass = $_POST['newpass'];
        $correo = $_POST['correo'];

        $resul = $this->userModel->updatePassword($newpass, $correo);

        $message = "Contraseña actualizada correctamente";

        $datos = [
            'resul' => $resul,
            'messageInfo' => $message
        ];
        header('Content-Type: application/json');
        echo json_encode($datos);
    }
}
