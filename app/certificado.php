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

            $sqlQuery = $this->conexao->prepare("UPDATE "
                                                    . $this->db_table .
                                                " SET 
                                                    dn = :dn,
                                                    issuer_dn = :issuerDN,
                                                    validade_certificado_before = :validityBefore,
                                                    validade_certificado_after = :validityAfter
                                                WHERE 
                                                    usuarios.id = :id");

            // bind data
            $stmt->bindValue(":dn", "oooooo");
            $stmt->bindValue(":issuerDN", "oooooo");
            $stmt->bindParam(":validityBefore", $this->validityBefore);
            $stmt->bindParam(":validityAfter", $this->validityAfter);
            $stmt->bindParam(":id", $id);

            $sqlQuery->execute();

            if($sqlQuery){
                echo "<script> 
                        alert('Upload feito com sucesso!'); 
                        window.location.href='../public/info_certificado.php';
                     </script>";
            }else{
                echo "<script> 
                        window.location.href='../public/upload_certificado.php';
                     </script>";
            }
        }
    }