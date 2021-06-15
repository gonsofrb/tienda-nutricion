<?php

class Categoria{

    
    private $id;
    private $nombre;
    private $db;

    public function  __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }
    function getNombre(){
        return $this->nombre;
    }

    function setId($id){
        $this->id=$id;
    }
    function setNombre($nombre){
        $this->nombre= $this->db->real_escape_string($nombre);
    }

        //Obtener todas las categorias en orden descendente.
    public function getAll(){

        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC");
        return $categorias;
    }

    

        //Obtener una categoria pasada por id
        //Retorna la categoría pasada por id.
    public function getOne(){

    $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()}");
        return $categoria->fetch_object();
    }

    
        //Método para guardar una nueva categoría.
    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
        $save =  $this->db->query($sql);

        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }




}


?>