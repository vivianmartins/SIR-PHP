<?php
session_start();
include "./conexao.php";

// Se for enviado um email e senha
if( isset($_POST['login']) ){

$email = $_POST['email'];
$senha = $_POST ['senha'];

try {
	$statement = $pdo->prepare("SELECT * FROM utilizadores WHERE email = :email and ativo = 1");
	$statement->bindValue(':email', $email);
	$statement->execute();
	$row = $statement->fetchAll(PDO::FETCH_ASSOC);

	foreach($row as $rw) {

		$idUtiliz = $rw ['idUtiliz'];
		$hashed_senha = $rw['senha'];
		$email = $rw['email'];

		if(password_verify($senha, $hashed_senha)){
			$_SESSION['id'] = $idUtiliz;
			$_SESSION['email'] = $email;
			$_SESSION['nome'] = $rw['nome'];
		// redirect para o dash do user
			header('Location: ./home.php');
		} else {
			$_SESSION ['erro']="Credenciais de acesso inválidas";
		}
	}
} catch (PDOException $e){
		echo "erro: ". $e->getMessage();
	}
}
header('Location: ./index.php');

?>

