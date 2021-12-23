<?php
require_once './conexao.php';

if(isset($_POST['registar'])){

    $nome = $_POST['nome'];
    $email = $_POST ['email'];
    $senha = $_POST['senha'];

    $hashed_senha = password_hash( $senha, PASSWORD_DEFAULT);

    try{
        $SQLInsert = "INSERT INTO utilizadores (nome, email, senha)
        values (:nome,  :email, :senha)";

        $statement = $pdo -> prepare ($SQLInsert);
        $statement -> execute (array(':nome' => $nome, ':email' => $email, ':senha' => $hashed_senha ));

        if($statement-> rowCount() == 1) {
            $result = header('location: index.php');

        }
    }catch(PDOException $e){
            echo "erro: " .$e->getMessage();
        }
    }
?>