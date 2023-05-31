<?php 
    $mqtt_secret = "";
    class Database {
        private $host = 'localhost';
        private $database_name = 'relojeria';
        private $username = 'phpmyadmin';
        private $password = '12345';
        public $conn;
        
        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "No se pudo conectar a la base de datos: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>
