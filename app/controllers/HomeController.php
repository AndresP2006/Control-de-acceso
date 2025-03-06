<?php

class HomeController extends Controlador
{

    private $articleModel;
    private $porterController;
    private $userController;
    private $torreModel;
    private $apartamentModel;
    private $visitorModel;
    private $paquetModel;

    public function __construct()
    {
        $this->articleModel = $this->modelo('ArticleModel');
        $this->porterController = $this->controller('PorterController');
        $this->userController = $this->controller('UserController');
        $this->torreModel = $this->modelo('TorreModel');
        $this->apartamentModel = $this->modelo('ApartamentModel');
        $this->visitorModel = $this->modelo('VisitorModel');
        $this->paquetModel = $this->modelo('PaquetModel');
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
    
    public function verUser(){
        $this->vista("pages/user/userView");
    }
    public function notificaciones(){
        $this->vista("pages/user/notifiView");
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
        $paquets = $this->paquetModel->getPackegesByTable();

        $datos = [
            'paquets' => $paquets
        ];

        $this->vista('pages/admin/paquetesView', $datos);
    }

    public function Edificios()
    {
        $torres = $this->torreModel->getTorreByTable();
        $apartaments = $this->apartamentModel->getApartamentByTable();

        $data = [
            'torres' => $torres,
            'apartaments' => $apartaments
        ];

        $this->vista('pages/admin/edificiosView', $data);
    }
}
