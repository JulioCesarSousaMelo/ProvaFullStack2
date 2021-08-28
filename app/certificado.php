<?php
    class Certificado{

        include_once '../config/database.php';
        include_once '../vendor/autoload.php';

        use phpseclib3\File\X509; 

        // Instanciando Novos Objetos 
        $database = new Database();
        $x509 = new X509(); 

        // Conexão
        private $conexao;

        // Tabela
        private $db_table = "usuarios";

        // Atributos
        private $certificado;
        private $nomeCertificado;
        private $resultado;
        private $dn[] = array();
        private $issuerDN[] = array();
        private $validityBefore;
        private $validityAfter;
        private $id = $_SESSION['id'];;

        //  Fazer upload do certificado
        public fucntion uploadCertificado($resultForm){
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
                                alert('Upload feito com sucesso!'); 
                                window.location.href='../public/info_certificado.php';
                              </script>";
                    }else{
                        echo "<script> 
                                alert('Erro no upload do arquivo!'); 
                              </script>";
                    }
                }else{
                    echo "<script> 
                            alert('Erro no upload do arquivo, extensão inválida!'); 
                          </script>"; 
                }
            }
        }
        
        // Extrair as informações do certificado e armazenar em variáveis
        public function infoCertificado(){
 
            $this->resultado = $x509->loadX509(file_get_contents("../storage/certificado/$this->nomeCertificado")); 

            $this->dn[] = ($x509->getDN()); // armazenando o valor de DN 
            $this->issuerDN[] = ($x509->getIssuerDN()); // armazenando o valor de Issuer DN
            $this->validityBefore = ($this->resultado['tbsCertificate']['validity']['notBefore']['utcTime']); // armazenando a VALIDADE - NOT BEFORE
            $this->validityAfter = ($this->resultado['tbsCertificate']['validity']['notAfter']['utcTime']); // armazenando a VALIDADE - NOT AFTER 
        }

        // Inserir dados do certificado no banco
        public function insertCertificado(){

            $this->conexao = $database->getConnection();

            $sqlQuery = $this->conexao->prepare("UPDATE 
                                                        ". $this->db_table ." 
                                                    SET 
                                                        dn = "$this->dn[]",
                                                        issuer_dn = "$this->issuerDN[]",
                                                        validade_certificado_before = "$this->validityBefore",
                                                        validade_certificado_after = "$this->validityAfter"
                                                    WHERE 
                                                        usuarios.id = $this->id;");
            $sqlQuery->execute();

            if($sqlQuery){
                echo "Update Realizado!";
            }else{
                echo "Falha no update";
            }
        }


    }