<?php
include_once('templates/header.php');
$recebidos = countRecebidos($conn, $_SESSION['id_usuario']);
$enviados = countEnviados($conn, $_SESSION['id_usuario']);
?>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm card1-adjust">
            <a href="#">
                <div class="card-body">
                    <h5 class="card-title">FeedBacks recebidos</h5>
                    <p class="card-text"><?=$recebidos?></p>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm card-adjust">
            <a href="#">
                <div class="card-body">
                    <h5 class="card-title">Feedbacks enviados</h5>
                    <p class="card-text"><?=$recebidos?></p>
                </div>
            </a>
        </div>
    </div>
    <!-- Adicione mais estatísticas conforme necessário -->
</div>

<?php
include_once('templates/footer.php');
?>
