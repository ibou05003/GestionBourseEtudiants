<?php
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    public static function autoload($class_name)
    {
        if (file_exists($class_name . '.class.php')) {
            require_once $class_name . '.class.php';
        } elseif (file_exists('class/' . $class_name . '.class.php')) {
            require_once 'class/' . $class_name . '.class.php';
        } else {
            require_once '../class/' . $class_name . '.class.php';
        }

    }
}
