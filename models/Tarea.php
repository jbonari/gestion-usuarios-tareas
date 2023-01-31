<?php


class Tarea{
    private $id;
    private $userId;
    private $proyectoId;
    private $nombre;
    private $estado;
    private $db;

    public function __construct(){
        $this->db=Database::connect();
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id){
        $this->id = $id;
    }


    public function getUsuarioId(){
        return $this->userId;
    }


    public function setUsuarioId($userId){
        $this->userId = $userId;
    }


    public function getProyectoId(){

        return $this->proyectoId;
    }


    public function setProyectoId($proyectoId){
        $this->proyectoId = $proyectoId;
    }


    public function getNombre(){
        return $this->nombre;
    }


    public function setNombre($nombre){
        $this->nombre = $nombre;
    }


    public function getEstado(){
        return $this->estado;
    }


    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getAll(){

        $tareas=$this->db->query("SELECT t.id, u.nombre AS'usuario',p.nombre AS 'proyecto',t.nombre,t.estado
                                        FROM tarea t
                                        INNER JOIN usuario u on t.id_usuario = u.id
                                        INNER JOIN proyecto p on t.id_proyecto = p.id ORDER BY id DESC;");

        return $tareas;
    }

    public function getOne(){
        //consulta SQL
        $sql=("SELECT t.id, u.nombre AS'usuario',p.nombre AS 'proyecto',t.nombre,t.estado
                                        FROM tarea t
                                        INNER JOIN usuario u on t.id_usuario = u.id
                                        INNER JOIN proyecto p on t.id_proyecto = p.id WHERE t.id='{$this->getId()}';");

        $tarea=$this->db->query($sql);

        return $tarea->fetch_object();
    }

    public function getAllUsers(){
        //consulta sql
        $sql="SELECT * FROM usuario WHERE tipo_usuario!=0;";
        $usuarios=$this->db->query($sql);

        return $usuarios;
    }

    public function getAllProjects(){
        //consulta sql
        $sql="SELECT * FROM proyecto;";
        $proyectos=$this->db->query($sql);

        return $proyectos;
    }


    public function save(){
        //Creamos la consulta SQL
        $sql="INSERT INTO tarea VALUES(null,{$this->getUsuarioId()},{$this->getProyectoId()},'{$this->getNombre()}',{$this->getEstado()}); ";

        $save=$this->db->query($sql);

        $resultado=false;
        //si se ejecuta la consulta, devolverá true
        if($save){
            $resultado=true;
        }
        return $resultado;
    }


    //editar consulta
    public function updateStatus(){

        $sql="UPDATE tarea SET estado='{$this->getEstado()}' WHERE id={$this->getId()} ";

        $save= $this->db->query($sql);

        $result=false;

        if($save){
            $result=true;
        }

        return $result;


    }


    public function edit(){

        $sql="UPDATE tarea SET nombre='{$this->getNombre()}', id_usuario='{$this->getUsuarioId()}', id_proyecto='{$this->getProyectoId()}' WHERE id={$this->getId()};";

        $save=$this->db->query($sql);
        $result=false;

        if($save){
            $result=true;
        }
        return $result;
    }


    public function eliminar(){
        $sql="DELETE FROM tarea WHERE id='{$this->getId()}' ";

        $save=$this->db->query($sql);
        $result=false;

        if($save){
            $result=true;
        }
        return $result;
    }

    public function getAllByUser(){
        $sql="SELECT t.id, t.nombre as 'nombreTar',p.nombre as 'nombrePro',t.estado
                FROM tarea t 
                INNER JOIN proyecto p ON t.id_proyecto=p.id
                WHERE t.id_usuario={$this->getUsuarioId()} 
                ORDER BY id DESC;";



        $tareas=$this->db->query($sql);


        return $tareas;
    }






}//fin clase