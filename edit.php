<?php
    include_once('conexaoDB.php');
    
?>
<?= include_once('templates/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Editar perfil</h1>
            <form action="actions/editUser.php" method="POST">
                <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $_SESSION['nome_usuario'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sobrenome" class="col-sm-2 col-form-label">Sobrenome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?= $_SESSION['sobrenome_usuario'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['email_usuario'] ?>">
                    </div>
                </div>
            
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= include_once('templates/footer.php'); ?>