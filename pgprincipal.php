<?php
include_once('conexao.php');
if(isset($_POST['email']) && isset ($_POST['senha'])){

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = test_input($_POST['username']);
        $senha = test_input($_POST['senha']);
        
        if (empty($email)){
             header("Location: ../main.php?error= Requer email");
         } else if (empty($senha)){
            header("Location: ../main.php?error= Requer email");
        }else{
            echo "valido";
        }



    } else {
        header("location:../main.php");

    }

?>