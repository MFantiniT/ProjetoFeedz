<?php
    session_start();
    $_SESSION['id_usuario'] == null;
    header("location: ../login.php");
    $_SESSION['mensagem'] = "Usuário deslogado!";
?>