<?php

require_once 'models/Categoria.php';

class ProyectoController{

    public function index(){
        echo "controlador proyecto, accion index";
    }

    public function alta(){
        Utils::isAdmin();
        require_once 'views/proyecto/alta.php';
    }

    public function gestion(){

        Utils::isAdmin();

        //creamos un obj de tipo producto
        $proyecto = new Proyecto();
        //accedemos al método getall y almacenamos el resultlist en producto
        $proyectos=$proyecto->getAll();

        require_once 'views/proyecto/gestion.php';

    }

    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $edit=true;

            $proyecto=new Proyecto();
            $proyecto->setId($id);
            $pro=$proyecto->getOne();

            require_once 'views/proyecto/alta.php';
        }else{
            header('Location:'.base_url.'proyecto/gestion');
        }


    }

    public function eliminar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $proyecto=new Proyecto();
            $proyecto->setId($id);
            $delete=$proyecto->eliminar();
            //var_dump($delete,$proyecto);die();


            if($delete) {
                $_SESSION['delete'] = 'completed';
            }else{
                $_SESSION['delete']='failed';
            }

        }else{
            $_SESSION['delete']="failed";
        }

        header('Location:'.base_url.'proyecto/gestion');
    }

    public function save(){
        Utils::isAdmin();

        if(isset($_POST)){

            $nombre= isset($_POST['nombre']) ? $_POST['nombre'] :false;

            if($nombre){
                $proyecto=new Proyecto();
                $proyecto->setNombre($nombre);


                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $proyecto->setId($id);
                    $save=$proyecto->edit();
                }else{
                    $save=$proyecto->save();
                }

                if($save){
                    $_SESSION['proyecto']='completed';
                }else{
                    $_SESSION['proyecto']='failed';
                }


            }else{
                $_SESSION['proyecto']='failed';
            }

        }else{
            $_SESSION['proyecto']='failed';
        }

        header('location:'.base_url.'proyecto/gestion');
    }







}//fin clase
