<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Calendário</title>
</head>
<style type="text/css">
	@import url("visual.css");
</style> 
<body>
<?php
	// ligação à base de dados
	require('ligacao_bd.php');
	include('cabecalho.php');

	// criação da 1ª linha com nomes dos dias
	echo "<table align='center' class='calendario' cellspacing=0 cellpadding=1 border=1>";
	echo "<tr>";
	echo "<th class='calendario'>Domingo</th>";
	echo "<th class='calendario'>Segunda</th>";
	echo "<th class='calendario'>Terça</th>";
	echo "<th class='calendario'>Quarta</th>";
	echo "<th class='calendario'>Quinta</th>";
	echo "<th class='calendario'>Sexta</th>";
	echo "<th class='calendario'>Sábado</th>";
	echo "</tr>";
	$contar_dias = 1;
	$contar_dias_resto = 1;
	echo "<tr>";

	// verificar a data atual
	if(isset($_GET['date'])) {
		$separar_data = explode("-", $_GET['date']);
		$mes = $separar_data[0];
		$ano = $separar_data[1];
		$dia = date("t", mktime(0, 0, 0, $mes, 1, $ano));
	}
	else {
		$mes = date("n");
		$dia = date("t");
		$ano = date("Y");
	}


	// função para criar abreviatura do evento
	function resumo_evento($abreviatura_evento) {
		$resumo_evento = "";
		$resumo_evento = (substr($abreviatura_evento, 0, 15) . "...");
		return $resumo_evento;
	}


	// criação da tabela com os dias da semana, em função da data atual
	$colunas_tabela = 7;

	// --------------- calcular e construir primeira linha de dias ---------------------------------
	// calcular numero de dias da primeira semana desde o inicio do mês
	$dia_semana = date("w", mktime(-1, 0, 0, $mes, 1, $ano));

	// criação de células em branco na primeira linha
	for($celulas=0;$celulas<=$dia_semana;$celulas++) {
		echo "<td class='calendario' width='100' height='10'>";
		echo "</td>";
	}

	// calcular dias preenchidos da primeira linha
	$contar_dias_restantes = 5 - $dia_semana ;

	// ----------- criação de células para os dias preenchidos da primeira linha ------------------

	// criar parte de cima das células da primeira linha
	for($celulas=0;$celulas<=$contar_dias_restantes;$celulas++) {
		echo "<td class='datas' width='100' height='10'>";
		$mostrar = date("j", mktime(0, 0, 0, $mes, $contar_dias, $ano));
		$dia_actual = date("d");
		$mes_actual = date("n");
		$ano_actual = date("Y");

		// mostrar informação caso o dia atual esteja na primeira linha de células
		if($contar_dias == $dia_actual AND $mes == $mes_actual AND $ano == $ano_actual) { 
			echo "<strong>Hoje " . $mostrar . "</strong>";
		}
		else {
			echo $mostrar;
		}
		echo "</td>";
		$contar_dias++;
	}
	echo "</tr>";
	echo "<tr>";
	
	

	// colocar número do dia nas células da primeira linha
	for($celulas1=0;$celulas1<=$dia_semana;$celulas1++) {
		echo "<td class='calendario' width='100' height='10'>";
		if($contar_dias_resto <= $dia) { 
		}
		echo "</td>";
	}
		
	// criar parte de baixo das células da primeira linha
	for($celulas1=0;$celulas1<=$contar_dias_restantes;$celulas1++) {
		echo "<td class='calendario' width='100' height='40'>";
		
		$data_hoje = $ano . "-0" . $mes . "-0" . $contar_dias_resto ;

		// inserir novo evento ao clicar
		echo "<a class='calendario' href='novo_evento.php?data_evento=". $data_hoje ."'>[+]";
	
		// mostrar eventos existentes na base de dados
		$sql = "SELECT * FROM eventos WHERE data_evento ='$data_hoje';";
		$consulta = mysqli_query($ligacao,$sql);
		while($resultado=mysqli_fetch_assoc($consulta)) { 
	
		// resumo e hiperligação do evento existente
		echo "<a class='evento' href='detalhe_evento.php?id_evento=". $resultado['id_evento'] . "'>". resumo_evento($resultado['titulo_evento']) . "</a>";
	
		// apagar evento existente
		echo "<a class='apagar_evento' href='apagar_evento.php?id_evento=". $resultado['id_evento'] . "'>[-]</a><br />";
		}
		echo "</td>";
		$contar_dias_resto ++;
	}

	
//------------------------- Construção das linhas da tabela para restantes dias -----------------------------
	
	// calcular última linha do mês
	$num_linhas = ceil(($dia + $dia_semana) / $colunas_tabela);
	for($celulas=1;$celulas<=($num_linhas-1);$celulas++) {
		echo "<tr>";

		// criar parte de cima das células das restantes linhas
		for($celulas2=0;$celulas2<=($colunas_tabela-1);$celulas2++) {
			echo "<td class='datas' width='100' height='10'>";
			$mostrar = date("j", mktime(0, 0, 0, $mes, $contar_dias, $ano));
			$dia_actual = date("d");
			$mes_actual = date("n");
			$ano_actual = date("Y");
		
			//echo "<a class='calendario' href='novo_evento.php?data_evento=". $data_hoje ."'>";
			
			// verificar se o dia atual está nas restantes linhas da tabela
			if($contar_dias == $dia_actual AND $mes == $mes_actual AND $ano == $ano_actual) { 
				echo "<strong>HOJE " . $mostrar . "</strong>";
			}
			else {
				echo $mostrar;
			}
			echo "</a>";
			echo "</td>";
			$contar_dias++;	
		}
		echo "</tr>";
		echo "<tr>";
				

		// criar parte de baixo das células das restantes linhas
		for($celulas2=1;$celulas2<=$colunas_tabela;$celulas2++) {
			echo "<td class='calendario' width='110' height='10'>";
			if($contar_dias_resto  <= $dia) { 
				$data_hoje = $ano . "-" . $mes . "-" . $contar_dias_resto ;
	
				// inserir novo evento ao clicar
				echo "<a class='calendario' href='novo_evento.php?data_evento=". $data_hoje ."'>[+]";

				// selecionar todos os eventos para uma data
				$sql = "SELECT * FROM eventos WHERE data_evento ='$data_hoje';";
				$consulta = mysqli_query($ligacao,$sql);
				while($resultado=mysqli_fetch_assoc($consulta)) {
	
					// resumo e hiperligação do evento existente
					echo "<a class='evento' href='detalhe_evento.php?id_evento=". $resultado['id_evento'] . "'>" . resumo_evento($resultado['titulo_evento']) . "</a>";
	
					// apagar evento existente
					echo "<a class='apagar_evento' href='apagar_evento.php?id_evento=". $resultado['id_evento'] . "'>[-]</a><br />";
				}
			}
			echo "</td>";
			$contar_dias_resto ++;
		}
		echo "</tr>";
	}


	echo "</table>";
?>