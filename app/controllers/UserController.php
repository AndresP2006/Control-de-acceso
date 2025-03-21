<?php
class UserController extends Controlador
{
    private $adminModel;
    private $peopleModel;
    private $paquetModel;
    private $apartamentModel;
    private $torreModel;
    private $visitorModel;

    public function __construct()
    {
        // Inicialización de los modelos
        $this->adminModel = $this->modelo('AdminModel');
        $this->peopleModel = $this->modelo('PeopleModel');
        $this->paquetModel = $this->modelo('PaquetModel');
        $this->apartamentModel = $this->modelo('ApartamentModel');
        $this->torreModel = $this->modelo('TorreModel');
        $this->visitorModel = $this->modelo('VisitorModel');
    }


    public function index($messageError = null, $messageInfo = null,)
    {
        $paquets = $this->paquetModel->getPackegesByTable();
        $resindents = $this->peopleModel->getAllResident($_SESSION['datos']->Us_usuario);
        $people = $this->peopleModel->getAllRedident($_SESSION['datos']->Us_usuario);

        return [
            'messageError' => $messageError,
            'messageInfo' => $messageInfo,
            'paquets' => $paquets,
            'resindents' => $resindents,
            'people' => $people
        ];
    }

    public function createUser()
    {
        $messageInfo = null;
        $messageError = nUll;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro'])) {
            if (!empty(trim($_POST['Pe_id'])) && !empty(trim($_POST['U_Nombre']))  && !empty(trim($_POST['U_Apellido'])) && !empty(trim($_POST['U_Telefono'])) && !empty(trim($_POST['U_Gmail'])) && !empty(trim($_POST['U_id']))) {


                // Recoger los datos del formulario
                $departamento = isset($_POST['U_Departamento']) && !empty($_POST['U_Departamento'])
                    ? trim($_POST['U_Departamento'])
                    : trim($_POST['U_Departamento2']);

                $datos = [
                    'Cedula' => trim($_POST['Pe_id']),
                    'Nombre' => trim($_POST['U_Nombre']),
                    'Apellidos' => trim($_POST['U_Apellido']),
                    'Telefono' => trim($_POST['U_Telefono']),
                    'Gmail' => trim($_POST['U_Gmail']),
                    'Departamento' => !empty($departamento) ? $departamento : null,
                    'Rol' => trim($_POST['U_id']),
                    'Contrasena' => trim($_POST['U_contrasena']),
                ];

                // Intentar registrar al usuario
                $regist = $this->adminModel->addUser($datos);

                if ($regist === true) {
                    $messageInfo = 'Usuario guardado correctamente.';
                    $messageError = null;
                } else {
                    $messageInfo = null;
                    $messageError = 'El usuario con la cedula ' . $datos['Cedula'] . ' ya existe.';
                }
            } else {
                $messageError = 'Error al momento de ingresar los datos';
            }
            // Obtener todos los usuarios registrados
            $registros = $this->peopleModel->getAllUsuario();
            $usuarios = array_map(function ($registro) {
                return [
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
            }, $registros);

            // Pasar los datos y mensajes a la vista
            $datosVista = [
                'usuarios' => $usuarios,
                'messageError' => $messageError,
                'messageInfo' => $messageInfo,
            ];

            $this->vista('pages/admin/AdminView', $datosVista);
            exit;
        } else {
            // Manejo de error si no es POST o no hay registro
            $datosVista = [
                'messageError' => 'Hubo un error al procesar la solicitud.',
                'messageInfo' => null,
                'usuarios' => [],
            ];

            $this->vista('pages/admin/AdminView', $datosVista);
            exit;
        }
    }




