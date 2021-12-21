<?php 
   	session_start();
    require "conexao.php";
     
    $statement = $pdo->prepare("DELETE FROM tipo WHERE $idTipo = :idTipo");
    $statement->bindValue(':idTipo', $_SESSION['id']);
    $statement->execute();
    $cards = $statement->fetchAll(PDO::FETCH_ASSOC);
     
    if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    }   

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $idTipo = filter_input(INPUT_GET, 'idTipo');
        $operacao = filter_input(INPUT_GET, 'operacao');
    
        /* validar os dados recebidos através do pedido */
        if (empty($idTipo) || $operacao!="eliminar"){
            echo "  Erro, pedido inválido ";
            exit();
        }    
    }
    else{
       echo " Erro, pedido inválido ";
       exit();
    }



?>