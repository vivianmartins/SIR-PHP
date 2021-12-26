<?php 
   	session_start();
   	require "./conexao.php";

	//	Fazer aqui o codigo para verficar os dados e dps guardar na bd
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_ap = $_POST['id_ap'];
		$titulo = $_POST['titulo'];
		$informacao = $_POST['informacao'];
		$idTIpo = $_POST['idTIpo'];
	
		$statement = $pdo->prepare("UPDATE apontamentos SET titulo='', informacao='', idTIpo='' WHERE id_ap = :id_ap;");
	
		$statement->bindValue(':titulo', $titulo);
		$statement->bindValue(':informacao', $informacao);
		$statement->bindValue(':idTIpo', $idTIpo);
        $statement->bindValue(':id_ap', $id_ap);
	
		$statement->execute();

		header('Location: ./home.php');
		}

   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>

<head>
	<title>Editar Apontamento - 221b</title>
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
			<h1> Editar Apontamento</h1> <br>
			
				<div class="field">
					<div class="control">
						<label for="#titulo"> <h5> Titulo: </h5></label><br>
						<input style="min-width: 40rem;" name="titulo" class="input" type="text" placeholder="Insira o titulo do apontamento...">
					</div>
				</div>

				<div class="field">
					<div class="control">
						<label for="#idTipo"> <h5> Categoria: </h5></label><br>
						<select name="idTipo" style="min-width: 40rem;">
							<option value="14">Aniversários</option>
							<option value="15">Localização</option>
						</select>			
					</div>
				</div>

				<div class="field">
					<div class="control">
						<label for="#informacao"> <h5> Conteudo: </h5></label><br>
						<textarea placeholder="Insira o conteudo do apontamento..." name="informacao" cols="79" rows="7"></textarea>
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