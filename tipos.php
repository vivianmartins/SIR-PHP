<?php 
   	session_start();
   	require "./conexao.php";

	// Verifica se a sessão foi iniciada
   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) { 
		// Busca todos os tipos que o utilizador criou
		$statement = $pdo->prepare("SELECT * FROM tipo WHERE ativo=1 and idUtil = :idUtil");
		$statement->bindValue(':idUtil', $_SESSION['id']);
		$statement->execute();
		$cards = $statement->fetchAll(PDO::FETCH_ASSOC);  
?>

<!DOCTYPE html>
<html>

<head>
	<title>Listagem de Tipos - 221b</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="./estilos/navbar.css">
	<link rel="stylesheet" href="./estilos/home.css">
	<link rel="shortcut icon" href="./image/favi.png" />
</head>

<body>
	<?php require_once "./navbar.php"; ?>

	<div class="container">
		<a class="button button-dark m1" href="./criar-tipos.php" > Criar Tipos</a>

		<!-- Cards com os tipos ja criados para depois se poder editar -->
		<div class="row">
			<?php foreach($cards as $card): ?>
			<div class="col-md-6 cards" style="background-color: <?php echo $card['cor']; ?> !important;">
				<div>
					<p>
						<h3> <?php echo $card['nome']; ?></h3>
					</p>
					<p> Codigo Hexadecimal da cor selcionada: <?php echo $card['cor']; ?></p>
					<form action="/tp1sir/eliminar-tipos.php" method="post">
						<input type="hidden" name="idTipo" value="<?php echo($card['idTIpo']);?>">
						<button type="submit" class="button button-dark"> Apagar </button>
					</form>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

</body>

</html>
<?php }else{
	header("Location: ./index.php");
} ?>