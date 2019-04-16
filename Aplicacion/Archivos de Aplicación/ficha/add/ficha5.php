


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

echo "<body>";

echo "<form action='$PHP_SELF' method='post'>";

echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2'>";
echo "      <p class='Texto'>Ficha Paciente</p>";
$paciente_rut = $_SESSION['id_pac'];
$id_eva_neuro = $_SESSION['id_eva_neuro'];
$ficha = $_SESSION['ficha'];
//// echo $ficha;
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
echo "      <tr class='Texto3' 	bgcolor='#CC3333' >";
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
<div id="eva_neuro" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Evaluación Nurológica</div>
  <div class="CollapsiblePanelContent">
<?php


//****************************************************************************************************************
//******************************************************************************Busca Tipo 
$sql_miotoma = "select * from tipo_miotoma";
$r_miotoma = mysql_query($sql_miotoma,$link);
//**********************************************************************************************
//******************************************************************************Agrega 
if($btn_add_mio)
{
$sql_add_mio = "insert into en_miotoma values('$list_tipo_miotoma','$id_eva_neuro','$txt_est_mio')";
mysql_query($sql_add_mio,$link);
$error_mio =mysql_errno();

	switch($error_mio)		//Error articulacion
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>MIOTOMA YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE MIOTOMA</span></p>";
		break;
	}
$txt_est_mio = "";
}
 //echo $sql_add_mio."<br>";
//**********************************************************************************************
//******************************************************************************Borra 
if($btn_del_mio)
{
$sql_del_mio_pac = "delete from en_miotoma where id_miotoma = (select id_miotoma from tipo_miotoma where desc_miotoma = '$list_mio') and id_eva_neuro = $id_eva_neuro";
mysql_query($sql_del_mio_pac,$link);	
}
////// echo $sql_del_mio_pac."<br>";
//**********************************************************************************************
//******************************************************************************Modifica 
$btn_mod_mio_v=" name='btn_mod_mio' value='Modificar' ";


if($btn_mod_mio)
{
$sql_mod_miotoma = "select * from en_miotoma where id_miotoma = (select id_miotoma from tipo_miotoma where desc_miotoma = '$list_mio') and id_eva_neuro = '$id_eva_neuro'";
$rmod_miotoma = mysql_query($sql_mod_miotoma,$link); 
$info_miotoma = mysql_fetch_array($rmod_miotoma);
$btn_mod_mio_v=" name='btn_mod_mio2' value='Presione para guardar Modificaciones'";
$txt_est_mio = $info_miotoma[2];
}
if ($btn_mod_mio2)
{
$sql_mod_miotoma2 = "update en_miotoma set est_miotoma_en = '$txt_est_mio' where id_miotoma = '$list_tipo_miotoma' and id_eva_neuro = '$id_eva_neuro'";
mysql_query($sql_mod_miotoma2,$link);
$txt_est_mio = "";	
}

// echo "<br>".$sql_mod_miotoma."<br>";
// echo "<br>".$sql_mod_miotoma2."<br>";

//**********************************************************************************************
//******************************************************************************Lista Pac
$sql_rng_mio = "select desc_miotoma from en_miotoma, tipo_miotoma where id_eva_neuro = '$id_eva_neuro' and tipo_miotoma.id_miotoma = en_miotoma.id_miotoma order by tipo_miotoma.id_miotoma";
$r_rng_mio = mysql_query($sql_rng_mio,$link);
//// echo $sql_rng_mio."<br>";
//**********************************************************************************************


//****************************************************************************************************************



echo "      <table border='0' bgcolor='#99CCFF' width='100%' >";
echo "      <tr>";
echo "        <td colspan='7' class='Texto3'>EVALUACION NEUROLOGICA";
echo "          <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td colspan='7' class='Texto3' bgcolor='#638cb5'>MIOTOMA";
echo "          <hr /></td>";
echo "      </tr>";
echo "      <tr>";


echo "        <td class='Texto3' width='150px'>Tipo Miotoma:</td>";
echo "        <td class='Texto2' width='300px'><select name='list_tipo_miotoma' id='list_tipo_miotoma'>";
						if($btn_mod_mio)
						{
						echo "<option value='$info_miotoma[0]'>$list_mio</option> ";		
						}
					
						if(!($btn_mod_mio))
						{
							echo "<option>Miotoma</option> ";		
						}
						while ($r_mio_pac = mysql_fetch_array($r_miotoma))
						{
							echo "<option value='$r_mio_pac[0]'>$r_mio_pac[1]</option> ";	
						}
