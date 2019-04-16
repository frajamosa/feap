


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t√≠tulo</title>
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
	$btn_agrega_ex = "name='btn_aa_add_examen' id='btn_aa_add_examen' value='Agregar Examen' ";
	$txt_nuevo_examen = "Nuevo Examen:";
echo "<body>";

echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data'>";

if ($btn_pac)
{
	$_SESSION['fica_pac'] = "1";
}

echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2'>";
echo "      <p class='Texto'>Ficha Paciente No.".$_SESSION['ficha']."</p>";
      
      

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

<div id="ana_actual" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Anaeva Actual</div>
  <div class="CollapsiblePanelContent">
  
<?php
 
//*******************************************************************************************************************************************
//-------------------------------------------------------------------------------------------------------------------------------------------
//**************************************INICIO ANAEVA ACTUAL*********************************************************************************
//-------------------------------------------------------------------------------------------------------------------------------------------
//*******************************************************************************************************************************************  

$paciente_rut = $_SESSION['id_pac'];
$ana_actual = $_SESSION['ana_actual'];
//***********************************************************************************************************
//*********************************************GUARDAR CAMPOS DE TEXTO***************************************
//***********************************************************************************************************
//------------------------------------------------------------------------------------ID ANAEVA ACTUAL-------
if($btn_aa_add_all_text or $btn_aa_ciru or $btn_aa_prot or $btn_aa_add_examen)
{
	$ana_actual = $_SESSION['ana_actual'];
	//$sql_ana_act = "insert into ana_actual values ('$ana_actual','$txt_aa_diagnostico','$txt_aa_origen_lesion','$txt_aa_farmacos','$txt_aa_obs')";
	$sql_ana_act = "update ana_actual set 	diagnostico_ana_act='$txt_aa_diagnostico',
											origen_lesion_ana_act='$txt_aa_origen_lesion',
											farmaco_ana_act='$txt_aa_farmacos',
											obs_ana_act='$txt_aa_obs'
									where 	id_ana_act = '$ana_actual'";
	
	//--Ficha--
	$sql_ficha="insert into ficha (id_ana_act) values ('$ana_actual')";

		mysql_query($sql_ana_act,$link);
		mysql_query($sql_ficha,$link);


	$_SESSION['ana_actual']=$ana_actual;
}

// echo $sql_ana_act;
//-------------------------------------------------------------------------------FIN ID ANAEVA ACTUAL---------

//------------------------------------------------------------------------------------BUSCA CAMPOS DE TEXTO---
$sql_info_ana_act="select * from ana_actual where id_ana_act = '$ana_actual'";
$r_info_ana_act = mysql_query($sql_info_ana_act,$link);
$info_ana_act = mysql_fetch_array ($r_info_ana_act);
//// echo $sql_info_ana_act."<br>";
//-------------------------------------------------------------------------------FIN-BUSCA CAMPOS DE TEXTO----


	$sql_info_ficha7="select * from ana_actual where id_ana_act = '$ana_actual'";
	$r_info_ana_act = mysql_query($sql_info_ana_act,$link);
	$info_ana_act = mysql_fetch_array ($r_info_ana_act);






//echo "	<form action='$PHP_SELF' method='post'>";
echo "      <div class='CollapsiblePanelContent'>";
echo "        <table width='100%' border='0'>";
echo "          <tr bgcolor='#99CCFF'>";
echo "            <td width='13%' valign='top' class='Texto3'>Origen de Lesi√≥n:</td>";
echo "            <td width='87%' class='Texto2'><textarea name='txt_aa_origen_lesion' id='txt_aa_origen_lesion' cols='100' rows='3'>$info_ana_act[2]</textarea>";
echo "			  </td>";

echo "          </tr>";
echo "          <tr bgcolor='#638cb5'>";

echo "            <td valign='top' class='Texto3'>F√°rmacos:</td>";
echo "            <td class='Texto2'><textarea name='txt_aa_farmacos' id='txt_aa_farmacos' cols='100' rows='3' >$info_ana_act[3]</textarea>";
echo "			  </td>";

echo "          </tr>";
echo "          <tr bgcolor='#99CCFF'>";

