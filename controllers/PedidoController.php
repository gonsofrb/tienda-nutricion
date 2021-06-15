<?php
require_once 'models/pedido.php';
require_once 'models/usuario.php';
class PedidoController
{
        //Acción del controlador pedido que carga un formulario para hacer un pedido en una vista.
    public function hacer()
    {

        require_once 'views/pedido/hacer.php';

    }


    //Acción para añadir un pedido.
    public function add()
    {
                //Comprobación si hay una sesión de identity abierta para poder realizar el pedido.
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            // var_dump($usuario_id);
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
           
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if ($provincia && $localidad && $direccion) {
                
                //Guardar datos en bd
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
              
                $pedido->setCoste($coste);
                //var_dump($pedido);

                $save = $pedido->save();
             
                //Guardar linea pedido
                $save_linea = $pedido->save_linea();
               
                if ($save && $save_linea) {

                    $_SESSION['pedido'] = "complete";

                } else {

                    $_SESSION['pedido'] = "failed";
                }
            } else {
                $_SESSION['pedido'] = "failed";
            }

            header("Location:".base_url."pedido/confirmado");
        } else {
            //Redirigir a index
            header("Location:".base_url);
        }

    }

    //Acción para confirmar un pedido.
    public function confirmado()
    {

        if (isset($_SESSION['identity'])) {

            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);

            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductoByPedido($pedido->id);

        }

        if(isset($_SESSION['carrito'])){
                Utils::deleteSession('carrito');
        }

        //Vista donde se muestra los datos de un pedido confirmado.
        require_once 'views/pedido/confirmado.php';
    }


    //Acción para mostrar los pedidos que se han realizado.
    public function mis_pedidos(){

        //Método para restringir el acceso a toda persona que no esté registrada.
        Utils::isIdentity();

        $usuario_id = $_SESSION['identity']->id;    
        $pedido = new Pedido();

        //Sacar los pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();

        //Vista donde se muestran los pedidos de un usuario.
        require_once 'views/pedido/mis_pedidos.php';
    }


        //Obtener productos de un pedido de un usuario determinado
    public function detalles(){
        
        //Método para asegurarnos que no acceda ninguna persona que no esté logueada.
        Utils::isIdentity();


        if(isset($_GET['id'])){

            $id = $_GET['id'];

            //Sacar datos del pedido
            $pedido = new Pedido();
            $pedido->setId($id);

            $pedido = $pedido->getOne();
            
            //Datos del usuario del pedido
            $usuario = new Usuario();
            $usuario->setId($id);
            $user = $usuario->getDateUserPedido();
           
            //Sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductoByPedido($id);



            require_once 'views/pedido/detalle.php';

        }else{
            header("Location:".base_url.'pedido/mis_pedidos');
        }

        
    }
        //Obtener todos los pedidos
    public function gestion(){

        //Método para restringir el acceso a toda persona que no sea administrador
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();


        require_once 'views/pedido/mis_pedidos.php';
    }

    //Cambiar estado de un pedido
    public function estado(){
        
        //Método para restringir el acceso a toda persona que no sea administrador.
        Utils::isAdmin();

        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){

           //Recoger datos form
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            


             //Update del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location:".base_url.'pedido/detalles&id='.$id);
            ob_end_flush();
        }else{
            header("Location:".base_url);
        }
    }

}
