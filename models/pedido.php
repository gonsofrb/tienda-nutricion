<?php

class Pedido{

   
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
   
    private $db;

    function getId(){
        return $this->id;
    }

    function getUsuario_id(){
        return $this->usuario_id;   
    }

    function getProvincia(){
        return $this->provincia;   
    }

    function getLocalidad(){
        return $this->localidad;   
    }

    function getDireccion(){
        return $this->direccion;   
    }
    
    function getCoste(){
        return $this->coste;
        
    }

    function getEstado(){
        return $this->estado;   
    }
    
    function getFecha(){
        return $this->fecha;   
    }

    function getHora(){
        return $this->hora;   
    }
    

    function setId($id){
        $this->id = $id;
    }
    function setUsuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
    }

    function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function setLocalidad($localidad){
        $this->localidad =  $this->db->real_escape_string($localidad);
    }

    function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste){
        $this->coste = $coste;
    }

    function setEstado($estado){
        $this->estado = $estado;
    }

    function setFecha($fecha){
        $this->fecha = $fecha;
    }

    function setHora($hora){
        $this->hora = $hora;
    }
   
    public function __construct(){
            $this->db= Database::connect();
        }

      //Obtener todos los pedidos
    public function getAll()
    {

        $pedido = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $pedido;
    }   
       


        //Obtener un pedido 
        //Recibe id
        //Devuelve el objeto pedido
    public function getOne(){

         $pedido = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");

        
        return $pedido->fetch_object();
    }


    //Obtener un pedido por un usuario determinado
    public function getOneByUser(){
        $sql = "SELECT p.id, p.coste FROM pedidos p "
                //. "INNER JOIN lineas_pedidos lp ON p.id = lp.pedido_id "
                . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";

        $pedido = $this->db->query($sql);

     
      //echo $this->db->error;
     
       return $pedido->fetch_object();
      
   }

   //Sacar todos los pedidos por usuario
   public function getAllByUser(){
    $sql = "SELECT p.* FROM pedidos p "
            //. "INNER JOIN lineas_pedidos lp ON p.id = lp.pedido_id "
            . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";

    $pedido = $this->db->query($sql);

 
  //echo $this->db->error;
 
   return $pedido;
  
}

        //Devolver productos en base a un id de pedido.
        //Recibe el id del pedido
    public function getProductoByPedido($id){
       // $sql = "SELECT * FROM productos WHERE id IN " 
         //       . "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";

        $sql = "SELECT pr.*,lp.unidades FROM productos pr " 
                . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id " 
                . "WHERE lp.pedido_id={$id}";  

        $productos = $this->db->query($sql);
       
        return $productos;
        

   }


            //Método para guardar un pedido en la base de datos.
    public function save()
    {
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuario_id()},'{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);

        //  echo $sql;
        //  echo "<br/>";
        // echo $this->db->error;
        // die();

        $result = false;

        if($save) {
            $result = true;
        }
        return $result;
    }
       
                //Relaciona producto con pedido
               
     public function save_linea(){
                    
         //$sql = "SELECT LAST_INSERT_ID() as 'pedido' ;";//Devuelve id del ultimo pedido
        $sql = "SELECT * FROM pedidos ORDER BY id DESC LIMIT 1;";
        $query = $this->db->query($sql);

        $pedido_id = $query->fetch_object()->id;

        $cast_pedido_id = (int)$pedido_id;
        
        //var_dump($cast_pedido_id);
        
         //Insertamos productos y cantidad de productos
         foreach($_SESSION['carrito'] as  $indice =>$elemento){
            
            $producto = $elemento['producto'];
            $product_id = (int)$producto->id;
        
            $insert = "INSERT INTO lineas_pedidos VALUES(null , $cast_pedido_id, $product_id, {$elemento['unidades']});";
            $save = $this->db->query($insert);
           
            //Llamada al método updateStock, el cual le pasamos el id del producto y las unidades y va modificando el stock.
            $this->updateStock($producto->id, $elemento['unidades']);
           // echo $this->db->error;
           // die();
        }  


        $result = false;
        if($save){
            $result = true;
        }
        return $result;
     }         
        //Metodo para actualizar el stock 
        //Recibe el id del producto y el número de unidades a descontar
     public function updateStock($id, $unidades){
        
        $sql = "SELECT stock FROM productos WHERE id = $id";
        $query= $this->db->query($sql);
        $register = $query->fetch_object()->stock;
        $newStock = 0;

        if($register){
            $newStock = $register-$unidades;
            $sql = "UPDATE productos SET stock = $newStock WHERE id = $id";
            $this->db->query($sql);
        }
     }


     //Actualizar un pedido en concreto
     //Recibe el id del pedido 
     public function edit()
    {
        $sql = "UPDATE  pedidos SET estado = '{$this->getEstado()}' ";

        $sql .= " WHERE  id={$this->getId()};";
            // echo $sql;
            //echo "<br/>";
            // echo $this->db->error;
            // die();

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



}

?>