<?php

class HomeController extends Controlador
{

    private $articleModel;
    private $porterController;
    private $userController;

    public function __construct()
    {
        $this->articleModel = $this->modelo('ArticleModel');
        $this->porterController = $this->controller('PorterController');
        $this->userController = $this->controller('UserController');
    }

    public function index()
    {
        // $articles = $this->articleModel->getArticles();

        $datos = [
            'titulo' => 'Bienvenido a MVC render2web',
            // 'articles' => $articles
        ];

        $this->vista('pages/homeView', $datos);
    }

    // desplazamiento de vistas
    public function informacion(){
        $this->vista('pages/home/informacionView');
    }
    public function nosotros(){
        $this->vista('pages/home/nosotrosView');
    }

    public function admin() {
        if (!isset($_SESSION['sesion_activa'])) {
            header('location:' . RUTA_URL . '/pages/homeView');
            exit;
        }
    
        $datos = $this->userController->MostrarDatos();
    
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
    public function usuario(){
        $this->vista('pages/admin/adminView');
    }

}
