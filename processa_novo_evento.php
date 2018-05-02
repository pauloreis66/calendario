<?php
	// estabelecer ligação à base de dados
	require('ligacao_bd.php');
	
	// atribuir uma variável aos dados recolhidos do formulário
	$data_evento = $_POST['data_evento'];
	$titulo_evento = $_POST['titulo_evento'];
	$descricao = $_POST['descricao'];
	$hora_inicio = $_POST['hora_inicio'];
	$hora_fim = $_POST['hora_fim'];
	// comparar horas
	$hora1 = strtotime($hora_inicio);
	$hora2 = strtotime($hora_fim);
	if( $hora1 > $hora2 ) {
		echo "As horas inseridas estão incorretas!</br>";
		echo "<a href='calendario.php'>Clique aqui para regressar ao calendário</a>";
	} else {
	// criar a instrução para introduzir dados da tabela e executá-la

	$sql = "INSERT INTO eventos (data_evento, inicio_evento, fim_evento, titulo_evento, descricao ) VALUES ('$data_evento', '$hora_inicio', '$hora_fim', '$titulo_evento', '$descricao')";
	$consulta = mysqli_query($ligacao, $sql);
	
	// mensagem de confirmação de registo inserido
	
	if (($consulta) != 1) {
	// Caso os dados não sejam inseridos com sucesso, obriga a novo registo
	header("Location: novo_evento.php"); exit;
	} else {
	// Caso os dados sejam inseridos com sucesso, volta ao calendário
	header("Location: calendario.php"); exit;
	}
	}
?>