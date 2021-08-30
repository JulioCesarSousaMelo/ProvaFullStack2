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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Upload</title>
</head>
<body>
    <h1>UPLOAD DE CERTIFICADO</h1>

    <p>Olá, <?= $_SESSION['nome']; ?> | <a href="../controller/logout.php">Logout</a></p> 

    <form action= "<?php echo "../controller/enviar_certificado.php"; ?>" method= "POST" enctype= "multipart/form-data">
        <input type="file" name="file"/><br><br>
        <input type="submit" name="enviarArquivo" value="Enviar"/><br><br>
    </form>
    
    <!-- CHAMANDO SCRIPTS JS-->
    <script src="../resources/js/post.js"></script>
</body>
</html>