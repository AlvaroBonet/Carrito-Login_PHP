<?php

require_once 'db/Database.php';

class Rol {
    private $id;
    private $nombre;

    public function __construct(){}

    public function getId() : int | null{
        return $this->id;
    }
    public function setId($id) : void{ 
        $this->id = $id;
    }

    public function getNombre() : string | null{
        return $this->nombre;
    }

    public function setNombre($nombre) : void{ 
        $this->nombre = $nombre;
    }

    public function findAll() : PDOStatement
    {
        /**
         * 1. Me conecto a la base de datos.
         * 2. Realizo la query
         * 3. Me desconecto de la base de datos.
         * 4. Devuelvo la query
         */
        $db = Database::conectar();
        $query = "SELECT * FROM rol";
        $result = $db->query($query);
        $db = Database::desconectar();
        return $result;
    }

    public function findById($id) 
    {
        /**
         * 1. Recibir el id que necesitamos buscar.
         * 2. Realizar la query
         * 3. Retornoar el usuario
         */
        $query = "SELECT * FROM rol WHERE id = $id";
        $db = Database::conectar();
        $user = $db->query($query);
        $db = Database::desconectar();
        return $user;
    }
}

?>