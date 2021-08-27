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

    // Armazenando nome do usuário para exibir
    $nome = $_SESSION['nome']; 
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

    <?php
        if(isset($_POST['enviarArquivo'])){
            // definir os formatos permitidos para upload
            $formatosPermitidos = array("pem");

            // descobrir a extensão do arquivo
            $extensao = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            // realizar o upload do arquivo
            if(in_array($extensao, $formatosPermitidos)){
                // diretório de destino
                $pasta = "../storage/";

                // caminho do arquivo temporário
                $temporario = $_FILES['file']['tmp_name'];

                // gerando nome único para o novo arquivo
                $novoNome = uniqid().".$extensao";

                // upload do arquivo
                if(move_uploaded_file($temporario, $pasta.$novoNome)){
                    $mensagem = "<p style = color:green>Upload feito com sucesso!</p>";
                }else{
                    $mensagem = "<p style = color:red>Erro, não foi possível fazer o upload!</p>";
                }
                
            }else{
                $mensagem = "<p style = color:red>Formato inválido!</p>";  
            }
        }
    ?>

    <span><?= $mensagem ?></span>
    <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method= "POST" enctype= "multipart/form-data" >
        <input type="file" name="file"/><br><br>
        <input type="submit" name="enviarArquivo" value="Enviar"/><br><br>
    </form>

    

    <a href="../public/logout.php">Logout</a>
</body>
</html>