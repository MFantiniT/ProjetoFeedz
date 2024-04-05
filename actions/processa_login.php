<?php
 include_once('../conexaoDB.php');

 
 session_start();

 //Recebe os valores do formulário
 $usuario = $_POST['email'];
 $senha = $_POST['senha'];

 //Consulta Banco de dados
 $sql = "SELECT * FROM usuarios WHERE email=:usuario";
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(":usuario", $usuario);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);

 //Autenticação de login
 if($result['email'] == $usuario && password_verify($senha, $result['senha_hash'])){
    $_SESSION['mensagem']= "Olá ".$result['nome']." você está logado!!";
    $_SESSION['id_usuario'] = $result['id_usuario']; // 
    $_SESSION['nome_usuario'] = $result['nome'];
    $_SESSION['sobrenome_usuario'] = $result['sobrenome'];
    $_SESSION['email_usuario'] = $result['email'];
    $_SESSION['img_perfil'] = $result['img'];    

    header("Location: ../dashboard.php");

} else {
    $_SESSION['mensagem'] = "Nome de usuário ou senha incorretos.";
    header("Location: ../login.php");
 }
?>
