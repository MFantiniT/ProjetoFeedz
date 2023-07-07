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
        $sql = "SELECT * FROM feedback WHERE id_destinatario = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;

    }


?>