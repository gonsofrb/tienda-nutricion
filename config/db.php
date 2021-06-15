<?php
 class Database {
     public static function connect(){
         
      try{
             
        $db = new mysqli('localhost', 'root', '' , 'tienda_nutricion');
        $db->query("SET NAME 'utf8'");
        
      }catch(Exception $e){
            die($e->getMessage());
      }  
           
         return $db;

     }
 }



?>