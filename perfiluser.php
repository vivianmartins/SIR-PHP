<?php

include_once './conexao.php';
session_start();
//Buscar os dados por id do utilizador
$statement = $pdo ->prepare  ("SELECT nome, email, senha  FROM utilizadores where idUtiliz = '".$_SESSION['id']."' ");
// inicializar 

$statement->execute();
$utilizadores = $statement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_SESSION['email']) && isset($_SESSION['id'])) {  ?>

<!DOCTYPE html>
<html>

<head>
    <title>Perfil - 221b</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/navbar.css">
    <link rel="stylesheet" href="estilos/user.css">
    <link rel="stylesheet" href="estilos/home.css">
    <link rel="shortcut icon" href="image/favi.png" />
</head>

<body>

    <?php require_once "./navbar.php"?>
    <?php foreach ($utilizadores as $utilizadores) : ?>

    <div class="container">
        <div class="card">

            <div class="col-lg-auto-1">
                <p class="title"> Dados Pessoais: <?php echo $utilizadores['nome']?></p>
                <img src="./image/2.png" style="width:25%">
            </div>

            <br>
            <p>Nome: <?php echo $utilizadores['nome']; ?></p>
            <p>Email: <?php echo $utilizadores['email']; ?></p>
            <!-- <p>Senha: <?php // echo $utilizadores['senha']; ?></p> -->
            <br>
            <!--<a  //?php 'echo <a href="update.php?id='.$id.'"></a>'; ?>  class="btn btn-primary">Editar conta</a>-->
            <a style="color: white; " href="./perfilupdate.php?id=<?$id ?> " class="botao">Editar Perfil</a>          
            <a   style="color: white; " href="./perfildeletar.php" class="botao"> Apagar Conta</a>
            <a   style="color: white; "     href="./logout.php" class="botao"> Sair da conta</a>

        </div>

        <?php endforeach; ?>
</body>

</html>
<?php }else{
	header("Location: ./index.php");
} ?>



