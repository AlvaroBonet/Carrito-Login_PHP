<?php
    require_once 'controller/Controller.php';
    require_once 'model/Rol.php';
 class RelojController implements Controller{
    
    # Funcion abstracta index que muestra todos los elementos (tabla)
    public static function index(){
        # Caso de administrador
        if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 1){
            $reloj = new Relojes();
            $relojes = $reloj->findAll()->fetchAll();
            include 'views/private/dashboard-admin.php';
            if(isset($_SESSION['mensaje'])) {
                unset($_SESSION['mensaje']);
            }
        }
        # Caso usuario 
        else if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 2){
            $_SESSION['mensaje'] = "No tienes permisos para realizar la operacion";
            header('Location: home');
        }
        else{
            $_SESSION['mensaje'] = "No has iniciado sesion.";
            header('Location: login');
        }
    }

    # Funcion abstracta create que muestra un formulario para agregar un elemento
    public static function create(){
        # Caso de administrador
        if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 1){
            $reloj = new Reloj();
            $relojes = $reloj->findAll()->fetchAll();
            include 'views/private/relojes/create.php';
        }
        # Caso usuario 
        else if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 2){
            $_SESSION['mensaje'] = "No tienes permisos para realizar la operacion";
            header('Location: home');
        }
        else{
            $_SESSION['mensaje'] = "No has iniciado sesion.";
            header('Location: login');
        }
    }

    # Funcion abstracta save que inserta en la BD los elementos recogidos del formulario
    public static function save(){
        # Caso de administrador
        if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 1){
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]);
            
            $user = new User();
            $datos = array(
                'email' => $email,
                'password' => $password,
                'rol_id' => $_POST['rol_id']
            );

            $user->store($datos);

            header('Location: index-user');

        }
        # Caso usuario 
        else if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 2){
            $_SESSION['mensaje'] = "No tienes permisos para realizar la operacion";
            header('Location: home');
        }
        else{
            $_SESSION['mensaje'] = "No has iniciado sesion.";
            header('Location: login');
        }
    }

    # Funcion abstracta edit que recibe un $id de un elemento y muestra un formulario con su datos
    public static function edit($id){
        # Caso de administrador
        if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 1){
            # Compruebo si existe la variable id dentro de los parametros que recibo (que pueden ser varios)
            /*var_dump($id);
            exit();*/
            if(isset($id['id'])){
                $reloj = new Relojes();
                $relojes = $reloj->findById($id['id'])->fetch();
                include 'views/private/relojes/edit.php';
            }
        }
    }

    # Funcion abstracta update que recibe un $id de un elemento y actualiza su contenido
    public static function update($id){
        # Caso de administrador
        if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 1){
            $reloj = new Relojes();
            $reloj ->setNombre($_POST['nombre']);
            $reloj ->setMarca($_POST['marca']);
            $reloj ->setPrecio($_POST['precio']);
            $reloj->updateById($id);

            header("location: dashboard");

        }
        # Caso usuario 
        else if(isset($_SESSION['user']) && $_SESSION['user']['rol_id'] == 2){
            $_SESSION['mensaje'] = "No tienes permisos para realizar la operacion";
            header('Location: home');
        }
        else{
            $_SESSION['mensaje'] = "No has iniciado sesion.";
            header('Location: login');
        }
    }

    # Function abstracta destroy que recibe un $id de un elemento y lo elimina de la BD
    public static function destroy($id){
        # Caso de administrador{          
            $numero = $_GET['id'];
            $reloj = new Relojes();
            $reloj->destroyById($id);
            header("Location: dashboard");
    }

 }

?>