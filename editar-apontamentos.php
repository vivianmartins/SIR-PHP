<?php 
   	session_start();
   	require "./conexao.php";

   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id_ap = $_GET['id_ap'];

			// Verificacao se os dados foram submetidos
			// Titulo
			if (!array_key_exists('titulo', $_POST) || empty($_POST['titulo'])){
				$erros[]= 'O titulo é obrigatório!';
			} else {
				$titulo = $_POST['titulo'];
			}
			// Tipo
			if (!array_key_exists('idTipo', $_POST)){
				$erros[]= 'O tipo é obrigatório!';
			} else {
				$idTIpo = $_POST['idTipo'];
			}
			// Informacao
			if (!array_key_exists('informacao', $_POST) || empty($_POST['informacao'])){
				$erros[]= 'O conteudo é obrigatório!';
			} else {
				$informacao = $_POST['informacao'];
			}
			if (empty($erros)){
		
				$statement = $pdo->prepare("UPDATE apontamentos SET titulo = :titulo, informacao = :informacao, idTIpo = :idTipo WHERE id_ap = :id_ap;");
			
				$statement->bindValue(':titulo', $titulo);
				$statement->bindValue(':informacao', $informacao);
				$statement->bindValue(':idTipo', $idTIpo);
				$statement->bindValue(':id_ap', $id_ap);
			
				$statement->execute();

				header('Location: ./home.php');
			}
		}
		   
		if(!empty($_GET)){
			// Verifica se o pedido contem alguma coisa
			if(empty($_GET['id_ap'])){
				header('Location: ./../home.php');
			}
			$statement = $pdo->prepare('SELECT * FROM apontamentos WHERE ativo=1 AND idUtiliz = :idUtil and id_ap = :ap');
			$statement->bindValue(':idUtil', $_SESSION['id']);
			$statement->bindValue(':ap', $_GET['id_ap']);
			$statement->execute();
			$ap = $statement->fetch(PDO::FETCH_ASSOC);

			// Busca todos os tipos disponiveis
			$statement = $pdo->prepare("SELECT * FROM tipo WHERE idUtil = :idUtil and ativo=1");
			$statement->bindValue(':idUtil', $_SESSION['id']);
			$statement->execute();
			$catgs = $statement->fetchAll(PDO::FETCH_ASSOC);  
			
		// se nao existir pedido get -> redirect
		} else {
			header('Location: ./../home.php');
		}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Editar Apontamento - 221b</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="estilos/navbar.css">
	<link rel="stylesheet" href="estilos/user.css">
	<link rel="stylesheet" href="estilos/home.css">
	<link rel="shortcut icon" href="image/favi.png" />
</head>

<body>
	<?php require "./navbar.php"; ?>

	<div class="container">
		<form class="form" action="#" method="post">
			<h1> Editar Apontamento</h1> <br>
			<?php if(!empty($erros)) {
				foreach ($erros as $erro) {
					echo ('<h6 style="color:red;">' . $erro . ' </h6>');
				}
			} ?>

			<div class="field">
				<div>
					<label for="#titulo"> <h5> Titulo: </h5> </label><br>
					<input style="min-width: 40rem;" name="titulo" class="input" type="text"
						value="<?php echo $ap['titulo']; ?>">
				</div>
			</div>

			<div class="field">
				<div class="control">
					<label for="#idTipo">
						<h5> Categoria: </h5>
					</label><br>
					<select name="idTipo" style="min-width: 40rem;" class="input">
						<?php foreach($catgs as $catg): ?>
						<option value="<?php echo $catg['idTIpo'];?>"
							<?php if($catg['idTIpo'] == $ap['idTIpo']) echo 'selected';?>>
							<?php echo $catg['nome'];?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="field">
				<div class="control">
					<label for="#informacao">
						<h5> Conteudo: </h5>
					</label><br>
					<textarea name="informacao" cols="79" rows="7"></textarea>
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