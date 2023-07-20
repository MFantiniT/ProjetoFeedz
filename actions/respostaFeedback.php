<?php include_once('../functions.php');
include_once('../conexaoDB.php');














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