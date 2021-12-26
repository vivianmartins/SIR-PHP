<?php 
   	session_start();

   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   
		   
		require "conexao.php";

		// Verifica se foi feito um GET
		if(!empty($_GET)){
			// Verifica se o pedido contem alguma coisa
			if(empty($_GET['search'])){
				header('Location: ./home.php');
			}
			$statement = $pdo->prepare('SELECT * FROM apontamentos a, tipo t WHERE a.ativo=1 AND a.idUtiliz = :idUtil AND a.idTIpo = t.idTIpo AND ( t.nome like concat("%", :campo, "%") or a.titulo like concat("%", :campo, "%"))');
			$statement->bindValue(':idUtil', $_SESSION['id']);
			$statement->bindValue(':campo', $_GET['search']);
			$statement->execute();
			$cards = $statement->fetchAll(PDO::FETCH_ASSOC);
	
			// Var que contem o placeholder da barra de pesquisa
			$srch = $_GET['search'];
			
		// Querry sem o GET
		} else {
			$statement = $pdo->prepare("SELECT * FROM apontamentos a, tipo t WHERE a.idUtiliz = :idUtil AND a.idTIpo = t.idTIpo AND a.ativo=1");
			$statement->bindValue(':idUtil', $_SESSION['id']);
			$statement->execute();
			$cards = $statement->fetchAll(PDO::FETCH_ASSOC);
	
			// Var que contem o placeholder da barra de pesquisa
			$srch = "Procurar";
		}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Home - 221b</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="estilos/navbar.css">
	<link rel="stylesheet" href="estilos/user.css">
	<link rel="stylesheet" href="estilos/home.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link rel="shortcut icon" href="image/favi.png" />
</head>

<body>
	<?php require_once "navbar.php"; ?>

	<div class="container">

		<div class="row">
			<div class="col-md-6 mt-1" style="display: flex; flex-direction: row-reverse;">
				<div class="dropdown mr1">
					<span class="button button-dark">Filtrar Por Categoria</span>
					<div class="dropdown-content">
						<a class="button" href="/tp1sir/home.php"> Todos</a>
						<?php foreach($cards as $card): ?>
						<div>
							<a class="button" href="/tp1sir/home.php?search=<?php echo($card['nome']) ?>">
								<?php echo($card['nome']) ?></a>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div>
					<a href="./criar-apontamentos.php" class="button button-dark mr1"> Criar Novo Apontamento</a>
				</div>
			</div>

			<div class="col-md-6 mt-1" style="display: flex;">
				<form action="#" method="get">
					<input type="text" id="search" name="search" placeholder="<?php echo($srch); ?>">
					<button type="submit" class="button button-dark"> <i class="bi bi-search"></i></button>
				</form>
			</div>
		</div>

		<div class="row">
			<?php foreach($cards as $card): ?>
			<div class="col-md-6 cards" style="background-color: <?php echo $card['cor']; ?> !important;">
				<div>
					<p>
						<h3> <?php echo $card['titulo']; ?></h3>
					</p>
					<p>
						<h5> Categoria: <?php echo $card['nome']; ?> </h5>
					</p>
					<p>
						<h6> Criado em: <?php echo $card['dataCriacao']; ?> </h6>
					</p>
					<p> Conteudo: <?php echo $card['informacao']; ?></p>
					<div style="display: flex;">
						<form class="mr1" action="/tp1sir/eliminar-apontamentos.php" method="post">
							<input type="hidden" name="id_ap" value="<?php echo($card['id_ap']);?>">
							<button type="submit" class="button button-dark"> Apagar </button>
						</form>
						<form action="/tp1sir/editar-apontamentos.php" method="get">
							<input type="hidden" name="id_ap" value="<?php echo($card['id_ap']);?>">
							<button type="submit" class="button button-dark"> Editar </button>
						</form>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

</body>

</html>
<?php }else{
	header("Location: ./main.php");
} ?>