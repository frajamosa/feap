


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="../../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(../../Images/FEAP-Fondo.jpg);
	background-repeat: no-repeat;
	background-position:center;
}
-->
</style>
<link href="../../Estilos.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>


</head>


<?php 

	session_start();
	include('../../conexion.php');
	$txt_frec=""; 
	$btn_agrega_vicio = "name='btn_vicio' id='btn_vicio' value='Agregar Vicio'";
	$txt_nuevo_vicio = "Nuevo Vicio:";
echo "<body>";

echo "<form action='$PHP_SELF' method='post'>";

echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2'>";
echo "      <p class='Texto'>Ficha Paciente</p>";
$paciente_rut = $_SESSION['id_pac'];
$id_tratamiento = $_SESSION['id_trata'];
echo "        </p>";

//****************************************************************************************************************
//************************************************************************************************Info. Pacientes   
//******************************************************************************Busca Paciente
$sql_paciente = "select * from paciente where rut_pac = '$paciente_rut'";
$r_paciente = mysql_query($sql_paciente,$link);
$info_paciente = mysql_fetch_array ($r_paciente);
$f = split ('-',$info_paciente[6]);

//**********************************************************************************************
echo "    <table width='100%' border='0' bgcolor='#638cb5'>";
echo "      <tr class='Texto3' 	bgcolor='#CC3333' b>";
echo "        <td>NOMBRE</td>";
echo "        <td>APELLIDO</td>";
echo "        <td>RUT</td>";
echo "        <td>DIRECCION</td>";
echo "        <td>TELEFONO</td>";
echo "        <td>F. NECIMIENTO</td>";
echo "        </tr>";
echo "      <tr class='Texto3'>";
echo "        <td>$info_paciente[1]</td>";
echo "        <td>$info_paciente[2]</td>";
echo "        <td>$info_paciente[0]</td>";
echo "        <td>$info_paciente[3]</td>";
echo "        <td>$info_paciente[4] - $info_paciente[5]</td>";
echo "        <td>$f[2]-$f[1]-$f[0]</td>";
echo "        </tr>";
echo "    </table><hr>";


//****************************************************************************************************************
   
?>
  </tr>
</table>
<div id="tratamiento" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Tratamiento</div>
  <div class="CollapsiblePanelContent">
  
  
<?php
if($_SESSION['usr']<>"add" and !$btn_guardar_trat)
{
$sql_trat_pac = "select * from tratamiento where id_trat = '$id_tratamiento'";
$r_trat_pac = mysql_query($sql_trat_pac,$link);	
$info_trat = mysql_fetch_array($r_trat_pac);

$txt_objetivo	= $info_trat[1];
$txt_tratamiento= $info_trat[2];
}

if ($btn_guardar_trat)
{
$sql_add_tratamiento = "update tratamiento set 	objetivo_trat='$txt_objetivo',
												tratamiento_trat='$txt_tratamiento'
											where id_trat='$id_tratamiento'";
mysql_query($sql_add_tratamiento,$link);
//echo $sql_add_tratamiento;
}


echo "    <table width='100%' border='0' >";
echo "      <tr bgcolor='#638cb5'>";
echo "        <td class='Texto3'>Objetivo:</td>";
echo "        <td>";
echo "          <textarea name='txt_objetivo' cols='100' rows='3'  id='txt_objetivo' >$txt_objetivo</textarea>";
echo "        </td>";
echo "      </tr>";
echo "      <tr bgcolor='#99CCFF'>";
echo "        <td class='Texto3'>Tratamiento:</td>";
echo "        <td>";
echo "          <textarea name='txt_tratamiento' cols='100' rows='3'  id='txt_tratamiento' >$txt_tratamiento</textarea>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td colspan='2' align='center' valign='middle'>";
echo "          <p>&nbsp;            </p>";
echo "          <p>";
echo "            <input type='submit' class='boton' name='btn_guardar_trat' id='btn_guardar_trat' value='Guardar Tratamiento' />";
echo "          </p>";
echo "          <p>&nbsp;</p>";
echo "        </td>";
echo "      </tr>";
echo "    </table>";


?>
    
    
    
    
  </div>
</div>
<div id="otros" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Otros</div>
  <div class="CollapsiblePanelContent"><span class="Texto2">Contenido</span></div>
</div>

<script type="text/javascript">
<!--
var CollapsiblePanel10 = new Spry.Widget.CollapsiblePanel("tratamiento");
var CollapsiblePanel11 = new Spry.Widget.CollapsiblePanel("otros");
//-->
</script>
<?php
	echo "</form>";
?>
</body>
</html>

