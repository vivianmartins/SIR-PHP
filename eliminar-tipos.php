<?php 
   	session_start();
    require "conexao.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idTipo = $_POST['idTipo'];

        var_dump($idTipo);
        $statement = $pdo->prepare("UPDATE tipo SET ativo='0' WHERE $idTipo = :idTipo");
        $statement->bindValue(':idTipo', $_SESSION['id']);
        $statement->execute();
        $cards = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
        }   
}


?>