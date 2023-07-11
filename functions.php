<?php
    function exibeMensagemSession(){
        // session_start();
        if (isset($_SESSION['mensagem'])) {
            echo "<p style='text-align: center;'>" . $_SESSION['mensagem'] . "</p>";
            unset($_SESSION['mensagem']);
        }
    }

    function exibeVagas($conn){
        try {
            $sql = "SELECT * FROM vagas WHERE id_recrutador=".$_SESSION['id_usuario'];
            $stmt = $conn -> prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            error_log("Erro: " . $e->getMessage());
            echo "Ocorreu um erro. Por favor, tente novamente mais tarde.";
        }
    }

    function pesquisaVagas($conn, $pesquisa){
        try {
            $sql = "SELECT * FROM vagas WHERE titulo_vaga LIKE :pesquisa OR descricao_vaga LIKE :pesquisa OR requisitos_vaga LIKE :pesquisa";
            $pesquisa = '%' . $pesquisa . '%';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":pesquisa", $pesquisa);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            error_log("Erro: " . $e->getMessage());
            echo "Ocorreu um erro. Por favor, tente novamente mais tarde.";
        }
    }

    function enviarFeedback($conn, $id_remetente, $id_destinatario, $mensagem, $status, $tipo_feedback){
        try{
            session_start();
            $sql = "INSERT INTO feedback(id_remetente, id_destinatario, mensagem, status, tipo_feedback) VALUES (:id_remetente, :id_destinatario, :mensagem, :status, :tipo_feedback)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id_remetente", $id_remetente);
            $stmt->bindParam(":id_destinatario", $id_destinatario);
            $stmt->bindParam(":mensagem", $mensagem);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":tipo_feedback", $tipo_feedback);
            $_SESSION['mensagem'] = "Feedback enviado com sucesso!!";
            header("location: ../feedbacks.php");
        } catch(PDOException $e){
            error_log("Erro: ". $e->getMessage());
            echo "ocorreu um erro ao enviar o feedback";
        }
    }

    function feedbackRecebidos($conn, $id){
        $sql = "SELECT f.*, u.id_usuario AS id_remetente, u.nome AS nome_remetente FROM feedback f
                INNER JOIN usuarios u ON f.id_remetente = u.id_usuario
                WHERE f.id_destinatario = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function feedbackEnviados($conn, $id){
        $sql = "SELECT f.*, u.id_usuario AS id_destinatario, u.nome AS nome_destinatario FROM feedback f
                INNER JOIN usuarios u ON f.id_destinatario = u.id_usuario
                WHERE f.id_remetente = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function conteudoFeedback($conn, $id){
        $sql="SELECT f.mensagem, u1.id_usuario AS id_remetente, CONCAT(u1.nome, ' ', u1.sobrenome) AS remetente, u2.id_usuario AS id_destinatario, CONCAT(u2.nome, ' ', u2.sobrenome) AS destinatario, f.created_at as data
        FROM feedback f
        INNER JOIN usuarios u1 ON f.id_remetente = u1.id_usuario
        INNER JOIN usuarios u2 ON f.id_destinatario = u2.id_usuario
        WHERE f.id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function formataDate($datafeedback){ 
        $data = DateTime::createFromFormat('Y-m-d H:i:s', $datafeedback);
        $data_formatada = $data->format('d/m/Y H:i:s');
        return $data_formatada;
    }
    function countRecebidos($conn, $id_destinatario){
        try {
            $sql = "SELECT COUNT(*) as count FROM feedback WHERE id_destinatario = :id_destinatario";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id_destinatario", $id_destinatario);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch(PDOException $e) {
            error_log("Erro ao contar feedbacks recebidos: " . $e->getMessage());
            
            return false;
        }
    }

    function countEnviados($conn, $id_remetente){
        try {
            $sql = "SELECT COUNT(*) as count FROM feedback WHERE id_remetente = :id_remetente";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id_remetente", $id_remetente);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch(PDOException $e) {
            error_log("Erro ao contar feedbacks enviados: " . $e->getMessage());
            
            return false;
        }
    }
    function getUsuarios($conn){
        $sql = "SELECT * FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    


?>