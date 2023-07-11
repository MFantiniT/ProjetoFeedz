<?php
    include_once('templates/header.php');
 // Pega o ID do usuário logado
 $id_usuario = $_SESSION['id_usuario'];
 //Pega os usuários que existem para poder selecionar um destinatário
 $usuarios = getUsuarios($conn);
 // Pega o feedbacks do usuário
 $feedbacks_recebidos = feedbackRecebidos($conn, $id_usuario);
 $feedbacks_enviados = feedbackEnviados($conn, $id_usuario);
 if(isset($_GET['id_feedback'])){
    $feedbacks_conteudo = conteudoFeedback($conn, $_GET['id_feedback']);
    // verificação de segurança
    if($id_usuario == $feedbacks_conteudo['id_destinatario'] || $id_usuario == $feedbacks_conteudo['id_remetente']) {
        $data = formataDate($feedbacks_conteudo['data']);
    } else {
        die("Você não tem permissão para ver este feedback.");
    }
}
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
                             <a href="?id_feedback=<?=$feedback['id']?>"><?= $feedback['nome_remetente']; ?></a>
                         </li>
                     <?php endforeach; ?>
                 </ul>
             </div>
             <!-- Feedbacks enviados -->
             <div class="tab-pane fade" id="sent">
                 <ul class="list-group mt-2">
                     <?php foreach ($feedbacks_enviados as $feedback) : ?>
                         <li class="list-group-item">
                             <a href="?id_feedback=<?=$feedback['id']?>"><?= $feedback['nome_destinatario']; ?></a>
                         </li>
                     <?php endforeach; ?>
                 </ul>
             </div>                   
         </div>
     </div>
                        
            <!-- Feedback selecionado -->
        <?php if(isset($feedbacks_conteudo['remetente'])&& isset($feedbacks_conteudo['mensagem'])&& isset($data)): ?>                
            <div class="col-md-8">
                <h2>Feedback selecionado</h2>
                <div id="selected-feedback" class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?=$feedbacks_conteudo['remetente']?> -> <?=$feedbacks_conteudo['destinatario'] ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?=$feedbacks_conteudo['mensagem']?></p>
                    </div>
                    <div class="card-footer">
                        <?=$data?>
                    </div>
                </div>             
                <!-- Campo de resposta do feedback -->
                <div id="response-field" class="mt-4">
                    <h3>Resposta</h3>
                    <textarea class="form-control" rows="3"></textarea>
                    <button class="btn btn-primary mt-2">Enviar resposta</button>
                </div>
            </div>  
        <?php endif; ?>

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
                <form action="actions/enviaFeedback.php" method="POST">
                    <input type="hidden" name="id_remetente" value="<?= $_SESSION['id_usuario'] ?>">

                    <div class="form-group">
                        <label for="id_destinatario">Para:</label>
                        <select class="form-control" id="id_destinatario" name="id_destinatario">
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?= $usuario['id_usuario'] ?>"><?= $usuario['nome'] ?> <?=$usuario['sobrenome']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo de Feedback:</label>
                        <select class="form-control" id="tipo" name="tipo_feedback">
                            <option value="Neutro">neutro</option>
                            <option value="Positivo">positivo</option>
                            <option value="Construtivo">construtivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mensagem">Feedback:</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Enviar Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include_once('templates/footer.php');
?>
