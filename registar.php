<?php
session_start();

?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilos/style_registar.css">
    <link rel="shortcut icon" href="image/favi.png" />
    <title>22B1</title>    
  </head>


<body>
    <section>
        <!-- BACKGROUND -->        
     <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>

    </div>

    <div class="box">
             <!--- FORMULÁRIO -->
       <form action="./registo.php" method="POST">
            <img src="image/4.png" class="imag" alt="logo">
            <h3>Bem vindo, efetue o seu registo!</h3>
         <div >
             <p1>Faça login utilizando o seu email e senha <a href="./logout.php">AQUI</a></p1>
         </div>           
                         
         <div class="field">
             <div class="control">
                  <input name="nome" type="text" class="input" placeholder="Insira o seu nome" autofocus>
             </div>
         </div>
        
         <div class="field">
             <div class="control">
                 <input name="email" type="text" class="input" placeholder="Insira o seu email">
             </div>
         </div>

         <div class="field">
             <div class="control">
               <input name="senha" class="input" type="password" placeholder="Insira a senha">
                <?php                         
              if(isset($_SESSION['erro']))
                  {  echo $_SESSION['erro'];
                     unset($_SESSION['erro']);
                  }?>  
             </div>  
             
         </div>
           <div>
             <button name="registar" type="submit" class="button_r" role="button" >Registar</button>
          </div>
       </form>
     </div>            
        
    </section>
</body>

</html>

