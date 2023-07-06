<?php
    include_once('templates/header.php');
?>
<!-- Conteúdo principal -->
<div class="container">
    <div class="row">
        <!-- Lista de feedbacks -->
        <div class="col-md-4">
            <h2>Feedbacks recebidos</h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="#">Feedback 1</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Feedback 2</a>
                </li>
                <!-- Adicione mais itens de feedback conforme necessário -->
            </ul>
        </div>
        <!-- Feedback selecionado -->
        <div class="col-md-8">
            <h2>Feedback selecionado</h2>
            <div id="selected-feedback">
                <!-- As informações do feedback selecionado serão exibidas aqui -->
            </div>
        </div>
    </div>
</div>










<?php
    include_once('templates/footer.php');
?>