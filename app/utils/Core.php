<?php

/* 
  TRAER L AURL ingresada en el navegador,
  1= CONTROLADOR 
  2= METODO
  3= PARAMETRO 
  */
class Core
{
    protected $controladorActual = 'HomeController';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct()
    {
        //print_r($this->getUrl());
        $url = $this->getUrl();


        //buscar un controladores existen
        if (file_exists('../app/controllers/' . ucwords(!isset($url) ? null : $url[0]) . '.php')) {
            //si existe se setea como controlador por defecto
            $this->controladorActual = ucwords($url[0]);

            //unset indice
            unset($url[0]);
        }

        //requerir el controlador 
        require_once '../app/controllers/' . $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual;

        //chequear la segunda parte de la URL que seria el metodo 
        if (isset($url[1])) {
            if (method_exists($this->controladorActual, $url[1])) {
                //chequeamos el metodo 
                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }
        //para probar
        // echo $this->metodoActual;

        //obtener los posibles parametros 
        $this->parametros = $url ? array_values($url) : [];

        //llamar callback con parametros array
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    public function getUrl()
    {
        //echo $_GET['url'];
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);

            $url = explode('/', $url);
            return $url;
        }
    }
}
