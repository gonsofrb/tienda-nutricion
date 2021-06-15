<?php
require_once 'models/producto.php';
class ProductoController
{
    //Mostrar todos los productos aleatoriamente con un límite pasado por parámetro
    public function index()
    {
        $producto = new Producto();
                                //Método que obtiene 12 productos de la base de datos
       $productos = $producto->getRandom(12);
       

        //renderizar una vista,cargamos los 12 productos procedentes de la base de datos en una vista y se le muestra al usuario.
        require_once 'views/producto/destacados.php';

    }


    //Acción que recoge un producto a través del modelo producto
    public function ver(){
       
        if(isset($_GET['id'])){

            $id = $_GET['id'];
           
        
            $producto = new Producto();
                //le pasamos el id del producto que queremos obtener en la consulta.
            $producto->setId($id);
                                    //getOne(), funcion para obtener un producto.
             $product = $producto->getOne();


            

        }
        //Mostramos en la vista el producto que queremos ver a través del id.
           require_once 'views/producto/ver.php';
        
    }

        //Acción para obtener todos los productos que tenemos en la base de datos.
    public function gestion()
    {
        //Con este método restringimos el acceso a la acción gestion a toda persona que no sea admin, pueda tener acceso a la vista gestion.php
        Utils::isAdmin();

        $producto = new Producto();
        $productos = $producto->getAll();
        
        //Renderizamos una vista y cargamos en ella todos los productos de la base de datos.
        require_once 'views/producto/gestion.php';
    }


        //Acción 
        public function crear()
       {
           //Con este método restringimos el accesp a la acción crear a toda persona que no sea admin
            Utils::isAdmin();


           require_once 'views/producto/crear.php';
        }

        //Acción para guardar un producto en la base de datos.
        //Reutilizamos esta acción para guardar un producto si se ha creado nuevo o si se ha editado un producto existente, en ambos casos hay que guardarlos en la base de datos.
    public function save()
    {
        //Con este método retringimos el acceso a la acción save() a toda persona que no sea admin.
        Utils::isAdmin();

        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            // $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                if(isset($_FILES['imagen'])){
                //Guardar la imagen
                $file = $_FILES['imagen'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                //  var_dump($file);
                //   die();
                //                    // Sólamente guardaremos la imagen del producto si tiene como extensión jpg,jpeg,png o gif.
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {

                        

                        //Si no exite el directorio uplods/images, se crea para ir guardando las imagenes.
                        if(!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                        }
                            //con move_uploaded_files, le indicamos que vaya guardando las imagenes que están en los archivos temporales en el directorio uploads/images/ y que le ponga de nombre lo que recibe por la variable $filename.
                     move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                        $producto->setImagen($filename);
                        }
                }

                //Con esta comprobación nos aseguramos que si recibe por $_GET['id], recibimos el id del producto que queremos editar, le pasamos el id del producto y utilizamos la funcion edit() del método producto, que se encarga de actualizar el producto específico.
                if(isset($_GET['id'])){
                    
                    $id = $_GET['id'];
                    $producto->setId($id);

                    $save = $producto->edit();
                }else{
                    //Si no le hemos indicado el id del producto por $_GET['id], entonces significa que utilizaremos la función save() del método producto , porque se trata de un producto nuevo.
                     $save = $producto->save();
                }

               

                if ($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }

        } else {
            $_SESSION['producto'] = "failed";
        }
        header("Location:".base_url."producto/gestion");
    }

    //Acción para editar un producto exixtente en la base de datos.
    public function editar() {
        //Con este método restringimos el acceso a toda persona que no sea admin.
        Utils::isAdmin();
      
        if(isset($_GET['id'])){

            $id = $_GET['id'];
            //Varible que le damos el valor true, y significaría que en la vista crear estamos utilizando la acción editar().
            $edit = true;
             
        
            $producto = new Producto();
            $producto->setId($id);

             $pro = $producto->getOne();

                //cargamos las propiedades del producto que queremos editar en la vista crear.php.
            require_once 'views/producto/crear.php';

        }else{
            header("Location:".base_url."producto/gestion");
        }
        
        
            

    }

        //Eliminar un producto
    public function eliminar()
    {
        //Método para restringir el acceso a toda persona que no sea admin.
        Utils::isAdmin();

        //Comprueba si por $_GET['id], recibe el id del producto que queremos eliminar.
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();

            //Paso del id del producto que queremos eliminar de la base de datos.
            $producto->setId($id);
                                //Función del modelo producto que recibe  el id del producto que queremos eliminar de la base de datos.
            $delete = $producto->delete();

            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }

        }else{
            $_SESSION['delete'] = 'failed';
        }

        header("Location:".base_url."producto/gestion");

    }

}
