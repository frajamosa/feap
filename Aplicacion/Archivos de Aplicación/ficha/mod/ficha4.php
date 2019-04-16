


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin tÃ­tulo</title>
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
	
echo "<body>";

echo "<form action='$PHP_SELF' method='post'>";

echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2'>";
echo "      <p class='Texto'>Ficha Paciente</p>";

$paciente_rut = $_SESSION['id_pac'];
$id_ficha=$_SESSION['ficha'];

$sql_id_rng = "select * from ficha where id_ficha = '$id_ficha'";
$r_id_rng = mysql_query($sql_id_rng,$link);
$info_id_rng = mysql_fetch_array ($r_id_rng);

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

<div id="rng_artic" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Rango Articular</div>
  <div class="CollapsiblePanelContent"><span class="Texto2">

<?php
//------------------------------------------------------------------------------------ID R. ARTICULAR-

$id_r_artic = $_SESSION['id_r_artic'];

//echo "RNG ART ".$id_r_artic."<br>";

//-------------------------------------------------------------------------------FIN ID R. ARTICULAR-

//****************************************************************************************************************
//******************************************************************************Busca Tipo 
$sql_articulacion = "select * from tipo_articulacion";
$r_articulacion = mysql_query($sql_articulacion,$link);
//**********************************************************************************************
//******************************************************************************Agrega 
if($btn_add_rng)
{
 //update rng_articular set id_articulacion = '$list_tipo_articulacion', movimiento_rng_art='$txt_movimiento', rango_rng_art='$txt_rango', endfeel_rng_art='$txt_endfeel' where id_
$sql_add_artic_pac = "insert into rng_articular values('$info_id_rng[2]','$list_tipo_articulacion','$txt_movimiento','$txt_rango','$txt_endfeel')";
$sql_update_ficha = "update ficha set id_rngo_art='$id_r_artic' where id_ficha = '$id_ficha'";
mysql_query($sql_add_artic_pac,$link);
mysql_query($sql_update_ficha,$link);

$error_artic =mysql_errno();
	switch($error_artic)		//Error articulacion
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>ARTICULACION YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE ARTICULACION</span></p>";
		break;
	}

}
 echo $sql_add_artic_pac."<br>";
// echo $sql_add_rng_ficha."<br>";
//**********************************************************************************************
//******************************************************************************Borra 
if($btn_del_rng)
{
$sql_del_artic_pac = "delete from rng_articular where id_articulacion = (select id_articulacion from tipo_articulacion where desc_articulacion = '$list_rng_art') and id_rngo_art = $id_r_artic";
mysql_query($sql_del_artic_pac,$link);	
}
////// echo $sql_del_artic_pac."<br>";
//**********************************************************************************************
//******************************************************************************Modifica 
$btn_agrega_articulacion = "name='btn_add_rng' id='btn_add_rng' value='Agregar' ";	
$txt_nuevo_articulacion = "Nuevo Rango Articular:";


