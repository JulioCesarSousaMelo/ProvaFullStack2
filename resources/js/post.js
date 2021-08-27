function postUsuario(url, body){

    // criando novo objeto XMLHttpRequest 
    let request = new XMLHttpRequest();

    // inicializa uma nova requisição
    request.open("POST", url, true);

    // define o valor do cabeçalho de uma requisição
    request.setRequestHeader("Content-type", "application/json");

    // envia uma requisição para o servidor.
    request.send(JSON.stringify(body));

    // conteúdo retornado
    request.onload = function(){
        console.log(this.responseText);
    }

    return request.responseText;

}

function cadastroUsuario(){

    event.preventDefault(); // cancela o EVENTO se for cancelável

    let url = "http://localhost:8080/provafullstack2/routes/create.php";  // define a URL 

    // armazena os valores dos INPUTS do formulário
    let nome = document.getElementById("nome").value;
    let cpf = document.getElementById("cpf").value;
    let telefone = document.getElementById("telefone").value;
    let email = document.getElementById("email").value;
    let data_nascimento = document.getElementById("data_nascimento").value;
    let senha = document.getElementById("senha").value;
    let endereco = document.getElementById("endereco").value;



    // define o BODY em formato JSON
    body = {
        "nome": nome,
        "cpf": cpf, 
        "telefone": telefone,
        "email": email,
        "data_nascimento": data_nascimento,
        "senha": senha,
        "endereco": endereco
    }

    postUsuario(url, body); // realiza o POST com a URL e o BODY

    alert("Usuário Cadastrado com sucesso !!!"); // gerando um alert
    window.location.href='index.php'; // redireciona para a pagina inicial

}