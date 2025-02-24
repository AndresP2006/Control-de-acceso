<?php

class VisitorModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getVisitrosByTable()
    {
        $this->db->query("SELECT DISTINCT *  FROM visitantes");
        return $this->db->showTables();
    }
}
