<?php 
   	session_start();
   	require "./conexao.php";

	//	Fazer aqui o codigo para verficar os dados e dps guardar na bd
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$nome = $_POST['nome'];
		$cor = $_POST['cor'];
	
		if (!$nome){
			$erros[]= 'O nome é obrigatorio!';
		}
	
		if (!$cor){
			$erros[]= 'A cor é obrigatorio!';
		}
		if (empty($erros)){
	
		$statement = $pdo->prepare("INSERT INTO tipo(nome, cor) VALUES (:nome, :cor);");
	
		$statement->bindValue(':nome', $nome);
		$statement->bindValue(':cor', $cor);
	
		$statement->execute();

		header('Location: ./tipos.php');
		}
	}

   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>

<head>
	<title>Criar Tipo - 221b</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="./estilos/navbar.css">
	<link rel="stylesheet" href="./estilos/home.css">
	<link rel="shortcut icon" href="./image/favi.png" />
</head>

<body>
	<?php require_once "./navbar.php"; ?>

	<div class="container">
		<form class="form" action="#" method="post">
			<h1> Criar um novo tipo de apontamento</h1>
			<div>
				<label for="#nome"> <h5> Nome: </h5></label><br>
				<input type="text" name="nome" id="nome">
			</div>
			<!-- Cor -->
			<p><h5> Cor de fundo: </h5></p>
			<div>
				<div style="color: #0d6efd;">
					<input type="radio" name="cor" id="azul" value="#0d6efd">
					<label for="#nome"> Azul </label>
				</div>
				<div style="color: #6c757d;">
					<input type="radio" name="cor" id="cinza" value="#6c757d">
					<label for="#nome"> Cinzento </label>
				</div>
				<div style="color: #198754;">
				
				<input type="radio" name="cor" id="verde" value="#198754">
					<label for="#nome"> Verde</label>
				</div>
				<div style="color: #dc3545;">
					<input type="radio" name="cor" id="vermelho" value="#dc3545">
					<label for="#nome"> Vermelho </label>
				</div>
				<div style="color: #000;">
					<input type="radio" name="cor" id="preto" value="#000">
					<label for="#nome"> Preto </label>
				</div>
				<div style="color: #d63384;">
					<input type="radio" name="cor" id="preto" value="#d63384">
					<label for="#nome"> Rosa </label>
				</div>
			</div>
			<div>
				<button class="button button-dark" type="submit"> Confirmar</button>
			</div>
		</form>
	</div>

</body>

</html>
<?php }else{
	header("Location: ./index.php");
} ?>