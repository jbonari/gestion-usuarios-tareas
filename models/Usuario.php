<?php

class Usuario{
    private $id;
    private $nombre;
    private $password;
    private $tipoUsuario;
    private $db;

    //Método constructor
    public function __construct(){
        $this->db=Database::connect();
    }

    //Métodos Setters

    public function setId($id){
        $this->id=$id;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function setPassword($password){
        $this->password =$password ;
    }

    public function setTipoUsuario($tipoUsuario){
        $this->tipoUsuario=$tipoUsuario;
    }

    //Métodos Getters
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPassword(){
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);
    }

    public function getTipoUsuario(){
        return $this->tipoUsuario;
    }

    /*save()
     * Nos permite guardar usuarios en la base de datos
     */
    public function save(){
        //Creamos la consulta SQL
        $sql="INSERT INTO actividad5.usuario VALUES(null,'{$this->getNombre()}','{$this->getPassword()}','{$this->getTipoUsuario()}'); ";
        $save=$this->db->query($sql);

        $resultado=false;
        //si se ejecuta la consulta, devolverá true
        if($save){
            $resultado=true;
        }
        return $resultado;
    }

    public function getOne(){
        //Consulta SQL
        $sql="SELECT * FROM usuario WHERE id='{$this->getId()}'";
        $usuario=$this->db->query($sql);
        return $usuario->fetch_object();
    }

    public function getAll(){

        $usuarios=$this->db->query("SELECT * FROM usuario ORDER BY id DESC;");

        return $usuarios;
    }

    /*login()
     * Comprueba la existencia del usuario en la base de datos
     */
    public function login(){
        $result=false;
        //Obtenemos los datos del usuario
        $nombre=$this->nombre;
        $password=$this->password;


        //consulta SQL
        $sql="SELECT * FROM usuario WHERE nombre='{$nombre}' ";
        $login=$this->db->query($sql);

        if($login->num_rows==1){
            //Si el número de rows que obtiene la consulta=1=>almacenará el resultado
            $usuario=$login->fetch_object();
            //var_dump($usuario);die();
            if($usuario->tipo_usuario==0){
                // Verificar la contraseña para un Admin sin cifrar
                if($password ==$usuario->password){
                    $verify=true;
                }
            }else{
                // Verificar la contraseña cifrada, para usuarios ordinarios
                $verify = password_verify($password, $usuario->password);

            }

            if($verify){
                //Si la comprobación es true, retorna el objeto
                $result=$usuario;
                return $result;
            }
        }


        return $result;
    }

    public function eliminar(){
        $sql="DELETE FROM usuario WHERE id='{$this->getId()}' ";

        $save=$this->db->query($sql);
        $result=false;

        if($save){
            $result=true;
        }
        return $result;
    }

    public function edit(){
        $sql="UPDATE usuario SET nombre='{$this->getNombre()}', password='{$this->getPassword()}' WHERE id={$this->getId()};";

        $save=$this->db->query($sql);
        $result=false;

        if($save){
            $result=true;
        }
        return $result;
    }




}//fin clase