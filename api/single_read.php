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

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleUsuarios();

    if($item->nome != null){
        // create array
        $emp_arr = array(
            "id" => $item->id,
            "nome" => $item->nome,
            "cpf" => $item->cpf,
            "telefone" => $item->telefone,
            "email" => $item->email,
            "data_nascimento" => $item->data_nascimento,
            "senha" => $item->senha,
            "endereco" => $item->endereco 
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Usuário não encontrado.");
    }
?>