if($btn_mod_rng)
{
$sql_id_articulacion = "select * from rng_articular where id_articulacion = (select id_articulacion from tipo_articulacion where desc_articulacion = '$list_rng_art') and id_rngo_art = '$id_r_artic';";
$r_id_articulacion = mysql_query($sql_id_articulacion,$link);
$id_articulacion = mysql_fetch_array ($r_id_articulacion);

$btn_agrega_articulacion = "name='btn_mod_articulacion2' id='btn_mod_articulacion2' value='Aceptar Modificacion Articulacion'";	
$txt_nuevo_articulacion = "Modificar Articulacion:";
$txt_movimiento = $id_articulacion[2];
$txt_rango = $id_articulacion[3];
$txt_endfeel = $id_articulacion[4];
$_SESSION['id_articulacion'] = $id_articulacion[1];

}
if($btn_mod_articulacion2)
{
 $id_articulacion2 = $_SESSION['id_articulacion'];
$sql_mod_artic_pac = "update rng_articular set  movimiento_rng_art = '$txt_movimiento', rango_rng_art = '$txt_rango', endfeel_rng_art = '$txt_endfeel' where id_articulacion = '$id_articulacion2' and id_rngo_art = '$id_r_artic'";
mysql_query($sql_mod_artic_pac,$link);	
$txt_movimiento = "";
$txt_rango = "";
$txt_endfeel = "";

//  echo $sql_id_articulacion."<br>";
//  echo $sql_mod_artic_pac."<br>";

 echo "MODIFICADO...<br>";
}
//**********************************************************************************************
//******************************************************************************Lista Pac
$sql_rng_artic_pac = "select desc_articulacion from rng_articular, tipo_articulacion where id_rngo_art = '$id_r_artic' and tipo_articulacion.id_articulacion = rng_articular.id_articulacion order by tipo_articulacion.id_articulacion";
$r_rng_artic_pac = mysql_query($sql_rng_artic_pac,$link);
// echo $sql_rng_artic_pac."<br>";


//**********************************************************************************************


//****************************************************************************************************************
echo "  <table border='0' width='100%'  bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='7' class='Texto3' bgcolor='#638cb5'>RANGO ARTICULAR";
echo "        <hr /></td>";
echo "      </tr>";

echo "      <tr>";

echo "        <td colspan='5' class='Texto3'>$txt_nuevo_articulacion";
echo "        <hr /></td>";
echo "        <td rowspan='4' valign='top' class='Texto3' width='130px%' align='right'>Rango Articular:</td>";
echo "        <td rowspan='5' valign='top' >";
echo "          <select style=\"width:250px\" name='list_rng_art' size='9' class='Texto2' id='list_rng_art'>";
						while ($r_art_pac = mysql_fetch_array($r_rng_artic_pac))
						{
							echo "<option value='$r_art_pac[0]'>$r_art_pac[0]</option> ";	
						}
echo "          </select>";
echo "        </td>";

echo "      </tr>";

echo "      <tr>";
echo "        <td class='Texto3' width='150px'>Tipo Articulación:</td>";
echo "        <td class='Texto2' width='300px'>";
echo "          <select name='list_tipo_articulacion' id='list_tipo_articulacion'>";

						if($btn_mod_rng)
						{
						echo "<option value='$id_articulacion[1]'>$list_rng_art</option> ";		
						}
					
						if(!($btn_mod_rng))
						{
							echo "<option>Articulacion</option> ";		
						}
												
						while ($r_art = mysql_fetch_array($r_articulacion))
						{
							echo "<option value=$r_art[0]>$r_art[1]</option> ";	
						}
echo "          </select>";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'  width='200px'>Agregar Rango Articular:</td>";
echo "        <td width='150px'>";
echo "          <input type='submit' class='boton' $btn_agrega_articulacion/>";
echo "        </td>";
echo "      </tr>";

echo "      <tr>";
echo "        <td class='Texto3'>Movimiento:</td>";
echo "        <td class='Texto2'>";
echo "          <input type='text' name='txt_movimiento' id='txt_movimiento' value='$txt_movimiento'/>";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Eliminar Rango Artiular:</td>";
echo "        <td>";
echo "          <input type='submit' class='boton' name='btn_del_rng' id='btn_del_rng' value='Eliminar' />";
echo "        </td>";
echo "      </tr>";

echo "      <tr>";
echo "        <td class='Texto3'>Rango:</td>";
echo "        <td class='Texto2'>";
echo "          <input type='text' name='txt_rango' id='txt_rango' value='$txt_rango'/>";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Modificar Rango Articular:</td>";
echo "        <td>";
echo "          <input type='submit' class='boton' name='btn_mod_rng' id='btn_mod_rng' value='Modificar' />";
echo "        </td>";
echo "      </tr>";

echo "      <tr>";

