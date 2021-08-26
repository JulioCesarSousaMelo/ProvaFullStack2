<?php 
    class Database {
        private $host = "localhost";
        private $database_name = "phpapidb";
        private $username = "root";
        private $password = "root";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("SET NAMES utf8");
            }catch(PDOException $exception){
                echo "Não foi possível conectar ao Banco de Dados" . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>