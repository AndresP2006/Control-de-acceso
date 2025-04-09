<?php

class HomeController extends Controlador
{

    private $porterController;
    private $userController;
    private $torreModel;
    private $apartamentModel;
    private $visitorModel;
    private $paquetModel;
    private $peopleModel;

    public function __construct()
    {
        $this->porterController = $this->controller('PorterController');
        $this->userController = $this->controller('UserController');
        $this->torreModel = $this->modelo('TorreModel');
        $this->apartamentModel = $this->modelo('ApartamentModel');
        $this->visitorModel = $this->modelo('VisitorModel');
        $this->paquetModel = $this->modelo('PaquetModel');
        $this->peopleModel = $this->modelo('PeopleModel'); // Corregido
    }

    public function index()
    {
        session_destroy();
        $datos = [
            'titulo' => 'Bienvenido a MVC render2web'
        ];

        $this->vista('pages/homeView', $datos);
    }

    // desplazamiento de vistas
    public function informacion()
    {
        $this->vista('pages/home/informacionView');
    }

    public function nosotros()
    {
        $this->vista('pages/home/nosotrosView');
    }

    public function verUser()
    {
        $this->vista("pages/user/userView");
    }
    public function notificaciones_admin()
    {
        // Obtener todas las solicitudes de actualización pendientes desde el modelo
        $solicitudes = $this->peopleModel->getAllSolicitudesNotifi();

        // Formatear los datos para la vista
        $notificaciones = array_map(function ($solicitud) {
            return ['tipo' => 'solicitud_actualizacion', 'data' => $solicitud];
        }, $solicitudes);

        // Pasar los datos a la vista
        $datos = [
            'notificaciones' => $notificaciones
        ];

        $this->vista("pages/admin/notifiAdmin", $datos);
    }


    public function notificaciones()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['Us_usuario'];

            // Obtener visitas desde el modelo PeopleModel
            $visitas = $this->peopleModel->getNotificacion($usuario);

            // Obtener paquetes desde el modelo PaquetModel
            $paquetes = $this->paquetModel->getPaquetesPorUsuario($usuario);

            // Combinar visitas y paquetes en un solo arreglo
            $notificaciones = array_merge(
                array_map(function ($visita) {
                    return ['tipo' => 'visita', 'data' => $visita];
                }, $visitas),
                array_map(function ($paquete) {
                    return ['tipo' => 'paquete', 'data' => $paquete];
                }, $paquetes)
            );

            // Mezclar las notificaciones de forma aleatoria
            shuffle($notificaciones);

            // Pasar los datos a la vista
            $datos = [
                'notificaciones' => $notificaciones
            ];
            $this->vista("pages/user/notifiView", $datos);
        } else {
            $this->vista('pages/user/notifiView', ($this->userController->index()));
        }
    }

    public function solicitud_user()
    {
        if (isset($_POST["detalles"])) {

            $id_residente = $_POST["id"];
            $resident = $this->peopleModel->getPersonaById($id_residente);
            $datos_resident = $this->peopleModel->getAllSolicitudes($id_residente);

            $datos = [
                'resindents' => $resident,
                'datos_resident' => $datos_resident
            ];
            $this->vista("pages/admin/modalSolicitud", $datos);
        } else {
            $this->vista("pages/admin/modalSolicitud");
        }
    }
    public function admin()
    {
        if (!isset($_SESSION['sesion_activa'])) {
            header('location:' . RUTA_URL . '/pages/homeView');
            exit;
        }

        $datos = $this->userController->MostrarDatos();
        $Torres = $this->torreModel->setTorres();

        $_SESSION['torre'] = $Torres;
        // Pasamos los datos correctamente a la vista
        $this->vista('pages/admin/adminView', $datos);
    }

    public function guard()
    {
        if (!isset($_SESSION['sesion_activa'])) {
            header('location:' . RUTA_URL . '/pages/homeView');
            exit;
        }

        $this->vista('pages/porter/porterView', ($this->porterController->index()));
    }

    // Cargar datos de residente
    public function resident()
    {
        if (!isset($_SESSION['sesion_activa'])) {
            header('location:' . RUTA_URL . '/pages/homeView');
            exit;
        }
        $this->vista('pages/user/userView', ($this->userController->index($_SESSION['datos']->Us_usuario)));
    }
    // menu de administracion 
    public function usuario()
    {
        $this->vista('pages/admin/adminView');
    }

    public function HistoryRecords()
    {
        $visitors = $this->visitorModel->getVisitrosByTable();

        $datos = [
            'visitors' => $visitors,
        ];

        $this->vista('pages/admin/historialViView', $datos);
    }

    public function HistoryPackages()
    {
        $paquets = $this->paquetModel->getpaquetesByTable();

        $datos = [
            'paquets' => $paquets
        ];

        $this->vista('pages/admin/paquetesView', $datos);
    }
    public function BuscarPaquetes()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {

            // Obtener fechas de POST o GET
            $fechaInicio = isset($_POST['fecha_inicio']) ? trim($_POST['fecha_inicio']) : (isset($_GET['fecha_inicio']) ? trim($_GET['fecha_inicio']) : '');
            $fechaFin = isset($_POST['fecha_fin']) ? trim($_POST['fecha_fin']) : (isset($_GET['fecha_fin']) ? trim($_GET['fecha_fin']) : '');

            // Validar fechas
            if (!empty($fechaInicio) && !empty($fechaFin)) {
                if ($fechaInicio > $fechaFin) {
                    $datos = [
                        'paquets' => [],
                        'messageError' => 'La fecha de inicio no puede ser mayor que la fecha de fin.'
                    ];
                } else {
                    // Obtener paquetes en el rango de fechas
                    $paquets = $this->paquetModel->getPackagesByDateRange($fechaInicio, $fechaFin);
                    $datos = [
                        'paquets' => $paquets,
                        'filter_date' => true,
                        'fecha_inicio' => $fechaInicio,
                        'fecha_fin' => $fechaFin
                    ];
                }
            } else {
                $datos = [
                    'paquets' => [],
                    'messageError' => 'Las fechas no son válidas.'
                ];
            }

            // Cargar la vista con los resultados
            $this->vista('pages/admin/paquetesView', $datos);
        }
    }

    public function DeletePaquete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_pid'])) {
            $paqueteId = $_POST['delete_pid'];

            // Eliminar el paquete
            $this->paquetModel->deletePaquetById($paqueteId);

            // Recuperar fechas si existen
            $fechaInicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
            $fechaFin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';

            // Si las fechas existen, redirigir con los filtros activos
            if (!empty($fechaInicio) && !empty($fechaFin)) {
                header("Location: " . RUTA_URL . "/HomeController/BuscarPaquetes?fecha_inicio=$fechaInicio&fecha_fin=$fechaFin");
            } else {
                header("Location: " . RUTA_URL . "/HomeController/HistoryPackages");
            }

            exit;
        } else {
            header("Location: " . RUTA_URL . "/HomeController/HistoryPackages");
            exit;
        }
    }
}
