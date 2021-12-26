<?php 
   	session_start();
    require "conexao.php";
    if (isset($_SESSION['email']) && isset($_SESSION['id'])) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_ap = $_POST['id_ap'];
            $titulo = $_POST['titulo'];
            $informacao = $_POST['informacao'];
            $idTipo = $_POST['idTipo'];

            $statement = $pdo->prepare("UPDATE apontamentos(titulo, informacao, idTipo) SET (:titulo, :informacao,  :idTipo) WHERE id_ap = :id_ap");
            $statement->bindValue(':id_ap', $id_ap);
            $statement->execute();

            header("Location: ./home.php");
        }   
    }
?>