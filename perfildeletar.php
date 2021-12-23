<?php
require_once './conexao.php';
session_start();

$idUtiliz =  $_SESSION['id'];

$statement = $pdo->prepare("DELETE FROM utilizadores WHERE idUtiliz = :id");
$statement->bindValue(':id', $idUtiliz);
$statement->execute();

/* Falta redirecionar*/
header('Location:login.php');
?>

