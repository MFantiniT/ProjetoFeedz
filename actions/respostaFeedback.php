<?php 
include_once('../functions.php');
include_once('../conexaoDB.php');
session_start();
$id_feedback = $_GET['id_feedback'];
RespostaFeedback($conn, $_GET['id_feedback'], $_SESSION['id_usuario'], $_POST['mensagem'], 0);
header("location: ../feedbacks.php?id_feedback=$id_feedback");











// function RespostaFeedback($conn, $id_feedback, $id_usuario, $mensagem, $status){
//     session_start();
//     try {
//         $sql = "INSERT INTO respostas(id_feedback, id_usuario, mensagem, status) VALUES (:id_feedback, :id_usuario, :mensagem, :status)";
//         $stmt = $conn->prepare($sql);
//         $stmt->bindParam(":id_feedback", $id_feedback);
//         $stmt->bindParam(":id_usuario", $id_usuario);
//         $stmt->bindParam(":mensagem", $mensagem);
//         $stmt->bindParam(":status", $status);
//     } catch (PDOException $e) {
//         error_log("Erro: ". $e->getMessage());
//         echo "ocorreu um erro ao responder o feedback";
//     }
// }
?>