echo "            <td valign='top' class='Texto3'>Diagn√≥stico:</td>";
echo "            <td class='Texto2'><textarea name='txt_aa_diagnostico' id='txt_aa_diagnostico' cols='100' rows='3' >$info_ana_act[1]</textarea>";
echo "			  </td>";

echo "          </tr>";
echo "          <tr bgcolor='#638cb5'> ";

echo "            <td valign='top' class='Texto3'>Observaciones:</td>";
echo "            <td class='Texto2'><textarea name='txt_aa_obs' id='txt_aa_obs' cols='100' rows='3' >$info_ana_act[4]</textarea>";
echo "			  </td>";

echo "          </tr>";
echo "          <tr>";

echo "            <td class='Texto3'>&nbsp;</td>";
echo "            <td><input type='submit' class='boton' name='btn_aa_add_all_text' id='btn_aa_add_all_text' value='Guardar Todo' /></td>";
echo "          </tr>";
echo "        </table><br>";
//***********************************************************************************************************
//*****************************************FIN GUARDAR CAMPOS DE TEXTO***************************************
//***********************************************************************************************************




//***********************************************************************************************************
//**************************************************CIRUGIA**************************************************
//***********************************************************************************************************

$c_aa = split ('-',$list_aa_ciru_pac);
//************************************************************************************************Info. Cirugia   
//******************************************************************************Busca Tipo cirugia
$sql_aa_ciru = "select * from tipo_cirugia";
$r_aa_ciru = mysql_query($sql_aa_ciru,$link);
$info_aa_ciru = mysql_fetch_array ($r_aa_ciru);
//// echo $sql_aa_ciru."<br>";
//**********************************************************************************************
//******************************************************************************Agrega cirugia

if($btn_aa_ciru)
{
$sql_add_aa_ciru_pac = "insert into aa_cirugia values('$ana_actual','$tipo_aa_ciru')";
mysql_query($sql_add_aa_ciru_pac,$link);
$error_ciru =mysql_errno();
//echo "Error Pato:".$error_pato."<br>";
	switch($error_ciru)		//Error Cirugia
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>CIRUGIA YA REGISTRADA EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE CIRUGIA</span></p>";
		break;
	}
}
//// echo $sql_add_aa_ciru_pac."<br>";
//**********************************************************************************************
//******************************************************************************Borra cirugia
if($btn_del_aa_ciru)
{
$sql_del_aa_ciru_pac = "delete from aa_cirugia where id_cirugia = (select id_cirugia from tipo_cirugia where desc_cirugia = '$c_aa[0]') and id_ana_act = $ana_actual";
mysql_query($sql_del_aa_ciru_pac,$link);	
}
//// echo $sql_del_aa_ciru_pac."<br>";
//**********************************************************************************************
//******************************************************************************Lista cirugia Pac
$sql_aa_ciru_pac = "select desc_cirugia from aa_cirugia, tipo_cirugia where id_ana_act = '$ana_actual' and tipo_cirugia.id_cirugia = aa_cirugia.id_cirugia";
$r_aa_ciru_pac = mysql_query($sql_aa_ciru_pac,$link);
//// echo $sql_aa_ciru_pac."<br>";
//**********************************************************************************************

echo "	<table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='3' bgcolor='#638cb5'><span class='Texto3' >CIRUGIAS";
echo "        </span><hr /></td>";

echo "      </tr>";
echo "      <tr>";

echo "        <td  width='30%'>";
echo "          <span class='Texto3'>Nueva Cirugia<hr></span>";
echo "          <span class='Texto3'>Tipo de Cirugia: <br></span>";
echo "            <select name='tipo_aa_ciru' class='Texto2' id='tipo_aa_ciru'>";

						echo "<option>cirugia</option> ";		
						
						while ($r_aa_cirug = mysql_fetch_array($r_aa_ciru))
						{
							echo "<option value=$r_aa_cirug[0]>$r_aa_cirug[1]</option> ";	
						}
echo "            </select>";
echo "			  ";
echo "        </td>";


echo "        <td valign='top' width='15%'>";
echo "          <p class='Texto3' align='right'>Cirugias:</p></td>";
echo "          <td td valign='top'>";
echo "			<select style=\"width:250px\" name='list_aa_ciru_pac' class='Texto2' id='list_aa_ciru_pac' multiple='multiple' size='7'>";	
						

						while ($r_aa_cirug_pac = mysql_fetch_array($r_aa_ciru_pac))
						{
							echo "<option value='$r_aa_cirug_pac[0]'>$r_aa_cirug_pac[0]</option> ";	
						}
