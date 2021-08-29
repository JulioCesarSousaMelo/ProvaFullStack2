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

    include_once '../vendor/autoload.php'; 
    include_once '../config/database.php';
    include_once '../app/certificado.php'; 
    
    use phpseclib3\File\X509; 

    // Instanciando Novos Objetos 
    $x509 = new X509(); 
    $database = new Database();
    $db = $database->getConnection();
    $certificado = new Certificado($db);

    if(isset($_POST['enviarArquivo'])){

        $resultForm = $_POST['enviarArquivo'];
        $nomeCertificado = $certificado->uploadArquivo($resultForm);

        $resultado = $x509->loadX509(file_get_contents("../storage/certificado/$nomeCertificado")); 

        $dn[] = ($x509->getDN()); // armazenando o valor de DN 
        $issuerDN[] = ($x509->getIssuerDN()); // armazenando o valor de Issuer DN
        $validityBefore = ($resultado['tbsCertificate']['validity']['notBefore']['utcTime']); // armazenando a VALIDADE - NOT BEFORE
        $validityAfter = ($resultado['tbsCertificate']['validity']['notAfter']['utcTime']); // armazenando a VALIDADE - NOT AFTER 

        $itemDN = array();
        $itemIssuerDN = array();

        // items DN
        for($i = 0; $i < 6; $i++){
            array_push($itemDN, $dn[0]["rdnSequence"][$i][0]["value"]["printableString"]);
        }

        // items issuerDN
        for($i = 0; $i < 5; $i++){
            array_push($itemIssuerDN, $dn[0]["rdnSequence"][$i][0]["value"]["printableString"]);
        }

        // trasformando os item array para string, pois os mesmos serão enviado ao banco de dados
        $itemDN = implode(',', $itemDN);
        $itemIssuerDN = implode("','", $itemIssuerDN);

        $certificado->armazenarInformacoes($itemDN, $itemIssuerDN, $validityBefore, $validityAfter);

        $id = $_SESSION['id'];
        $certificado->inserirInformacoes($id);
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