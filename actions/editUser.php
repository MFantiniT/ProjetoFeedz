<?php
include_once('../conexaoDB.php');
include_once('../functions.php');

session_start();

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$id_usuario = $_POST['id_usuario'];
$nomeArquivoHash = '';

// Verifica se há um arquivo e se o erro de upload é igual a UPLOAD_ERR_OK
if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
    $pastaDestino = "C:\\xampp\\htdocs\\ProjetoFeedz\\img\\";
    $nomeArquivoOriginal = $_FILES['img']['name'];
    $extensao = pathinfo($nomeArquivoOriginal, PATHINFO_EXTENSION);
    $nomeArquivoHash = md5(uniqid()) . '.' . $extensao;
    
    if (move_uploaded_file($_FILES['img']['tmp_name'], $pastaDestino . $nomeArquivoHash)) {
        $_SESSION['img_perfil'] = $nomeArquivoHash;
    } else {
        die('Erro ao mover o arquivo.');
    }
} else {
    // Se não houver arquivo enviado, mantém o nome da imagem de perfil atual (se existir)
    if(isset($_SESSION['img_perfil'])) {
        $nomeArquivoHash = $_SESSION['img_perfil'];
    }
}

// Chama a função de edição do usuário com o nome da imagem, que pode ser o hash novo ou o antigo
editUser($conn, $id_usuario, $nome, $sobrenome, $email, $nomeArquivoHash);