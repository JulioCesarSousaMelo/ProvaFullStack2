<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <!-- =================================================================================================================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <!-- =================================================================================================================================================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- =================================================================================================================================================== -->
</head>
<body>
    <h1>Cadastro</h1>
    <hr>
    <form action="../controller/enviar_cadastro.php" method="POST">
            <label>Nome</label>
                <input type="text" name="nome" id="nome" required></br>
            <label>CPF</label>
                <input type="text" name="cpf" id="cpf" minlength="14" maxlength="14" onkeypress="$(this).mask('000.000.000-00')"required></br>
            <label>Data de Nascimento </label>
                <input type="text" name="data_nascimento" id="data_nascimento" onkeypress="$(this).mask('00/00/0000')" required></br>
            <label>Telefone</label>
                <input type="text" name="telefone" id="telefone" onkeypress="$(this).mask('(00)00000-0000')" required></br>
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