echo "            </select>";
echo "        </td>";

echo "	   <tr valign='top'><td></td><td class ='Texto3' align='right'>Eliminar Cirugia: </p></td>";
echo "	   <td><input type='submit' class='boton' name='btn_del_aa_ciru' id='btn_del_aa_ciru' value='Eliminar Cirugia' /></td>";
echo "     </tr>";


echo "    </table><br>";

//***********************************************************************************************************
//**********************************************FIN CIRUGIA**************************************************
//***********************************************************************************************************

//***********************************************************************************************************
//***********************************************PROTESIS****************************************************
//***********************************************************************************************************

$p_aa = split ('-',$list_aa_prot_pac);
//************************************************************************************************Info. protesis   
//******************************************************************************Busca Tipo protesis
$sql_aa_prot = "select * from tipo_protesis";
$r_aa_prot = mysql_query($sql_aa_prot,$link);
$info_aa_prot = mysql_fetch_array ($r_aa_prot);
//// echo $sql_aa_prot."<br>";
//**********************************************************************************************
//******************************************************************************Agrega protesis
$ana_actual = $_SESSION['ana_actual'];
if($btn_aa_prot)
{
$sql_add_aa_prot_pac = "insert into aa_protesis values('$tipo_aa_prot','$ana_actual')";
mysql_query($sql_add_aa_prot_pac,$link);	
}
//// echo $sql_add_aa_prot_pac."<br>";
//**********************************************************************************************
//******************************************************************************Borra protesis
if($btn_del_aa_prot)
{
$sql_del_aa_prot_pac = "delete from aa_protesis where id_protesis = (select id_protesis from tipo_protesis where desc_protesis = '$p_aa[0]') and id_ana_act = $ana_actual";
mysql_query($sql_del_aa_prot_pac,$link);	
}
//// echo $sql_del_aa_prot_pac."<br>";
//**********************************************************************************************
//******************************************************************************Lista protesis Pac
$sql_aa_prot_pac = "select desc_protesis from aa_protesis, tipo_protesis where id_ana_act = '$ana_actual' and tipo_protesis.id_protesis = aa_protesis.id_protesis";
$r_aa_prot_pac = mysql_query($sql_aa_prot_pac,$link);
//// echo $sql_aa_prot_pac."<br>";
//**********************************************************************************************

echo "	<table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='3' bgcolor='#638cb5'><span class='Texto3'>PROTESIS";
echo "        </span><hr /></td>";

echo "      </tr>";
echo "      <tr>";

echo "        <td width='30%'>";
echo "          <span class='Texto3'>Nueva Protesis<hr></span>";
echo "          <span class='Texto3'>Tipo de Protesis: <br></span>";
echo "            <select name='tipo_aa_prot' class='Texto2' id='tipo_aa_prot'>";

						echo "<option>protesis</option> ";		
						
						while ($r_aa_protg = mysql_fetch_array($r_aa_prot))
						{
							echo "<option value=$r_aa_protg[0]>$r_aa_protg[1]</option> ";	
						}
echo "            </select>";
echo "    		  <p><input type='submit' class='boton' name='btn_aa_prot' id='btn_aa_prot' value='Agregar Protesis'/>";
echo "        </td>";

echo "        <td valign='top' width='15%'>";
echo "          <p class='Texto3' align='right'>Protesis:</p></td>";
echo "          <td td valign='top'>";
echo "			<select  style=\"width:250px\" name='list_aa_prot_pac' class='Texto2' id='list_aa_prot_pac' multiple='multiple' size='7'>";	
						

						while ($r_aa_protg_pac = mysql_fetch_array($r_aa_prot_pac))
						{
							echo "<option value='$r_aa_protg_pac[0]'>$r_aa_protg_pac[0]</option> ";	
						}
echo "            </select>";
echo "        </td>";

echo "	   <tr valign='top'><td></td><td class ='Texto3' align='right'>Eliminar Protesis: </p></td>";
echo "	   <td><input type='submit' class='boton' name='btn_del_aa_prot' id='btn_del_aa_prot' value='Eliminar Protesis' /></td>";
echo "     </tr>";


