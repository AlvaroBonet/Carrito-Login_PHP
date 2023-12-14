<?php
require_once 'model/User.php';
require_once 'model/Relojes.php';

class AuthController{

    /**
     * Funcion que me lleva a la vista de login
     */
    public static function login(){
        include 'views/auth/login.php';
        if(isset($_SESSION['mensaje'])) {
            unset($_SESSION['mensaje']);
        }
    }

    /**
     * Funcin que me lleva a la vista del register
     */
    public static function register(){
        include 'views/auth/register.php';
        if(isset($_SESSION['mensaje'])) {
            unset($_SESSION['mensaje']);
        }
    }

    /**
     * Funcion que me lleva a la vista del usuario
     */
    public static function home(){
        # Comprobar si existe $_SESSION['user'] implica haber iniciado sesion
        # Comprobar si el rol_id es 2 implica iniciar sesion como usuario
        if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 2){
            include 'views/private/dashboard-user.php';
        }else if(!isset($_SESSION['user'])){
            header('Location: login');
        }
    }

    /**
     * Funcion que me lleva a la vista del admin
     */
    public static function dashboard(){
        # Comprobar si existe $_SESSION['user'] implica haber iniciado sesion
        # Comprobar si el rol_id es 2 implica iniciar sesion como admin
        if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 1){
            include 'views/private/dashboard-admin.php';
        }else if(!isset($_SESSION['user'])){
            $_SESSION['mensaje'] = 'No tienes permisos para acceder';
            header('Location: login');
            if(isset($_SESSION['mensaje'])) {
                unset($_SESSION['mensaje']);
            }
        }
    }

    /**
     * Funcion que realiza el login
     */
    public static function doLogin(){
        /**
         * 1. Recoger elementos del formulario.
         * 2. Realizar una encriptacion o hasheo de la contraseña en el mismo formato que la de la base de datos.
         * 3. Crear un objeto del modelo User.
         * 4. Llevarle los datos al modelo User.
         * 5. Realizar llamada a la funcion que comprueba (password_verify) que las credenciales son correctas.
         * 5.1. Si es correcta, realizarmos inicio de sesion y guardamos en $_SESSION el usuario.
         * 5.2. Si no es correcta, retornamos a la vista login (header) mostrando el error.
         */

         $email = $_POST['email'];
         $password = $_POST['password'];

         # Utilizar password_verify para comprobar la contraseña ya hasheada
         $user = new User();
         $user_log = $user->findByEmail($email)->fetch();
         if (password_verify($password, $user_log['password'])) {
            # Guardamos los datos del registro del usuario que ha iniciado sesion.
            $_SESSION['user'] = $user_log;
            switch ($user_log['rol_id']) {
                case 1:
                     # Eres usuario administrador
                    header('Location: dashboard');
                    break;
                case 2:
                    # Eres usuario normal
                    header('Location: home');
                    break;
                default:
                    # En este caso no debería entrar nunca (teoricamente)
                    header('Location: login');
                    break;
            }
        } else {
            $_SESSION['mensaje'] = 'Error de credenciales. No son correctas';
            header('Location: login');
        }
    }

    /**
     * Funcion que realiza el registro de un usuario
     */
    public static function doRegister(){
        /**
         * 1. Recoger elementos del formulario.
         * 2. Encriptar o hashear la contraseña.
         * 3. Crear un objeto del modelo User.
         * 4. Llevarle los datos al modelo User.
         * 5. Realizar llamada a la funcion que registra o inserta usuario (save).
         */
        if($_POST['password'] === $_POST['password-verify']){
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]);
            
            $user = new User();
            $datos = array(
                'email' => $email,
                'password' => $password
            );
            $user->store($datos);
            # ¿Que pasa si store no se ejecuta correctamente y no muestra error?

            header('Location: login');
        }else{
            $_SESSION['mensaje'] = 'No coinciden';
            header('Location: register');
            if(isset($_SESSION['mensaje'])) {
                unset($_SESSION['mensaje']);
            }
        }
    }

    /**
     * Funcion que realiza el cierre de sesion
     */
    public static function logout(){
        /**
         * 1. ¿Esta iniciada la sesion?
         * 1.1 En caso afirmativo, cerrarla.
         * 1.2 En caso negativo, dirigir al login
         */

        if(session_id()){
            unset($_SESSION['user']);
        }
        header('Location: login');
    }
}

?>