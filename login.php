<?php
session_start();
include "./conexao.php";

// Se for enviado um email e senha
if(isset($_POST['email']) && isset ($_POST['senha'])){

	// Formata os dados
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		return $data;
	}

	// Busca os valores enviados pelo form
	$email = test_input($_POST['email']);
	$senha = test_input($_POST['senha']);

	// Verifica se foi introduzido um email
	if (empty($email)){
		header("Location: ./main.php?error=requer-email");
	} else if (empty($senha)){
	// Verifica se foi introduzida uma passwd
		header("Location: ./index.php?error=requer-senha");
	}else{

// Ainda não estas a incriptar a senha ao guardar na BD
		// $senha = md5($senha);
		
		// Prepara a querry
		$statement = $pdo->prepare("SELECT * FROM utilizadores WHERE email = :email AND senha=:senha");
		$statement->bindValue(':email', $email);
		$statement->bindValue(':senha', $senha);
		$statement->execute();
		$dados = $statement->fetchAll(PDO::FETCH_ASSOC);

		// Verifica se foi encontrado algum resultado
		if(!empty($dados)){
			// Set variavel global de sessao
			$_SESSION['id'] = $dados[0]['idUtiliz'];
			$_SESSION['nome'] = $dados[0]['nome'];
			$_SESSION['email'] = $dados[0]['email'];
			$_SESSION['senha'] = $dados[0]['senha'];
			$_SESSION['ativo'] = $dados[0]['ativo'];

			// redirect para o dash do user
			header("Location: ./home.php");
		}else{
			header("Location: ./main.php?error=senha_errada");
		}
	}
} else {
	header("location:./index.php");
}

?>