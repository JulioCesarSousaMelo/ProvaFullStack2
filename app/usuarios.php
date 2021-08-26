<?php
    class Usuarios{

        // Connection
        private $connection;

        // Table
        private $db_table = "usuarios";

        // Columns
        public $id;
        public $nome;
        public $cpf;
        public $telefone;
        public $email;
        public $data_nascimento;
        public $senha;
        public $endereco;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // CREATE - Criar registro
        public function createUsuarios(){
            $sqlQuery = "INSERT INTO
                            ". $this->db_table ."
                        SET 
                            nome = :nome, 
                            cpf = :cpf, 
                            telefone = :telefone, 
                            email = :email, 
                            data_nascimento = :data_nascimento, 
                            senha = :senha, 
                            endereco = :endereco";
        
            $stmt = $this->connection->prepare($sqlQuery);
        
            // sanitize
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->cpf=htmlspecialchars(strip_tags($this->cpf));
            $this->telefone=htmlspecialchars(strip_tags($this->telefone));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->data_nascimento=htmlspecialchars(strip_tags($this->data_nascimento));
            $this->senha=htmlspecialchars(strip_tags($this->senha));
            $this->endereco=htmlspecialchars(strip_tags($this->endereco));
        
            // bind data
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":data_nascimento", $this->data_nascimento);
            $stmt->bindParam(":senha", $this->senha);
            $stmt->bindParam(":endereco", $this->endereco);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // GET ALL - Pegar todos os registros
        public function getUsuarios(){
            $sqlQuery = " SELECT 
                            id, 
                            nome, 
                            cpf, 
                            telefone, 
                            email, 
                            data_nascimento, 
                            senha, 
                            endereco 
                        FROM " 
                            . $this->db_table . "";
            $stmt = $this->connection->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET single - Pegar registros únicos
        public function getSingleUsuarios(){
            $sqlQuery = " SELECT
                            id, 
                            nome, 
                            cpf, 
                            telefone, 
                            email, 
                            data_nascimento, 
                            senha, 
                            endereco 
                        FROM "
                            . $this->db_table ."
                        WHERE 
                            id = ?
                        LIMIT 0,1";

            $stmt = $this->connection->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nome = $dataRow['nome'];
            $this->cpf = $dataRow['cpf'];
            $this->telefone = $dataRow['telefone'];
            $this->email = $dataRow['email'];
            $this->data_nascimento = $dataRow['data_nascimento'];
            $this->senha = $dataRow['senha'];
            $this->endereco = $dataRow['endereco'];
        }        

        // UPDATE - Atualizar registros
        public function updateUsuarios(){
            $sqlQuery = " UPDATE
                             ". $this->db_table ." 
                        SET
                            nome = :nome, 
                            cpf = :cpf, 
                            telefone = :telefone, 
                            email = :email, 
                            data_nascimento = :data_nascimento, 
                            senha = :senha, 
                            endereco = :endereco 
                        WHERE 
                            id = :id";
        
            $stmt = $this->connection->prepare($sqlQuery);
        
            // sanitize
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->cpf=htmlspecialchars(strip_tags($this->cpf));
            $this->telefone=htmlspecialchars(strip_tags($this->telefone));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->data_nascimento=htmlspecialchars(strip_tags($this->data_nascimento));
            $this->senha=htmlspecialchars(strip_tags($this->senha));
            $this->endereco=htmlspecialchars(strip_tags($this->endereco));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":data_nascimento", $this->data_nascimento);
            $stmt->bindParam(":senha", $this->senha);
            $stmt->bindParam(":endereco", $this->endereco);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE - Deletar registros
        function deleteUsuarios(){
            $sqlQuery = " DELETE FROM " 
                            . $this->db_table . " 
                        WHERE 
                            id = ?";
            $stmt = $this->connection->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>