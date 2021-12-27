<?php
require_once './conexao.php';
session_start();

if(isset($_POST['registar'])){

    $nome = $_POST['nome'];
    $email = $_POST ['email'];
    $senha = $_POST['senha'];

    $hashed_senha = password_hash( $senha, PASSWORD_DEFAULT);

    try{
        // Procura por um registo com o mesmo email
        $st = $pdo->prepare('SELECT * FROM utilizadores WHERE email = :email');
        $st->bindValue(':email', $email);
        $st->execute();
        $res = $st->fetchAll(PDO::FETCH_ASSOC);

        // Se nao existir um registo com o mesmo email cria um novo registo
        if(empty($res)) {
            $SQLInsert = "INSERT INTO utilizadores (nome, email, senha)
            values (:nome,  :email, :senha)";

            $statement = $pdo -> prepare ($SQLInsert);
            $statement -> execute (array(':nome' => $nome, ':email' => $email, ':senha' => $hashed_senha ));

            if($statement-> rowCount() == 1) {
                $result = header('location: index.php');

            }
        } else {
       /* $_SESSION ['erro_m']="Email já existe";	*/
       
           $_SESSION ['erro']="Dados inválidos";	
          
        }
    }catch(PDOException $e){
            echo "erro: " .$e->getMessage();
        }
    } 
    header('location: registar.php');
?>