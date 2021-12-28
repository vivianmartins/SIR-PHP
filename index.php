

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
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="shortcut icon" href="image/favi.png" />
    <title>221B</title>
</head>

<body>

    <section>
        <!------------------ BACKGROUND ------------------------------>
        <div class="background  col-mb-6 mt-1">
           <!-- <div class="shape"></div>
            <div class="shape"></div>--> 
        </div> 

        
        <div class=" container">   
        <img src="image/9.png" class="image" alt="logo">
             <div class = "box"> 
    
  
      
            <!-------- FORMULÁRIO -----------------------------------------
	        --------------------------------------------------------------->
           
            <form action="./login.php" method="POST">
                <div class="col-mb-6 mt-1">
                <img src="image/4.png" class="imag" alt="logo">  
                <h3>Bem vindo, inicie sessão!</h3>
                <div class="mb-3 field">
                    <div class="control">
                        <input name="email" type="text" class="input" placeholder="Insira o seu email">
                    </div>
                </div>
                </div>
                <div class="col-mb-6 mt-1 field">
                    <div class="control">
                        <input  name="senha" class="input" type="password"  placeholder="Insira a senha">
                    </div>
                </div>
                <br>
                <?php 
                if(isset($_SESSION['erro'])){
                    echo('<div style="color:brown; 	font-weight: bold;">'. $_SESSION ['erro'] . '</div>');
                    unset ($_SESSION['erro']);
;                }
                 ?>
                <div class="col-mb-6 mt-1 ">
                    <button type="submit" name="login" class="button_r" role="button">Iniciar sessão</button>
                </div>
                <!---BOTAO TEMPORARIO -->
                <div>
                    <p1>Não possui conta conta?<a href="registar.php"> CRIAR CONTA </a>
                </div>
                
            </form> 
                </div>
           
         </div>
    </section>
</body>

</html>
<?php }else{
	header("Location: ./home.php");} ?>