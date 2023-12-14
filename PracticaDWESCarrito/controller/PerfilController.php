<?php
require_once 'model/User.php';
class PerfilController {

    /**
     * Funcion para ir a la vista de edicion del perfil de usuario.
     * Debe consultar el usuario logueado en $_SESSION para identificar cual utilizar
     */
    public static function edit(){
        /**
         * 1. Recoger id de la $_SESSION
         * 2. Ir al modelo para recoger el objeto entero del usuario.
         * 3. Ir a la vista con los datos rellenos.
         * 
         * NOTA: en este caso el perfil unicamente cambiaria el password, por lo que no
         * es necesario llevar nada a la vista. En otros casos, seria necesario puesto
         * que hay mas datos en la tabla users.
         */
        include 'views/private/perfil/edit.php';
        if(isset($_SESSION['mensaje'])) {
            unset($_SESSION['mensaje']);
        }
    }

    /**
     * Funcion para acutalizar el perfil de usuario.
     * No utilizamos parametros puesto que recogemos el id de la $_SESSION
     */
    public static function update(){
        /**
         * 1. Recojo el $_POST de la vista edit
         * 2. Identifico a que registro de la base de datos actualizo.
         * Si existe parametro, sera un id. En este caso no uso parametro puesto
         * que el id viene de la $_SESSION.
         * 3. Invocar la funcion update del modelo.
         * 4. Redirigir.
         */
        
        # Comprobar si la contraseña introducida es correcta. En caso afirmativo, continuar operacion.
        if(password_verify($_POST['old-password'], $_SESSION['user']['password'])){
            # Comprobar que la contraseña nueva es correcta, es decir, que esta igual en ambos campos
            if($_POST['new-password'] === $_POST['password-verify']){
                # OPCIONAL. Poder plantear comprobacion de si old-pasword y new-password son el mismo

                # EN ESTE PUNTO SE CAMBIA EL PASSWORD DE LA BASE DE DATOS
                # Antes de invocar UPDATE debo saber que elementos le envio
                $user = new User();
                $user->setPassword(password_hash($_POST['new-password'], PASSWORD_BCRYPT, ['cont' => 4]));
                $user->updateById($_SESSION['user']['id']);
            }else{
                $_SESSION['mensaje'] = 'Contraseña nueva NO coincide';
            }
        }else{
            $_SESSION['mensaje'] = 'Contraseña antigua NO coincide. NO PROBAMOS MAS';
        }
        
         header('Location: edit-perfil');
    }

    /**
     * Funcion que elimina una cuenta de usuario.
     * Se debe (este caso) eliminar el registro de la base de datos
     */
    public static function destroy(){
        /**
         * 1. Recoger el id (o bien del href de la etiqueta <a> o bien de la $_SESSION).
         * 2. En caso de tener asociadas cosas en la $_SESSION, se deben eliminar.
         * 3. Eliminar usuario logueado de la $_SESSION.
         * 4. Eliminar registro usuario de la base de datos.
         * 5. Cerrar la session con session_destroy().
         * 6. Redirigir.
         */
        if(isset($_SESSION['user'])){
            $id = $_SESSION['user']['id'];
            unset($_SESSION['user']);
            # Eliminar todo lo que tenga que ver con el $id como campo user_id
            $user = new User();
            $user->setId($id); # Esto no hace nada puesto que destrotById recibe ya un parametro (ERROR???)
            $user->destroyById($id);
            session_destroy();
            $_SESSION['mensaje'] = 'Cuenta eliminada correctamente';
        }
        header('Location: login');
    }
}

?>