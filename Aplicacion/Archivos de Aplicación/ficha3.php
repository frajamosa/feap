


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(Images/FEAP-Fondo.jpg);
	background-repeat: no-repeat;
	background-position:center;
}
-->
</style>
<link href="Estilos.css" rel="stylesheet" type="text/css" />

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
include('conexion.php');

echo "<body>";

echo "<form action='$PHP_SELF' method='post'>";

echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2'>";
echo "      <p class='Texto'>Ficha Paciente</p>";
$paciente_rut = $_SESSION['id_pac'];

echo "        </p>";

//****************************************************************************************************************
//************************************************************************************************Info. Pacientes   
//******************************************************************************Busca Paciente
$sql_paciente = "select * from paciente where rut_pac = '$paciente_rut'";
$r_paciente = mysql_query($sql_paciente,$link);
$info_paciente = mysql_fetch_array ($r_paciente);
$f = split ('-',$info_paciente[6]);

//**********************************************************************************************
echo "    <table width='100%' border='0'>";
echo "      <tr class='Texto3'>";
echo "        <td>NOMBRE</td>";
echo "        <td>APELLIDO</td>";
echo "        <td>RUT</td>";
echo "        <td>DIRECCION</td>";
echo "        <td>TELEFONO</td>";
echo "        <td>F. NECIMIENTO</td>";
echo "        </tr>";
echo "      <tr class='Texto2'>";
echo "        <td>$info_paciente[1]</td>";
echo "        <td>$info_paciente[2]</td>";
echo "        <td>$info_paciente[0]</td>";
echo "        <td>$info_paciente[3]</td>";
echo "        <td>$info_paciente[4] - $info_paciente[5]</td>";
echo "        <td>$f[2]-$f[1]-$f[0]</td>";
echo "        </tr>";
echo "    </table>";


//****************************************************************************************************************
   
?>

    <p class="Texto4">&nbsp;</p></td>
  </tr>
</table>
<div id="aco_musc" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Evaluación Postural</div>
  <div class="CollapsiblePanelContent"><span class="Texto2">

<?php

$id_eva_post = $_SESSION['id_eva_post'];



if($_SESSION<>"add" and !$btn_guardar)
{

$sql_add_eva_post_pac = "select * from eva_postural where id_eva_post = '$id_eva_post'";
$r_eva_post = mysql_query($sql_add_eva_post_pac,$link);
$info_eva_post = mysql_fetch_array($r_eva_post);
$error_eva_post =mysql_errno();	

$txt_anterior		= $info_eva_post[1];
$txt_posterior		= $info_eva_post[2];
$txt_lateral		= $info_eva_post[3];
$txt_observaciones	= $info_eva_post[4];

echo $sql_add_eva_post_pac;
}

//----------------------------------------------------------------------------------------AGREGAR-------
if ($btn_guardar)
{
	$sql_add_e_post_pac = "update eva_postural set 	anterior_eva_post='$txt_anterior',
													posterior_eva_post='$txt_posterior',
													lateral_eva_post='$txt_lateral',
													obs_eva_post='$txt_observaciones'
												where id_eva_post = '$id_eva_post'";
	mysql_query($sql_add_e_post_pac,$link);
	$error_ekine =mysql_errno();
	
		switch($error_dol)		//Error Postural
		{ 
			case 1062:
			echo "<p><span class='ALERTA'>EVALUACION POSTURAL YA REGISTRADO EN ESTE PACIENTE</span></p>";
			break;
			case 1264:
			echo "<p><span class='ALERTA'>SELECCIONE EXAMEN</span></p>";
			break;
		}	
}

echo $sql_add_e_post_pac."<br>";
//------------------------------------------------------------------------------------FIN-AGREGAR-------
echo "        <table width='100%' border='1'>";
echo "          <tr>";
echo "            <td width='13%' valign='top' class='Texto3'>Anterior:</td>";
echo "            <td width='87%' class='Texto2'><textarea name='txt_anterior' id='txt_anterior' cols='100' rows='3'>$txt_anterior</textarea>";
echo "			  </td>";

