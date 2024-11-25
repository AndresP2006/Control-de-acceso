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

            $departamento = isset($_POST['U_Departamento']) && $_POST['U_Departamento'] != ''   ? $_POST['U_Departamento'] : $_POST['U_Departamento2'];
            $datos = [
                'Cedula' => trim($_POST['Pe_id']),
                'Nombre' => trim($_POST['U_Nombre']),
                'Apellidos' => trim($_POST['U_Apellido']),
                'Telefono' => trim($_POST['U_Telefono']),
                'Gmail' => trim($_POST['U_Gmail']),
                'Departamento' => trim($departamento),
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
                    'Ap_numero' => $registro->Ap_numero,
                    'To_letra' => $registro->To_letra,
                    'To_id' => $registro->To_id,
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

        // Eliminar el registro del modelo
        $this->AdminModel->eliminarRegistro($delete_id);

        // Mensaje de éxito
        $_SESSION['message'] = 'Usuario borrado correctamente';
    } else {
        $_SESSION['error'] = 'Error: No se pudo procesar la solicitud';
    }

    // Recuperar el filtro actual desde el POST (si existe), de lo contrario usar un valor predeterminado
    // Asegúrate de que el filtro se reciba desde el formulario POST correctamente
    $filter = isset($_POST['select_rol']) ? $_POST['select_rol'] : 'Todos';

    // Si el filtro es 'Todos', obtenemos todos los registros
    // Sino, obtenemos los usuarios filtrados por rol
    if ($filter == 'Todos') {
        $registros = $this->PeopleModel->getAllUsuario();
    } else {
        $registros = $this->PeopleModel->getAllUsuario($filter);
    }

    // Verificar si no hay registros después de la eliminación
    if (empty($registros)) {
        $_SESSION['error'] = 'No hay usuarios que coincidan con el filtro seleccionado.';
    }

    // Preparar los datos de los usuarios para pasar a la vista
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

    // Pasar los datos a la vista con el filtro actual
    $datos = [
        'usuarios' => $usuarios,
        'filter' => $filter,  // Aseguramos que el filtro se mantenga
    ];

    // Redirigir a la misma página con el filtro aplicado
    $this->vista('pages/admin/adminView', $datos);
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
                'To_letra' => $registro->To_letra,
                'To_id' => $registro->To_id,
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
    $datos = []; // Inicializamos los datos
    $usuarios = [];
    $filter = 'Todos'; // Valor predeterminado del filtro
    $error = '';

    // Verifica la acción de búsqueda o filtrado
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'filter') {
            $rolId = $_POST['select_rol'] ?? null;
            $usuarios = $rolId ? $this->PeopleModel->getAllUsuario($rolId) : $this->PeopleModel->getAllUsuario();
            $filter = $rolId ?: 'Todos';
        } elseif ($_POST['action'] === 'search' && !empty($_POST['id_usuario'])) {
            $usuario = $this->PeopleModel->getPersonaById($_POST['id_usuario']);

            if ($usuario) {
                $usuarios = [$usuario];
                $filter = $usuario->Ro_id; // Cambia el filtro automáticamente según el rol del usuario encontrado
            } else {
                $error = 'Usuario no encontrado.';
                $filter = 'Todos';
            }
        }

        // Convertir los usuarios a formato array
        if (!empty($usuarios)) {
            $usuariosArray = array_map(function ($usuario) {
                return [
                    'Cedula' => $usuario->Pe_id,
                    'Pe_nombre' => $usuario->Pe_nombre,
                    'Pe_apellidos' => $usuario->Pe_apellidos,
                    'Pe_telefono' => $usuario->Pe_telefono,
                    'Us_correo' => $usuario->Us_correo,
                    'Ap_id' => $usuario->Ap_id,
                    'Ro_id' => $usuario->Ro_id,
                    'Ap_numero' => $usuario->Ap_numero,
                    'To_letra' => $usuario->To_letra,
                    'Us_contrasena' => $usuario->Us_contrasena,
                    'Ro_tipo' => $usuario->Ro_tipo,
                ];
            }, $usuarios);

            $datos['usuarios'] = $usuariosArray;
        } else {
            $error = $rolId ? "No se encontraron usuarios con el rol seleccionado." : 'No se encontraron usuarios.';
            $datos['usuarios'] = [];
        }
    } else {
        $error = 'Acción no válida.';
    }

    // Asignar el error y el filtro
    $datos['filter'] = $filter; // Asegura que el filtro correcto se pase a la vista
    $datos['error'] = $error;

    // Renderiza la vista con los datos
    $this->vista('pages/admin/adminView', $datos);
}

    



}