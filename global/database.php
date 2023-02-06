<?php
    class Database{

        private $conexion;

        public function __construct() {
            $host = 'localhost';    
            $database   = 'reyzone_onlineshop';   
            $user = 'root';    
            $pass = '';

            /*Es mejor pasar las opciones en el constructor*/
            $options = array(
                PDO::ATTR_EMULATE_PREPARES => FALSE,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try{
                $this->conexion = new PDO('mysql:host='.$host.';dbname='.$database.';charset="utf8"', $user, $pass, $options);

            }catch(PDOException $e){

                echo "Conexion fallida: ".$e->getMessage(); 
                exit();
            }
        }

        public function getConexion() {
            return $this->conexion;
        }
    }

?>