echo "        <td class='Texto3'>Endfeel:</td>";
echo "        <td class='Texto2'>";
echo "          <input type='text' name='txt_endfeel' id='txt_endfeel' value='$txt_endfeel'/>";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td colspan='2'>&nbsp;</td>";
echo "      </tr>";

echo "    </table>";
?>
    
  </span></div>
</div>

<div id="aco_musc" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Acortamiento Muscular</div>
  <div class="CollapsiblePanelContent"><span class="Texto2">

<?php


//------------------------------------------------------------------------------------ID A. MUSCULAR-
$id_a_musc = $_SESSION['id_a_musc'];
	
//echo "ACO MUSC ".$id_a_musc."<br>";
// // echo $info_id_a_musc[0]."<br>";

//-------------------------------------------------------------------------------FIN ID A. MUSCULAR-


//****************************************************************************************************************
//******************************************************************************Busca Tipo 
$sql_a_musculo = "select * from tipo_musculo";
$r_a_muscular = mysql_query($sql_a_musculo,$link);
//**********************************************************************************************
//******************************************************************************Agrega 
if($btn_add_aco_musc)
{
 
$sql_add_acor_m_pac = "insert into acor_muscular values('$id_a_musc','$list_musculo','$txt_izquierdo','$txt_derecho')";
$sql_update_ficha2 = "update ficha set id_aco_musc='$id_a_musc' where id_ficha = '$id_ficha'";
mysql_query($sql_add_acor_m_pac,$link);
mysql_query($sql_update_ficha2,$link);
$erroa_musc =mysql_errno();
	switch($erroa_musc)		//Error a_musculo
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>a_musculo YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE a_musculo</span></p>";
		break;
	}

}
// echo $sql_add_acor_m_pac."<br>";
// echo $sql_add_aco_ficha."<br>";
//**********************************************************************************************
//******************************************************************************Borra 
if($btn_del_aco_musc)
{
$sql_del_acor_m_pac = "delete from aco_muscular where id_musculo = (select id_musculo from tipo_musculo where desc_musculo = '$list_rng_art') and id_aco_musc = $id_a_musc";
mysql_query($sql_del_acor_m_pac,$link);	
}
////// echo $sql_del_acor_m_pac."<br>";
//**********************************************************************************************
//******************************************************************************Modifica 
$btn_agrega_aco_musculo = "name='btn_add_aco_musc' id='btn_add_aco_musc' value='Agregar'  ";	
$txt_aco_nuevo_musculo = "Nuevo Acortamiento Muscular:";


if($btn_mod_aco_musc)
{
$sql_id_musculo = "select * from acor_muscular where id_musculo = (select id_musculo from tipo_musculo where desc_musculo = '$list_aco_musc') and id_aco_musc = '$id_a_musc'";
$r_id_musculo = mysql_query($sql_id_musculo,$link);
$id_musculo = mysql_fetch_array ($r_id_musculo);

$btn_agrega_aco_musculo = "name='btn_mod_musculo2' id='btn_mod_musculo2' value='Aceptar Modificacion A. Muscular'";	
$txt_aco_nuevo_musculo = "Modificar Acortamiento Muscular:";
$txt_izquierdo = $id_musculo[2];
$txt_derecho = $id_musculo[3];
$_SESSION['id_musculo'] = $id_musculo[1];

}
if($btn_mod_musculo2)
{
$id_musculo2 = $_SESSION['id_musculo'];
$sql_mod_acor_m_pac = "update acor_muscular set  izquierdo_am = '$txt_izquierdo', derecho_am = '$txt_derecho' where id_musculo = '$id_musculo2' and id_aco_musc = '$id_a_musc'";
mysql_query($sql_mod_acor_m_pac,$link);	
$txt_izquierdo = "";
$txt_derecho = "";


 echo "MODIFICADO...<br>";
}
// echo $sql_id_musculo."<br>";
// echo $sql_mod_acor_m_pac."<br>";
//**********************************************************************************************
//******************************************************************************Lista Pac
$sql_acor_m_pac = "select desc_musculo from acor_muscular, tipo_musculo where id_aco_musc = '$id_a_musc' and tipo_musculo.id_musculo = acor_muscular.id_musculo order by tipo_musculo.id_musculo";
$r_acor_m_pac = mysql_query($sql_acor_m_pac,$link);
// echo $sql_acor_m_pac."<br>";
//**********************************************************************************************


