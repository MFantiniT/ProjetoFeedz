<?php
include_once('conexaoDB.php');
include_once('functions.php');
//verifica as notificações
// verifica se o usuário está logado
session_start();
$notifications = exibeNotificacao($conn, $_SESSION['id_usuario']);
if (!isset($_SESSION['id_usuario'])) {
    // se o usuário não estiver logado ele volta para a tela de login
    header("Location: ./login.php");
    exit; // garante que o resto do código não sera executado
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FeedCycle</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/your_custom_style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">FeedCycle</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feedbacks.php">Feedbacks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="onboarding.php">Onboarding</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach($notifications as $notification):?>
                                <?php if($notification['status']==0): ?>
                            <a class="dropdown-item" href="actions/statusfeedback.php?id_feedback=<?=$notification['id'] ?>">Novo feedback de <?=$notification['nome']." ".$notification['sobrenome'] ?></a>
                            <?php endif; ?>
                            <!-- <div class="dropdown-divider"></div> -->
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <li class=nav-item>
                        <a href="" class=nav-link>
                            Olá <?= $_SESSION['nome_usuario'] ?>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            Perfil
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="edit.php">Editar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="actions/logout.php">Sair</a>
                        </div>
                    </li>
                    <li>
                        <div id="imgperfil">
                            <img src="img/<?= $_SESSION['img_perfil'] ?>" alt="Logo" style="width:40px; height:40px; border-radius: 50%;">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>