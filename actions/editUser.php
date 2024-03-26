<?php
include_once('conexaoDB.php');
include_once('../functions.php');

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$id_usuario = $_POST['id_usuario'];

editUser($conn, $id_usuario, $nome, $sobrenome, $email);