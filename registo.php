<?php
session_start();
include "./conexao.php";


$nome = filter_input(INPUT_POST,'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST,'senha', FILTER_SANITIZE_STRING);

/*VERIFICAR SE JÁ ESXISTE UTILIZADOR*/
$sql = "select count(*) as total  from utilizadores where email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['msg'] = "<p style='color:red; font-size:20px;'> Usuario já existe!</p>";
	header('Location: registar.php');
	exit;
}
/*CASO NÃO EXISTE É EFETUADO O REGISTO */ 
$sql = "INSERT INTO utilizadores ( nome, email, senha) VALUES ('$nome', '$email', '$senha')";
$result = mysqli_query($conn, $sql);

if (mysqli_insert_id($conn)){
    $_SESSION ['msg'] = "<p style='color:green; font-size:20px;'> Registo efetuado com sucesso!</p>";
    header('Location: registar.php');
    exit;
} 
?>