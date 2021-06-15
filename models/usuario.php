<?php

class Usuario{

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $fecha;
    private $imagen;
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
    function getApellidos(){
        return $this->apellidos;
    }
    function getEmail(){
        return $this->email;
    }
    function getPassword(){

        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT,['cost' => 4]);
    }
    function getRol(){
        return $this->rol;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getImagen(){
        return $this->imagen;
    }


    function setId($id){
        $this->id=$id;
    }
        //Limpiamos los datos con real_escape_string
    function setNombre($nombre){
        $this->nombre= $this->db->real_escape_string($nombre);
    }
    function setApellidos($apellidos){
        $this->apellidos=$this->db->real_escape_string($apellidos);
    }
    function setEmail($email){
        $this->email=$this->db->real_escape_string($email);
    }

    //Ciframos el password
    function setPassword($password){
        $this->password=$password;
    }
    function setFecha($fecha){
        $this->fecha=$fecha;
    }
    function setImagen($imagen){
        $this->imagen=$imagen;
    }

    public function getDateUserPedido(){
    $usuario = $this->db->query("SELECT u.nombre,u.apellidos,u.email FROM usuarios u INNER JOIN pedidos p ON p.usuario_id=u.id WHERE p.id= {$this->getId()}");
     return $usuario->fetch_object();
    }


    //Método para comprobar si existe el email que le pasamos en la base de datos.
    public function uniqueEmail ($email){
        $exist = false;

        if(isset($email) && !empty($email)){
        $sql = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $query = $this->db->query($sql);
        if(mysqli_num_rows($query) > 0){
            $exist = true;
        }
        }
        return $exist;
    }




//Método para obtener un usuario pasandole el id.
    public function getOneUser(){

        $usuario = $this->db->query( "SELECT * FROM usuarios WHERE id = {$this->getId()}");
        return $usuario->fetch_object();
    }

    //Método para guardar un usuario en la base de datos, le pasamos los datos necesarios.
    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', CURDATE(), null);";
        $save =  $this->db->query($sql);

        
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }

    //Método para editar los datos de un usuario existente en la base de datos.
    public function edit(){

        $sql = "UPDATE usuarios SET nombre = '{$this->getNombre()}', apellidos = '{$this->getApellidos()}', email = '{$this->getEmail()}'";
        $sql .= " , password = '{$this->getPassword()}' WHERE id = {$this->getId()}";
        $save = $this->db->query($sql);

      
        $result = false;
        if ($save){
            $result = true;
        }
        return $result;
       
       // $this->db->error;
      // var_dump($sql);
      // var_dump($save);
      // die();
        

    }

    //Método para verificar si existe el email que le pasamos y la contraseña en la base de datos.
    public function login($email, $password){

           $result = false;
        //Comprobar si existe el usuario
        $sql= "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

            if($login && $login->num_rows == 1){
                
                $usuario = $login->fetch_object();

                //Verificar la contraseña
                $verify = password_verify($password,$usuario->password);

                if($verify){
                    $result = $usuario;
                }

            }

            return $result;

        }

        
       

}



?>