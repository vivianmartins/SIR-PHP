<?php
session_start();
include "../conexao.php";

if(isset($_POST['email']) && isset ($_POST['senha'])){

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            return $data;
        }

        $username = test_input($_POST['username']);
        $senha = test_input($_POST['senha']);

        
        if (empty($email)){
             header("Location: ../main.php?error=Requer email");
         } else if (empty($senha)){
            header("Location: ../main.php?error=Requer senha");
        }else{

            $senha = md5($senha);
            
            $sql = "SELECT * FROM utilizadores where email='$email'
            AND senha='$senha'";
            
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)===1){

                $row = mysqli_fetch_assoc($result);
                    if($row['senha'] === $senha  && $row ['role'] == $role) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['nome'] = $row['nome'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['senha'] = $row['senha'];
                        $_SESSION['ativo'] = $row['ativo'];

                        header("Location: ../home.php");
                    }else {
                        header("Location: ../main.php?error=Requer senha");
                    }
            }else{
                header("Location: ../main.php?error=Requer senha");
            }
        }



    } else {
        header("location:../main.php");

    }

?>