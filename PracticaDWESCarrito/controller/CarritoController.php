<?php
    class CarritoController {

        public static function index(){
            include 'views/carrito/index.php';
        }
    
        public static function agregarProducto($producto) {
    
            if (!isset($_SESSION['carritos'][$_SESSION['user']['id']])) {
                $_SESSION['carritos'][$_SESSION['user']['id']] = [];
            }
    
            $producto = [
                'id' => $_POST['id'],
                'nombre' => $_POST['nombre'],
                'precio' => $_POST['precio'],
                'cantidad' => $_POST['cantidad'],
            ];
    
            $existe = false;
    
            foreach ($_SESSION['carritos'][$_SESSION['user']['id']] as $id => $reloj) {
                if ($reloj['id'] === $producto['id']) {
                    $_SESSION['carritos'][$_SESSION['user']['id']][$id]['cantidad'] += $producto['cantidad'];
                    $existe = true;
                    break;
                }
            }
    
            if (!$existe) {
                $_SESSION['carritos'][$_SESSION['user']['id']][] = $producto;
            }
    
            header('Location: index-carrito'); 
        }
    
        public static function eliminarDelCarrito() {
            session_start();
    
            if (isset($_SESSION['carritos'][$_SESSION['user']['id']])) {
                foreach ($_SESSION['carritos'][$_SESSION['user']['id']] as $indice => $producto) {
                    if ($producto['id'] === $_GET['id']) {
                        unset($_SESSION['carritos'][$_SESSION['user']['id']][$indice]);
                        break;
                    }
                }
            }
    
            header('Location: index-carrito'); 
        }
    
        public static function obtenerCarrito() {
            session_start();
    
            if (isset($_SESSION['carritos'][$_SESSION['user']['id']])) {
                return $_SESSION['carritos'][$_SESSION['user']['id']];
            } else {
                return [];
            }
        }
    }
    
?>