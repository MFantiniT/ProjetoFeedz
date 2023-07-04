<?php
 include_once('helpers/url.php');
 include_once('functions.php');
 session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="caminho/para/o/seu/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Login - Banco de Talentos</title>
  </head>
  <body>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h1 class="text-center mb-4">BankFellas</h1>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center mb-4">Login</h5>
              <?= exibeMensagemSession() ?>
              <form action="<?=$BASE_URL?>actions/processa_login.php" method="post">
                <div class="mb-3">
                  <label for="email" class="form-label">Endereço de email</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">Nós nunca compartilharemos seu email com ninguém.</div>
                </div>
                <div class="mb-3">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control" id="senha" name="senha">
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">Entrar</button>
              </form>
              <div class="mt-3">
                <a href="#">Esqueceu a senha?</a>
              </div>
              <div class="mt-3">
                <p class="text-center">Não tem uma conta? <a href="<?=$BASE_URL?>cadastrar.php">Cadastre-se</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php  include_once("templates/footer.php") ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Hj8Y6AsQyA7ELTnqzvB5M2gu0tGMJk3o8NX7ckAGWDU7Q48h76zELr7Er1t1wHjG" crossorigin="anonymous"></script>

  </body>
</html>