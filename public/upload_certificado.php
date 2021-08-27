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
<?php
    if(isset($_POST['enviarArquivo'])){
        // definir os formatos permitidos para upload
        $formatosPermitidos = array("pem");

        // descobrir a extensão do arquivo
        $extensao = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // realizar o upload do arquivo
        if(in_array($extensao, $formatosPermitidos)){
            // diretório de destino
            $pasta = "../storage/certificado/";

            // caminho do arquivo temporário
            $temporario = $_FILES['file']['tmp_name'];

            // gerando nome único para o novo arquivo
            $novoNome = uniqid().".$extensao";

            // upload do arquivo
            if(move_uploaded_file($temporario, $pasta.$novoNome)){

                // incluindo nome do arquivo na sessão, para ser utilizado em info_certificado.php
                $_SESSION['nome_certificado'] = $novoNome;

                // passando $nome_certificado na url utilizando o GET
                echo "<script> 
                        alert('Upload feito com sucesso!'); 
                        window.location.href='../public/info_certificado.php'
                        </script>";
                
            }else{
                echo "<script> 
                        alert('Erro no upload do arquivo!'); 
                        </script>";
            }
            
        }else{
            echo "<script> 
                        alert('Erro no upload do arquivo, extensão inválida!'); 
                    </script>"; 
        }
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

    <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method= "POST" enctype= "multipart/form-data" >
        <input type="file" name="file"/><br><br>
        <input type="submit" name="enviarArquivo" value="Enviar"/><br><br>
    </form>

    

    <a href="../public/logout.php">Logout</a>
</body>
</html>