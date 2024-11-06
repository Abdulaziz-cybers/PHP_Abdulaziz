<?php

class DB {
    public $pdo;
    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=Work_time", "root", "root");
    }
}