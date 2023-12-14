<?php
    /**
     * Esta clase se encarga de la conexion a la base de datos.
     * 
     * 1. funcion conectar(): realizar una conexion a la base de datos. 
     * 2. funcion desconectar() : realiza la desconexion a la base de datos.
     * 
     * - ¿De que forma realizamos la configuracion de la conexion a la base de datos?
     *  + nombre base de datos
     *  + ubicacion de la BD
     *  + puerto de la DB
     *  + usuario
     *  + password
     */

     class Database {

        /**
         * Realiza la conexion a la base de datos
         */
        public static function conectar() : PDO{
            $db = new \PDO('sqlite:db/db.sqlite', '', '', array(
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
             ));
              //self::iniciarTablas($db);
             return $db;
        }

        /**
         * Realiza la desconexion a la base de datos
         */
        public static function desconectar(){
            return null;
        }

        /**
         * Funcion de prueba para iniciar una tabla con contenido.
         */
        public static function iniciarTablas($db) : void{
            // $delete = "
            //     DROP TABLE IF EXISTS users;
                
            // ";
            // $db->exec($delete);

            $delete = "
            DROP TABLE IF EXISTS juegos;
            
        ";

        $db->exec($delete);
        $delete = "
            DROP TABLE IF EXISTS rol;
            
        ";

            $db->exec($delete);

            $query = "
                CREATE TABLE IF NOT EXISTS users(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    email TEXT,
                    password TEXT,
                    rol_id INTEGER
                )
            ";

            $db->exec($query);

            $query = "
                CREATE TABLE IF NOT EXISTS rol(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT
                )
            ";

            $db->exec($query);

            $query = "
                INSERT INTO rol (nombre) VALUES ('admin'),('usuario');
            ";

            $db->exec($query);

            $delete = "
            DROP TABLE IF EXISTS relojes;
            
        ";

            $db->exec($delete);

            $query = "
            CREATE TABLE IF NOT EXISTS relojes(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT,
                marca TEXT, 
                precio INTEGER
            )
        ";

            $db->exec($query);

            $query = "
            INSERT INTO relojes (nombre, marca, precio) VALUES
            ('Submariner', 'Rolex', 10000),
            ('Speedmaster', 'Omega', 8500),
            ('Royal Oak', 'Audemars Piguet', 12000),
            ('Nautilus', 'Patek Philippe', 15000),
            ('Navitimer', 'Breitling', 9000),
            ('Tank', 'Cartier', 8000),
            ('Presidential', 'Rolex', 18000),
            ('Portugieser', 'IWC Schaffhausen', 11000),
            ('Big Bang', 'Hublot', 13000),
            ('Luminor', 'Panerai', 9500),
            ('Seamaster', 'Omega', 8500),
            ('Datejust', 'Rolex', 12000),
            ('Carrera', 'TAG Heuer', 9000),
            ('Master Control', 'Jaeger-LeCoultre', 14000),
            ('Constellation', 'Omega', 8000),
            ('Reverso', 'Jaeger-LeCoultre', 12500),
            ('Aquaracer', 'TAG Heuer', 9500),
            ('Fifty Fathoms', 'Blancpain', 16000),
            ('Master Ultra Thin', 'Jaeger-LeCoultre', 13500),
            ('Big Crown', 'Oris', 7500);
        
        ";

            $db->exec($query);
           
        }

        /*public static function delete($db, $id) : int{
            $query = "
                DELETE FROM users WHERE id = $id;
            ";

            $filas = $db->exec($query);
            return $filas;
        }

        public static function insert($db, $nombre, $email, $edad) : void{
            $query = "
                INSERT INTO users (nombre, email, edad) VALUES 
                ('$nombre', '$email', $edad);
            ";

            $db->exec($query);
        }

        public static function select($db) : PDOStatement{
            $query = "
                SELECT * FROM users;
            ";

            $result = $db->query($query);
            return $result;
        }*/
     }
?>
