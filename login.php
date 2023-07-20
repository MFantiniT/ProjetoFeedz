<?php 
    include_once('functions.php');
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <?php exibeMenssagemSession(); ?>
                        <form action="actions/processa_login.php" method="post">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="senha" placeholder="senha">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Login</button>
                            <div class="form-group">
                                <a href="#" data-toggle="modal" data-target="#registerModal">Registrar-se</a>
                                <a href="#" data-toggle="modal" data-target="#forgotPasswordModal" class="float-right">Esqueceu sua senha?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- registro Modal -->
<div class="modal" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Registro</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="actions/cadastro.php" method="post">
                    <div class="form-group">
                        <label for="registerNome">Nome</label>
                        <input type="text" class="form-control" id="registerNome" name="nome" placeholder="Insira seu nome" required>
                    </div>
                    <div class="form-group">
                        <label for="registerSobrenome">Sobrenome</label>
                        <input type="text" class="form-control" id="registerSobrenome" name="sobrenome" placeholder="Insira seu sobrenome" required>
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Insira seu email" required>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Senha</label>
                        <input type="password" class="form-control" id="registerPassword" name="senha" placeholder="Insira sua senha" required>
                    </div>
                    <div class="form-group">
                        <label for="registerEmpresa">Empresa</label>
                        <input type="text" class="form-control" id="registerEmpresa" name="empresa" placeholder="Insira o nome da empresa">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- PErdi minha senha Modal -->
<div class="modal" id="forgotPasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Esqueceu a Senha?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="process_forgot_password.php" method="post">
                    <div class="form-group">
                        <label for="forgotEmail">Endereço de Email</label>
                        <input type="email" class="form-control" id="forgotEmail" name="email" placeholder="Insira seu email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Redefinir Senha</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- jQuery e Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
