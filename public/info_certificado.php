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

    include_once '../config/database.php';
    include_once '../app/certificado.php'; 
    

    // Instanciando Novos Objetos 
    $database = new Database();
    $db = $database->getConnection();
    $certificado = new Certificado($db);

    $id = $_SESSION['id'];

    // retorna as informações sobre o certificado
    $items = $certificado->retornarInformações($id);

    // armazenando as informações específicas
    $dn = $items[dn];
    $issuerDN = $items[issuer_dn];
    $validade_certificado_before = $items[validade_certificado_before];
    $validade_certificado_after = $items[validade_certificado_after];

    
    list($c_dn, $o_dn, $ou_dn_1, $ou_dn_2, $ou_dn_3, $cn_dn) = explode(",", $dn);
    list($c_issuer_dn, $o_issuer_dn, $ou_issuer_dn_1, $ou_issuer_dn_2, $ou_issuer_dn_3) = explode(",", $issuerDN);


    
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
            <td><?= $c_dn; ?></td>
        </tr>
        <tr>
            <td>O</td>
            <td><?= $o_dn; ?></td>
        </tr>
        <tr>
            <td>OU</td>
            <td><?= $ou_dn_1; ?></td>
        </tr>
        <tr>
            <td>OU</td>
            <td><?= $ou_dn_2; ?></td>
            
        </tr>
        <tr>
            <td>OU</td>
            <td><?= $ou_dn_3; ?></td>
            
        </tr>
        <tr>
            <td>CN</td>
            <td><?= $cn_dn; ?></td>
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
            <td><?= $c_issuer_dn; ?></td>
        </tr>
        <tr>
            <td>O</td>
            <td><?= $o_issuer_dn; ?></td>
        </tr>
        <tr>
            <td>OU</td>
            <td><?= $ou_issuer_dn_1; ?></td>
        </tr>
        <tr>
            <td>OU</td>
            <td><?= $ou_issuer_dn_2; ?></td>
            
        </tr>
        <tr>
            <td>OU</td>
            <td><?= $ou_issuer_dn_3; ?></td>
            
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
            <td><?= $validade_certificado_before ?></td>
        </tr>
        <tr>
            <td>Não depois de</td>
            <td><?= $validade_certificado_after ?></td>
        </tr>
    </table><br><br>
    </div>
</body>
</html>