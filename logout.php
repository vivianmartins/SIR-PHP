<?php
session_start(); 
unset ($_SESSION["id"]);
unset ($_SESSION["email"]);
//session_destroy(); // s

header("Location:login.php"); //pagina que vai ser redirecionada
?>