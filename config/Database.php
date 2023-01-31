<?php

class Database{
    public static function connect(){
        $db=new mysqli('localhost','root','','actividad5');
        return $db;
    }
}