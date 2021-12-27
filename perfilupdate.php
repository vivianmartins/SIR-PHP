<?php
require_once './conexao.php';
session_start();

//vai buscar o id
$idUtiliz =  $_SESSION['id'];

$statement = $pdo ->prepare  ("SELECT * FROM utilizadores where   ativo=1  and idUtiliz = :id");
$statement->bindValue(':id', $idUtiliz);
$statement->execute();
$utilizadores = $statement->fetch(PDO::FETCH_ASSOC);



$nome = $utilizadores ['nome'];
$senha = $utilizadores['senha'];

$erros = [];

if($_SERVER ['REQUEST_METHOD'] === 'POST'){
	$nome = $_POST ['nome'];
	$senha = $_POST['senha'];
	
	if (!$nome) {
        $erros[] = 'O nome é obrigatorio!';
    }

	if  (!$senha) {
        $erros[] = ' A senha é obrigatoria!';
    }

	if(empty($erros)){
        $hashed_senha= password_hash($senha, PASSWORD_DEFAULT);
         $statement = $pdo ->prepare ("UPDATE utilizadores set nome= :nome,  senha =:senha where idUtiliz = :id");	
        try
        {       	
            $statement -> bindValue(':id', $idUtiliz);
            $statement -> bindValue(':nome', $nome);
            $statement -> bindValue(':senha', $hashed_senha);
            $statement->execute();

            $_SESSION['nome'] = $nome;     
        }
        catch (PDOException $e)
        {  
            echo $e;
            die(); 
            header('location: perfiluser.php');
      }
      header('location: perfiluser.php');		
       
    }		
}

include_once './navbar.php' 
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Perfil - 221b</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/navbar.css">
    <link rel="stylesheet" href="estilos/user.css">
    <link rel="stylesheet" href="estilos/home.css">
    <link rel="shortcut icon" href="image/favi.png" />
</head>

<body>
    <div class="container">
        <div class="card_u">
            <h1 class="mt-5">EDITAR PERFIL</h1>
            <?php if (!empty($erros)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($erros as $erro) : ?>
                <div><?php echo $erro ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form class="mt-5" action="" method="POST">

                <div class="mb-3">
                    <label class="edtext">Nome: </label>
                    <input type="text" class="input" name="nome" value="<?php echo $nome ?>">
                </div>

                <div class="mb-3">
                    <label class="edtext">Senha: </label>
                    <input class="input" id="senha" type="password" name="senha">
                    <br>
                </div>
                <br>

                <!--FALTA         <div class="mb-3">
            <label for="confirma_senha">Confirme sua senha:</label>
            <input class="input" type="password" id="confirma_senha" name="senha2" >
        vou colocar cofnirmar senha 
                    -->

                <div class="mb-3">
                    <a class="botaoup" style="color:white; width:100%;" href="perfiluser.php">Voltar ao perfil</a>
                </div>
                <button type="submit" class="botaoup">Submeter</button>

            </form>
        </div>
    </div>
</body>