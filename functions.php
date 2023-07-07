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

    function enviarFeedback($conn){

    }

    function feedbackRecebidos($conn, $id){
        $sql = "SELECT f.*, u.nome AS nome_remetente FROM feedback f
                INNER JOIN usuarios u ON f.id_remetente = u.id_usuario
                WHERE f.id_destinatario = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function feedbackEnviados($conn, $id){
        $sql = "SELECT f.*, u.nome AS nome_destinatario FROM feedback f
                INNER JOIN usuarios u ON f.id_destinatario = u.id_usuario
                WHERE f.id_remetente = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function conteudoFeedback($conn, $id){
        $sql="SELECT f.mensagem, 
              CONCAT(u1.nome, ' ', u1.sobrenome) AS remetente, 
              CONCAT(u2.nome, ' ', u2.sobrenome) AS destinatario
              FROM feedback f
              INNER JOIN usuarios u1 ON f.id_remetente = u1.id_usuario
              INNER JOIN usuarios u2 ON f.id_destinatario = u2.id_usuario
              WHERE f.id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    


?>