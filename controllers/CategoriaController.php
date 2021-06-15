<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class CategoriaController{


  //Acción para ver todas las categorías disponibles en el proyecto.
    public function index(){
      
      //con éste método restringimos el acceso a toda persona que no sea admin para acceder a la acción index.
      Utils::isAdmin();
        $categoria = new Categoria();
                                //Método para obtener todas las categorías.
        $categorias = $categoria->getAll();

                        //vista donde se cargan todas las categorías.
      require_once 'views/categoria/index.php';



    }
    

    //Acción para crear una nueva categoría
    public function crear(){

      //Con éste método restringimos el acceso a toda persona que no sea admin.
      Utils::isAdmin();

      //Vista donde hay un formulario para crear una nueva categoría.
      require_once 'views/categoria/crear.php';
    }



            //Acción para ver ver todos los productos que hay de una categoria determinada.
      public function ver(){
          if(isset($_GET['id'])){
           $id = $_GET['id'];

           //Conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
                                    //Método para obtener una categoría
            $categoria = $categoria->getOne();
            //var_dump($categoria);

            //Conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
                                    //Método para obtener todos los productos de una categoría específica.
            $productos = $producto->getAllCategory();


          }
          //Vista donde se muestran todos los productos de una categoria especifica.
        require_once 'views/categoria/ver.php';
      }

      //Acción para guardar una nueva categoría.
    public function save(){
      
      //Método para restringir el acceso a toda persona que no sea admin.
      Utils::isAdmin();

      //Comprobación de si se ha seleccionado el botón submit del formulario y si se ha escrito el nombre de la categoría en su input correspondiente.
      if(isset($_POST) && isset($_POST['nombre'])){

     
            //Guardamos la categoria en la base de datos
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

                            //Método para guardar el nombre de la categoría en la base de datos.
          $save =$categoria->save();



          

        }
                          //Vista donde se muestran las categorías que hay en el proyecto.
      header("Location:".base_url."categoria/index");
    }


}






















?>