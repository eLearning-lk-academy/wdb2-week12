<?php 

function autoload() {
    $files = scandir('../app/controllers');

    foreach ($files as $file) {
        if ($file != '.'&& $file != '..') {
            include '../app/controllers/' . $file;
        }
    }
    
}
autoload();
