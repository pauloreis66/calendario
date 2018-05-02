<?php
// iniciar a sessão
session_start();

// ligar à base de dados
require('ligacao_bd.php');

// verificar se os campos do formulário estão preenchidos
if (!empty($_POST) AND (empty($_POST['nome']) OR empty($_POST['password']))) {
	header("Location: login.php"); exit;
}

// definir $username and $password
$username=$_POST['nome'];
$password=$_POST['password'];

// consulta a base de dados
$sql="SELECT nome_utilizador, palavra_passe FROM utilizadores WHERE nome_utilizador='$username' AND palavra_passe='$password' ";

$consulta = mysqli_query($ligacao,$sql) or die(mysqli_error($ligacao));

if (mysqli_num_rows($consulta) == 1) {
// Caso os dados de login estejam corretos, envia para página calendario.php
	header("Location: calendario.php"); exit;
} else {
// Caso os dados de login estejam incorretos, envia para página login.php
	header("Location: login.php"); exit;
	}

mysqli_free_result($consulta);
?>