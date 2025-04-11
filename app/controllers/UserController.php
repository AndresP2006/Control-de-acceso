<?php
class UserController extends Controlador
{
    private $adminModel;
    private $peopleModel;
    private $paquetModel;
    private $apartamentModel;
    private $torreModel;
    private $visitorModel;
    private $userModel;

    public function __construct()
    {
        // Inicialización de los modelos
        $this->adminModel = $this->modelo('AdminModel');
        $this->peopleModel = $this->modelo('PeopleModel');
        $this->paquetModel = $this->modelo('PaquetModel');
        $this->apartamentModel = $this->modelo('ApartamentModel');
        $this->torreModel = $this->modelo('TorreModel');
        $this->visitorModel = $this->modelo('VisitorModel');
        $this->userModel = $this->modelo('UserModel');
    }


    public function index($messageError = null, $messageInfo = null,)
    {
        // $paquets = $this->paquetModel->getPackegesByTable();
        $resindents = $this->peopleModel->getAllResident($_SESSION['datos']->Us_usuario);
        $people = $this->peopleModel->getAllRedident($_SESSION['datos']->Us_usuario);
        // $notificacion = $this->peopleModel->getNotificacion($_SESSION['datos']->Us_usuario);
        $datos_resident = $this->peopleModel->getAllSolicitudes($_SESSION['datos']->Us_id);


        return [
            'messageError' => $messageError,
            'messageInfo' => $messageInfo,
            // 'paquets' => $paquets,
            'resindents' => $resindents,
            'datos_resident' => $datos_resident,
            'people' => $people,
            // 'notificacion' => $notificacion
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

            // Recoger los datos correctamente desde $_POST
            $datos = [
                'Cedula'      => trim($_POST['E_id']),
                'Nombre'      => trim($_POST['E_Nombre']),
                'Apellidos'   => trim($_POST['E_Apellido']),
                'Telefono'    => trim($_POST['E_Telefono']),
                'Gmail'       => trim($_POST['E_Gmail']),
                'Torre'       => trim($_POST['E_torre']),
                'Ap_numero'   => trim($_POST['E_Departamento2']),
                'Departamento' => trim($_POST['E_Departamento']),
                'Rol'         => trim($_POST['R_id']),
                'Contrasena'  => trim($_POST['E_contrasena']),
            ];


            $resultado = $this->adminModel->updateUser($datos);
            $registros = $this->peopleModel->getAllUsuario();

            // Formatear los datos de los usuarios
            $usuarios = [];
            foreach ($registros as $registro) {
                $usuarios[] = [
                    'Cedula'    => $registro->Pe_id,
                    'Pe_nombre' => $registro->Pe_nombre,
                    'Pe_apellidos' => $registro->Pe_apellidos,
                    'Pe_telefono'  => $registro->Pe_telefono,
                    'Us_correo'    => $registro->Us_correo,
                    'Ap_id'        => $registro->Ap_id,
                    'Ap_numero'    => $registro->Ap_numero,
                    'To_letra'     => $registro->To_letra,
                    'To_id'        => $registro->To_id,
                    'Ro_tipo'      => $registro->Ro_tipo,
                ];
            }

            if ($resultado) {
                $messageInfo = 'Usuario actualizado correctamente';
            } else {
                $messageError = 'Error al actualizar el usuario';
            }

            $datos = [
                'usuarios'      => $usuarios,
                'messageError'  => $messageError,
                'messageInfo'   => $messageInfo,
            ];
        } else {
            $messageError = 'Error: No se pudo procesar la solicitud';
            $datos = [
                'messageError' => $messageError,
            ];
        }
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
                'To_letra' => $registro->To_letra,
                'Ap_numero' => $registro->Ap_numero,
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
                $hay = $this->apartamentModel->peopleApartamento($torre, $apartamento);

                if (!$hay) {
                    $this->apartamentModel->DeleteApartamento($torre, $apartamento);
                    $mensaje = 'Apartamento eliminado correctamente.';
                } else {
                    $mensaje = 'No se puede eliminar: el apartamento tiene personas asociadas.';
                }
            } elseif (isset($_POST['guardar']) && isset($_POST['torre']) && isset($_POST['apartamento'])) {
                $torre = $_POST['torre'];
                $apartamento = $_POST['apartamento'];

                $this->apartamentModel->IngresarApartamento($torre, $apartamento);
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
            $fecha = $_POST['fecha'] ?? null;

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
                        'Ap_numero' => $registro->Ap_numero,
                        'To_letra' => $registro->To_letra,
                    ];
                }
                $datos = [
                    'historial' => $usuarios
                ];
            } else {
                $datos = ['historial' => []]; // Si no hay registros, aseguramos que la variable no cause errores
            }

            // Mantener los visitantes filtrados por fecha
            if ($fecha) {
                $datos['visitors'] = $this->visitorModel->obtenerVisitantesPorFecha($fecha);
            } else {
                $datos['visitors'] = $this->visitorModel->getVisitrosByTable();
            }

            $this->vista('pages/admin/historialViView', $datos);
        }
    }

    public function enterTower() {}

    public function ActualizarUsuario()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Depuración: ver qué llega por $_POST
            error_log("Datos recibidos en ActualizarUsuario: " . print_r($_POST, true));

            // Validar que existan los campos requeridos
            $requiredFields = ['E_id', 'E_nombre', 'E_Gmail', 'E_Telefono', 'To_id', 'Ap_numero'];
            foreach ($requiredFields as $field) {
                if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                    echo json_encode(['success' => false, 'error' => "Falta el campo: " . $field]);
                    exit;
                }
            }
            $usuario = $this->peopleModel->getPersonaById($_POST['E_id']);



            // Armar array para el modelo con las claves correspondientes a la tabla de solicitudes
            $usuarioActualizado = [
                'id_residente'      => trim($_POST['E_id']),
                'nombre'      => trim($_POST['E_nombre']),
                'correo_nuevo'      => trim($_POST['E_Gmail']),
                'telefono_nuevo'    => trim($_POST['E_Telefono']),
                'torre_nuevo'       => trim($_POST['To_id']),
                'apartamento_nuevo' => trim($_POST['Ap_numero']),
            ];

            // Llamar al modelo para insertar la solicitud de actualización
            $resultado = $this->adminModel->insertUserUpdateRequest($usuarioActualizado);
            // Responder en JSON
            echo json_encode(['success' => $resultado]);
            exit;
        }

        // Si no es POST, mensaje de error
        echo json_encode(['success' => false, 'error' => 'Método no permitido']);
        exit;
    }

    public function VisitantesPorFecha()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si se proporcionó la fecha
            $fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : null;

            if ($fecha) {
                // Obtener visitantes por fecha desde el modelo
                $visitors = $this->visitorModel->obtenerVisitantesPorFecha($fecha);
            } else {
                // Obtener todos los visitantes si no se proporciona una fecha
                $visitors = $this->visitorModel->getVisitrosByTable();
            }

            // Pasar los datos a la vista
            $datos = [
                'visitors' => $visitors,
                'error' => null
            ];
            $this->vista('pages/admin/historialViView', $datos);
        } else {
            // Redirigir si no es una solicitud POST
            header('Location: ' . RUTA_URL . '/HomeController/admin');
            exit;
        }
    }

    public function ActualizarResidente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Depuración: ver qué llega por $_POST
            error_log("Datos recibidos en ActualizarResidente: " . print_r($_POST, true));

            // Validar que existan los campos requeridos
            $requiredFields = ['E_id', 'E_Gmail', 'E_Telefono', 'To_id', 'Ap_numero'];
            foreach ($requiredFields as $field) {
                if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                    echo json_encode(['success' => false, 'error' => "Falta el campo: " . $field]);
                    exit;
                }
            }

            // Armar array para el modelo con las claves correspondientes a la tabla de residentes
            $residenteActualizado = [
                'Cedula'            => trim($_POST['E_id']),
                'Nombre'            => trim($_POST['E_nombre']),
                'Gmail'             => trim($_POST['E_Gmail']),
                'Telefono'          => trim($_POST['E_Telefono']),
                'Torre'             => trim($_POST['To_id']),
                'Apartamento'       => trim($_POST['Ap_numero']),
            ];

            // Llamar al modelo para actualizar los datos del residente
            try {
                $resultado = $this->adminModel->insertUserUpdate($residenteActualizado);

                // Responder en JSON
                if ($resultado) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Error al actualizar el residente']);
                }
            } catch (Exception $e) {
                // Manejar cualquier error que ocurra
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }

            exit;
        }

        // Si no es POST, mensaje de error
        echo json_encode(['success' => false, 'error' => 'Método no permitido']);
        exit;
    }
    public function motivoRechazo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Depuración: ver qué llega por $_POST
            error_log("Datos recibidos en ActualizarResidente: " . print_r($_POST, true));

            // Validar que existan los campos requeridos
            $requiredFields = ['E_id', 'M_rechazo'];
            foreach ($requiredFields as $field) {
                if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                    echo json_encode(['success' => false, 'error' => "Falta el campo: " . $field]);
                    exit;
                }
            }

            // Armar array para el modelo con las claves correspondientes a la tabla de residentes
            $residenteActualizado = [
                'Cedula'            => trim($_POST['E_id']),
                'rechazo'            => trim($_POST['M_rechazo']),
            ];

            // Llamar al modelo para actualizar los datos del residente
            try {
                $resultado = $this->adminModel->insertRechazo($residenteActualizado);

                // Responder en JSON
                if ($resultado) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Error al actualizar el residente']);
                }
            } catch (Exception $e) {
                // Manejar cualquier error que ocurra
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }

            exit;
        }

        // Si no es POST, mensaje de error
        echo json_encode(['success' => false, 'error' => 'Método no permitido']);
        exit;
    }

    public function verifyRol()
    {
        file_put_contents('log.txt', "Llamado a verifyRol\n", FILE_APPEND);

        header('Content-Type: application/json');

        $respuesta =  $this->userModel->getUserByRol($_POST['ValueRol']);

        echo json_encode($respuesta);
        exit;
    }
}
