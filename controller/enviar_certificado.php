<?php 

    // Iniciando sessão ou resumindo sessão existe
    session_start();

    include_once '../vendor/autoload.php'; 
    include_once '../config/database.php';
    include_once '../model/certificado.php'; 

    use phpseclib3\File\X509; 

    // Instanciando Novos Objetos 
    $x509 = new X509(); 
    $database = new Database();
    $db = $database->getConnection();
    $certificado = new Certificado($db);

    // Recebendo resultado do formulário 
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
    $itemIssuerDN = implode(',', $itemIssuerDN);

    $certificado->armazenarInformacoes($itemDN, $itemIssuerDN, $validityBefore, $validityAfter);

    $id = $_SESSION['id'];
    $certificado->inserirInformacoes($id);

    