<?php 
   	session_start();
    require "conexao.php";
    if (isset($_SESSION['email']) && isset($_SESSION['id'])) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_ap = $_POST['id_ap'];

            $statement = $pdo->prepare("UPDATE apontamentos SET ativo='1' WHERE id_ap = :id_ap");
            $statement->bindValue(':id_ap', $id_ap);
            $statement->execute();

            header("Location: ./lixo.php");
        }   
    }
?>