<?php

class Proyecto{
    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this->db=Database::connect();
    }

    public function setId($id){
        $this->id=$id;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getAll(){

        $proyectos=$this->db->query("SELECT * FROM proyecto ORDER BY id DESC;");

        return $proyectos;
    }


    public function save(){
        //Creamos la consulta SQL
        $sql="INSERT INTO actividad5.proyecto VALUES(null,'{$this->getNombre()}'); ";
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
        $sql="SELECT * FROM proyecto WHERE id='{$this->getId()}'";
        $proyecto=$this->db->query($sql);
        return $proyecto->fetch_object();
    }

    public function edit(){
        $sql="UPDATE proyecto SET nombre='{$this->getNombre()}' WHERE id='{$this->getId()}'";

        $save=$this->db->query($sql);
        $result=false;

        if($save){
            $result=true;
        }
        return $result;
    }

    public function eliminar(){
        $sql="DELETE FROM proyecto WHERE id='{$this->getId()}' ";

        $save=$this->db->query($sql);
        $result=false;

        if($save){
            $result=true;
        }
        return $result;
    }



}//fin clase