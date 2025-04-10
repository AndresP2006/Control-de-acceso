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
        $this->vista('pages/recoveryView');
        header('location:' . RUTA_URL . '/RecoveryController/recovery');
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
            $mail->setFrom('villarica1malambo@gmail.com', 'Control De Acceso');
            $mail->addReplyTo('jcharryme@gmail.com', 'Soporte');
            $mail->addAddress($correo);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Importante: Actividad en su cuenta';
            $mail->Body = '
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" 
                   style="padding: 20px; text-align: center;">
                <tr>
                    <td align="center">
                        <table role="presentation" width="400px" cellspacing="0" cellpadding="0" border="0" 
                               style="background-color: #c0c0c0; border-radius: 8px; 
                                      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); padding: 20px;">
                            <tr>
                                <td align="center">
                                    <h2>Control de <span style="color: red;">Acceso</span></h2>
                                    <p>Ha solicitado un cambio de clave.</p>
                                    <p>Si no es usted, ignore este mensaje.</p>
                                    <p><strong>Código de confirmación:</strong> 
                                        <span style="font-size: 18px; font-weight: bold; color: #2c3e50; background: #ecf0f1; 
                                                    padding: 5px; border-radius: 5px;">' . $codigo . '</span>
                                    </p>
                                    <p style="margin-top: 20px; font-size: 14px; color: #555;">
                                        Atentamente, <br> <strong>Soporte Técnico</strong>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>';
            

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
