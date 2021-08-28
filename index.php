<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
</head>
<body>
    <h1>Login</h1>
    <hr>
    <form action="public/verifica_login.php" method="POST">
        <label>E-mail</label>
            <input type="email" name="email" ></br>      
        <label>Senha</label>
            <input type="password" name="senha" ></br>
        <button type="submit" name="btn-entrar"> Entrar</button>
    </form>

    <p>Ainda não possui <a href="public/cadastro.php">cadastro ?</a></p>
</body>
</html>