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
    include_once '../model/certificado.php'; 
    

    // Instanciando Novos Objetos 
    $database = new Database();
    $db = $database->getConnection();
    $certificado = new Certificado($db);

    $id = $_SESSION['id'];

    // Retorna as informações sobre o certificado
    $items = $certificado->retornarInformações($id);

    // Armazenando as informações específicas
    $dn = $items[dn];
    $issuerDN = $items[issuer_dn];
    $validade_certificado_before = $items[validade_certificado_before];
    $validade_certificado_after = $items[validade_certificado_after];

    // Criando novas variáveis de informações do certificado a partir de uma única
    list($c_dn, $o_dn, $ou_dn_1, $ou_dn_2, $ou_dn_3, $cn_dn) = explode(",", $dn);
    list($c_issuer_dn, $o_issuer_dn, $ou_issuer_dn_1, $ou_issuer_dn_2, $dn_issuer_dn) = explode(",", $issuerDN);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Informações do Certificado</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- =================================================================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- =================================================================== -->
</head>
<body>

    <div class="bg-dark p-4">
        <img src="../resources/img/logo_horizontal_soluti.png" class="mx-auto d-block " alt="MDN logo">
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12 mt-2">
                <h1>INFORMAÇÕES CERTIFICADO DIGITAL</h1>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <p>Olá, <?= $_SESSION['nome']; ?></p> 
            </div>
            <hr>
            <div class="col-1">
                <a class="btn btn-danger" href="../controller/logout.php">Logout</a>
            </div>
            <div class="col-6">
                <a class="btn btn-warning" href="../view/upload_certificado.php">Cadastrar novo certificado</a>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    
    <div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">DN</th>
            <th scope="col">Issuer DN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">C</th>
            <td><?= $c_dn; ?></td>
            <td><?= $c_issuer_dn; ?></td>
            </tr>
            <tr>
            <th scope="row">O</th>
            <td><?= $o_dn; ?></td>
            <td><?= $o_issuer_dn; ?></td>
            </tr>
            <tr>
            <th scope="row">OU</th>
            <td><?= $ou_dn_1; ?></td>
            <td><?= $ou_issuer_dn_1; ?></td>
            </tr>
            <th scope="row">OU</th>
            <td><?= $ou_dn_2; ?></td>
            <td><?= $ou_issuer_dn_2; ?></td>
            </tr>
            <th scope="row">OU</th>
            <td><?= $ou_dn_3; ?></td>
            <td></td>
            </tr>
            <th scope="row">CN</th>
            <td><?= $cn_dn?></td>
            <td><?= $dn_issuer_dn; ?></td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="container">
    <table class="table table-dark">
        <thead class="thead">
            <tr>
            <th scope="col">#</th>
            <th scope="col">VALIDADE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">Não antes de</th>
            <td><?= $validade_certificado_before ?></td>
            </tr>
            <tr>
            <th scope="row">Não depois de</th>
            <td><?= $validade_certificado_after ?></td>
            </tr>
        </tbody>
    </table>
    </div>
</body>
</html>