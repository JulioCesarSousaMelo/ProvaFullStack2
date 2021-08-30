<?php 

    session_start();  //  Iniciando sessão ou resumindo sessão existe   

    include_once '../vendor/autoload.php'; 
    include_once '../config/database.php';
    include_once '../model/certificado.php'; 
    include_once '../model/logs.php'; 

    use phpseclib3\File\X509; 

    // Instanciando Objetos
    $x509 = new X509(); 
    $database = new Database();
    $db = $database->getConnection();
    $certificado = new Certificado($db);
    $logs = new Logs();

    // .............................................................. //
    //  Recebendo e armazenando as informações do Certificado         //
    // .............................................................. //
    $resultForm = $_POST['enviarArquivo'];

    $nomeCertificado = $certificado->uploadArquivo($resultForm);

    $resultado = $x509->loadX509(file_get_contents("../storage/certificado/$nomeCertificado")); 

    $dn[] = ($x509->getDN()); // armazenando o valor de DN 
    $issuerDN[] = ($x509->getIssuerDN()); // armazenando o valor de Issuer DN
    $validityBefore = ($resultado['tbsCertificate']['validity']['notBefore']['utcTime']); // armazenando a VALIDADE - NOT BEFORE
    $validityAfter = ($resultado['tbsCertificate']['validity']['notAfter']['utcTime']); // armazenando a VALIDADE - NOT AFTER 

    $itemDN = array();
    $itemIssuerDN = array();

    // inserindo as informações específicas de $dn[] para o array $itemDN
    for($i = 0; $i < 6; $i++){
        array_push($itemDN, $dn[0]["rdnSequence"][$i][0]["value"]["printableString"]); 
    }

    // inserindo as informações específicas de $issuerDN[] para o array $issuerDN
    for($i = 0; $i < 5; $i++){
        array_push($itemIssuerDN, $dn[0]["rdnSequence"][$i][0]["value"]["printableString"]);  
    }

    // trasformando os item do array $itemDN para uma única string
    $itemDN = implode(',', $itemDN);
    // trasformando os item do array $itemIssuerDN para uma única string
    $itemIssuerDN = implode(',', $itemIssuerDN);

    $certificado->armazenarInformacoes($itemDN, $itemIssuerDN, $validityBefore, $validityAfter);

    $id = $_SESSION['id']; // parâmetro para inserirInformacoes()
    $nome = $_SESSION['nome']; // parâmetro para mensagemUpload()

    // .............................................................. //
    //  Definições para a criação do Log de Upload                    //
    // .............................................................. //
    date_default_timezone_set('America/Sao_Paulo'); // Definindo o fuso horário de São Paulo

    $mensagemLog = $logs->mensagemUpload($nome);  // Criando Mensagem para o Log
    $logs->criarLog($mensagemLog);  // Criando Log

    // .............................................................. //
    //  Inserindo dados do arquivo no Banco de Dados                  //
    // .............................................................. //
    $certificado->inserirInformacoes($id);


    