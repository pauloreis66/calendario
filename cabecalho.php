<?php
require('ligacao_bd.php');

if(isset($_GET['date'])) {
$explodeddate = explode("-", $_GET['date']);
$mes = $explodeddate[0];
$ano = $explodeddate[1];
$dia = date("t", mktime(0, 0, 0, $mes, 1, $ano));
}
else {
$mes = date("n", time());
$dia = date("t", time());
$ano = date("Y", time());
}

// mostra data atual
$data_atual = date("F Y", mktime(0, 0, 0, $mes, 1, $ano));


// ------------- mes anterior -------------------
/* se for o primeiro mes do ano (Janeiro), retorna para o mês de ano anterior */
if($mes == 1) {
$mes_anterior = "12-" . ($ano-1);
}
else {
// calcula mes anterior para ano atual
$mes_anterior = ($mes-1) . "-" . $ano;
}

// ------------- mes seguinte -------------------
// se for o ultimo mes do ano (Dezembro), adiciona 1 para avançar de ano
if($mes == 12) {
$mes_seguinte = "1-" . ($ano+1);
}
// se não for o ultimo mes do ano, adiciona 1 para avançar de mês
else {$mes_seguinte = ($mes+1) . "-" . $ano;
}

echo "<span class='cabecalho'>";


// muda nome dos meses para português
switch ($mes) {
        case "1":     $mes = 'janeiro';     break;
        case "2":     $mes = 'fevereiro';   break;
        case "3":     $mes = 'março';       break;
        case "4":     $mes = 'abril';       break;
        case "5":     $mes = 'maio';        break;
        case "6":     $mes = 'junho';       break;
        case "7":     $mes = 'julho';       break;
        case "8":     $mes = 'agosto';      break;
        case "9":     $mes = 'setembro';    break;
        case "10":    $mes = 'outubro';     break;
        case "11":    $mes = 'novembro';    break;
        case "12":    $mes = 'dezembro';    break; 
 }

$data_atual = $mes.' de '.$ano;

echo $data_atual;
echo "<br/><a href='calendario.php?date=" . $mes_anterior . "'><img border = '0' src = 'icones/anterior.png'></a> ";
echo "<a href='calendario.php?date=" . $mes_seguinte . "'><img border = '0' src = 'icones/seguinte.png'></a> ";
echo "</span>";
echo "<br />";

// mostrar eventos próximos
echo "<h2>Próximos eventos:</h2>";
echo "<ul>";
	$sql = "SELECT * FROM eventos WHERE data_evento >= NOW() ORDER BY data_evento;";
	$consulta = mysqli_query($ligacao,$sql);
	$eventos_recentes = (mysqli_num_rows($consulta));
	if($eventos_recentes == 0) {
		echo "Não existem eventos próximos para mostrar!";
		}
		else {
			while($eventos_recentes = mysqli_fetch_assoc($consulta)) {
			echo "<li><a href='detalhe_evento.php?id_evento=". $eventos_recentes['id_evento'] . "'>" 
			. $eventos_recentes['titulo_evento'] . "</a> (" 
			. $eventos_recentes['data_evento'] . ")</li>";
			}
		}
echo "</ul>";
?>
<p>Clique numa data para inserir um evento!</p>