echo "    </table>";

//***********************************************************************************************************
//**********************************************FIN PROTESIS*************************************************
//***********************************************************************************************************

//***********************************************************************************************************
//***********************************************EXAMEN******************************************************
//***********************************************************************************************************
//------------------------------------------------------------------------------------ID EXAMEN ACTUAL-------
$sql_id_aa_ex="select max(id_aa_examen) from aa_examen";
$r_id_aa_ex = mysql_query($sql_id_aa_ex,$link);
$info_id_aa_ex = mysql_fetch_array ($r_id_aa_ex);

if ($info_id_aa_ex[0] == 'NULL')
{
	$nuevo_id_aa_ex="1";
}
else
{
	$nuevo_id_aa_ex=$info_id_aa_ex[0]+1;
}
 $_SESSION['id_aa_ex'] = $nuevo_id_aa_ex;
 $id_aa_ex = $_SESSION['id_aa_ex'];

// echo $sql_id_aa_ex."<br>";
// echo $nuevo_id_aa_ex."<br>";
//echo "id_aa_ex: ".$id_aa_ex."<br>";
//-------------------------------------------------------------------------------FIN ID EXAMEN ACTUAL---------
//------------------------------------------------------------------------------------ID RESULTADO EXAMEN ----
$sql_id_aa_rex="select max(id_resultado_ex) from resultado_examen";
$r_id_aa_rex = mysql_query($sql_id_aa_rex,$link);
$info_id_aa_rex = mysql_fetch_array ($r_id_aa_rex);

if ($info_id_raa_ex[0] == 'NULL')
{
	$nuevo_id_aa_rex="1";
}
else
{
	$nuevo_id_aa_rex=$info_id_aa_rex[0]+1;
}
 $_SESSION['id_aa_rex'] = $nuevo_id_aa_rex;
 $id_aa_rex = $_SESSION['id_aa_rex'];

// echo $sql_id_aa_rex."<br>";
// echo $nuevo_id_aa_rex."<br>";
// echo $info_id_aa_rex[0]."<br>";

//-------------------------------------------------------------------------------FIN ID RESULTADO EXAMEN ----

//******************************************************************************Busca Tipo Examen
$sql_aa_exam = "select * from tipo_examen";
$r_aa_exam = mysql_query($sql_aa_exam,$link);
$info_aa_exam = mysql_fetch_array ($r_aa_exam);
//// echo $sql_aa_prot."<br>";
//*********************************************************************************

//******************************************************************************Agrega Examen
if($btn_aa_add_examen)
{

$sql_add_ex_pac = "insert into aa_examen values('$id_aa_ex','$ana_actual','$tipo_examen')";
mysql_query($sql_add_ex_pac,$link);
$error_ex =mysql_errno();


	switch($error_ex)		//Error Examen
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>EXAMEN YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE EXAMEN</span></p>";
		break;
	}
//echo "Agrega Examen: ".$sql_add_ex_pac."<br> Error:".$error_ex."<br>";	

}

//**********************************************************************************************
//******************************************************************************Adjuntar Examen
if ($btn_aa_add_examen)
 { 	
	$extension = explode(".",$adjunto_name);
	$adjunto_name = $id_aa_ex."-".$id_aa_rex."-".$tipo_examen.".".$extension[1];
	$sql_aa_rex_pac = "insert into resultado_examen values ('$id_aa_rex','$adjunto_name','$txt_ex_obs','$id_aa_ex')";
	
 
	 // echo $adjunto_name."<br>";

		if(!copy($adjunto, "../../Examenes/".$adjunto_name))
		{
			echo "error al copiar el archivo su tamaÒo debe ser menor a 2Mb";
		}
		else
		{
			echo "archivo subido con exito";
			$r_aa_rex_pac = mysql_query($sql_aa_rex_pac,$link);
		}
	
 }
 //echo "Error resultad_examen: ".$error_ex =mysql_errno();
  echo $sql_aa_rex_pac."<br>";
 // echo $adjunto_name."<br>";

//*********************************************************************************
// //******************************************************************************Borra Examen
 if($btn_del_ex)
 {
  
 $sql_del_ex_pac = "delete from resultado_examen where id_aa_examen = '$list_examenes'";
 mysql_query($sql_del_ex_pac,$link);	
 
  $sql_del_ex_pac_2 = "delete from aa_examen where id_aa_examen = '$list_examenes'";
 mysql_query($sql_del_ex_pac_2,$link);
 }
 //// echo $sql_del_ex_pac."<br>";
