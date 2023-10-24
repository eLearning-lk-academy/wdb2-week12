<?php

class Autoloader
{
    public static function autoload($className)
    {
        $file = __DIR__ .'/../app/controllers/' . $className . '.php';
        
        if (file_exists($file)){
            include $file;
        }
    }
}

spl_autoload_register('Autoloader::autoload');
