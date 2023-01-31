<?php

require_once 'models/Tarea.php';

class TareaController{

    public function gestion(){
        Utils::isAdmin();
        $gestion=true;

        //creamos un obj de tipo tarea
        $tarea = new Tarea();
        //accedemos al método getall y almacenamos el resultlist en producto
        $tareas=$tarea->getAll();

        require_once 'views/tarea/gestion.php';
    }

    public function alta(){
        Utils::isAdmin();

        //creamos un obj de tipo usuario para el select
        $usuario = new Tarea();
        //accedemos al método getallusers y almacenamos el resultlist en producto
        $usuarios=$usuario->getAllUsers();
        //Recuperamos todos los proyectos
        $proyecto=new Tarea();
        $proyectos=$proyecto->getAllProjects();


        require_once 'views/tarea/alta.php';
    }

    public function detalle(){
        Utils::isIdentity();

        if(isset($_GET['id'])){

            $id=$_GET['id'];

            //sacar datos de la tarea
            $tarea = new Tarea();
            $tarea->setId($id);
            $tarea=$tarea->getOne();



        }else{
            header('Location'.base_url.'tarea/mis_tareas');
        }

        require_once 'views/tarea/detalle.php';
    }

    public function editar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $edit=true;

            $tarea=new Tarea();
            $tarea->setId($id);
            $tar=$tarea->getOne();

            //Recuperamos los usuarios para el select
            $usuario = new Tarea();
            //accedemos al método getallusers y almacenamos el resultlist en usuarios
            $usuarios=$usuario->getAllUsers();
            //Recuperamos todos los proyectos
            $proyecto=new Tarea();
            $proyectos=$proyecto->getAllProjects();

            require_once 'views/tarea/alta.php';
        }else{
            header('Location:'.base_url.'tarea/gestion');
        }


    }


    public function save(){
        Utils::isAdmin();

        if(isset($_POST)){
            //almacenamos los datos del POST en variables, creamos un objeto y le pasamos como valor
            // los datos recogidos
            $nombre= isset($_POST['nombre']) ? $_POST['nombre'] :false;
            $id_usuario=isset($_POST['id_usuario']) ? $_POST['id_usuario'] :false;
            $id_proyecto=isset($_POST['id_proyecto']) ? $_POST['id_proyecto'] :false;

            if($nombre && $id_usuario && $id_proyecto){
                $tarea=new Tarea();
                $tarea->setNombre($nombre);
                $tarea->setUsuarioId($id_usuario);
                $tarea->setProyectoId($id_proyecto);
                $tarea->setEstado(1);


                if(isset($_GET['id'])){

                    $id=$_GET['id'];

                    $tarea->setId($id);
                    $save=$tarea->edit();
                }else{
                    $save=$tarea->save();
                }

                if($save){
                    //si se cumple, creamos una sesion
                    $_SESSION['tarea_alta']="completed";
                }else{
                    $_SESSION['tarea_alta']="failed";
                }
            }else{
                $_SESSION['tarea_alta']="failed";
            }

        }else{
            $_SESSION['tarea_alta']="failed";
        }
        header("Location:".base_url.'tarea/gestion');
    }

    public function eliminar(){
        Utils::isAdmin();

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $tarea = new Tarea();
            $tarea->setId($id);
            $delete = $tarea->eliminar();

            if ($delete) {
                $_SESSION['delete'] = 'completed';
            } else {
                $_SESSION['delete'] = "failed";
            }

        } else {
            $_SESSION['delete'] = "failed";
        }

        header('Location:'.base_url.'tarea/gestion');
    }

    public function mis_tareas(){
        Utils::isIdentity();
        $usuario_id=$_SESSION['identity']->id;
        $tarea=new Tarea();
        //sacar tareas del ususario
        $tarea->setUsuarioId($usuario_id);
        $tareas=$tarea->getAllByUser();

        require_once 'views/tarea/mis_tareas.php';
    }


    public function estado(){
        Utils::isAdmin();

        if(isset($_POST['tarea_id']) && isset($_POST['estado'])){
            //recoger datos del form
            $id=$_POST['tarea_id'];
            $estado=$_POST['estado'];
            //update de la tarea
            $tarea=new Tarea();
            $tarea->setId($id);
            $tarea->setEstado($estado);
            $tarea->updateStatus();

            header('Location:'.base_url.'tarea/detalle&id='.$id);
        }else{
            header('Location:'.base_url);
        }
    }





}//fin clase