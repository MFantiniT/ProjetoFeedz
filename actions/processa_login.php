<?php
 include_once('../conexaoDB.php');
 include_once('../helpers/url.php');
 
 session_start();
 $usuario = $_POST['email'];
 $senha = $_POST['senha'];
 $sql = "SELECT * FROM usuario WHERE email=:usuario";
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(":usuario", $usuario);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);
 if($result['email'] == $usuario && password_verify($senha, $result['senha_hash'])){
    $_SESSION['mensagem']= "Olá ".$result['nome_usuario']." você está logado";
    $_SESSION['id_usuario'] = $result['id_usuario']; // 
    $_SESSION['nome_usuario'] = $result['nome_usuario'];

    header("Location: ../dashboard.php");

} else {
    $_SESSION['mensagem'] = "Nome de usuário ou senha incorretos.";
    header("Location: ../login.php");
 }
?>
