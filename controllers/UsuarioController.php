<?php
require_once 'models/usuario.php';
require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class UsuarioController{

    public function index(){

        header("Location:".base_url);
    }



 //Acción que carga en una vista el formulario de registro de un nuevo usuario.
    public function registro(){

        //Vista donde se carga el formulario de registro.
       require_once 'views/usuario/crear.php';
    }

    
    //Acción para editar los datos de un usuario.
    public function editUser(){
        //Método para restringir el acceso a los usuarios que no estén registrados.
        Utils::isIdentity();

        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $editUser = true;

            $usuario = new Usuario();
            $usuario->setId($id);
            $user = $usuario->getOneUser();
           
            //Vista donde se muestran los datos de un usuario registrado que quiere modificar sus datos.
            require_once 'views/usuario/crear.php'; 
        }else{

            header("Location:".base_url);
        }


       
    }            

                    
/*
    public function saveRegister(){
            $errors = array();
            
        if(isset($_POST)){

                $user = new Usuario();
                $nombre = !empty($_POST['name']) ? $_POST['name'] : false ;
                $apellidos = !empty($_POST['surname']) ? $_POST['surname'] : false ;
                $email = !empty($_POST['email']) ? $_POST['email'] : false ;
                $password = !empty($_POST['password']) ? $_POST['password'] : false ;

               
                //Validar los datos antes de guardarlos en la base de datos
                if(!$nombre && !$apellidos && !$email && !$password){
                        array_push($errors, "Debe rellenar  todos los campos, por favor.");
                }

                //Validación campo nombre
                
                if(is_numeric($nombre) && preg_match("/[0-9]/",$nombre)){
                    array_push($errors, "El nombre no puede contener números.");
                }

                //Validación campo apellido
                if(is_numeric($apellidos) && preg_match("/[0-9]/",$apellidos)){
                    array_push($errors, "Los apellidos no pueden contener números.");
                }

                //Validación campo email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "El correo no es válido.");
                }

                //Validación email que no exista ya en la base de datos.
                if($user->uniqueEmail($email)){
                    array_push($errors, "Ese correo pertenece a un usuario, escriba una dirección de correo diferente  por favor.");
                }
               if(empty($password)){
                   array_push($error, "Debe escribir una contraseña");
               }

                
                if(count($errors) == 0){
                        
                    //Introducimos los datos en la base de datos
                    $user->setNombre($nombre);
                    $user->setApellidos($apellidos);
                    $user->setEmail($email);
                    $user->setPassword($password);
            
                    $saveRegister = $user->save();
                            
                         if($saveRegister){

                            $_SESSION['register_complete'] = "Registro de usuario completado";

                         }else{

                            $_SESSION['error_register']['save'] = "Se ha producido un error al introducir los datos.";
                         }       
                }else{

                    $_SESSION['error_register'] = $errors;
                }
               
        }
    
                header("Location:".base_url."usuario/registro");  
        
    }

*/

/*
    public function saveEdit(){
        $errors = array();
        
    if(isset($_POST)){

            $user = new Usuario();
            $nombre = !empty($_POST['name']) ? $_POST['name'] : false ;
            $apellidos = !empty($_POST['surname']) ? $_POST['surname'] : false ;
            $email = !empty($_POST['email']) ? $_POST['email'] : false ;
            $password = !empty($_POST['password']) ? $_POST['password'] : false ;

           
            //Validar los datos antes de guardarlos en la base de datos
            if(!$nombre && !$apellidos && !$email && !$password){
                    array_push($errors, "Debe rellenar  todos los campos, por favor.");
            }

            //Validación campo nombre
            
            if(is_numeric($nombre) && preg_match("/[0-9]/",$nombre)){
                array_push($errors, "El nombre no puede contener números.");
            }

            //Validación campo apellido
            if(is_numeric($apellidos) && preg_match("/[0-9]/",$apellidos)){
                array_push($errors, "Los apellidos no pueden contener números.");
            }

            //Validación campo email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "El correo no es válido.");
            }

           if(empty($password)){
               array_push($error, "Debe escribir una contraseña");
           }

            
            if(count($errors) == 0){
                    
                //Introducimos los datos en la base de datos
               
               


                $user->setNombre($nombre);
                $user->setApellidos($apellidos);
                $user->setEmail($email);
                $user->setPassword($password);


                 if(isset($_GET['id'])){


                     $user_id = $_GET['id'];

                   //  $cast_user_id = (int)$user_id;

                   

                    
                    $user->setId($user_id);

                    $saveEdit = $user->edit();
                   
                 }

                      
                     if($saveEdit){
                        
                        $_SESSION['register_complete'] = "Datos mofidicados correctamente";
                        
                     }else{

                        $_SESSION['error_register']['save'] = "Se ha producido un error al introducir los datos.";
                     }       
            }else{

                $_SESSION['error_register'] = $errors;
            }
           
    }

            header("Location:".base_url."usuario/registro");  
    
}

*/


    

