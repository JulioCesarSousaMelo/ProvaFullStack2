<?php
    // Iniciando Sessão
    session_start();

    // Verificar se os dados não estão vazios, se estiverem , irá redirecionar para o index.php
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

        // Incluindo arquivos
        include_once '../config/database.php';
        include_once '../model/usuarios.php';
        include_once '../model/certificado.php';

        // Instanciando Novos Objetos 
        $database = new Database();
        $db = $database->getConnection();

        $usuario = new Usuarios($db); 
        $certificado = new Certificado($db);

        // Conexão com o Banco
        $database->getConnection();

        // Receber Dados do Formulário 
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        // Verificar login e existência de upload
        if($usuario->login($email, $senha)){

            $id = $_SESSION['id'];

            if(isset($_SESSION['id'])){

                if($certificado->verificarArquivo($id)){
                    if(isset($_SESSION['dn'])){
                        header("Location: ../public/info_certificado.php");
                    }else{
                        header("Location: ../public/upload_certificado.php");
                    }
                }else{
                    header("Location: ../public/upload_certificado.php");
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


    

    

    



