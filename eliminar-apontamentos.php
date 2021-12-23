<?php 
   	session_start();
    require "conexao.php";

    var_dump($id_ap);
    $statement = $pdo->prepare("UPDATE apontamentos SET ativo='0' WHERE $id_ap = :id_ap");
    $statement->bindValue(':idTipo', $_SESSION['id']);
    $statement->execute();
    $cards = $statement->fetchAll(PDO::FETCH_ASSOC);
     
    if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    }   


?>