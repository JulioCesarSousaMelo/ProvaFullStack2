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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página de Upload</title>
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
                <h1>UPLOAD DE CERTIFICADO</h1>
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
                <a class="btn btn-warning" href="../view/info_certificado.php">Meu Certificado</a>
            </div>
            <hr class="mt-3">
        </div>
    </div>

    <form action= "<?php echo "../controller/enviar_certificado.php"; ?>" method= "POST" enctype= "multipart/form-data" class="form-inline">
       
        <div class="container mt-5">
            <div class="row g-2">
                <div class="col-8">
                    <input type="file" name="file" class="form-control"/>
                </div>
                <div class="col-4">
                    <button type="submit" name="enviarArquivo" class="btn btn-success" value="Enviar">Enviar</button>
                </div>
            </div>
        </div>
    </form>
    
    <!-- CHAMANDO SCRIPTS JS-->
    <script src="../resources/js/post.js"></script>
</body>
</html>