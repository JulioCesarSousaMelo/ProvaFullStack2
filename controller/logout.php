<?php 

    session_start(); //  Iniciando sessão ou resumindo sessão existe   

    include_once '../model/logs.php'; 

    // Instanciando Objeto
    $logs = new Logs(); 

    // parâmetro para mensagemUpload()
    $nome = $_SESSION['nome']; 

    // .............................................................. //
    //  Fazendo Logout no sistema                                     //
    // .............................................................. //
    session_destroy();

    // .............................................................. //
    //  Definições para a criação do Log de Logout                    //
    // .............................................................. //
    date_default_timezone_set('America/Sao_Paulo'); // Definindo o fuso horário de São Paulo

    $mensagemLog = $logs->mensagemLogout($nome);  // Criando Mensagem para o Log
    $logs->criarLog($mensagemLog);  // Criando Log
    
    header("Location: ../index.php");