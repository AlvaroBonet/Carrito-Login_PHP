<?php


function controllers_autoload($class){
    require_once 'controller/'. $class .'.php';
}

spl_autoload_register('controllers_autoload');
?>