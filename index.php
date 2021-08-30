<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página de Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- =================================================================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- =================================================================== -->
    <link rel="stylesheet" href="resources/css/style.css">
    <!-- =================================================================== -->
</head>
<body>
    
    <div class="bg-dark p-4">
        <img src="resources/img/logo_horizontal_soluti.png" class="mx-auto d-block " alt="MDN logo">
    </div>
    <form action="controller/verifica_login.php" method="POST">
        <div class="container w-50">
            <div class="row g-1">
                <div class="col-md-12 mt-5">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control"></br>   
                </div>
                <div class="col-md-12">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control"></br>
                </div>
                <div class="col-md-12">
                    <button type="submit" name="btn-entrar" class="btn btn-success"> Entrar</button>
                </div>
                <div class="col-md-12 mt-3">
                    <p>Ainda não possui <a href="./view/cadastro.php" >cadastro ?</a></p>
                </div>
            </div>
        </div>
    </form>
    <footer class="background-footer p-5">
        <p class="text-white">Feito por @Júlio César S. Melo</p>
    </footer>
</body>
</html>