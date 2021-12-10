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
		header("Location: ./main.php?error=requer-senha");
	}else{

// Ainda não estas a incriptar a senha ao guardar na BD
		// $senha = md5($senha);
		
		// Querry para ir buscar os dados à BD
		$sql = "SELECT * FROM utilizadores where email='$email'
		AND senha='$senha'";
		
		// Realiza a querry
		$result = mysqli_query($conn, $sql);

		// Verifica se foi encontrado algum resultado
		if(mysqli_num_rows($result)==1){

			// Pega na primeira linha do output da querry
			$row = mysqli_fetch_assoc($result);
				if($row['senha'] === $senha) {
					// Set variavel global de sessao
					$_SESSION['id'] = $row['idUtiliz'];
					$_SESSION['nome'] = $row['nome'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['senha'] = $row['senha'];
					$_SESSION['ativo'] = $row['ativo'];

					// redirect para o dash do user
					header("Location: ./home.php");
				}else {
					header("Location: ./main.php?error=senha_errada");
				}
		}else{
			header("Location: ./main.php?error=erro_a_encontrar_o_utilizador");
		}
	}
} else {
	header("location:./main.php");
}

?>