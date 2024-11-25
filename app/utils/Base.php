<?php


//CLASE PARA CONECTAR A LA BASE DE DATOS y ejecutar CONSULTAS
class Base
{
    private $host = DB_HOST;
    private $usuario = DB_USUARIO;
    private $password = DB_PASSWORD;
    private $nombre_base = DB_NOMBRE;

    private $dbh;
    private $stmt;
    private $error;


    public function __construct()
    {
        //CONFUGAR AL CONECCION
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->nombre_base;
        $opciones = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //CREAR UNA INSTANCIA DE PDO 
        try {
            $this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);
            $this->dbh->exec('set names utf8');
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    //vinculamos el metodo con bind
    public function bind($parametro, $valor, $tipo = null)
    {
        if (is_null($tipo)) {
            switch (true) {
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;

                default:
                    $tipo = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($parametro, $valor, $tipo);
    }

    //ESTA EJECUTA LA CONSULTA
    public function execute()
    {
        return $this->stmt->execute();
    }

    //OBTENER LOS REGISTROS 
    public function registros()
    {
        $this->execute();
        try{
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e){
            return;
        }
       
    }
    //OBTENER REGISTRO PARA LAS TABLAS
    public function showTables(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //OBTENER UN SOLO REGISTRO 
    public function registro()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //OBTENER CANTIDAD DE FILAS CON EL MOTODO rowCOUNT
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }


    public function beginTransaction()
    {
        $this->dbh->beginTransaction();
    }

    public function commit()
    {
        $this->dbh->commit();
    }

    public function rollBack()
    {
        $this->dbh->rollBack();
    }
}
