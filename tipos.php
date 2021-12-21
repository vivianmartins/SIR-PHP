<?php 
   	session_start();
   	require "./conexao.php";

	$statement = $pdo->prepare("SELECT * FROM tipo WHERE ativo=1");
	$statement->execute();
	$cards = $statement->fetchAll(PDO::FETCH_ASSOC);

   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   ?>

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
		<a class="button button-dark m1" href="./criar-tipos.php" class="m1"> Criar tipos</a>

		<!-- Cards com os tipos ja criados para depois se poder editar -->
		<div class="row">
			<?php foreach($cards as $card): ?>
			<div class="col-md-6 cards" style="background-color: <?php echo $card['cor']; ?> !important;">
				<div>
					<p>
						<h3> <?php echo $card['nome']; ?></h3>
					</p>
					<p> Codigo Hexadecimal da cor selcionada: <?php echo $card['cor']; ?></p>
					<button  class="button button-dark" href="./eliminar-tipos.php"> Apagar </button>
					<button  class="button button-dark"> Editar </button>
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