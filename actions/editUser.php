<?php
include_once('../conexaoDB.php');
include_once('../functions.php');

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$id_usuario = $_POST['id_usuario'];
$nomeArquivoHash = '';

//carrega a img de perfil, salva o nome com uma hash no banco e a foto salva na pasta sinalizada.
if (isset($_FILES['img'])) {
    session_start();
    $pastaDestino = $pastaDestino = "C:\\xampp\\htdocs\\ProjetoFeedz\\img\\";
    $nomeArquivoOriginal = $_FILES['img']['name'];
    $extensao = pathinfo($nomeArquivoOriginal, PATHINFO_EXTENSION);
    $nomeArquivoHash = md5(uniqid()) . '.' . $extensao;
    unset($_SESSION['img_perfil']);
    $_SESSION['img_perfil'] = $nomeArquivoHash;
    if (!move_uploaded_file($_FILES['img']['tmp_name'], $pastaDestino . $nomeArquivoHash)) {
        die('Erro ao mover o arquivo.');
    }
    
}

editUser($conn, $id_usuario, $nome, $sobrenome, $email, $nomeArquivoHash);