//****************************************************************************************************************




echo "  <table border='0' width='100%' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='7' class='Texto3' bgcolor='#638cb5'>ACORTAMIENTO MUSCULAR";
echo "        <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td colspan='5' class='Texto3'>$txt_aco_nuevo_musculo<hr></td>";
echo "        <td rowspan='4' valign='top' class='Texto3' width='130px' align='right'>Acortamiento Muscular:</td>";
echo "        <td rowspan='5'>";
echo "          <select style=\"width:250px\"  name='list_aco_musc' size='9' class='Texto2' id='list_aco_musc'>";
						while ($r_acor = mysql_fetch_array($r_acor_m_pac))
						{
							echo "<option value='$r_acor[0]'>$r_acor[0]</option> ";	
						}
echo "          </select>";
echo "        </td>";

echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3' width='150px'>Musculo:</td>";
echo "        <td class='Texto2' width='300px'>";
echo "          <select name='list_musculo' id='list_musculo'>";
						if($btn_mod_aco_musc)
						{
						echo "<option value='$id_musculo[1]'>$list_aco_musc</option> ";		
						}
					
						if(!($btn_mod_aco_musc))
						{
							echo "<option>Musculo</option> ";		
						}
												
						while ($r_acor = mysql_fetch_array($r_a_muscular))
						{
							echo "<option value=$r_acor[0]>$r_acor[1]</option> ";	
						}
echo "          </select>";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'  width='200px'>Agregar A. Muscular:</td>";
echo "        <td>";
echo "          <input type='submit' class='boton' $btn_agrega_aco_musculo />";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Izquierdo:</td>";
echo "        <td class='Texto2'>";
echo "          <input type='text' name='txt_izquierdo' id='txt_izquierdo' value='$txt_izquierdo' />";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Eliminar A. Muscular:</td>";
echo "        <td>";
echo "          <input type='submit' class='boton' name='btn_del_aco_musc' id='btn_del_aco_musc' value='Eliminar' />";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Derecho</td>";
echo "        <td class='Texto2'>";
echo "          <input type='text' name='txt_derecho' id='txt_derecho' value='$txt_derecho' />";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Modificar A. Muscular:</td>";
echo "        <td>";
echo "          <input type='submit' class='boton' name='btn_mod_aco_musc' id='btn_mod_aco_musc' value='Modificar' />";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "      </tr>";
echo "    </table>";
?>
    
  </span></div>
</div>


<div id="fza_musc" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Fuerza Muscular</div>
  <div class="CollapsiblePanelContent"><span class="Texto2">

<?php
//------------------------------------------------------------------------------------ID FZA. MUSCULAR-
if ($_SESSION['usr']<>"add" and !$btn_add_fza_musc)
{
$id_fza_musc = $_SESSION['id_fza_musc'];
$sql_fza_musc_pac = "select * from fza_muscular where id_fza_musc = '$id_fza_musc'";
$r_fza_musc_pac = mysql_query($sql_fza_musc_pac,$link);
$info_fza_musc = mysql_fetch_array($r_fza_musc_pac);
$txt_mov_musc	= $info_fza_musc[1];
$txt_porcentaje	= $info_fza_musc[2];
	
}

