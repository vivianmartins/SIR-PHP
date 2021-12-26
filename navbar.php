<div class="col-md-auto-2">
	<nav>
		<ul class="menu">
			<li>
				<img src="./image/4.png" class="imag" alt="logo">
			</li>

			<li><a style="	font-size: 22px;" href="./home.php"> Apontamentos </a></li>
			<li><a href="./tipos.php"> Categorias </a></li>
			<li><a href="./lixo.php"> Lixo </a></li>
			<?php /*
			<!-- <li><a style="	font-size: 22px;" href="#"> Filtrar </a></li> -->
			<li><a style="	font-size: 22px;" href="#">Criar</a>
				<ul>

					<l><a href="./tipos.php">Tipos</a></l>
					<!-- <l><a href="#">Categorias</a></l> -->
					<l><a href="#">Apontamentos</a></l>
				</ul>
			</li>
			*/ ?>
			<!--SUBMENU DO USERNAME-->
			<!-- <li> <input type="text" style="float:right " class="pesquisar" placeholder="Pesquisar"></li> -->
			<li style="float:right ">
				<a style="font-size: 22px; margin-right: 4rem" href="#about"> <?php echo($_SESSION['nome']); ?> </a>
				<ul>
					<l1><a href="perfiluser.php">Perfil</a></l1>
					<l1><a href="./logout.php">Logout</a></l1>
				</ul>
			</li>
		</ul>
	</nav>

	<!--footer falta colocar a informação-->

	<footer class="footer">

		<p>SISTEMAS DE INFORMAÇÃO EM REDE </p>

	</footer>
</div>
