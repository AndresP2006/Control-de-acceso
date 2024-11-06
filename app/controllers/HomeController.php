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
        $articles = $this->articleModel->getArticles();

        $datos = [
            'titulo' => 'Bienvenido a MVC render2web',
            'articles' => $articles
        ];

        $this->vista('pages/homeView', $datos);
    }
}
