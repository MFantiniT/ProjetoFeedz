<?php
//verifica as notificações
session_start();
$notifications = exibeNotificacao($conn, $_SESSION['id_usuario']);
$countNotifications = countNotifications($conn, $_SESSION['id_usuario']);
// verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // se o usuário não estiver logado ele volta para a tela de login
    header("Location: ./login.php");
    exit; // garante que o resto do código não sera executado
}