//Acción para guardar un usuario nuevo y también para guardar un usuario que ha mofidicado sus datos.
    public function saveUser(){
            $errors = array();
            $url_redirec = "";
            //Comprobamos si existe $_GET['id'], significa que llamaria al método editar, porque le pasamos el id del usuario a modificar.
                if(isset($_GET['id'])){
                    $action = "edit";

                }else{

                    $action = "save";
                }
        
        if(isset($_POST)){

                $user = new Usuario();
                $nombre = !empty($_POST['name']) ? $_POST['name'] : false ;
                $apellidos = !empty($_POST['surname']) ? $_POST['surname'] : false ;
                $email = !empty($_POST['email']) ? $_POST['email'] : false ;
                $password = !empty($_POST['password']) ? $_POST['password'] : false ;

               
                //Validar los datos antes de guardarlos en la base de datos
                if(!$nombre && !$apellidos && !$email && !$password){
                        array_push($errors, "Debe rellenar  todos los campos, por favor.");
                }

                //Validación campo nombre
                
                if(is_numeric($nombre) && preg_match("/[0-9]/",$nombre)){
                    array_push($errors, "El nombre no puede contener números.");
                }

                //Validación campo apellido
                if(is_numeric($apellidos) && preg_match("/[0-9]/",$apellidos)){
                    array_push($errors, "Los apellidos no pueden contener números.");
                }

                
                //Validación campo email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "El correo no es válido.");
                
                }
                
                //Validación email que no exista ya en la base de datos.
                if($action == "save"){

                    if($user->uniqueEmail($email)){
                    array_push($errors, "El correo ya está registrado, escriba otro correo por favor.");
                }

                }
                
               
               
                if(empty($password)){
                   array_push($error, "Debe escribir una contraseña");
               }

                
                if(count($errors) == 0){
                        
                    //Introducimos los datos en la base de datos
                    $user->setNombre($nombre);
                    $user->setApellidos($apellidos);
                    $user->setEmail($email);
                    $user->setPassword($password);

                    if(isset($_GET['id'])){

                        $user_id = $_GET['id'];
                        $user->setId($user_id);

                                        //Llamamos el método edit() para editar los datos de un usuario existente y lo guardamos en la base de datos.
                        $saveEdit = $user->edit();
                           
                    }else{
                                        //Llamamos el método save() para guardar en la base de datos un usuario nuevo.
                        $saveRegister = $user->save();
                    }
                    
                    //Comprobación si se ha utilizado la acción edit, que es editar los datos de un usuario existente.
                    if($action == "edit"){

                        if($saveEdit){

                            $_SESSION['register_complete'] = "Datos del usuario modificados.";
                            $url_redirec = "usuario/editUser&id=$user_id";

                        }else{
                            $_SESSION['error_register']['save'] = "Se ha producido un error al modificar los datos.";
                            $url_redirec = "usuario/editUser&id=$user_id";
                        }

                    }else{
                            //Comprobación si se ha utilizado la acción save, que es guardar un registro, es decir un usuario nuevo.
                        if($action == "save"){

                                if($saveRegister){

                                $_SESSION['register_complete'] = "Registro de usuario completado.";
                                $url_redirec = "usuario/registro";
                            
                             }else{
                                
                                $_SESSION['error_register']['save'] = "Se ha producido un error al introducir los datos.";
                                $url_redirec = "usuario/registro";                            
                        }
                                
                        }else{

                            
                        }
                    }

             }else{

                        if($action == "save"){

                            $url_redirec = "usuario/registro";

                            $_SESSION['error_register'] = $errors;
                          
                        }else{
                            if($action == "edit"){

                            $_SESSION['error_register'] = $errors;

                            $url_redirec = "usuario/editUser&id=$user_id";
                            }
                                                     
      

                        }

             }
        
                        header("Location:".base_url.$url_redirec);
        }

          
 


 }




        //Acción para comprobar si existe el usuario en la base de datos y si coincide con la contraseña que se le pasa.
            public function login(){
                if(isset($_POST)){
                    //Identificar al usuario
                    //Consulta a la base de datos
                    $usuario = new Usuario();
                    
                    $identity = $usuario->login($_POST['email'],$_POST['password']);
                  
                        //Crear una sesion
                    if(is_object($identity)){
                        $_SESSION['identity'] = $identity;

                        if($identity->rol == 'admin'){

                            $_SESSION['admin'] = true;
                        }
                    }else{
                     
                        $_SESSION['error_login'] = "Identificación fallida !!";
                    }

                   

                }
                header("Location:".base_url);
            }


                //Método para comprobar si existe una sesion de un administrador o de un usuario y elimina esa sesión.
                public function logout(){
                    if(isset($_SESSION['identity'])){
                        unset($_SESSION['identity']);

        
                    }
                    if(isset($_SESSION['admin'])){
                        unset($_SESSION['admin']);

                    }
                
                
                header("Location:".base_url);
                
                }

                
                 
                //Método para  hacer uso de la librería phpmailer, para enviar un e-mail de contacto.
                public function contact(){

                    
                    $result = "";
                    if(isset($_POST['send'])){
                                            
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->Host='smtp.gmail.com';
                        $mail->Port=587;
                        $mail->SMTPAuth=true;
                        $mail->SMTPSecure='tls';
                        $mail->Username='Nutritionprofessional087@gmail.com';
                        $mail->Password='proyecto087';
                    
                    
                    
                    
                    
                        $mail->setFrom($_POST['email'],$_POST['name'],$_POST['surname']);
                        $mail->addAddress('Nutritionprofessional087@gmail.com');
                        $mail->addReplyTo($_POST['email'],$_POST['name']);
                    
                        $mail->isHTML(true);
                        $mail->Subject='Enviado por '.$_POST['name']." ".$_POST['surname'];
                        $mail->Body='<h3 align=center>Nombre: '.$_POST['name'].'<br/>Email: '.$_POST['email'].'<br/>Teléfono: '.$_POST['telephone'].'<br/>'.$_POST['message'].'<h3/>';
                    
                        if(!$mail->send()){
                    
                            $result = "<h2 style = 'color:red'>Inténtelo de nuevo  pasados unos minutos por favor.</h2>";
                             }else{
                            $result = "<h2 style = 'color:green'>Gracias ".$_POST['name']." por contactarnos, recibirá la respuesta muy pronto!<h2>";
                                }
                    
                    
                    
                    
                            }
                    
                   
                            //Vista donde se muestra el formulario de contacto a un usuario.
                    require_once 'views/usuario/contacto.php';
                }


}



?>