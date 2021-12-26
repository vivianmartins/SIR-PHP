<?php
require_once './conexao.php';
session_start();

$idUtiliz =  $_SESSION['id'];
$statement = $pdo->prepare("UPDATE utilizadores SET ativo='0' WHERE idUtiliz = :id");
$statement->bindValue(':id', $idUtiliz);
$statement->execute();

/* Falta redirecionar*/
header('Location: ./logout.php');
?>