echo "        </select></td>";

echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3' width='150px'>Agregar Miotoma:</td>";
echo "        <td><input type='submit' class='boton' name='btn_add_mio' id='btn_add_mio' value='Agregar' /></td>";
echo "        <td rowspan='3' valign='top' class='Texto3' width='150px'>Miotomas:</td>";
echo "        <td rowspan='3'><select style=\"width:250px\" name='list_mio' size='7' class='Texto2' id='list_mio'>";
						while ($r_mio_pac = mysql_fetch_array($r_rng_mio))
						{
							echo "<option value='$r_mio_pac[0]'>$r_mio_pac[0]</option> ";	
						}
echo "        </select></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Estado:</td>";
echo "        <td class='Texto2'><input type='text' name='txt_est_mio' value='$txt_est_mio'/></td>";

echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Eliminar Miotoma:</td>";
echo "        <td><input type='submit' class='boton' name='btn_del_mio' id='btn_del_mio' value='Eliminar' /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>&nbsp;</td>";
echo "        <td class='Texto2'>&nbsp;</td>";
echo "        <td>&nbsp;</td>";

echo "        <td class='Texto3'>Modificar Miotoma:</td>";
echo "        <td><input type='submit' class='boton' $btn_mod_mio_v/></td>";
echo "      </tr>";
echo "      <tr>";

//------------DERMATOMA---------------------------------------//

//****************************************************************************************************************
//******************************************************************************Busca Tipo 
$sql_dermatoma = "select * from tipo_dermatoma";
$r_dermatoma = mysql_query($sql_dermatoma,$link);
//**********************************************************************************************
//******************************************************************************Agrega 
if($btn_add_derma)
{
$sql_add_derma = "insert into en_dermatoma values('$list_tipo_dermatoma','$id_eva_neuro','$txt_est_der')";
mysql_query($sql_add_derma,$link);
$error_derma =mysql_errno();

	switch($error_derma)		//Error articulacion
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>DERMATOMA YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE DERMATOMA</span></p>";
		break;
	}
$txt_est_der = "";
}
 echo $sql_add_derma."<br>";
//**********************************************************************************************
//******************************************************************************Borra 
if($btn_del_derma)
{
$sql_del_derma_pac = "delete from en_dermatoma where id_dermatoma = (select id_dermatoma from tipo_dermatoma where desc_dermatoma = '$list_dermatoma') and id_eva_neuro = $id_eva_neuro";
mysql_query($sql_del_derma_pac,$link);	
}
////// echo $sql_del_derma_pac."<br>";
//**********************************************************************************************
//******************************************************************************Modifica 
$btn_mod_derma_v=" name='btn_mod_derma' value='Modificar' ";


if($btn_mod_derma)
{
$sql_mod_dermatoma = "select * from en_dermatoma where id_dermatoma = (select id_dermatoma from tipo_dermatoma where desc_dermatoma = '$list_dermatoma') and id_eva_neuro = '$id_eva_neuro'";
$rmod_dermatoma = mysql_query($sql_mod_dermatoma,$link); 
$info_dermatoma = mysql_fetch_array($rmod_dermatoma);
$btn_mod_derma_v=" name='btn_mod_derma2' value='Presione para guardar Modificaciones'";
$txt_est_der = $info_dermatoma[2];
}
if ($btn_mod_derma2)
{
$sql_mod_dermatoma2 = "update en_dermatoma set est_dermatoma_en = '$txt_est_der' where id_dermatoma = '$list_tipo_dermatoma' and id_eva_neuro = '$id_eva_neuro'";
mysql_query($sql_mod_dermatoma2,$link);
$txt_est_der = "";	
}

//echo "<br>".$sql_mod_dermatoma."<br>";
//echo "<br>".$sql_mod_dermatoma2."<br>";

//**********************************************************************************************
//******************************************************************************Lista Pac
$sql_rng_derma = "select desc_dermatoma from en_dermatoma, tipo_dermatoma where id_eva_neuro = '$id_eva_neuro' and tipo_dermatoma.id_dermatoma = en_dermatoma.id_dermatoma order by tipo_dermatoma.id_dermatoma";
$r_rng_derma = mysql_query($sql_rng_derma,$link);
// // echo $sql_rng_derma."<br>";

//**********************************************************************************************


//****************************************************************************************************************

echo "        <td colspan='7' class='Texto3' bgcolor='#638cb5'>DERMATOMA";
echo "          <hr /></td>";
echo "      </tr>";
echo "      <tr>";


