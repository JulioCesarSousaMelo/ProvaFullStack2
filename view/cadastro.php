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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- =================================================================== -->
</head>
<body>
    <div class="bg-dark p-4">
        <img src="../resources/img/logo_horizontal_soluti.png" class="mx-auto d-block " alt="MDN logo">
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 mt-2">
                <h1>CADASTRO</h1>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <a class="btn btn-warning" href="../index.php">Fazer Login</a>
            </div>
            <hr class="mt-3">
        </div>
    </div>

    
        <form action="../controller/enviar_cadastro.php" method="POST">
            <div class="container w-75">
                <div class="row">
                    <div class="col-12">
                        <label class="label-control">Nome</label>
                        <input class="form-control" type="text" name="nome" id="nome" required></br>
                    </div>
                    <div class="col-6">
                        <label class="label-control">CPF</label>
                        <input class="form-control" type="text" name="cpf" id="cpf" maxlength="14" onkeypress="$(this).mask('000.000.000-00')" placeholder="000.000.000-00" required></br>
                    </div>
                    <div class="col-3">
                        <label class="label-control">Data de Nascimento </label>
                        <input class="form-control" type="text" name="data_nascimento" id="data_nascimento" onkeypress="$(this).mask('00/00/0000')" placeholder="00/00/0000" required></br>
                    </div>
                    <div class="col-3">
                        <label class="label-control">Telefone</label>
                        <input class="form-control" type="text" name="telefone" id="telefone" onkeypress="$(this).mask('(00)00000-0000')" placeholder="(00)00000-0000" required></br>
                    </div>
                    <div class="col-6">
                        <label class="label-control">E-mail</label>
                        <input class="form-control" type="email" name="email" id="email" required></br>   
                    </div>
                    <div class="col-6">
                        <label class="label-control">Senha</label>
                        <input class="form-control" type="password" name="senha" id="senha" required></br>
                    </div>
                    <div class="col-12">
                        <label class="label-control">Endereço</label>
                        <input class="form-control" type="text" name="endereco" id="endereco" required></br>
                    </div>
                    <div class="col mb-5">
                        <input type="submit" id="send" value="Cadastrar" class="btn btn-success">
                    </div>
                </div>
            </div>
        </form>
    

    <!-- CHAMANDO SCRIPTS JS-->
    <script src="../resources/js/post.js"></script>
</body>
</html>