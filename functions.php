    <?php
        function exibeMenssagemSession(){
            // session_start();
            if (isset($_SESSION['mensagem'])) {
                echo "<p style='text-align: center;'>" . $_SESSION['mensagem'] . "</p>";
                unset($_SESSION['mensagem']);
            }
        }

        // funçoes feedback's
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
                $stmt->execute();
                $_SESSION['mensagem'] = "Feedback enviado com sucesso!!";
                header("location: ../feedbacks.php");
            } catch(PDOException $e){
                error_log("Erro: ". $e->getMessage());
                echo "ocorreu um erro ao enviar o feedback";
            }
        }

        function feedbackRecebidos($conn, $id){
            $sql = "SELECT f.*, u.id_usuario AS id_remetente, u.nome AS nome_remetente, u.img AS img_remetente
            FROM feedback f
            INNER JOIN usuarios u ON f.id_remetente = u.id_usuario
            WHERE f.id_destinatario = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        function feedbackEnviados($conn, $id){
            $sql = "SELECT f.*, u.id_usuario AS id_destinatario, u.nome AS nome_destinatario, u.img AS img_destinatario FROM feedback f
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
        function RespostaFeedback($conn, $id_feedback, $id_usuario, $mensagem, $status){
            session_start();
            try {
                $sql = "INSERT INTO respostas(id_feedback, id_usuario, mensagem, status) VALUES (:id_feedback, :id_usuario, :mensagem, :status)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id_feedback", $id_feedback);
                $stmt->bindParam(":id_usuario", $id_usuario);
                $stmt->bindParam(":mensagem", $mensagem);
                $stmt->bindParam(":status", $status);
                $stmt->execute();
                $_SESSION['mensagem']="Resposta enviada com sucesso!!";
                
            } catch (PDOException $e) {
                error_log("Erro: ". $e->getMessage());
                echo "ocorreu um erro ao responder o feedback";
            }
        }
        function exibeRespostas($conn, $id_feedback){
            try {
                $sql = "SELECT respostas.*, usuarios.nome
                        FROM respostas 
                        JOIN usuarios ON respostas.id_usuario = usuarios.id_usuario 
                        WHERE respostas.id_feedback=:id_feedback";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_feedback', $id_feedback);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Erro: ". $e->getMessage());
                echo "<p style='text-align: center;'> ocorreu um erro ao exibir as respostas</p>";
            }
        }
        
        //formata a data do feedback para o formato padrão.
        function formataDate($datafeedback){
            $data = DateTime::createFromFormat('Y-m-d H:i:s', $datafeedback);
            $data_formatada = $data->format('d/m/Y H:i:s');
            return $data_formatada;
        }
        //exibe a lista de funcionários para selecionar a quem enviar o feedback. 
        function getUsuarios($conn){
            $sql = "SELECT * FROM usuarios";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        function trocaSenha($conn, $id_usuario, $senha_antiga, $senha_nova){
            $sql = "SELECT senha_hash FROM usuarios WHERE id_usuario = :id_usuario";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id_usuario", $id_usuario);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($senha_antiga, $result['senha_hash'])){
                $sql = "UPDATE usuarios SET senha_hash = :senha_nova WHERE id_usuario = :id_usuario";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":senha_nova", $senha_nova);
                $stmt->bindParam(":id_usuario", $id_usuario);
                $stmt->execute();
                return true;
            } else {
                return false;
            }
        }

        //funções Dashboard
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

        //editar users

        function editUser($conn, $id_usuario, $nome, $sobrenome, $email, $img){
            $sql = "UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome, email = :email, img = :img WHERE id_usuario = :id_usuario";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":sobrenome", $sobrenome);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id_usuario", $id_usuario);
            $stmt->bindParam(":img", $img);
            $stmt->execute();
            session_start();
            $_SESSION['nome_usuario'] = $nome;
            $_SESSION['sobrenome_usuario'] = $sobrenome;
            $_SESSION['email_usuario'] = $email;
            $_SESSION['img']= $img;
            $_SESSION['mensagem'] = "Usuário editado com sucesso!!";   
            header("location: ../dashboard.php");
        }
        ?>
                