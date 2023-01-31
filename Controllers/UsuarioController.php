<?php
require_once 'models/Usuario.php';

class UsuarioController{

    public function index(){
        //renderizamos la vista
        require_once 'views/usuario/login.php';
    }

    public function registro(){
        //primero mostramos la vista
        require_once 'views/usuario/registro.php';
    }

    public function alta(){
        Utils::isAdmin();
        require_once 'views/usuario/alta.php';
    }

    public function gestion(){

        Utils::isAdmin();

        //creamos un obj de tipo producto
        $usuario = new Usuario();
        //accedemos al método getall y almacenamos el resultlist en producto
        $usuarios=$usuario->getAll();

        require_once 'views/usuario/gestion.php';

    }


    public function login(){
        //Consulta a la base de datos

        //insanciamos un objeto y le pasamos los valores recibidos por post
        if(isset($_POST)){
            $usuario=new Usuario();
            $usuario->setNombre($_POST['nombre']);
            $usuario->setPassword($_POST['password']);
            //usamos el método login
            $identity=$usuario->login();


            if($identity && is_object($identity)){

                //si identity es true y es un objeto, lo almacenamos en sesión
                $_SESSION['identity']=$identity;

                if($identity->tipo_usuario==0) {
                    //Almacenamos en session el valor de admin
                    $_SESSION['admin'] = true;
                }

            }else{
                //Si algo sale mal, almacenamos un error
                $_SESSION['error_login']='Identificación fallida';
            }

        }

        header("location:".base_url);
    }


    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
            session_destroy();
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
            session_destroy();
        }

        header("Location:".base_url);
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            //almacenamos los datos del POST en variables, creamos un objeto y le pasamos como valor
            // los datos recogidos
            $nombre= isset($_POST['nombre']) ? $_POST['nombre'] :false;
            $password=isset($_POST['password']) ? $_POST['password']: false;

            if($nombre && $password){
                $usuario=new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setPassword($password);
                $usuario->setTipoUsuario(1);

                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $usuario->setId($id);
                    $save=$usuario->edit();
                }else{
                    $save=$usuario->save();
                }

                if($save){
                    //si se cumple, creamos una sesion
                    $_SESSION['register']="completed";
                }else{
                    $_SESSION['register']="failed";
                }
            }else{
                $_SESSION['register']="failed";
            }

        }else{
            $_SESSION['register']="failed";
        }
        header("Location:".base_url.'usuario/gestion');
    }

    public function eliminar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $usuario=new Usuario();
            $usuario->setId($id);
            $delete=$usuario->eliminar();
            //var_dump($delete,$proyecto);die();


            if($delete) {
                $_SESSION['delete'] = 'completed';
            }else{
                $_SESSION['delete']='failed';
            }

        }else{
            $_SESSION['delete']="failed";
        }

        header('Location:'.base_url.'usuario/gestion');
    }

    public function editar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $edit=true;

            $usuario=new Usuario();
            $usuario->setId($id);
            $user=$usuario->getOne();

            require_once 'views/usuario/alta.php';
        }else{
            header('Location:'.base_url.'usuario/gestion');
        }

    }

    public function mis_tareas(){
        Utils::isIdentity();
        $usuario_id=$_SESSION['identity']->id;


    }




}