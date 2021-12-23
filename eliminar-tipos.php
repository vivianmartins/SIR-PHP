<?php 
   	session_start();
    require "conexao.php";
    if (isset($_SESSION['email']) && isset($_SESSION['id'])) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idTipo = $_POST['idTipo'];

            $statement = $pdo->prepare("UPDATE tipo SET ativo='0' WHERE $idTipo = :idTipo");
            $statement->bindValue(':idTipo', $idTipo);
            $statement->execute();
        }   
    }
?>