<?php

class ArticleModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getArticles()
    {
        $this->db->query("SELECT * FROM articulos");

        return $this->db->registros();
    }
}
