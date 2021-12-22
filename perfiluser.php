<?php

include_once './conexao.php';
session_start();
//Buscar os dados por id do utilizador
$statement = $pdo ->prepare  ("SELECT nome, email, senha  FROM utilizadores where idUtiliz = '".$_SESSION['id']."' ");
// inicializar 

$statement->execute();
$utilizadores = $statement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_SESSION['email']) && isset($_SESSION['id'])) {  ?>

<!-------------front-end------------------->

<body>

<?php require_once "./navbar.php"?>
<?php foreach ($utilizadores as $utilizadores) : ?>

<div class="container">
  <div class="card">

     <div class="col-lg-auto-1">
    <p class="title" > Dados Pessoais: <?php echo $utilizadores['nome']?></p>
         <img src="./image/2.png"style="width:25%">
     </div>
   
        <br>
        <p>Nome: <?php echo $utilizadores['nome']; ?></p>         
        <p>Email: <?php echo $utilizadores['email']; ?></p>
        <p>Senha:  <?php echo $utilizadores['senha']; ?></p>
        <br>
    <!--<a  //?php 'echo <a href="update.php?id='.$id.'"></a>'; ?>  class="btn btn-primary">Editar conta</a>-->


    <a style="color: white; " href="perfilupdate.php?id=<?$id ?> " class="botao">Editar conta</a> 

    <button type="submit" class="botao"> Deletar</button>

</div>
     
 <?php endforeach; ?>
</body>
</html>
<?php }else{
	header("Location: ./index.php");
} ?>