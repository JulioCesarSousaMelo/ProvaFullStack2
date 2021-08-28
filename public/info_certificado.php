<?php
    // Iniciando sessão ou resumindo sessão existe
    session_start();

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        session_unset();
        echo "<script>
                alert('Está página só pode ser acessa por usuário logado');
                window.location.href='../index.php';
              </script>";

    }
?>
<?php
    // incluindo o auto-load
    include '../vendor/autoload.php'; 

    // armazenando o nome_certificado contido na SESSION
    $nome_certificado = $_SESSION['nome_certificado'];

    // usando a biblioteca phpseclib
    use phpseclib3\File\X509; 

    // instanciando um novo objeto
    $x509 = new X509(); 

    //lendo o certificado .pem  & armazendando resultado na variavel $aux
    $aux = $x509->loadX509(file_get_contents("../storage/certificado/$nome_certificado")); 

    $dn[] = ($x509->getDN()); // armazenando o valor de DN 

    $issuerDN[] = ($x509->getIssuerDN()); // armazenando o valor de Issuer DN

    $validityBefore = ($aux['tbsCertificate']['validity']['notBefore']['utcTime']); // armazenando a VALIDADE - NOT BEFORE
    $validityAfter = ($aux['tbsCertificate']['validity']['notAfter']['utcTime']); // armazenando a VALIDADE - NOT AFTER 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página Inicial</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ============================================================= -->
    <link rel="stylesheet" href="../resources/css/style.css">
    <!-- ============================================================= -->
</head>
<body>
    <h1>INFORMAÇÕES CERTIFICADO DIGITAL</h1>

    <p>Olá, <?= $_SESSION['nome']; ?> | <a href="../public/logout.php">Logout</a></p> 
    <hr>
    <!-- tabela DN -->
    <div class="table">
    <table border="1">
        <tr>
            <td></td>
            <td>DN</td>
        </tr>
        <tr>
            <td>C</td>
            <td><?php echo $dn[0]["rdnSequence"][0][0]["value"]["printableString"]; ?></td>
        </tr>
        <tr>
            <td>O</td>
            <td><?php echo $dn[0]["rdnSequence"][1][0]["value"]["printableString"]; ?></td>
        </tr>
        <tr>
            <td>OU</td>
            <td><?php echo $dn[0]["rdnSequence"][2][0]["value"]["printableString"]; ?></td>
        </tr>
        <tr>
            <td>OU</td>
            <td><?php echo $dn[0]["rdnSequence"][3][0]["value"]["printableString"]; ?></td>
            
        </tr>
        <tr>
            <td>OU</td>
            <td><?php echo $dn[0]["rdnSequence"][4][0]["value"]["printableString"]; ?></td>
            
        </tr>
        <tr>
            <td>CN</td>
            <td><?php echo $dn[0]["rdnSequence"][5][0]["value"]["printableString"]; ?></td>
        </tr>
    </table><br><br>
    </div>

    <!-- tabela Issuer DN -->
    <div class="table">
    <table border="1">
        <tr>
            <td></td>
            <td>Issuer DN</td>
        </tr>
        <tr>
            <td>C</td>
            <td><?php echo $issuerDN[0]["rdnSequence"][0][0]["value"]["printableString"]; ?></td>
        </tr>
        <tr>
            <td>O</td>
            <td><?php echo $issuerDN[0]["rdnSequence"][1][0]["value"]["printableString"]; ?></td>
        </tr>
        <tr>
            <td>OU</td>
            <td><?php echo $issuerDN[0]["rdnSequence"][2][0]["value"]["printableString"]; ?></td>
        </tr>
        <tr>
            <td>OU</td>
            <td><?php echo $issuerDN[0]["rdnSequence"][3][0]["value"]["printableString"]; ?></td>
            
        </tr>
        <tr>
            <td>OU</td>
            <td><?php echo $issuerDN[0]["rdnSequence"][4][0]["value"]["printableString"]; ?></td>
            
        </tr>
    </table><br><br>
    </div>

    <!-- tabela VALIDADE -->
    <div class="table">
    <table border="1">
        <tr>
            <td></td>
            <td>Validade do Certificado</td>
        </tr>
        <tr>
            <td>Não antes de</td>
            <td><?= $validityBefore ?></td>
        </tr>
        <tr>
            <td>Não depois de</td>
            <td><?= $validityAfter ?></td>
        </tr>
    </table><br><br>
    </div>

    
</body>
</html>