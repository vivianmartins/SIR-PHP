<?php 
   	session_start();
   	require "./conexao.php";

	// Verifica se a sessão está iniciada
   	if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   
		// Verfica se recebeu um pedido POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
				$idTipo = $_POST['idTipo'];
			}
			// Informacao
			if (!array_key_exists('informacao', $_POST) || empty($_POST['informacao'])){
				$erros[]= 'O conteudo é obrigatório!';
			} else {
				$informacao = $_POST['informacao'];
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
	<link rel="stylesheet" href="estilos/user.css">
	<link rel="shortcut icon" href="./image/favi.png" />
</head>

<body>
	<?php require_once "./navbar.php"; ?>

	<div class="container">
		<form class="form" action="#" method="post">
			<h1> Criar um Novo Apontamento</h1> <br>
			<?php if(!empty($erros)) {
				foreach ($erros as $erro) {
					echo ('<h6 style="color:red;">' . $erro . ' </h6>');
				}
			} ?>
			<div>

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
					<select name="idTipo" style="min-width: 40rem;" class="input">
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