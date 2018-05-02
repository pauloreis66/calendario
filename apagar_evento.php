<?php
// ligação base dados
require('ligacao_bd.php');

// criar a consulta à base de dados para apagar evento registado
$sql = "DELETE FROM eventos WHERE id_evento = " . $_GET['id_evento'];
$consulta = mysqli_query($ligacao, $sql);
header("Location: calendario.php");
exit;

?>
