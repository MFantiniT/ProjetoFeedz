<?php
include_once('../conexaoDB.php');
$id_feedback = $_GET['id_feedback'];

$sql = "UPDATE feedback SET status = '1' WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam('id', $id_feedback);
$stmt->execute();
header('Location: ../feedbacks.php?id_feedback=' . $id_feedback);
