<?php 

class Logs{

    // .............................................................. //
    //                                                                //
    //  Abre um arquivo de log, insere informações e fecha o mesmo    //
    //                                                                //
    // .............................................................. //
    public function criarLog($mensagemLog){

        $arquivo = fopen("../storage/log/log.txt", "a");
        fwrite($arquivo, $mensagemLog);
        fclose($arquivo);
    }

    // .............................................................. //
    //                                                                //
    //  Gera uma mensagem de Login no sistema, para ser usada na      //
    //  função criarLog()                                             //
    //                                                                //
    // .............................................................. //
    public function mensagemLogin($nome){
        $mensagemLog = "[Usuário: " . $nome . "] - [Ação: Login no Sistema] - [Data/Hora: " . date('d/m/Y \à\s H:i:s') . "]\n";

        return $mensagemLog;
    }

    // .............................................................. //
    //                                                                //
    //  Gera uma mensagem de Upload de certificado, para ser usada    //
    //  na função criarLog()                                          //
    //                                                                //
    // .............................................................. //
    public function mensagemUpload($nome){
        $mensagemLog = "[Usuário: " . $nome . "] - [Ação: Upload de Arquivo] - [Data/Hora: " . date('d/m/Y \à\s H:i:s') . "]\n";

        return $mensagemLog;
    }
}