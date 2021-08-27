<?php
    // Iniciando Sessão
    session_start();

    // Verificar se os dados não estão vazios, senão redirecionar para o index.php
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

        // Incluindo arquivos
        include_once '../config/database.php';
        include_once '../app/usuarios.php';

        // Instanciando Novos Objetos 
        $database = new Database();

        $db = $database->getConnection();
        $usuario = new Usuarios($db);

        // Conexão com o Banco
        $database->getConnection();

        // Receber Dados do Formulário 
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        // Verificar login
        if($usuario->login($email, $senha)){
            if(isset($_SESSION['id'])){
                header("Location: upload_certificado.php");
            }else{
                session_unset(); // remove todas as variáveis de sessão
                session_destroy(); // destroi a sessão
                header("Location: http://localhost:8080/ProvaFullStack2/");
            } 
        }else{
            session_unset(); // remove todas as variáveis de sessão
            session_destroy(); // destroi a sessão
            header("Location: http://localhost:8080/ProvaFullStack2/");
        }


    }else{
        session_unset(); // remove todas as variáveis de sessão
        session_destroy(); // destroi a sessão
        header("Location: http://localhost:8080/ProvaFullStack2/");
    }


    

    

    



