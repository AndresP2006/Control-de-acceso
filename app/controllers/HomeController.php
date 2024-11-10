<?php

class HomeController extends Controlador
{

    private $articleModel;

    public function __construct()
    {
        $this->articleModel = $this->modelo('ArticleModel');
        //echo 'Controlador paginas cargado';
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

    public function admin()
    {
        if (!isset($_SESSION['sesion_activa'])) {
            header('location:' . RUTA_URL . '/pages/homeView');
            exit;
        }
        $this->vista('pages/admin/adminView', null);
    }
    public function guard()
    {
        if (!isset($_SESSION['sesion_activa'])) {
            header('location:' . RUTA_URL . '/pages/homeView');
            exit;
        }
        $this->vista('pages/porter/porterView', null);
    }
}
