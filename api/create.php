<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../app/usuarios.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Usuarios($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nome = $data->nome;
    $item->cpf = $data->cpf;
    $item->telefone = $data->telefone;
    $item->email = $data->email;
    $item->data_nascimento = $data->data_nascimento;
    $item->senha = $data->senha;
    $item->endereco = $data->endereco;

    if($item->createUsuarios()){
        echo 'Usuário criado com sucesso.';
    } else{
        echo 'Usuário não foi criado.';
    }
?>