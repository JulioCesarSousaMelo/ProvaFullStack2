<?php
    // Iniciando Sessão
    session_start();

    // Verificar se os dados não estão vazios, se estiverem , irá redirecionar para o index.php
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

        // Incluindo arquivos
        include_once '../config/database.php';
        include_once '../model/usuarios.php';
        include_once '../model/certificado.php';
        include_once '../model/logs.php';

        // Instanciando Novos Objetos 
        $database = new Database();
        $db = $database->getConnection();

        $usuario = new Usuarios($db); 
        $certificado = new Certificado($db);
        $logs = new Logs();

        // Conexão com o Banco
        $database->getConnection();

        // Receber Dados do Formulário 
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        // Verificar login e existência de upload
        if($usuario->login($email, $senha)){

            $id = $_SESSION['id']; // parâmetro para verificarArquivo()
            $nome = $_SESSION['nome']; // parâmetro para mensagemLogin()

            if(isset($_SESSION['id'])){

                
                date_default_timezone_set('America/Sao_Paulo'); // Definindo o fuso horário de São Paulo

                $mensagemLog = $logs->mensagemLogin($nome);  // Criando Mensagem para o Log
                $logs->criarLog($mensagemLog);  // Criando Log

                if($certificado->verificarArquivo($id)){
                    if(isset($_SESSION['dn'])){
                        header("Location: ../view/info_certificado.php");
                    }else{
                        header("Location: ../view/upload_certificado.php");
                    }
                }else{
                    header("Location: ../view/upload_certificado.php");
                }
            }else{
                session_unset(); // remove todas as variáveis de sessão
                session_destroy(); // destroi a sessão
                header("Location: ../index.php");
            } 
        }else{
            session_unset(); // remove todas as variáveis de sessão
            session_destroy(); // destroi a sessão
            header("Location: ../index.php");
        }


    }else{
        session_unset(); // remove todas as variáveis de sessão
        session_destroy(); // destroi a sessão
        header("Location: ../index.php");
    }


    

    

    



