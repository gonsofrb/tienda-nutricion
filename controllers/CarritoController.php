<?php
require_once 'models/producto.php';
class CarritoController{

            //Index del carrito
    public function index(){
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
            $carrito = $_SESSION['carrito'];
        }else{
            $carrito = array();
        }
           
       
        require_once 'views/carrito/index.php';



    }


   //Método para ir añadiendo productos al carrito de la compra
    public function add(){
        
        $exits = 0;
        $position = 0;
            if(isset($_GET['id'])){
                $producto_id = $_GET['id'];
            }else{
                header("Location:".base_url);
            }

            if(isset($_SESSION['carrito'])){

            
                foreach($_SESSION['carrito'] as $indice => $elemento){

                    
                    if($elemento['id_producto'] == $producto_id){
                        $exits++;
                        $position = $indice;
                    }

                }

            }

            if(!isset($exits) || $exits == 0){
                //Conseguir producto

                    $producto = new Producto();
                    $producto->setId($producto_id);
                    $producto = $producto->getOne();
                        
                    //Añadir al carrito
                if(is_object($producto)){

                    $_SESSION['carrito'] [] = array(
                        "id_producto" => $producto->id,
                        "precio" => $producto->precio,
                        "unidades"=>1,
                        "producto"=> $producto


                        );
                    }
                
            }else{
                $_SESSION['carrito'][$position]['unidades']++;
            }   
        header("Location:".base_url."carrito/index");
    }



    //Método para ir añadiendo unidades de un producto al carrito de la compra
    public function up(){
        if($_GET['index'] >= 0){
            $index = $_GET['index'];
           
            $unidades = $_SESSION['carrito'][$index]['unidades']++;
          
            //Comprueba que el producto tenga stock
           /* 
            $producto_id = $_GET['id'];
           
            $producto = new Producto();
            $producto->setId($producto_id);
            if($producto->getStock()-$unidades>0){
                
                $unidades++;
            }else{
                return "No hay stock suficiente";
            }
            */
        
        }

        header("Location:".base_url."carrito/index");
    }


    //Método para ir reduciendo unidades de un producto del carrito de la compra.
    //Si al ir restando unidades, llegamos a 0 unidades, se vacia el carrito.
    public function down(){
        if($_GET['index'] >= 0){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if($_SESSION['carrito'][$index]['unidades'] == 0){
                unset($_SESSION['carrito'][$index]);
            }
        }

        header("Location:".base_url."carrito/index");
    }


        //Método para borrar un producto del carrito de la compra.
    public function delete(){
        if($_GET['index'] >= 0){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }

        header("Location:".base_url."carrito/index");
    }

    
    //Método para vaciar el carrito de la compra.
    public function delete_all(){

        unset($_SESSION['carrito']);

        header("Location:".base_url."carrito/index");
    }      




}





