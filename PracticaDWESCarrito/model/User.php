<?php

require_once 'db/Database.php';
require_once 'model/Model.php';


class User implements Model
{
    private $id;
    private $email;
    private $password;
    private $rol;
    


    public function __construct(){}

    public function getId() : int | null{
        return $this->id;
    }
    public function setId($id) : void{ 
        $this->id = $id;
    }

    public function getEmail() : string | null{
        return $this->email;
    }

    public function setEmail($email) : void{ 
        $this->email = $email;
    }

    public function getpassword() : string | null{
        return $this->password;
    }

    public function setPassword($password) : void{ 
        $this->password = $password;
    }

    public function getRol() : int | null{
        return $this->rol;
    }

    public function setRol($rol) : void{ 
        $this->rol = $rol;
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
        $query = "SELECT * FROM users";
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
        $query = "SELECT * FROM users WHERE id = $id";
        $db = Database::conectar();
        $user = $db->query($query);
        $db = Database::desconectar();
        return $user;
    }

    public function findByEmail($email) 
    {
        /**
         * 1. Recibir el id que necesitamos buscar.
         * 2. Realizar la query
         * 3. Retornoar el usuario
         */
        $query = "SELECT * FROM users WHERE email = '$email'";
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
        $query = "INSERT INTO users (".implode(",",array_keys($datos)).", rol_id) VALUES ('".implode("','",array_values($datos))."', 2)";

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
        $query ="UPDATE users SET";
        /**
         * Comprobamos valores getXX de id, email, password, rol_id
         * Si hay contenido, concateno.
         * Si no hay contenido, no hago nada
         */
       
        # $datos contiene un array con todos los datos existentes para actualizar
        $datos = array(); 
        // $datos['email'] = 'hola';
        // $datos['rol_id'] = 2;
        if($this->getEmail() != null){
            $datos['email'] = $this->getEmail();
        }
        if($this->getPassword() != null){
            $datos['password'] = $this->getPassword();
        }
        if($this->getRol() != null){
            $datos['rol_id'] = $this->getRol();
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
        // var_dump('CASO FINAL: '. $query);
        // exit();
        $query = $query." WHERE id = $id ";
        
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
        $db = Database::conectar();
        $query = "DELETE FROM users WHERE id = $id";
        $db->exec($query);
        $db = Database::desconectar();
    }
}

?>