echo "          </tr>";
echo "          <tr>";

echo "            <td valign='top' class='Texto3'>Posterior:</td>";
echo "            <td class='Texto2'><textarea name='txt_posterior' id='txt_posterior' cols='100' rows='3'>$txt_posterior</textarea>";
echo "			  </td>";

echo "          </tr>";
echo "          <tr>";

echo "            <td valign='top' class='Texto3'>Lateral:</td>";
echo "            <td class='Texto2'><textarea name='txt_lateral' id='txt_lateral' cols='100' rows='3'>$txt_lateral</textarea>";
echo "			  </td>";

echo "          </tr>";
echo "          <tr>";

echo "            <td valign='top' class='Texto3'>Observaciones:</td>";
echo "            <td class='Texto2'><textarea name='txt_observaciones' id='txt_observaciones' cols='100' rows='3'>$txt_observaciones</textarea>";
echo "			  </td>";

echo "          </tr>";
echo "          <tr>";

echo "            <td colspan='2' align='center' class='Texto3'><p>&nbsp;";
echo "  </p>";
echo "  <p>";
echo "    <input type='submit' class='boton' name='btn_guardar' id='btn_guardar' value='Guardar E. Postural' />";
echo "  </p>";
echo "  <p>&nbsp; </p></td>";
echo "            ";
echo "          </tr>";
echo "        </table> ";
?>
 
  </span></div>
</div>
<form id="form1" name="form1" method="post" action="">
  <table border="0" align="center">
    <tr>
      <td align="center"><input name="btn_a_remota" type="button" class="boton" id="btn_a_remota" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha.php');return document.MM_returnValue" value="A. REMOTA" /></td>
      <td align="center"><input name="btn_a_actual" type="submit" class="boton" id="btn_a_actual" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha7.php');return document.MM_returnValue" value="A. ACTUAL" /></td>
      <td align="center"><input name="btn_e_kine" type="submit" class="boton" id="btn_e_kine" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha2.php');return document.MM_returnValue" value="E. KINESIOLOGICA"kinesiologos_marcos.php","_self")"/></td>
      <td align="center"><input name="btn_e_postural" type="submit" class="boton" id="btn_e_postural" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha3.php');return document.MM_returnValue" value="E. POSTURAL" /></td>
    </tr>
    <tr>
      <td align="center"><input name="btn_r_articular" type="submit" class="boton" id="btn_r_articular" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha4.php');return document.MM_returnValue" value="R. ARTICULAR" /></td>
      <td align="center"><input name="btn_aco_musc" type="submit" class="boton" id="btn_aco_musc" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha4.php');return document.MM_returnValue" value="ACO. MUSCULAR" /></td>
      <td align="center"><input name="btn_fza_musc" type="submit" class="boton" id="btn_fza_musc" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha4.php');return document.MM_returnValue" value="FZA. MUSCULAR" /></td>
      <td align="center"><input name="btn_e_neuro" type="submit" class="boton" id="btn_e_neuro" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha5.php');return document.MM_returnValue" value="E. NEUROLOGICA" /></td>
    </tr>
    <tr>
      <td align="center"><input name="btn_p_func" type="submit" class="boton" id="btn_p_func" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha5.php');return document.MM_returnValue" value="P. FUNCIONALES" /></td>
      <td align="center"><input name="btn_tratamiento" type="submit" class="boton" id="btn_tratamiento" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha6.php');return document.MM_returnValue" value="TRATAMIENTO" /></td>
      <td align="center"><input name="btn_otros" type="submit" class="boton" id="btn_otros" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha6.php');return document.MM_returnValue" value="OTROS" /></td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var CollapsiblePanel6 = new Spry.Widget.CollapsiblePanel("aco_musc");
//-->
</script>
</body>
</html>

