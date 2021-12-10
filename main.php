<?php 
	 session_start();
	 if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   ?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="favi.png" />
	<title>221B</title>
</head>

<body>
	<!-- remover o bootstrap -->
	<nav class="navbar navbar-default">
		<div class="navbar-header">
			<a class="navbar-brand " href="#">
				<!--<img src="image/2.png" class="imgs"  width=80 height=80>-->
				<img alt="Brand" src="image/4.png" width=250 height=250>
			</a>
		</div>
	</nav>
	<section class="h-100 gradient-form" style="background-color: #233451;">

		<div class="container">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-xl-10">
					<div class="card rounded-3 text-black">
						<div class="row g-0">
							<!-- Login -->
							<div class="col-lg-6">
								<div class="card-body p-md-5 mx-md-4">
									<div class="text-center">
										<img src="favi.png" style="width: 185px;" alt="logo">
										<h4 class="mt-1 mb-5 pb-1">Bem vindo ao 221B</h4>
									</div>
									<form action="./login.php" method="post">
										<?php if (isset($_GET['error'])) { ?>
										<div class="alert alert-danger" role="alert">
											<?=$_GET['error']?>
										</div>
										<?php } ?>
										<p>Efetue o seu login:</p>
										<div class="form-outline mb-4">
											<label class="form-label" for="email">Email</label>
											<input type="text" name="email" id="email" class="form-control"
												placeholder="Insira o email" />

										</div>
										<div class="form-outline mb-4">
											<label class="form-label" for="senha">Senha</label>
											<input type="password" id="senha" name="senha" class="form-control" />

										</div>
										<div class="text-center pt-1 mb-5 pb-1">
											<button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
												type="submit">Login</button>
											<p><a class="text-muted" href="#!">Esqueceu sua senha?</a></p>
										</div>
									</form>
								</div>
							</div>
							<!-- Registar -->
							<div class="col-lg-6 d-flex rule gradient-custom-2 ">
								<div class="card-body p-md-5 mx-md-4">
									<div class="text-center">
										<h4 class="mt-1 mb-5 pb-1" style="color:#ffffff"> Não pussui conta? Crie a sua
											conta agora!</h4>
									</div>
									<form>
										<p class="mt-1 mb-5 pb-1" style="color:#ffffff; text-align: center;"> Venha
											fazer parte do 221B!
										</p>
										<div class="form-outline mb-4 ">
											<label class="form-label" for="form2Example11"
												style="color:#ffffff">Email:</label>
											<input type="email" id="form2Example11" class="form-control"
												placeholder="Insira o email" />
										</div>
										<div class="form-outline mb-4">
											<label class="form-label" for="form2Example11"
												style="color:#ffffff">Nome:</label>
											<input type="email" id="form2Example11" class="form-control"
												placeholder="Insira o nome" />
										</div>
										<div class="form-outline mb-4">
											<label class="form-label" for="form2Example22"
												style="color:#ffffff">Senha:</label>
											<input type="password" id="form2Example22" class="form-control" />
										</div>
										<div class="text-center pt-1 mb-5 pb-1">
											<button class="btn btn-dark btn-primary fa-lg gradient-custom-3 mb-3"
												type="button">Criar
												Conta</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
</body>

</html>
<?php }else{
	header("Location: ./home.php");
} ?>