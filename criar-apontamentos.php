<?php 
   	session_start();
   	require "./conexao.php";

	//	Fazer aqui o codigo para verficar os dados e dps guardar na bd
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$titulo = $_POST['titulo'];
		$informacao = $_POST['informacao'];
		$idTipo = $_POST['idTipo'];
		$idUtiliz = $_POST['idUtiliz'];
	
		if (!$titulo){
			$erros[]= 'O titulo é obrigatório!';
		}

		if (!$idTipo){
			$erros[]= 'O tipo é obrigatório!';
		}
	
		if (!$informacao){
			$erros[]= 'A informacao é obrigatória!';
		}

		if (!$idUtiliz){
			$erros[]= 'O utilizador é obrigatório!';
		}

		if (empty($erros)){
	
		$statement = $pdo->prepare("INSERT INTO apontamentos (titulo, informacao, idTipo, idUtiliz) VALUES (:titulo, :informacao, :idTipo, :idUtiliz);");
	
		$statement->bindValue(':titulo', $titulo);
		$statement->bindValue(':informacao', $informacao);
		$statement->bindValue(':idTipo', $idTipo);
		$statement->bindValue(':idUtiliz', $idUtiliz);
	
		$statement->execute();

		header('Location: ./home.php');
		}
	}

   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>

<head>
	<title>Criar Apontamento - 221b</title>
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
			<h1> Criar um Novo Apontamento</h1> <br>
			
				<div class="field">
					<div class="control">
						<label for="#titulo"> <h5> Titulo: </h5></label><br>
						<input name="titulo" class="input" type="titulo" placeholder="Insira o titulo do apontamento...">
					</div>
				</div>

				<div class="field">
					<div class="control">
						<label for="#idTipo"> <h5> Categoria: </h5></label><br>
						<input name="idTipo" class="input" type="idTipo" placeholder="Insira o nº do tipo...">
					</div>
				</div>

				<div class="field">
					<div class="control">
						<label for="#informacao"> <h5> Conteudo: </h5></label><br>
						<input name="informacao" class="input" type="informacao" placeholder="Insira o conteudo do apontamento...">
					</div>
				</div>

				<div class="field">
					<div class="control">
						<label for="#idUtiliz"> <h5> Utilizador: </h5></label><br>
						<input name="idUtiliz" class="input" type="idUtiliz" placeholder="Insira o seu nº de utilizador...">
					</div>
				</div>

			<br>
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