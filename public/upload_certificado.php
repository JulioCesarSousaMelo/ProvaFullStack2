<?php
    // Iniciando sessão ou resumindo sessão existe
    session_start();

    // Verificando se possui usuário logado
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        session_unset();
        echo "<script>
                alert('Está página só pode ser acessa por usuário logado');
                window.location.href='../index.php';
              </script>";
    }

    include_once '../config/database.php';
    include '../vendor/autoload.php'; 

    use phpseclib3\File\X509; 

    // Instanciando Novos Objetos 
    $database = new Database();
    $x509 = new X509(); 

    // Conexão com o Banco
    $conexao = $database->getConnection();

    $id = $_SESSION['id'];

    if(isset($_POST['enviarArquivo'])){

        $formatosPermitidos = array("pem");

        $extensao = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // realizar o upload do arquivo
        if(in_array($extensao, $formatosPermitidos)){
            // diretório de destino
            $pasta = "../storage/certificado/";

            // caminho do arquivo temporário
            $temporario = $_FILES['file']['tmp_name'];

            // gerando nome único para o novo arquivo
            $novoNome = uniqid().".$extensao";

            // upload do arquivo      
            if(move_uploaded_file($temporario, $pasta.$novoNome)){

                //lendo o certificado .pem  & armazendando os resultados
                $aux = $x509->loadX509(file_get_contents("../storage/certificado/$novoNome")); 

                $dn[] = ($x509->getDN()); // armazenando o valor de DN 
                $issuerDN[] = ($x509->getIssuerDN()); // armazenando o valor de Issuer DN
                $validityBefore = ($aux['tbsCertificate']['validity']['notBefore']['utcTime']); // armazenando a VALIDADE - NOT BEFORE
                $validityAfter = ($aux['tbsCertificate']['validity']['notAfter']['utcTime']); // armazenando a VALIDADE - NOT AFTER 

                // inserindo os dados do certificado no BANCO
                    $resultado = $conexao->prepare("UPDATE 
                                                        `usuarios` 
                                                    SET 
                                                        `dn` = '$dn',
                                                        `issuer_dn` = '$issuerDN',
                                                        `validade_certificado_before` = '$validityBefore',
                                                        `validade_certificado_after` = '$validityAfter'
                                                    WHERE 
                                                        `usuarios`.`id` = $id;");

                $resultado->execute();

                echo "<script> 
                        alert('Upload feito com sucesso!'); 
                        </script>";

                        // window.location.href='../public/info_certificado.php'
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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Upload</title>
</head>
<body>
    <h1>UPLOAD DE CERTIFICADO</h1>

    <p>Olá, <?= $_SESSION['nome']; ?> | <a href="../public/logout.php">Logout</a></p> 

    <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method= "POST" enctype= "multipart/form-data">
        <input type="file" name="file"/><br><br>
        <input type="submit" name="enviarArquivo" value="Enviar"/><br><br>
    </form>
    
    <!-- CHAMANDO SCRIPTS JS-->
    <script src="../resources/js/post.js"></script>
</body>
</html>