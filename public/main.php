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
    include '../vendor/autoload.php'; // incluindo o auto-load

    use phpseclib3\File\X509; // usando a biblioteca phpseclib

    $x509 = new X509(); // instanciando um novo objeto
    $aux = $x509->loadX509(file_get_contents('../teste.pem')); //lendo o certificado .pem  & armazendando resultado na variavel $aux

    $dn = ($x509->getDN()); // armazenando o valor de DN

    $issuerDN = ($x509->getIssuerDN()); // armazenando o valor de Issuer DN

    $validityBefore = ($aux['tbsCertificate']['validity']['notBefore']['utcTime']); // armazenando a VALIDADE - NOT BEFORE
    $validityAfter = ($aux['tbsCertificate']['validity']['notAfter']['utcTime']); // armazenando a VALIDADE - NOT AFTER 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<body>
    <a href="../public/logout.php">Logout</a>
</body>
</html>