//echo "FZA MUSC ".$id_fza_musc."<br>";
//-------------------------------------------------------------------------------FIN ID FZA. MUSCULAR-
//******************************************************************************Agrega 
if($btn_add_fza_musc)
{
$sql_add_f_musc = "update fza_muscular set mov_muscular_fm = '$txt_mov_musc', porcentaje_fm = '$txt_porcentaje' where id_fza_musc = '$id_fza_musc'";
mysql_query($sql_add_f_musc,$link);
$error_aco_ficha =mysql_errno();
 
	switch($error_aco_ficha)		//Error fza. muscular
	{ 
		case 1062:
		echo "<p><span class='ALERTA'> YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
	}

}
// echo $sql_add_f_musc."<br>";
//**********************************************************************************************
// //******************************************************************************Modifica 
// if($btn_mod_fza_musc)
// {
// $sql_mod_f_musc = "update fza_muscular set mov_muscular_fm = '$txt_mov_musc', porcentaje_fm = '$txt_porcentaje' where id_fza_musc = '$id_fza_musc'";
// mysql_query($sql_mod_f_musc,$link);
// $error_aco_ficha =mysql_errno();
//  
// 	switch($error_aco_ficha)		//Error fza. muscular
// 	{ 
// 		case 1062:
// 		echo "<p><span class='ALERTA'> YA REGISTRADO EN ESTE PACIENTE</span></p>";
// 		break;
// 	}
// 
// }
// // echo $sql_mod_f_musc."<br>";
// //**********************************************************************************************
echo "  <table border='0' width='100%' bgcolor='#99CCFF'>";
echo "          <tr>";
echo "            <td colspan='5' class='Texto3' bgcolor='#638cb5'>FUERZA MUSCULAR";
echo "            <hr /></td>";
echo "          </tr>";
echo "          <tr>";
echo "            <td class='Texto3' width='150px'>Movimiento Muscular:</td>";
echo "            <td class='Texto2' width='150px'>";
echo "              <input type='text' name='txt_mov_musc' id='txt_mov_musc' value='$txt_mov_musc'/>";
echo "            </td>";
echo "            <td class='Texto2'>&nbsp;</td>";
echo "            <td class='Texto3' width='15%'>Agregar Fza. Muscular:</td>";
echo "            <td>";
echo "              <input type='submit' class='boton' name='btn_add_fza_musc' id='btn_add_fza_musc' value='Agregar / Modificar' />";
echo "            </td>";
echo "          </tr>";
echo "          <tr>";
echo "            <td class='Texto3'>Porcentaje:</td>";
echo "            <td class='Texto2'>";
echo "              <input type='text' name='txt_porcentaje' id='txt_porcentaje' value='$txt_porcentaje'/>";
echo "            </td>";
echo "            <td class='Texto2' width='150px'>Ingrese solo numeros</td>";
// echo "            <td class='Texto3'>Modificar Fza. Muscular:</td>";
//  echo "            <td>";
//  echo "              <input type='submit' class='boton' name='btn_mod_fza_musc' id='btn_mod_fza_musc' value='Modificar' />";
//  echo "            </td>";


echo "          </tr>";
 echo "          <tr>";
 echo "            <td>&nbsp;</td>";
 echo "            <td>&nbsp;</td>";
 echo "            <td>&nbsp;</td>";
//  echo "            <td class='Texto3'>Eliminar Fza. Muscular:</td>";
//  echo "            <td>";
//  echo "              <input type='submit' class='boton' name='btn_del_fza_musc' id='btn_del_fza_musc' value='Eliminar' />";
//  echo "            </td>";

 
 echo "          </tr>";

echo "    </table>";
?>
  </span></div>
  
  
</div>

<script type="text/javascript">
<!--
var CollapsiblePanel5 = new Spry.Widget.CollapsiblePanel("rng_artic");
var CollapsiblePanel6 = new Spry.Widget.CollapsiblePanel("aco_musc");
var CollapsiblePanel7 = new Spry.Widget.CollapsiblePanel("fza_musc");
//-->
</script>
</body>
</html>

