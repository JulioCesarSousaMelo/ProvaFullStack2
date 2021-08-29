<?php
    class Certificado {

        // Conexão com Banco
        public function __construct($db){
            $this->conexao = $db;
        }

        // Tabela
        private $db_table = "usuarios";

        // Atributos
        private $conexao;
        private $certificado;
        private $nomeCertificado;
        private $resultado;
        private $dn = array();
        private $issuerDN = array();
        private $validityBefore;
        private $validityAfter;

        //  Fazer upload do certificado
        public function uploadArquivo($resultForm){
            if(isset($resultForm)){

                $formatosPermitidos = array("pem");
        
                $extensao = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        
                // realizar o upload do arquivo
                if(in_array($extensao, $formatosPermitidos)){
                    // diretório de destino
                    $pasta = "../storage/certificado/";
        
                    // caminho do arquivo temporário
                    $temporario = $_FILES['file']['tmp_name'];
        
                    // gerando nome único para o novo arquivo
                    $this->nomeCertificado = uniqid().".$extensao";
        
                    // upload do arquivo      
                    if(move_uploaded_file($temporario, $pasta.$this->nomeCertificado)){
                        echo "<script> 
                                alert('Upload de arquivo feito com sucesso!'); 
                                window.location.href='../public/info_certificado.php';
                             </script>";
                    }else{
                        echo "<script> 
                                alert('Erro no upload do arquivo!'); 
                                window.location.href='../public/upload_certificado.php';
                              </script>";
                    }
                }else{
                    echo "<script> 
                            alert('Erro no upload do arquivo, extensão inválida!'); 
                            window.location.href='../public/upload_certificado.php';
                          </script>"; 
                }
            }

            return $this->nomeCertificado;
        }
        
        // Extrair as informações do certificado e armazenar em variáveis
        public function armazenarInformacoes($dn, $issuerDN, $validityBefore, $validityAfter){
 
            $this->dn = $dn; // armazenando o valor de DN 
            $this->issuerDN = $issuerDN; // armazenando o valor de Issuer DN
            $this->validityBefore = $validityBefore; // armazenando a VALIDADE - NOT BEFORE
            $this->validityAfter = $validityAfter; // armazenando a VALIDADE - NOT AFTER 
        }

        // Inserir dados do certificado no banco
        public function inserirInformacoes($id){
            
            $sqlQuery = "UPDATE " 
                            . $this->db_table .
                        " SET 
                            dn = :dn,
                            issuer_dn = :issuerDN,
                            validade_certificado_before = :validityBefore,
                            validade_certificado_after = :validityAfter
                        WHERE 
                            usuarios.id = :id";

            $sqlQuery = $this->conexao->prepare($sqlQuery);

            // sanitize
            $this->dn=htmlspecialchars(strip_tags($this->dn));
            $this->issuerDN=htmlspecialchars(strip_tags($this->issuerDN));
            $this->validityBefore=htmlspecialchars(strip_tags($this->validityBefore));
            $this->validityAfter=htmlspecialchars(strip_tags($this->validityAfter));
            $id=htmlspecialchars(strip_tags(id));

            // bind data
            $sqlQuery->bindParam(":dn", $this->dn);
            $sqlQuery->bindParam(":issuerDN", $this->issuerDN);
            $sqlQuery->bindParam(":validityBefore", $this->validityBefore);
            $sqlQuery->bindParam(":validityAfter", $this->validityAfter);
            $sqlQuery->bindParam(":id", $id);

            $sqlQuery->execute();
        }

        // Selecionar as informações do certificado no banco
        public function retornarInformações($id){
            $sqlQuery = " SELECT
                            dn,
                            issuer_dn,
                            validade_certificado_before,
                            validade_certificado_after
                        FROM "
                            . $this->db_table ."
                        WHERE 
                            usuarios.id = :id;";

            $sqlQuery = $this->conexao->prepare($sqlQuery);

            // sanitize
            $id=htmlspecialchars(strip_tags($id));

            // bind data
            $sqlQuery->bindParam(":id", $id);

            $sqlQuery->execute();

            $resultado = $sqlQuery->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        }

         // Verificar se já existe upload de arquivo no usuário
         public function verificarArquivo($id){
            $sqlQuery = " SELECT dn FROM " . $this->db_table . " WHERE usuarios.id = :id;";

            $sqlQuery = $this->conexao->prepare($sqlQuery);

            // sanitize
            $id=htmlspecialchars(strip_tags($id));

            // bind data
            $sqlQuery->bindParam(":id", $id);

            $sqlQuery->execute();

            // Validar se os dados existem
            if($sqlQuery->rowCount() > 0){
                $dado = $sqlQuery->fetch();

                // Criar uma sessão
                $_SESSION['dn'] = $dado['dn'];

                return true;
            }else{
                return false;
            }
        }

        
    }