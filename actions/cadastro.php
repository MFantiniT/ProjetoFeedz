<?php
 include_once('../conexaoDB.php');
 

 $nome = $_POST['nome'];
 $sobrenome = $_POST['sobrenome'];
 $email = $_POST['email'];
 $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
 $empresa = $_POST['empresa'];
 session_start();
 try {   
    $sql = "INSERT INTO usuarios(nome, sobrenome, email, senha_hash, empresa) VALUES (:nome, :sobrenome, :email, :senha, :empresa)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":sobrenome", $sobrenome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);
    $stmt->bindParam(":empresa", $empresa);
    $stmt->execute();
    header("Location: ../login.php");
    $_SESSION['mensagem']= "Cadastro concluído com sucesso!";
 } catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062){
        $_SESSION['mensagem']= "Este email já esta cadastrado";
        
        header("Location: ../cadastrar.php");
        exit();
    } else {
        echo "Erro: " . $e->getMessage();
    }
}


?>