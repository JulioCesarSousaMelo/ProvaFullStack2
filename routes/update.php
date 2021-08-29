<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../model/usuarios.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Usuarios($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // valores do usuario 
    $item->nome = $data->nome;
    $item->cpf = $data->cpf;
    $item->data_nascimento = $data->data_nascimento;
    $item->telefone = $data->telefone;
    $item->email = $data->email;
    $item->senha = $data->senha;
    $item->endereco = $data->endereco;
    $item->dn = $data->dn;
    $item->issuer_dn = $data->issuer_dn;
    $item->validade_certificado_before = $data->validade_certificado_before;
    $item->validade_certificado_after = $data->validade_certificado_after;
    
    
    if($item->updateUsuarios()){
        echo json_encode("Dados do usuário atualizados.");
    } else{
        echo json_encode("Dados do usuários não foram atualizados.");
    }
?>