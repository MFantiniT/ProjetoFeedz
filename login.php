<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
            background: #f8f9fa;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #8657db;
        }
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }
    </style>
</head>
<body>
    
    <main class="form-signin">
        <form action="login.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Entre na sua conta</h1>

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="nome@exemplo.com" required>
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Senha" required>
                <label for="floatingPassword">Senha</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>

            <div class="mt-3">
                <a href="#" data-bs-toggle="modal" data-bs-target="#esqueciModal">Esqueci minha senha</a> | 
                <a href="#">Cadastrar-se</a>
            </div>
        </form>
    </main>

    <!-- Modal para "Esqueci minha senha" -->
    <div class="modal fade" id="esqueciModal" tabindex="-1" role="dialog" aria-labelledby="esqueciModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="esqueciModalLabel">Esqueci minha senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Insira seu email para receber instruções de recuperação de senha.</p>
                    <form action="recuperar_senha.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="email" name="emailRecuperacao" class="form-control" id="emailRecuperacao" placeholder="nome@exemplo.com" required>
                            <label for="emailRecuperacao">Email</label>
                        </div>
                        <button type="submit" class="w-100 btn btn-lg btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
