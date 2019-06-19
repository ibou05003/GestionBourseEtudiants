<?php
class Autoloader
{
    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'));
    }
    static function autoload($class_name){
        if(file_exists($class_name.'.class.php'))
            require_once $class_name.'.class.php';
        else
            require 'class/'.$class_name.'.class.php';
    }
}
?>