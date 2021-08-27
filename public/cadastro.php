<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
</head>
<body>
    <form onsubmit="cadastroUsuario()">
            <label>Nome</label>
                <input type="text" name="nome" id="nome" required></br>
            <label>CPF</label>
                <input type="text" name="cpf" id="cpf" required></br>
            <label>Data de Nascimento </label>
                <input type="text" name="data_nascimento" id="data_nascimento" required></br>
            <label>Telefone</label>
                <input type="text" name="telefone" id="telefone" required></br>
            <label>E-mail</label>
                <input type="email" name="email" id="email" required></br>      
            <label>Senha</label>
                <input type="password" name="senha" id="senha" required></br>
            <label>Endereço</label>
                <input type="text" name="endereco" id="endereco" required></br>
            <input type="submit" id="send" value="Cadastrar">
    </form>

    <p>Fazer <a href="../index.php"> login</a></p>


    <!-- CHAMANDO SCRIPTS JS-->
    <script src="../resources/js/post.js"></script>
</body>
</html>