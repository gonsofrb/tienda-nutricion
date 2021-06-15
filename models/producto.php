<?php

class Producto
{

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }
    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
    }
    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
    }
    public function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
        //Método para obtener todos los productos de la base de datos
    public function getAll()
    {

        $productos = $this->db->query("SELECT * FROM productos  ORDER BY id DESC");
        return $productos;
    }

        //Método para obtener todos los productos de una categoria especifica
    public function getAllCategory()
    {
        $sql = "SELECT p.*, c.nombre  AS 'catnombre' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoria_id()} "
                .  "ORDER BY id DESC";

        $productos = $this->db->query($sql);
       // var_dump($productos);
       // die();
        return $productos;
    }


        //Obtener un producto determinado.
        //Recibe id
        //Devuelve el objeto producto
    public function getOne(){

         $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");

        //Hacemos el fetcht_object para tener acceso a todas las propiedades.
        return $producto->fetch_object();
    }

    //Obtener los productos de forma aleatoria y con un limite pasado por parametro
    //Retorna los productos.
    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");

       
        return $productos;
    }
            //Guardar un producto
    public function save()
    {
        $sql = "INSERT INTO productos VALUES(NULL, '{$this->getCategoria_id()}','{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}');";
        $save = $this->db->query($sql);

        //  echo $sql;
        //  echo "<br/>";
        // echo $this->db->error;
        // die();

        $result = false;

        if ($save) {
            $result = true;
        }
        return $result;
    }
        //Editar un producto en concreto .
    public function edit()
    {
        $sql = "UPDATE  productos SET categoria_id = {$this->getCategoria_id()}, nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()}, stock =  {$this->getStock()}";
        
        if($this->getImagen() != null){
             $sql .=",imagen ='{$this->getImagen()}'";

           }     

             $sql .=" WHERE  id={$this->getId()};";

         //    echo $sql;
         //    echo "<br/>";
           //  echo $this->db->error;
           //  die();

        $save = $this->db->query($sql);

        //  echo $sql;
        //  echo "<br/>";
        // echo $this->db->error;
        // die();

        $result = false;

        if ($save) {
            $result = true;
        }
        return $result;
    }
                //Método para borrar un producto , pasando el id del producto que queremos borrar
    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        $delete = $this->db->query($sql);
        $result = false;

        if ($delete) {
            $result = true;
        }
        return $result;
    }

}
