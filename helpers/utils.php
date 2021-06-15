<?php
//Creamos la clase Utils que luego usaremos con métodos estáticos para no tener que crear el objeto cadaz que queramos hacer uso de ellos
class Utils{

        //Creamos un método estátitco para borrar una sesion que le pasaremos por parámetro
    public static function deleteSession($name){
        
        //Comprobamos si existe la sesion
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;

            //Borramos la sesion finalmente
            unset($_SESSION[$name]);
        }
        //Devolvemos el nombre de la sesión borrada
        return $name;
        
    }


    //Creación de un método estático para asignarselo a acción en los controladores y en el caso que la persona que desee utilizar esa acción no sea admin, la rediriga al index y no pueda hacer usos de ninguna acción.
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            
            header("Location:".base_url);

        }else{
            return true;
        }
    }


    //Creación de un método para retringir el acceso a cualquier persona que no esté registrada en el sistema y por lo tanto no pueda hacer uso de ninguna acción.
    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            
            header("Location:".base_url);

        }else{
            return true;
        }
    }

    //Creación de un método que muestre todas las categorías que hay en la base de datos.
    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        return $categorias;
    }


        //Creación de método que muestre las estadísticas del carrito de compra.
        public static function statsCarrito(){
            $stats = array(
                'count' => 0,
                'total' => 0
            );
            if(isset($_SESSION['carrito'])){
                $stats['count'] = count($_SESSION['carrito']);


                foreach($_SESSION['carrito'] as  $producto){
                            $stats['total'] += $producto['precio'] * $producto['unidades'];
                }
            }
            return $stats;
        }



        
        public static function showStatus($status){
            $value = 'Pendiente';
            if($status == 'confirm'){
                $value = 'Pendiente';
            }elseif($status == 'preparation' ){
                $value = 'En Preparación';
            }elseif($status == 'ready'){
                $value = 'Preparado para enviar';
            }elseif($status == 'sended'){
                $value = 'Enviado';
            }
            return $value;
        }




   //     public static function redireccion($url){

     //      echo "<script>window.location.href=$url</script>";
           
       // }
}




?>