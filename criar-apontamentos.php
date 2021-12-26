<?php 
   	session_start();
   	require "./conexao.php";

   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$titulo = $_POST['titulo'];
			$informacao = $_POST['informacao'];
			$idTipo = $_POST['idTipo'];
		
			if (!$titulo){
				$erros[]= 'O titulo é obrigatório!';
			}
	
			if (!$idTipo){
				$erros[]= 'O tipo é obrigatório!';
			}
		
			if (!$informacao){
				$erros[]= 'A informacao é obrigatória!';
			}
	
			if (empty($erros)){
		
			$statement = $pdo->prepare("INSERT INTO apontamentos (titulo, informacao, idTipo, idUtiliz) VALUES (:titulo, :informacao, :idTipo, :idUtil);");
		
			$statement->bindValue(':titulo', $titulo);
			$statement->bindValue(':informacao', $informacao);
			$statement->bindValue(':idTipo', $idTipo);
			$statement->bindValue(':idUtil', $_SESSION['id']);
		
			$statement->execute();
	
			header('Location: ./home.php');
			}
		}
		// Busca todos os tipos disponiveis
		$statement = $pdo->prepare("SELECT * FROM tipo WHERE idUtil = :idUtil and ativo=1");
		$statement->bindValue(':idUtil', $_SESSION['id']);
		$statement->execute();
		$catgs = $statement->fetchAll(PDO::FETCH_ASSOC);  
?>

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
					<label for="#titulo">
						<h5> Titulo: </h5>
					</label><br>
					<input style="min-width: 40rem;" name="titulo" class="input" type="text"
						placeholder="Insira o titulo do apontamento...">
				</div>
			</div>

			<div class="field">
				<div class="control">
					<label for="#idTipo">
						<h5> Tipo de Apontamento: </h5>
					</label><br>
					<select name="idTipo" style="min-width: 40rem;">
						<?php foreach($catgs as $catg): ?>
						<option value="<?php echo $catg['idTIpo'];?>"><?php echo $catg['nome'];?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="field">
				<div class="control">
					<label for="#informacao">
						<h5> Conteudo: </h5>
					</label><br>
					<textarea placeholder="Insira o conteudo do apontamento..." name="informacao" cols="79"
						rows="7"></textarea>
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