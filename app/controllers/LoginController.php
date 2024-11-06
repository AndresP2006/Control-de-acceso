<?php

class LoginController extends Controlador
{

    public function __construct()
    {
        //echo 'Controlador paginas cargado';
    }

    public function index()
    {
        $this->vista('pages/admin/adminView', null);
    }

    public function verPorter()
    {
        $this->vista('pages/porter/porterView', null);
    }


}