echo "        <td class='Texto3'>Tipo Dermatoma:</td>";
echo "        <td class='Texto2'><select name='list_tipo_dermatoma' id='list_tipo_dermatoma'>";
						if($btn_mod_derma)
						{
						echo "<option value='$info_dermatoma[0]'>$list_dermatoma</option> ";		
						}
					
						if(!($btn_mod_derma))
						{
							echo "<option>dermatoma</option> ";		
						}
						while ($r_derma_pac = mysql_fetch_array($r_dermatoma))
						{
							echo "<option value='$r_derma_pac[0]'>$r_derma_pac[1]</option> ";	
						}
echo "        </select></td>";

echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Agregar Dermatoma:</td>";
echo "        <td><input type='submit' class='boton' name='btn_add_derma' id='btn_add_derma' value='Agregar' /></td>";
echo "        <td rowspan='3' valign='top' class='Texto3'>Dermatomas</td>";
echo "        <td rowspan='3'><select style=\"width:250px\" name='list_dermatoma' size='7' class='Texto2' id='list_dermatoma'>";
						while ($r_derma_pac = mysql_fetch_array($r_rng_derma))
						{
							echo "<option value='$r_derma_pac[0]'>$r_derma_pac[0]</option> ";	
						}
echo "        </select></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Estado:</td>";
echo "        <td class='Texto2'><input type='text' name='txt_est_der' id='txt_est_der' value='$txt_est_der'/></td>";
echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Eliminar Dermatoma:</td>";
echo "        <td><input type='submit' class='boton' name='btn_del_derma' id='btn_del_derma' value='Eliminar' /></td>";

echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>&nbsp;</td>";
echo "        <td class='Texto2'>&nbsp;</td>";
echo "        <td>&nbsp;</td>";

echo "        <td class='Texto3'>Modificar Dermatoma:</td>";
echo "        <td><input type='submit' class='boton' $$btn_mod_derma_v/></td>";
echo "      </tr>";
echo "      <tr>";

//------------------------------------REFLEJO-----------------------

//****************************************************************************************************************
//******************************************************************************Busca Tipo 
$sql_reflejo = "select * from tipo_reflejo";
$r_reflejo = mysql_query($sql_reflejo,$link);
//**********************************************************************************************
//******************************************************************************Agrega 
if($btn_add_ref)
{
$sql_add_ref = "insert into en_reflejo values('$list_tipo_reflejo','$id_eva_neuro','$txt_est_ref')";
mysql_query($sql_add_ref,$link);
$error_ref =mysql_errno();

	switch($error_ref)		//Error articulacion
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>REFLEJO YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE REFLEJO</span></p>";
		break;
	}
$txt_est_ref = "";
}
//// echo $sql_add_ref."<br>";
//**********************************************************************************************
//******************************************************************************Borra 
if($btn_del_ref)
{
$sql_del_ref_pac = "delete from en_reflejo where id_reflejo = (select id_reflejo from tipo_reflejo where des_reflejo = '$list_reflejo') and id_eva_neuro = $id_eva_neuro";
mysql_query($sql_del_ref_pac,$link);	
}
////// echo $sql_del_ref_pac."<br>";
//**********************************************************************************************
//******************************************************************************Modifica 
$btn_mod_ref_v=" name='btn_mod_ref' value='Modificar' ";


if($btn_mod_ref)
{
$sql_mod_reflejo = "select * from en_reflejo where id_reflejo = (select id_reflejo from tipo_reflejo where des_reflejo = '$list_reflejo') and id_eva_neuro = '$id_eva_neuro'";
$rmod_reflejo = mysql_query($sql_mod_reflejo,$link); 
$info_reflejo = mysql_fetch_array($rmod_reflejo);
$btn_mod_ref_v=" name='btn_mod_ref2' value='Presione para guardar Modificaciones'";
$txt_est_ref = $info_reflejo[2];
}
if ($btn_mod_ref2)
{
$sql_mod_reflejo2 = "update en_reflejo set est_reflejo_en = '$txt_est_ref' where id_reflejo = '$list_tipo_reflejo' and id_eva_neuro = '$id_eva_neuro'";
mysql_query($sql_mod_reflejo2,$link);
$txt_est_ref = "";	
}

// echo "<br>".$sql_mod_reflejo."<br>";
// echo "<br>".$sql_mod_reflejo2."<br>";


