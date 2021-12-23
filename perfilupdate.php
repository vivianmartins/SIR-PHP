<!------------------------------------PHP----------------------------------------------------->

<?php
require_once './conexao.php';
session_start();

//vai buscar o id
$idUtiliz =  $_SESSION['id'];


$statement = $pdo ->prepare  ("SELECT * FROM utilizadores where  idUtiliz=  :id");
$statement->bindValue(':id', $idUtiliz);
$statement->execute();
$utilizadores = $statement->fetch(PDO::FETCH_ASSOC);

$nome = $utilizadores ['nome'];
$email = $utilizadores ['email'];
$senha = $utilizadores['senha'];

$erros = [];
if($_SERVER ['REQUEST_METHOD']=== 'POST'){
	$nome = $_POST ['nome'];
	$senha = $_POST['senha'];
	
	if (!$nome) {
        $erros[] = 'O nome é obrigatorio!';
    }

	if  (!$senha) {
        $erros[] = ' A senha  é obrigatoria!';
    }

	if(empty($erros)){
			$statement = $pdo ->prepare ("UPDATE utilizadores set nome= :nome,  senha =:senha, email = :email where idUtiliz = :id");	
			$statement -> bindValue(':nome', $nome);
			$statement -> bindValue(':senha', $senha);
			$statement -> bindValue(':email', $email);
			$statement -> bindValue(':id', $idUtiliz);
			
			$statement->execute();
			header('location: perfiluser.php');
		}		
	}

?>


<!-------------                   front-end---------------------------------------------------------------------------->
<?php include_once './navbar.php' ?>
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
            <input class="input" id="senha" type="password" name="senha" value="<?php echo $senha ?>">
            <br>
        </div>

        <div class="col-lg-mb-3">
            <label class="edtext">Email: </label>	
            <p class="input"> <?php echo $utilizadores['email']; ?></p>
        </div>
        <br>

        <!--FALTA         <div class="mb-3">
            <label for="confirma_senha">Confirme sua senha:</label>
            <input class="input" type="password" id="confirma_senha" name="senha2" >
        vou colocar cofnirmar senha 
                    -->
        
        <div class="mb-3">
        <a   class="botaoup"style="color:white; width=100%"  href="perfiluser.php" >Voltar ao perfil</a>
        </div>
        <button type="submit" class="botaoup">Submit</button>
              
        </form>   
    </div>
  </div>
</body>