    public function EditarUser()
    {
        $messageInfo = '';
        $messageError = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['udate'])) {

            $departamento = isset($_POST['E_Departamento']) && $_POST['E_Departamento'] != '' ? $_POST['E_Departamento'] : $_POST['E_Departamento2'];

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

            $resultado = $this->adminModel->updateUser($datos);
            $registros = $this->peopleModel->getAllUsuario();

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


            $datos = [
                'usuarios' => $usuarios,
            ];
            if ($resultado) {
                $messageInfo = 'Usuario actualizado correctamente';
            } else {
                $messageError = 'Error al actualizar el usuario';
            }
        } else {
            $messageError = 'Error: No se pudo procesar la solicitud';
        }
        $datos = [
            'usuarios' => $usuarios,
            'messageError' => $messageError,
            'messageInfo' => $messageInfo,
        ];
        $this->vista('pages/admin/adminView', $datos);
        exit;
    }

    public function DeleteUser()
    {
        $messageDelet = null;
        $mensaageError = null;

        // Verificar si se han enviado los datos necesarios
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletebtn']) && isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];

            // Verificar si el usuario existe
            $result = $this->peopleModel->getAllpersonas($delete_id);
            if ($result) {
                $paque = $this->paquetModel->getPackegesBy($delete_id);
                if ($paque) {
                    $mensaageError = 'No se puede borrar por que tiene un paquete';
                } else {
                    if ($this->adminModel->eliminarRegistro($delete_id)) {
                        $messageDelet = 'Registro eliminado con éxito';
                    };
                }
            } else {
                $mensaageError = 'Por favor, verifica que el registro no esté asociado a otra entidad';
            }
        }
        // Recuperar el filtro actual desde el POST (si existe), de lo contrario usar un valor predeterminado
        // Asegúrate de que el filtro se reciba desde el formulario POST correctamente
        $filter = isset($_POST['select_rol']) ? $_POST['select_rol'] : 'Todos';

        // Si el filtro es 'Todos', obtenemos todos los registros
        // Sino, obtenemos los usuarios filtrados por rol
        if ($filter == 'Todos') {
            $registros = $this->peopleModel->getAllUsuario();
        } else {
            $registros = $this->peopleModel->getAllUsuario($filter);
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
            'filter' => $filter,
            'messageError' => $mensaageError,
            'messageDelet' => $messageDelet,
        ];

        // Redirigir a la misma página con el filtro aplicado
        $this->vista('pages/admin/adminView', $datos);
    }


    public function DeleteVisitas() {}

    public function DeletePaquete()
    {

        if (isset($_POST['deletePaquetes']) && isset($_POST['delete_pid'])) {
            $id = $_POST['delete_pid'];

            $this->paquetModel->deletePaquetById($id);

            $datos = $this->index(null, 'Paquete borrado correctamente');
            $this->vista('pages/admin/paquetesView', $datos);
        }
    }

    public function Torre()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['borrar']) && isset($_POST['id'])) {
                $id = $_POST['id'];
                $mensaje = $this->torreModel->DeleteTorre($id);


                $datos['filter'] = 'borrar';
                $datos['error'] = $mensaje;
            } elseif (isset($_POST['guardar']) && isset($_POST['id']) && isset($_POST['torre'])) {
                $id = $_POST['id'];
                $torre = $_POST['torre'];

                // Lógica para guardar la torre
                $mensaje = $this->torreModel->IngresarTorre($id, $torre);


                $datos['filter'] = 'guardar';
                $datos['error'] = $mensaje;
            } else {
                // Si no se envían datos válidos
                $datos['error'] = 'Datos incompletos.';
            }
        }

        $datos['torres'] = $this->torreModel->getTorreByTable();
        $datos['apartaments'] = $this->apartamentModel->getApartamentByTable();

        $this->vista('pages/admin/edificiosView', $datos);
    }


    public function Apartamento()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mensaje = null;
            $mensaje2 = null;
            if (isset($_POST['borrar']) && isset($_POST['torre']) && isset($_POST['apartamento'])) {
                $torre = $_POST['torre'];
                $apartamento = $_POST['apartamento'];
                $this->apartamentModel->DeleteApartamento($torre, $apartamento);
                $mensaje = 'Apartamento eliminado correctamente.';
            } elseif (isset($_POST['guardar']) && isset($_POST['torre']) && isset($_POST['apartamento'])) {
                $torre = $_POST['torre'];
                $apartamento = $_POST['apartamento'];

                $mensaje1 = $this->apartamentModel->IngresarApartamento($torre, $apartamento);
            } else {
                $mensaje2 = 'Datos incompletos.';
            }
            $datos['messageError'] = $mensaje2;
            $datos['messageInfo'] = $mensaje;
            $datos = $this->index($mensaje);
        }

        $datos['torres'] = $this->torreModel->getTorreByTable();
        $datos['apartaments'] = $this->apartamentModel->getApartamentByTable();

        $this->vista('pages/admin/edificiosView', $datos);
    }

    public function MostrarDatos()
    {
        // Captura el filtro desde el formulario POST o retiene el valor previo si existe
        $roleId = isset($_POST['select_id']) && $_POST['select_id'] !== '' ? intval($_POST['select_id']) : null;

        // Obtén todos los registros de usuarios con o sin filtro
        $registros = $this->peopleModel->getAllUsuario($roleId);

        // Si no hay registros, devuelve un mensaje
        if (empty($registros)) {
            return [
                'usuarios' => [],
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



    public function BuscarUsuario()
    {
        $datos = []; // Inicializamos los datos
        $usuarios = [];
        $filter = 'Todos'; // Valor predeterminado del filtro
        $messageError = null; // Usamos 'messageError' para los mensajes de error
        $rolId = null; // Inicializa la variable $rolId

        // Cargar todos los usuarios inicialmente
        $usuarios = $this->peopleModel->getAllUsuario();

        // Verifica la acción de búsqueda o filtrado
        if (isset($_POST['action'])) {
            // Filtrado por rol
            if ($_POST['action'] === 'filter') {
                $rolId = $_POST['select_rol'] ?? null; // Asignamos el valor de select_rol o null si no está definido
                $usuarios = $rolId ? $this->peopleModel->getAllUsuario($rolId) : $this->peopleModel->getAllUsuario();
                $filter = $rolId ?: 'Todos';
                // No hay necesidad de mostrar error si no se encuentra ningún resultado en el filtro
                if (empty($usuarios)) {
                }
            }
            // Búsqueda por id_usuario
            elseif ($_POST['action'] === 'search' && !empty($_POST['id_usuario'])) {
                $usuario = $this->peopleModel->getPersonaById($_POST['id_usuario']);

                if ($usuario) {
                    $usuarios = [$usuario]; // Mostrar solo el usuario encontrado
                    $filter = $usuario->Ro_id; // Cambia el filtro automáticamente según el rol del usuario encontrado
                } else {
                    $messageError = 'Usuario no encontrado con la cédula proporcionada.'; // Mensaje de error para búsqueda
                }
            }
        }

        // Convertir los usuarios a formato array si hay usuarios encontrados
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
        }

        // Asignar el error y el filtro
        $datos['filter'] = $filter; // Asegura que el filtro correcto se pase a la vista
        $datos['messageError'] = $messageError;

        // Renderiza la vista con los datos
        $this->vista('pages/admin/adminView', $datos);
    }

    public function MostrarHistorial()
    {
        if (isset($_POST['historial-btn'])) {
            $id = $_POST['historial_id'];

            $registros = $this->peopleModel->getAllRegistro($id);

            // Verificamos si $registros es un arreglo o un objeto
            if ($registros && is_array($registros)) {
                $usuarios = [];
                foreach ($registros as $registro) {
                    $usuarios[] = [
                        'Re_fecha_entrada' => $registro->Re_fecha_entrada,
                        'Re_hora_entrada' => $registro->Re_hora_entrada,
                        'Re_hora_salida' => $registro->Re_hora_salida,
                        'Re_motivo' => $registro->Re_motivo,
                        'Vi_departamento' => $registro->Vi_departamento,
                        'Pe_id' => $registro->Pe_id,
                    ];
                }
                $datos = [
                    'historial' => $usuarios
                ];
            } else {
                $datos = ['historial' => []]; // Si no hay registros, aseguramos que la variable no cause errores
            }
        }

        $datos['visitors'] = $this->visitorModel->getVisitrosByTable();

        $this->vista('pages/admin/historialViView', $datos);
    }

    public function enterTower() {}
}
