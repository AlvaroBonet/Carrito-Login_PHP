<?php

require_once 'db/Database.php';
require_once 'model/Model.php';


class Relojes implements Model
{
    private $id;
    private $nombre;
    private $marca;
    private $precio;
    


    public function __construct(){}

    public function getId() : int | null{
        return $this->id;
    }
    public function setId($id) : void{ 
        $this->id = $id;
    }

    public function getnombre() : string | null{
        return $this->nombre;
    }

    public function setnombre($nombre) : void{ 
        $this->nombre = $nombre;
    }

    public function getmarca() : string | null{
        return $this->marca;
    }

    public function setmarca($marca) : void{ 
        $this->marca = $marca;
    }

    public function getprecio() : int | null{
        return $this->precio;
    }

    public function setprecio($precio) : void{ 
        $this->precio = $precio;
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
        $query = "SELECT * FROM relojes";
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
        $query = "SELECT * FROM relojes WHERE id = $id";
        $db = Database::conectar();
        $user = $db->query($query);
        $db = Database::desconectar();
        return $user;
    }

    public function findBynombre($nombre) 
    {
        /**
         * 1. Recibir el id que necesitamos buscar.
         * 2. Realizar la query
         * 3. Retornoar el usuario
         */
        $query = "SELECT * FROM relojes WHERE nombre = '$nombre'";
        $db = Database::conectar();
        $user = $db->query($query);
        $db = Database::desconectar();
        return $user;
    }

    /**
     * CAMBIARLO PARA ADAPTAR A LA NUEVA FUNCIONALIDAD
     */
    public function store($datos)
    {
        /**
         * 1. Recorrer la estructura $datos.
         * 2. Generar sentencia insert con esos datos.
         * 2.1. Imprimir por pantalla antes de insertar.
         * 2.2. Ejecutar esa sentencia SQL.
         */
        # Formato de query: INSERT INTO tabla (campo1, etc) VALUES (val1, etc);
        $query = "INSERT INTO relojes (".implode(",",array_keys($datos)).", precio_id) VALUES ('".implode("','",array_values($datos))."', 2)";

        # Conectar a la base de datos, ejecutar y desconectar.
        $db = Database::conectar();
        $db->exec($query);
        $db = Database::desconectar();
    }

    public function updateById($id)
    {
        /**
         * 1. Conectar a la base de datos.
         * 2. Construir la query para actualizar datos
         * 3. Ejecutar la query
         * 4. Desconectar de la base de datos
         */
        $query ="UPDATE relojes SET";
        /**
         * Comprobamos valores getXX de id, nombre, marca, precio_id
         * Si hay contenido, concateno.
         * Si no hay contenido, no hago nada
         */
       
        # $datos contiene un array con todos los datos existentes para actualizar
        $datos = array(); 
        // $datos['nombre'] = 'hola';
        // $datos['precio_id'] = 2;
        if($this->getnombre() != null){
            $datos['nombre'] = $this->getnombre();
        }
        if($this->getmarca() != null){
            $datos['marca'] = $this->getmarca();
        }
        if($this->getprecio() != null){
            $datos['precio'] = $this->getprecio();
        }
        
        # Recorrer los elementos de $datos
        $keys = array_keys($datos);
        // var_dump($datos);
        // var_dump($keys);
        
        foreach ($datos as $key => $value) {
            # estoy en el ultimo caso. NO PONGO COMA AL FINAL
            if($key === end($keys)){
                $query = $query . " $key = '$value'";
                var_dump('ULTIMO CASO: '. $query);
            }else{
                # Estoy en un caso normal. PONGO COMA AL FINAL
                $query = $query . " $key = '$value', ";
                var_dump('CASO NORMAL: '. $query);
            }
        }
        $numero = $id['id'];
        $query = $query." WHERE id = $numero ";
        
        $db = Database::conectar();
        $resultado = $db->exec($query);

        if($resultado == 1){
            $_SESSION['mensaje'] = 'Actualizado correctamente';
        }else{
            $_SESSION['mensaje'] = 'Error al actualizar. MIRAR MODELO';
        }
        $db = Database::desconectar();
    }

    public function destroyById($id) : void
    {
        /**
         * 1. Conectar a la base de datos
         * 2. Realizar la query correspondiente.
         * 3. Desconectar de la base de datos.
         */
        $numero = $_GET['id'];
        $db = Database::conectar();
        $query = "DELETE FROM relojes WHERE id = $numero;";
        $db->exec($query);
        $db = Database::desconectar();
    }
}

?>