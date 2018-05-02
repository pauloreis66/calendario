<?php
// credenciais de acesso р base de dados
$servidor = "localhost";
$base_dados = "calendario";
$nome_administrador = "root";
$password_administrador = "root";

// estabelecer ligaчуo р base de dados
$ligacao = mysqli_connect($servidor, $nome_administrador, $password_administrador,$base_dados) or die ('Nуo foi possivel ligar р base de dados');

// ativar a base de dados pretendida
mysqli_select_db($ligacao, $base_dados) or die (mysqli_error($ligacao));

?>