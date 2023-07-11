<?php
 include_once('../conexaoDB.php');
 include_once('functions.php');




 $id_remetente = $_POST['id_remetente'];
 $id_destinatario = $_POST['id_destinatario'];
 $mensagem = $_POST['mensagem'];
 $status = 0;
 $tipo_feedback = $_POST['tipo_feedback'];



 enviarFeedback($conn, $id_remetente, $id_destinatario, $mensagem, $status, $tipo_feedback);