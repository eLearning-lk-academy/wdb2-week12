<?php

class Autoloader
{
    public static function autoload($className)
    {
        $file = __DIR__ .'/../app/controllers/' . $className . '.php';

        if (file_exists($file)){
            include $file;
        }else{

            foreach(glob(__DIR__ .'/../app/controllers/*', GLOB_ONLYDIR) as $dir) {
                $file = $dir.'/' . $className . '.php';
               
                if (file_exists($file)){
                    break;
                }
            }
            if (file_exists($file)){
                include $file;
            }else{

                $file = __DIR__ .'/../app/models/'. $className .'.php';
                include $file;
            }
        }
    }
}

spl_autoload_register('Autoloader::autoload');
