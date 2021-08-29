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

    event.preventDefault(); // cancela o evento

    let url = "../routes/create.php";  // define a URL 

    // armazena os valores dos INPUTS do formulário
    let nome = document.getElementById("nome").value;
    let cpf = document.getElementById("cpf").value;
    let telefone = document.getElementById("telefone").value;
    let email = document.getElementById("email").value;
    let data_nascimento = document.getElementById("data_nascimento").value;
    let senha = document.getElementById("senha").value;
    let endereco = document.getElementById("endereco").value;

    // Formata a data para o padrão YYYY-mm-dd
    var dia  = data_nascimento.split("/")[0];
    var mes  = data_nascimento.split("/")[1];
    var ano  = data_nascimento.split("/")[2];
    
    data_nascimento_formatada = ano + '-' + ("0"+mes) .slice(-2) + '-' + ("0"+dia).slice(-2);

    // define o BODY em formato JSON
    body = {
        "nome": nome,
        "cpf": cpf, 
        "data_nascimento": data_nascimento_formatada,
        "telefone": telefone,
        "email": email,
        "senha": senha,
        "endereco": endereco
    }

    // realiza o POST com a URL e o BODY
    postUsuario(url, body);

    alert("Usuário Cadastrado com sucesso !!!");
    window.location.href='../index.php';
    
}