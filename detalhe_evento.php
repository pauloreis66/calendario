<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalhes do evento</title>
</head>
<style type="text/css">
	@import url("visual.css");
</style> 

<?php
require ('ligacao_bd.php');

$id_evento = $_GET['id_evento'];

// criar a consulta à base de dados
$sql = 'SELECT * FROM eventos WHERE id_evento='.$id_evento;

// criar a variável $consulta que guarda os resultados obtidos, ordenados por nome de forma ascendente
$consulta = mysqli_query($ligacao, $sql);

// verificar se existem resultados e mostrá-los
if ($consulta) {
	echo('<table class="detalhe_evento" width="600px" align="left" border=0 >');
	echo('<tr><h2 class="calendario" align="left">Detalhes do evento</tr>');
	
	while ($mostrar = mysqli_fetch_array($consulta)) {
	
	echo('<tr>
	<td class="detalhe_evento">Nº registo: '.$id_evento = $mostrar["id_evento"].'</td></tr><br/>
	<td>Título do evento: '.$nome_evento = $mostrar["titulo_evento"].'</td></tr>
	<td>Data do evento: '.$data_evento = $mostrar["data_evento"].'</td></tr>
	<td>Descrição do evento: '.$descricao = $mostrar["descricao"].'</td></tr>
	<td>Hora de início: '.$inicio_evento = $mostrar["inicio_evento"].'</td></tr>
	<td>Hora de fim: '.$fim_evento = $mostrar["fim_evento"].'</td></tr>
	<td><br/><a class="detalhe_evento" href="calendario.php">Clique aqui para regressar ao calendário</td>');
	}
	echo ("</table>");
	
}
else { echo ("A base de dados não contém registos");
}

// libertar variável da memória 
mysqli_free_result($consulta);
?>