//**********************************************************************************************
//******************************************************************************Lista Pac
$sql_rng_ref = "select des_reflejo from en_reflejo, tipo_reflejo where id_eva_neuro = '$id_eva_neuro' and tipo_reflejo.id_reflejo = en_reflejo.id_reflejo order by tipo_reflejo.id_reflejo";
$r_rng_ref = mysql_query($sql_rng_ref,$link);
 // echo $sql_rng_ref."<br>";

//**********************************************************************************************


//****************************************************************************************************************

echo "        <td colspan='7' class='Texto3'  bgcolor='#638cb5'>REFLEJO";
echo "          <hr /></td>";
echo "      </tr>";
echo "      <tr>";



echo "        <td class='Texto3'>Tipo Reflejo:</td>";
echo "        <td class='Texto2'>";
echo "          <select name='list_tipo_reflejo' id='list_tipo_reflejo'>";
						if($btn_mod_ref)
						{
						echo "<option value='$info_reflejo[0]'>$list_reflejo</option> ";		
						}
					
						if(!($btn_mod_ref))
						{
							echo "<option>reflejo</option> ";		
						}
						while ($r_ref_pac = mysql_fetch_array($r_reflejo))
						{
							echo "<option value='$r_ref_pac[0]'>$r_ref_pac[1]</option> ";	
						}
echo "          </select>";
echo "        </td>";

echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Agregar Reflejo:</td>";
echo "        <td>";
echo "          <input type='submit' class='boton' name='btn_add_ref' id='btn_add_ref' value='Agregar' />";
echo "        <td rowspan='3' valign='top' class='Texto3'>Reflejos</td>";
echo "        <td rowspan='3' class='Texto2'>";
echo "          <select style=\"width:250px\" name='list_reflejo' size='7' class='Texto2' id='list_reflejo'>";
						while ($r_ref_pac = mysql_fetch_array($r_rng_ref))
						{
							echo "<option value='$r_ref_pac[0]'>$r_ref_pac[0]</option> ";	
						}
echo "          </select>";
echo "        </td>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Estado:</td>";
echo "        <td class='Texto2'>";
echo "          <input type='text' name='txt_est_ref' id='txt_est_ref' value='$txt_est_ref'/>";
echo "        </td>";

echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Eliminar Reflejo:</td>";
echo "        <td>";
echo "          <input type='submit' class='boton' name='btn_del_ref' id='btn_del_ref' value='Eliminar' />";
echo "        </td>";

echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>&nbsp;</td>";
echo "        <td class='Texto2'>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "        <td class='Texto3'>Modificar Reflejo:</td>";
echo "        <td>";
echo "          <input type='submit' class='boton' $btn_mod_ref_v/>";
echo "        </td>";


echo "    </table><br>";
?>
  </div>
</div>
<div id="p_func" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Pruebas Funcionales</div>
  <div class="CollapsiblePanelContent">
  
  
<?php

//------------------------------------PRUEBA FUNCIONAL-----------------------
$id_p_func = $_SESSION['id_p_func'];
//****************************************************************************************************************
//******************************************************************************Busca Tipo 
$sql_prueba = "select * from tipo_prueba";
$r_prueba = mysql_query($sql_prueba,$link);
//**********************************************************************************************
//******************************************************************************Agrega 
if($btn_add_prueba)
{
$sql_add_prueba = "insert into prueba_funcional values('$list_tipo_prueba','$id_p_func','$txt_resultado')";
$sql_update_ficha = "update ficha set id_pf='$id_p_func' where id_ficha = '$ficha'";
mysql_query($sql_add_prueba,$link);
mysql_query($sql_update_ficha,$link);

$error_prueba =mysql_errno();

	switch($error_prueba)		//Error articulacion
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>PRUEBA YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE PRUEBA</span></p>";
		break;
	}
$txt_resultado = "";
}
//// echo $sql_add_prueba."<br>";
//**********************************************************************************************
//******************************************************************************Borra 
if($btn_del_prueba)
{
$sql_del_prueba_pac = "delete from prueba_funcional where id_prueba = (select id_prueba from tipo_prueba where desc_prueba = '$list_p_func') and id_pf = $id_p_func";
mysql_query($sql_del_prueba_pac,$link);	
}
//// echo $sql_del_prueba_pac."<br>";
//**********************************************************************************************
//******************************************************************************Modifica 
$btn_mod_prueba_v=" name='btn_mod_prueba' value='Modificar' ";


