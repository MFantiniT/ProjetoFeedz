<?php
    include_once('templates/header.php');
 // Pega o ID do usuário logado
 $id_usuario = $_SESSION['id_usuario'];

 // Pega o feedbacks do usuário
 $feedbacks_recebidos = feedbackRecebidos($conn, $id_usuario)->fetchAll();
?>

<!-- Conteúdo principal -->
<div class="container mt-4">
 <div class="row">
     <div class="col-md-4">
         <!-- Botão de enviar feedback -->
         <div class="mb-2">
             <button class="btn btn-primary" data-toggle="modal" data-target="#newFeedbackModal">Enviar feedback</button>
         </div>
         <!-- Abas de feedbacks -->
         <ul class="nav nav-tabs">
             <li class="nav-item">
                 <a class="nav-link active" data-toggle="tab" href="#received">Recebidos</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="tab" href="#sent">Enviados</a>
             </li>
         </ul>
         <!-- Conteúdo das abas -->
         <div class="tab-content">
             <!-- Feedbacks recebidos -->
             <div class="tab-pane fade show active" id="received">
                 <ul class="list-group mt-2">
                     <?php foreach ($feedbacks_recebidos as $feedback) : ?>
                         <li class="list-group-item">
                             <a href="#"><?= $feedback['mensagem']; ?></a>
                         </li>
                     <?php endforeach; ?>
                 </ul>
             </div>
             <!-- Feedbacks enviados -->

         </div>
     </div>
     <!-- Feedback selecionado -->
     <div class="col-md-8">
         <h2>Feedback selecionado</h2>
         <div id="selected-feedback">
             <!-- As informações do feedback selecionado serão exibidas aqui -->
         </div>  
         
         <!-- Campo de resposta do feedback -->
         <div id="response-field" class="mt-4">
             <h3>Resposta</h3>
             <textarea class="form-control" rows="3"></textarea>
             <button class="btn btn-primary mt-2">Enviar resposta</button>
         </div>

     </div>
 </div>
</div>

<!-- Modal para enviar um novo feedback -->
<div class="modal fade" id="newFeedbackModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enviar feedback</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para enviar feedback -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </div>
</div>
<?php
    include_once('templates/footer.php');
?>
