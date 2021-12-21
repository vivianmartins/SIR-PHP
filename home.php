<?php 
   	session_start();
   	require "conexao.php";

	$statement = $pdo->prepare("SELECT * FROM apontamentos a, tipo t WHERE a.idUtiliz = :idUtil AND a.idTIpo = t.idTIpo");
	$statement->bindValue(':idUtil', $_SESSION['id']);
	$statement->execute();
	$cards = $statement->fetchAll(PDO::FETCH_ASSOC);

   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>

<head>
	<title>Home - 221b</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="estilos/navbar.css">
	<link rel="stylesheet" href="estilos/home.css">
	<link rel="shortcut icon" href="image/favi.png" />
</head>

<body>
	<?php require_once "navbar.php"; ?>

	<div class="container">
		<div class="row">
			<?php foreach($cards as $card): ?>
			<div class="col-md-6 cards" style="background-color: <?php echo $card['cor']; ?> !important;">
				<div>
					<p><h3> <?php echo $card['titulo']; ?></h3></p>
					<p><h5> Categoria: <?php echo $card['nome']; ?> </h5></p>
					<p><h6> Criado em: <?php echo $card['dataCriacao']; ?> </h6></p>
					<p> Conteudo: <?php echo $card['informacao']; ?></p>
					<button  class="button button-dark"> Apagar </button>
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