if($btn_mod_prueba)
{
$sql_mod_prueba = "select * from prueba_funcional where id_prueba = (select id_prueba from tipo_prueba where desc_prueba = '$list_p_func') and id_pf = '$id_p_func'";

$rmod_prueba = mysql_query($sql_mod_prueba,$link); 
$info_prueba = mysql_fetch_array($rmod_prueba);
$btn_mod_prueba_v=" name='btn_mod_prueba2' value='Presione para guardar Modificaciones'";
$txt_resultado = $info_prueba[2];
}
if ($btn_mod_prueba2)
{
$sql_mod_prueba2 = "update prueba_funcional set resultado_pf = '$txt_resultado' where id_prueba = '$list_tipo_prueba' and id_pf = '$id_p_func'";
mysql_query($sql_mod_prueba2,$link);
$txt_resultado = "";	
}

 //echo "<br>".$sql_mod_prueba."<br>";
 //echo "<br>".$sql_mod_prueba2."<br>";


//**********************************************************************************************
//******************************************************************************Lista Pac
$sql_rng_prueba = "select desc_prueba from prueba_funcional, tipo_prueba where id_pf = '$id_p_func' and tipo_prueba.id_prueba = prueba_funcional.id_prueba order by tipo_prueba.id_prueba";
$r_rng_prueba = mysql_query($sql_rng_prueba,$link);
// // echo $sql_rng_prueba."<br>";

//**********************************************************************************************


//****************************************************************************************************************

echo "    <table border='0'  bgcolor='#99CCFF'  width='100%'>";
echo "      <tr>";
echo "        <td colspan='7'  bgcolor='#638cb5'><span class='Texto3' >PRUEBAS FUNCIONALES<hr></span></td>";
echo "      </tr>";
echo "      <tr>";

echo "        <td width='150px'><span class='Texto3'>Tipo Prueba:</span></td>";
echo "        <td class='Texto2' width='300px'>";
echo "          <span class='Texto3'>";
echo "          <select name='list_tipo_prueba' id='list_tipo_prueba'>";
						if($btn_mod_prueba)
						{
						echo "<option value='$info_prueba[0]'>$list_p_func</option> ";		
						}
					
						if(!($btn_mod_prueba))
						{
							echo "<option>Prueba Funcional</option> ";		
						}
						while ($r_pf_pac = mysql_fetch_array($r_prueba))
						{
							echo "<option value='$r_pf_pac[0]'>$r_pf_pac[1]</option> ";	
						}
echo "          </select>";
echo "          </span>";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td width='150px'><span class='Texto3'>Agregar Prueba</span></td>";
echo "        <td>";
echo "          <span class='Texto3'>";
echo "          <input type='submit' class='boton' name='btn_add_prueba' id='btn_add_prueba' value='Agregar' />";
echo "        <td rowspan='3' valign='top' class='Texto3' width='150px'>Pruebas Funcionales:</td>";
echo "        <td rowspan='3' class='Texto2'>";
echo "          <select style=\"width:250px\" name='list_p_func' size='7' id='list_p_func'>";
						while ($r_pf_pac = mysql_fetch_array($r_rng_prueba))
						{
							echo "<option value='$r_pf_pac[0]'>$r_pf_pac[0]</option> ";	
						}
echo "          </select>";
echo "        </td>";
echo "          </span>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td><span class='Texto3'>Resultado</span></td>";
echo "        <td class='Texto2'>";
echo "          <span class='Texto3'>";
echo "          <input type='text' name='txt_resultado' id='txt_resultado' value = '$txt_resultado'/>";
echo "          </span>";
echo "        </td>";
echo "        <td>&nbsp;</td>";
echo "        <td><span class='Texto3'>Eliminar Prueba</span></td>";
echo "        <td>";
echo "          <span class='Texto3'>";
echo "          <input type='submit' class='boton' name='btn_del_prueba' id='btn_del_prueba' value='Eliminar' />";
echo "          </span>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "        <td>&nbsp;</td>";
echo "        <td><span class='Texto3'>Modificar Prueba</span></td>";
echo "        <td>";
echo "          <span class='Texto3'>";
echo "          <input type='submit' class='boton' $btn_mod_prueba_v/>";
echo "          </span>";
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
    
    
    
  </div>
</div>

<script type="text/javascript">
<!--
var CollapsiblePanel8 = new Spry.Widget.CollapsiblePanel("eva_neuro");
var CollapsiblePanel9 = new Spry.Widget.CollapsiblePanel("p_func");
//-->
</script>
</body>
</html>

