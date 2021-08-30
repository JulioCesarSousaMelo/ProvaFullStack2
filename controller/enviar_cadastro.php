<?php 

    // .............................................................. //
    // Receber Dados do Formulário                                    //
    // .............................................................. //
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $senha = $_POST['senha'];

    // .............................................................. //
    // Criptografia da senha                                          //
    // .............................................................. //
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

        <script>
            function submitform() {
                document.formulario.submit();
            }

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

                // Armazena fata formatada
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

        </script>
</head>
<body>   
    <form onsubmit="cadastroUsuario()">
        <h1>CONFIRMA AS INFORMAÇÕES?</h1>

        <label>Nome</label>
            <input type="text" id="nome" value="<?php echo $nome; ?>" placeholder="<?php echo $nome; ?>" required></br>
        <label>CPF</label>
            <input type="text" id="cpf" name="cpf"  value="<?php echo $cpf; ?>" minlength="14" maxlength="14" onkeypress="$(this).mask('000.000.000-00')" placeholder="<?php echo $cpf; ?>" required ></br>
        <label>Data de Nascimento </label>
            <input type="text" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento; ?>" onkeypress="$(this).mask('00/00/0000')" placeholder="<?php echo $data_nascimento; ?>" required></br>
        <label>Telefone</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo $telefone; ?>" onkeypress="$(this).mask('(00)00000-0000')" placeholder="<?php echo $telefone; ?>" required></br>
        <label>E-mail</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $email; ?>" required></br>      
        <label>Endereço</label>
            <input type="text" id="endereco" name="endereco" value="<?php echo $endereco; ?>" placeholder="<?php echo $endereco; ?>" required></br>
            <input type="hidden" id="senha" name="senha" value="<?php echo $senhaHash; ?>" placeholder="<?php echo $senhaHash; ?>" required></br>
        <input type="submit" id="send" value="Cadastrar">
    </form>
</body>
</html>

    