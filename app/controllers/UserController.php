<?php
class UserController extends Controlador
{
    private $AdminModel;
    private $PeopleModel;

    public function __construct()
    {
        // Inicialización de los modelos
        $this->AdminModel = $this->modelo('AdminModel');
        $this->PeopleModel = $this->modelo('PeopleModel');
    }


    public function index($message = null)
    {
        return [
            'messageInfo' => $message,
        ];
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro'])) {
            // Recoger los datos del nuevo usuario
            $datos = [
                'Cedula' => trim($_POST['Pe_id']),
                'Nombre' => trim($_POST['U_Nombre']),
                'Apellidos' => trim($_POST['U_Apellido']),
                'Telefono' => trim($_POST['U_Telefono']),
                'Gmail' => trim($_POST['U_Gmail']),
                'Departamento' => trim($_POST['U_Departamento']),
                'Torre' => trim($_POST['U_torre']),
                'Rol' => trim($_POST['U_id']),
                'Contrasena' => trim($_POST['U_contrasena']),
            ];

            // Mensaje de éxito
            $message = 'Usuario guardado correctamente';

            // Agregar el nuevo usuario
            $this->AdminModel->addUser($datos);

            // Obtener todos los usuarios después de agregar el nuevo
            $registros = $this->PeopleModel->getAllUsuario();

            // Formatear los datos de los usuarios como lo mencionas
            $usuarios = [];
            foreach ($registros as $registro) {
                $usuarios[] = [
                    'Cedula' => $registro->Pe_id,
                    'Pe_nombre' => $registro->Pe_nombre,
                    'Pe_apellidos' => $registro->Pe_apellidos,
                    'Pe_telefono' => $registro->Pe_telefono,
                    'Us_correo' => $registro->Us_correo,
                    'Ap_id' => $registro->Ap_id,
                    'Ro_tipo' => $registro->Ro_tipo,
                ];
            }

            // Pasar los usuarios y el mensaje a la vista
            $datosVista = [
                'messageInfo' => $message,
                'usuarios' => $usuarios,
            ];

            // Redirigir a la vista
            $this->vista('pages/admin/AdminView', $datosVista);
            exit; // Finaliza la ejecución para evitar redirecciones adicionales
        } else {
            // Manejar el caso donde no se cumple la condición POST o 'registro'
            $datosVista = [
                'messageInfo' => 'Hubo un error al procesar la solicitud.',
                'usuarios' => [], // Opcional: puedes pasar una lista vacía o los usuarios actuales
            ];

            // Redirigir a la misma vista con el mensaje de error
            $this->vista('pages/admin/AdminView', $datosVista);
            exit;
        }
    }




    public function EditarUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['udate'])) {

            $departamento = isset($_POST['E_Departamento']) && $_POST['E_Departamento'] != ''   ? $_POST['E_Departamento'] : $_POST['E_Departamento2'];

            $datos = [
                'Cedula' => trim($_POST['E_id']),
                'Nombre' => trim($_POST['E_Nombre']),
                'Apellidos' => trim($_POST['E_Apellido']),
                'Telefono' => trim($_POST['E_Telefono']),
                'Gmail' => trim($_POST['E_Gmail']),
                'Departamento' => trim($departamento),
                'Rol' => trim($_POST['R_id']), // Asegúrate de que el nombre del campo sea correcto
                'Contrasena' => trim($_POST['E_contrasena']),
            ];

            $resultado = $this->AdminModel->updateUser($datos);

            if ($resultado) {
                $_SESSION['message'] = 'Usuario actualizado correctamente';
            } else {
                $_SESSION['error'] = 'Error al actualizar el usuario';
            }
        } else {
            $_SESSION['error'] = 'Error: No se pudo procesar la solicitud';
        }

        $this->vista('pages/admin/adminView', null);
        exit;
    }



    public function DeleteUser()
    {
        // Verificar si se han enviado los datos necesarios
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletebtn']) && isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];


            // Llamar al modelo para eliminar el registro
            $this->AdminModel->eliminarRegistro($delete_id);

            // Opcionalmente, puedes configurar una variable de sesión o un mensaje flash para mostrar en la misma página
            $_SESSION['message'] = 'Usuario borrado correctamente';
        } else {
            $_SESSION['error'] = 'Error: No se pudo procesar la solicitud';
        }
        // Conservar el filtro seleccionado


        // Redirigir a la misma página para evitar redireccionamientos extraños
        $this->vista('pages/admin/adminView', null);
        exit;
    }
    public function DeleteVisitas() {}


    public function MostrarDatos()
    {
        // Captura el filtro desde el formulario POST o retiene el valor previo si existe
        $roleId = isset($_POST['select_id']) && $_POST['select_id'] !== '' ? intval($_POST['select_id']) : null;

        // Obtén todos los registros de usuarios con o sin filtro
        $registros = $this->PeopleModel->getAllUsuario($roleId);

        // Si no hay registros, devuelve un mensaje
        if (empty($registros)) {
            return [
                'usuarios' => [],
                'messageInfo' => 'No se encontraron registros.',
                'filter' => $roleId, // Mantener el filtro actual
            ];
        }

        // Mapeamos los datos en un array asociativo para la vista
        $usuarios = [];
        foreach ($registros as $registro) {
            $usuarios[] = [
                'Cedula' => $registro->Pe_id,
                'Pe_nombre' => $registro->Pe_nombre,
                'Pe_apellidos' => $registro->Pe_apellidos,
                'Pe_telefono' => $registro->Pe_telefono,
                'Us_correo' => $registro->Us_correo,
                'Us_contrasena' => $registro->Us_contrasena,
                'Ap_id' => $registro->Ap_id,
                'Ap_numero' => $registro->Ap_numero,
                'Ro_tipo' => $registro->Ro_tipo,
            ];
        }

        return [
            'usuarios' => $usuarios,
            'messageInfo' => null,
            'filter' => $roleId,
        ];
    }



    public function admin()
    {
        // Verifica la sesión antes de mostrar la vista
        if (!isset($_SESSION['sesion_activa'])) {
            header('location:' . RUTA_URL . '/pages/homeView');
            exit;
        }

        // Obtiene los datos para la vista
        $datos = $this->MostrarDatos();

        // Llama a la vista pasando los datos
        $this->vista('pages/admin/adminView', $datos);
    }




    //Este metodo de la barra de búsqueda
    public function BuscarUsuario()
    {
        // Verifica si se ha enviado un término de búsqueda
        if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {
            $id = $_POST['id_usuario'];

            // Realiza la búsqueda en la base de datos
            $registro = $this->PeopleModel->getPersonaById($id);

            if ($registro) { // Si se encuentra el registro
                // Mapea los registros para la vista
                $usuarios = [
                    'Cedula' => $registro->Pe_id,
                    'Pe_nombre' => $registro->Pe_nombre,
                    'Pe_apellidos' => $registro->Pe_apellidos,
                    'Pe_telefono' => $registro->Pe_telefono,
                    'Us_correo' => $registro->Us_correo,
                    'Ap_id' => $registro->Ap_id,
                    'Ro_id' => $registro->Ro_id,
                    'Us_contrasena' => $registro->Us_contrasena,
                    'Ro_tipo' => $registro->Ro_tipo,
                ];

                $datos = [
                    'usuarios' => [$usuarios], // Usar un array dentro de 'usuarios'
                    'filter' => $registro->Ro_id, // Pasar el rol encontrado al filtro
                ];
            } else {
                // Si no se encuentra el usuario, enviar un mensaje de error
                $datos = [
                    'error' => "No se encontró el usuario con ID: $id"
                ];
            }
        } else {
            // Si no se ha enviado un término de búsqueda
            $datos = [
                'error' => 'No se ha enviado un término de búsqueda válido.'
            ];
        }

        // Renderiza la vista con los datos obtenidos
        $this->vista('pages/admin/adminView', $datos);
    }
}
