<?php

class Utils{

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name]=null;
        }

        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location: index.php");
        }else{
            return true;
        }
    }

    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function showStatus($status){

        $value='Pendiente';

        if($status==1){
            $value;
        }elseif ($status==2){
            $value='En progreso';
        }elseif ($status==3){
            $value='Finalizada';
        }
        return $value;

    }



}