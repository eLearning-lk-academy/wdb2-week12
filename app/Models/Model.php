<?php

class Model{
    public $db;

    public function __construct(){
        require __DIR__.'/../../config/config.php';
        $this->db = new db($mysql);
    }
}