//**********************************************************************************************
//******************************************************************************Modifica Examen

//**********************************************************************************************

//******************************************************************************Lista Examen
$sql_aa_ex_pac = "select desc_examen, aa_examen.id_aa_examen from aa_examen, tipo_examen where id_ana_act = '$ana_actual' and tipo_examen.id_examen = aa_examen.id_examen order by tipo_examen.id_examen and aa_examen.id_aa_examen ='$id_aa_ex' ";
$r_aa_ex_pac = mysql_query($sql_aa_ex_pac,$link);
//echo "Lista Examen: ".$sql_aa_ex_pac."<br>";
//*********************************************************************************

						

echo "	<table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='5' bgcolor='#638cb5'><span class='Texto3'>EXAMENES";
echo "        </span><hr /></td>";
echo "      </tr>";
echo "      <tr>";

	echo "        <td colspan='3' class='Texto3' width='35%'>";
	echo "          <span class='Texto3'>$txt_nuevo_examen<hr></span>";
	
	echo "		  </td>";
	echo "        <td width='8%' rowspan='3' valign='top' class='Texto3' align='right'>Ex·menes:</td>";
	echo "        <td width='22%' rowspan='3'><select style=\"width:250px\" name='list_examenes' size='5' class='Texto2' id='list_examenes'>";
							while ($info_aa_exam = mysql_fetch_array($r_aa_ex_pac))
							{
								echo "<option value='$info_aa_exam[1]'>$info_aa_exam[0]</option> ";	
							}
	echo "        </select></td>";

echo "      </tr>";
echo "      <tr>";
	echo "        <td class='Texto3' valign='middle'>Tipo de Examen:</td>";
	echo "        <td valign='middle'>";
	echo "          <select  name='tipo_examen' class='Texto2' id='tipo_examen'>";
						if($btn_mod_ex)
						{
						echo "<option value='$id_ex[0]'>$tipo_examen</option> ";		
						}
						if(!($btn_mod_ex))
						{
							echo "<option>Examen</option> ";		
						}
							while ($r_aa_examg = mysql_fetch_array($r_aa_exam))
							{
								echo "<option value=$r_aa_examg[0]>$r_aa_examg[1]</option> ";	
							}
	
	echo "          </select>";
	echo "        </td>";
	echo "        <td valign='middle' >";
	echo "          <input type='submit' class='boton' $btn_agrega_ex/>";
	echo "        </td>";
echo "      </tr>";
echo "      <tr>";

	echo "        <td class='Texto3' valign='middle'>Adjuntar Resultado:</td>";
	echo "	      <td><input type='file' name='adjunto'/>";
	echo "        </td>";
	echo "        <td valign='middle'><input type='submit' class='boton2' name='btn_add_rex'  value='Agregar / Modificar otros Resultados' onclick='window.open(\"mod_adjunto.php\",\"_blank\")'/></td>";

echo "      </tr>";
echo "      <tr>";
	
	echo "        <td class='Texto3' valign='middle'>ObservaciÛn:</td>";
	echo "        <td colspan='2'><textarea name='txt_ex_obs' id='txt_ex_obs' cols='65' rows='4'>$info_rex_obs</textarea></td>";
echo "        <td align='right'>";
		echo "			<span class='Texto3'>Eliminar Examen</span>";
	echo "	      </td>";
	echo "        <td>";
	if($btn_mod_ex or $btn_add_rex)
	{
	 	$_SESSION['titulo']="3";
		$_SESSION['titulo2']="6";
	}
	echo "			<input type='submit' class='boton' name='btn_del_ex' id='btn_del_ex' value='Eliminar Examen' /><br>";
	echo "	      </td>";
echo "      </tr>";
echo "    </table><br>";

//***********************************************************************************************************
//**********************************************FIN EXAMEN***************************************************
//***********************************************************************************************************




echo "      </div>";
echo "    </form>";
echo "    ";





?>
    
    
    
  </div>
</div>

<script type="text/javascript">
<!--
var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("ana_actual");
//-->
</script>
</body>
</html>
