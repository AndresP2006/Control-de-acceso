<?php


// Clase controlador principal 
// Se encarga de poder cargar los modelos y las vistasS
class Controlador
{

    //cargar metodo 
    public function modelo($modelo)
    {
        //cargar modelo 
        require_once '../app/models/' . $modelo . '.php';
        //instanciamos el modelo 
        return new $modelo();
    }
    
    public function controller($controller)
    {
        //cargar modelo 
        require_once '../app/controllers/' . $controller . '.php';
        //instanciamos el modelo 
        return new $controller();
    }

    //cargamos la vista
    public function vista($vista, $datos = [])
    {
        //chequear si el archivo vista existe 
        if (file_exists('../app/views/' . $vista . '.php')) {
            require_once '../app/views/' . $vista . '.php';
        } else {
            //si el archivo no existe
            die('la vista no existe');
        }
    }
}
