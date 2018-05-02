<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Registar evento</title>
</head>
<style type="text/css">
	@import url("visual.css");
</style> 
<body>
<form id="form_registo" name="form_registo" method="POST" action="processa_novo_evento.php">
  <table class="detalhe_evento" width="600px" align="left" border=0 >
    <tr><h2 class="calendario" align="left">Registo de novo evento</tr>
	<tr>
      <td align="left" valign="top" width="200" class="detalhe_evento">Data do evento: 
	  
	  <?php 
	  // apresenta data no formato dia/mes/ano com 2 digitos
	  if(isset($_GET['data_evento'])) {
		$separar_data = explode("-", $_GET['data_evento']);
		$ano = $separar_data[0];
		$mes = $separar_data[1];
		$dia = $separar_data[2];
		$data_evento = date('Y-m-d', mktime(0, 0, 0, $mes, $dia, $ano));
		$nova_data = date('d-m-Y', mktime(0, 0, 0, $mes, $dia, $ano));
		}
	  echo $nova_data; ?></td>
	</tr>
    <tr>
      <td align="left" valign="top" width="200" class="calendario">Título do evento:</td><td><input type="text" name="titulo_evento" id="titulo_evento" />*</td>
    </tr>
	<tr>
      <td align="left" valign="top" width="200" class="calendario">Descrição do evento:</td><td><input type="text" name="descricao" id="descricao" />*</td>
    </tr>
    <tr>
      <td align="left" valign="top" width="200" class="calendario">Hora de início (hh:mm:ss):</td><td><input type="text" name="hora_inicio" id="hora_inicio" />*</td>
    </tr>
    <tr>
      <td align="left" valign="top" width="200" class="calendario">Hora de fim (hh:mm:ss):</td><td><input type="text" name="hora_fim" id="hora_fim" />*</td>
    </tr>
    <tr>
      <td>* Campo obrigatório</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="enviar" id="enviar" value="Registar" />
	  <input type="reset" name="apagar" id="apagar" value="Apagar" /></td>
	  <input type="hidden" name="data_evento" id="data_evento" value="<?php echo $data_evento; ?>" >
    </tr>
  </table>
</form>
</body>
</html>