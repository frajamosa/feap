


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


//echo $_SESSION['id_pac'];





//************************************************************************************************Lista Pacientes       
//******************************************************************************Busca Pacientes
$sql_paciente = "select * from paciente order by apellido_pac";
$r_paciente = mysql_query($sql_paciente,$link);
//**********************************************************************************************
//******************************************************************************Busca Kinesiologo
$sql_kinesiologo = "select * from kinesiologo order by apellido_k";
$r_kinesiologo = mysql_query($sql_kinesiologo,$link);
//**********************************************************************************************
//******************************************************************************Busca Internista
$sql_internista = "select * from interno order by apellido_int";
$r_internista = mysql_query($sql_internista,$link);
//**********************************************************************************************



/*
if ($btn_cambio_pac)
{
 	$_SESSION['list']= "0";
 	//echo "<meta http-equiv='refresh' content='0;URL= ficha.php'>";
// 	unset ( $lst_pacientes	);
// 	unset ( $_SESSION['id_pac']	);

}
if ($btn_cambio_kine)
{
 	$_SESSION['list']= "2";
 	//echo "<meta http-equiv='refresh' content='0;URL= ficha.php'>";
// 	unset ( $lst_pacientes	);
// 	unset ( $_SESSION['id_pac']	);

}
if ($btn_cambio_int)
{
 	$_SESSION['list']= "4";
 	//echo "<meta http-equiv='refresh' content='0;URL= ficha.php'>";
// 	unset ( $lst_pacientes	);
// 	unset ( $_SESSION['id_pac']	);

}
if ($btn_n_ficha)
{
	$_SESSION['list'] = "100";
	
}

switch ($_SESSION['list'])
{
	case "0":
		$_SESSION['list'] = "2";
		$titulo = "Seleccione Paciente";
		$disabled = "";
		echo "<p class='Texto3'>$titulo<select name='lst_pacientes' id='lst_pacientes' onchange='this.form.submit()' $disabled>";
		
			if ($_SESSION['id_pac2'])
			{
			 	$pac = $_SESSION['id_pac'];
				echo "<option value=$pac >$pac</option> ";
			}
			else
			{
				echo "<option value = 'Paciente'>Paciente</option>";	
			}
			
				while ($r_pac = mysql_fetch_array($r_paciente))
			{
				echo "<option value=$r_pac[0]>$r_pac[2] $r_pac[1] - $r_pac[0]</option> ";	
			}
		echo "</select>";
		
		$nuevo_paciente = "<input type='submit' class='boton' name='btn_fic' value='Nuevo Paciente' onclick='window.open(\"../../paciente/pacientes_marcos_add.php\",\"_parent\")'/>";
		
//		echo $nuevo_paciente;
		
		if ($_SESSION['id_pac2'])
		{
		 	$paciente_rut = $_SESSION['id_pac2'];
			echo "	<meta http-equiv='refresh' content='0;URL=ficha.php'>";
		}
		else
		{
		$_SESSION['id_pac'] = $lst_pacientes;
		$paciente_rut = $_SESSION['id_pac'];	
		}
		
		
		if ($btn_cambio_pac)
		{
			$_SESSION['list'] = "1";
		}
		
		
	break;

	case "2":
		$_SESSION['list'] = "4";
		
		if (!$btn_cambio_kine and !$_SESSION['id_pac2'])
		{
		$_SESSION['id_pac'] = $lst_pacientes;
		$paciente_rut = $_SESSION['id_pac'];	
		}
		
		
		$titulo_k = "Seleccione Kinesiologo";
		$disabled_k = "";
		echo"<p class='Texto3'>$titulo_k <select name='lst_kine' id='lst_kine' onchange='this.form.submit()' $disabled_k><option value = 'kinesiologo'>kinesiologo</option> ";	
		while ($r_kine = mysql_fetch_array($r_kinesiologo))
			{
				echo "<option value=$r_kine[0]>$r_kine[2] $r_kine[1] - $r_kine[0]</option> ";	
			}
		echo "          </select>";
		echo "<input type='submit' class='boton' name='btn_cambio_pac' value='Cambiar Paciente'/>";
		
		$_SESSION['id_kine'] = $lst_kine;
		$kinesiologo_rut = $_SESSION['id_kine'];
		
		if ($btn_cambio_kine)
		{
			$_SESSION['list'] = "3";
		}
	break;
	
	case "4":
		$_SESSION['list'] = "6";
		
		if (!$btn_cambio_int)
		{
		$_SESSION['id_kine'] = $lst_kine;
		$kinesiologo_rut = $_SESSION['id_kine'];	
		}
		
		
		$titulo_int = "Seleccione internista";
		$disabled_int = "";
		echo"<p class='Texto3'>$titulo_int <select name='lst_int' id='lst_int' onchange='this.form.submit()' $disabled_int><option value = 'internista'>Internista</option> ";	
		while ($r_int = mysql_fetch_array($r_internista))
			{
				echo "<option value=$r_int[0]>$r_int[2] $r_int[1] - $r_int[0]</option> ";	
			}
		echo "          </select>";
		echo "<input type='submit' class='boton' name='btn_cambio_pac' value='Cambiar Paciente'/>   ";
		echo "<input type='submit' class='boton' name='btn_cambio_kine' value='Cambiar Kinesiologo'/>";
		$_SESSION['id_int'] = $lst_int;
		$internista_rut = $_SESSION['id_int'];
		
		if ($btn_cambio_int)
		{
			$_SESSION['list'] = "5";
		}
	break;
	
	case "6":
		$_SESSION['list'] = "7";
		
		$_SESSION['id_int'] = $lst_int;
		$internista_rut = $_SESSION['id_int'];
		$btns_cambio = "1";
		
	break;
	
	case "1":
		// echo "lst_pacientes: ".$lst_pacientes;
		$_SESSION['id_pac'] = $lst_pacientes;
		$paciente_rut = $_SESSION['id_pac'];
		$btns_cambio = "1";
	break;
	
	case "3":
		// echo "lst_kine: ".$lst_kine;
		$_SESSION['id_kine'] = $lst_kine;
		$kinesiologo_rut = $_SESSION['id_kine'];
		$btns_cambio = "1";
	break;
	
	case "5":
		// echo "lst_int: ".$lst_int;
		$_SESSION['id_int'] = $lst_int;
		$internista_rut = $_SESSION['id_int'];
		$btns_cambio = "1";
	break;

}

if ($btns_cambio == "1")
{
		echo "<input type='submit' class='boton' name='btn_cambio_pac' value='Cambiar Paciente'/>   ";
		echo "<input type='submit' class='boton' name='btn_cambio_kine' value='Cambiar Kinesiologo'/>    ";
		echo "<input type='submit' class='boton' name='btn_cambio_int' value='Cambiar Internista'/>";
}


//echo "list: ".$_SESSION['list']."<br>";



	$paciente_rut 		= $_SESSION['id_pac']	;
	$kinesiologo_rut 	= $_SESSION['id_kine']	;
	$internista_rut 	= $_SESSION['id_int']	;
	
//  echo "	$paciente_rut"		;
//  echo "	$kinesiologo_rut"	;
//  echo "	$internista_rut"	;

*/


echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2' >";
echo "      <p class='Texto'>Modificar Ficha<hr></p>";

if(!$lst_pacientes and !$lst_fichas)
{
	$titulo = "Seleccione Paciente";
	$disabled = "";
	echo "<p class='Texto3'>$titulo<select name='lst_pacientes' id='lst_pacientes' onchange='this.form.submit()' $disabled>";
	
		echo "<option value = 'Paciente'>Paciente</option>";	
	
		while ($r_pac = mysql_fetch_array($r_paciente))
	{
		echo "<option value=$r_pac[0]>$r_pac[2] $r_pac[1] - $r_pac[0]</option> ";	
	}
	echo "</select>";
	
}
else
{
 	if ($lst_pacientes)
 	{
	$_SESSION['id_pac'] = $lst_pacientes;	
	}
	
	$paciente_rut 		= $_SESSION['id_pac']	;
	$sql_fichas_pac = "select * from ficha where rut_pac = '$paciente_rut'";
	$r_sql_fichas_pac = mysql_query($sql_fichas_pac, $link);
	
	$titulo = "Seleccione Ficha";

	echo "<p class='Texto3'>$titulo<select name='lst_fichas' id='lst_fichas' onchange='this.form.submit()'>";
	
	
		echo "<option value = 'Ficha'>Ficha</option>";	
	
	
		while ($info_fichas = mysql_fetch_array($r_sql_fichas_pac))
	{
		echo "<option value=$info_fichas[0]>$info_fichas[0]</option> ";	
	}
	echo "</select>";
		$_SESSION['id_ficha'] = $lst_fichas;
}
if($lst_fichas)
{
	$_SESSION['id_ficha'] = $lst_fichas;
	
}
	
$id_ficha = $_SESSION['id_ficha'];
		
echo "      <center><br><br><hr><span class='Texto5'>Ficha No. $id_ficha </span><hr></center>";		


//____________CARGA INFO_____________________________
if($lst_fichas)
{
 	$sql_info_ficha_sel = "select * from ficha where id_ficha = '$id_ficha'";
 	$r_sql_info_fichas_sel = mysql_query($sql_info_ficha_sel,$link);
 	$info_fichas = mysql_fetch_array($r_sql_info_fichas_sel);
 //	echo $sql_info_ficha_sel;
 
	$_SESSION['ana_actual'] 	= $info_fichas[7];
	$_SESSION['id_eva_kine'] 	= $info_fichas[8];
	$_SESSION['id_eva_post'] 	= $info_fichas[3];
	$_SESSION['id_eva_neuro'] 	= $info_fichas[4];
	$_SESSION['id_p_func'] 		= $info_fichas[12];
	$_SESSION['id_trata'] 		= $info_fichas[10];
	$_SESSION['id_fza_musc'] 	= $info_fichas[5];
	$_SESSION['id_a_musc'] 		= $info_fichas[11];
	$_SESSION['id_r_artic'] 	= $info_fichas[2];
	$_SESSION['id_kine'] 		= $info_fichas[6];
	$_SESSION['id_inter'] 		= $info_fichas[1];	
}
	
	$id_ana_act 	= $_SESSION['ana_actual'];
	$id_eva_kine 	= $_SESSION['id_eva_kine'];
	$id_eva_post	= $_SESSION['id_eva_post'];
	$id_eva_neuro 	= $_SESSION['id_eva_neuro'];
	$id_p_func 		= $_SESSION['id_p_func'];
	$id_tratamiento = $_SESSION['id_trata'];
	$id_fza_musc 	= $_SESSION['id_fza_musc'];
	$id_a_musc 		= $_SESSION['id_a_musc'];
	$id_r_artic 	= $_SESSION['id_r_artic'];
	$kinesiologo_rut= $_SESSION['id_kine'];
	$internista_rut	= $_SESSION['id_inter'];
	$paciente_rut 	= $_SESSION['id_pac']	;


// echo $paciente_rut;
// echo $kinesiologo_rut;
// echo $internista_rut;


//****************************************************************************************************************
//************************************************************************************************Info. Pacientes   
//******************************************************************************Busca Paciente
$sql_paciente = "select * from paciente where rut_pac = '$paciente_rut'";
$r_paciente = mysql_query($sql_paciente,$link);
$info_paciente = mysql_fetch_array ($r_paciente);
$f = split ('-',$info_paciente[6]);

//**********************************************************************************************

//******************************************************************************Busca Kinesiologo
$sql_kinesiologo = "select * from kinesiologo where rut_k = '$kinesiologo_rut'";
$r_kinesiologo = mysql_query($sql_kinesiologo,$link);
$info_kinesiologo = mysql_fetch_array ($r_kinesiologo);

//**********************************************************************************************
//******************************************************************************Busca Internista
$sql_internista = "select * from interno where rut_int ='$internista_rut'";
$r_internista = mysql_query($sql_internista,$link);
$info_internista = mysql_fetch_array ($r_internista);

//**********************************************************************************************		


echo "    <table width='100%' border='1' bgcolor='#99CCFF' cellspacing='0' cellpadding='1'>";
echo "<tr><td class='Texto3' colspan='6' bgcolor='#CC3333' >Paciente</td></tr>";
echo "      <tr class='Texto3' bgcolor='#638cb5'>";
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
echo "        </tr><br>";
echo "    </table>";


echo "    <table width='80%' border='1' bgcolor='#99CCFF' cellspacing='0' cellpadding='1'>";
echo "		<tr><td class='Texto3' colspan='2' bgcolor='#CC3333'>Kinesiologo</td><td class='Texto3' colspan='2' bgcolor='#CC3333'>Internista</td>";

echo "		</tr>";
echo "      <tr class='Texto3' bgcolor='#638cb5'>";
echo "        <td>NOMBRE</td>";
echo "        <td>APELLIDO</td>";
echo "        <td>NOMBRE</td>";
echo "        <td>APELLIDO</td>";

echo "        </tr>";
echo "      <tr class='Texto2'>";
echo "        <td>$info_kinesiologo[1]</td>";
echo "        <td>$info_kinesiologo[2]</td>";
echo "        <td>$info_internista[1]</td>";
echo "        <td>$info_internista[2]</td>";

echo "        </tr>";
echo "    </table><hr>";



//****************************************************************************************************************
?>
  </tr>
</table>


<div id="ana_remota" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Anamnesia Remota</div>
  <div class="CollapsiblePanelContent">



<?php   
//echo "ana Actual: ".$_SESSION['ana_actual'];


 
// echo "hola";
//*******************************************************************************************************************************************
//-------------------------------------------------------------------------------------------------------------------------------------------
//**************************************INICIO ANAEVA REMOTA*********************************************************************************
//-------------------------------------------------------------------------------------------------------------------------------------------
//*******************************************************************************************************************************************  
$paciente_rut = $_SESSION['id_pac'];



/*
$id_ana_act = $_SESSION['ana_actual'];
$id_eva_kine = $_SESSION['id_eva_kine'];
$id_eva_post = $_SESSION['id_eva_post'];
$id_eva_neuro = $_SESSION['id_eva_neuro'];
$id_p_func = $_SESSION['id_p_func'];
$id_tratamiento = $_SESSION['id_trata'];
$id_fza_musc = $_SESSION['id_fza_musc'];
$id_a_musc = $_SESSION['id_a_musc'];
$id_r_artic = $_SESSION['id_r_artic'];
*/



/*	
	$sql_ficha="select * from ficha where id_ficha = '$lst_ficha'";
	$r_ficha = mysql_query($sql_ficha,$link);
	$info_ficha = mysql_fetch_array($r_ficha);

	$id_r_artic 	= $info_ficha[2];
	$id_eva_post 	= $info_ficha[3];
	$id_eva_neuro 	= $info_ficha[4];	
	$id_fza_musc 	= $info_ficha[5];	
	$id_ana_act 	= $info_ficha[7];	
	$id_eva_kine 	= $info_ficha[8];	
	$id_tratamiento = $info_ficha[10];
	$id_a_musc 		= $info_ficha[11];	
	$id_p_func 		= $info_ficha[12];	
	
	$_SESSION['ficha'] 			= $nuevo_id_ficha;
	$_SESSION['ana_actual'] 	= $id_ana_act;
	$_SESSION['id_eva_kine'] 	= $id_eva_kine;
	$_SESSION['id_eva_post'] 	= $id_eva_post;  
	$_SESSION['id_eva_neuro'] 	= $id_eva_neuro;
	$_SESSION['id_p_func'] 		= $id_p_func;
	$_SESSION['id_trata'] 		= $id_tratamiento;
	$_SESSION['id_fza_musc'] 	= $id_fza_musc; 
	$_SESSION['id_a_musc'] 		= $id_a_musc; 
	$_SESSION['id_r_artic'] 	= $id_r_artic;
		
*/
//--------------------------------------------------------------------------------FIN ID FICHA---------------









$ana_actual = $_SESSION['ana_actual'];	
$v = split ('-',$list_vicio_pac);
//************************************************************************************************Info. Vicio   
//******************************************************************************Busca Tipo Vicio
$sql_vicio = "select * from tipo_vicio";
$r_vicio = mysql_query($sql_vicio,$link);
$info_vicio = mysql_fetch_array ($r_vicio);
//**********************************************************************************************
//******************************************************************************Busca Ana Remota
$paciente_rut = $_SESSION['id_pac'];


	$sql_ar = "select id_ana_remota from ana_remota where rut_pac = '$paciente_rut' ";
	$r_ar = mysql_query($sql_ar,$link);
	$info_ar = mysql_fetch_array ($r_ar);
	if($info_ar[0]=="0")
	{
		$info_ar[0]=="1";
	}
	
// echo $sql_ar."<br>";
	$_SESSION['ana_remota'] = $info_ar[0];	


//**********************************************************************************************
//******************************************************************************Agrega Vicio
$ana_remota = $_SESSION['ana_remota'];
if($btn_vicio)
{
$sql_add_vic_pac = "insert into ar_vicio values('$ana_remota','$tipo_vicio','$frec_vicio')";
mysql_query($sql_add_vic_pac,$link);
$error_vic =mysql_errno();
	switch($error_vic)		//Error Vicio
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>VICIO YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE VICIO</span></p>";
		break;
	}
	
}
// echo $sql_add_vic_pac."<br>";
//**********************************************************************************************
//******************************************************************************Borra Vicio
if($btn_del_vicio)
{
$sql_del_vic_pac = "delete from ar_vicio where id_vicio = (select id_vicio from tipo_vicio where desc_vicio = '$v[0]') and id_ana_remota = $ana_remota";
mysql_query($sql_del_vic_pac,$link);	
}
////// echo $sql_del_vic_pac."<br>";
//**********************************************************************************************
//******************************************************************************Modifica Vicio
if($btn_mod_vicio)
{
$sql_id_vicio = "select * from tipo_vicio where desc_vicio = '$v[0]'";
$r_id_vicio = mysql_query($sql_id_vicio,$link);
$id_vicio = mysql_fetch_array ($r_id_vicio);

$btn_agrega_vicio = "name='btn_mod_vicio2' id='btn_mod_vicio2' value='Aceptar Modificacion Vicio'";	
$txt_nuevo_vicio = "Modificar Frecuencia:";
$txt_frec = $v[1];

$_SESSION['id_vicio'] = $id_vicio[0];

}
if($btn_mod_vicio2)
{
 $id_vicio2 = $_SESSION['id_vicio'];
$sql_mod_vic_pac = "update ar_vicio set  frecuencia = '$frec_vicio' where id_vicio = '$id_vicio2' and id_ana_remota = '$ana_remota'";
mysql_query($sql_mod_vic_pac,$link);	
}
////// echo $sql_mod_vic_pac."<br>";
//**********************************************************************************************
//******************************************************************************Lista Vicios Pac
$sql_vicio_pac = "select desc_vicio, frecuencia from ar_vicio, tipo_vicio where id_ana_remota = '$ana_remota' and tipo_vicio.id_vicio = ar_vicio.id_vicio";
$r_vicio_pac = mysql_query($sql_vicio_pac,$link);
//// echo $sql_vicio_pac."<br>";
//**********************************************************************************************
echo "	<table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='3' bgcolor='#638cb5'><span class='Texto3'>VICIOS";
echo "        </span><hr /></td>";

echo "      </tr>";
echo "      <tr>";

echo "        <td width='30%'>";
echo "          <span class='Texto3' >$txt_nuevo_vicio<hr></span>";
echo "          <span class='Texto3' >Tipo de Vicio: <br></span>";
echo "            <select  style=\"width:250px\" name='tipo_vicio' class='Texto2' id='tipo_vicio'>";
						if($btn_mod_vicio)
						{
						echo "<option value='$id_vicio[0]'>$v[0]</option> ";		
						}
						if(!($btn_mod_vicio))
						{
							echo "<option>Vicio</option> ";		
						}
						while ($r_vic = mysql_fetch_array($r_vicio))
						{
							echo "<option value=$r_vic[0]>$r_vic[1]</option> ";	
						}
echo "            </select>";
echo "            <br><span class='Texto3'>Frecuencia: </span><br>";
echo "            <input type='text' name='frec_vicio' id='frec_vicio' value='$txt_frec'/>";
echo "          <span class='Texto2'>$obligatorio</span>";
echo "    		  <input type='submit' class='boton' $btn_agrega_vicio />";
echo "        </td>";
echo "        <td valign='top' align='right' width='15%'>";
echo "          <p class='Texto3'>Vicios del Paciente:</p></td>";


echo "          <td td valign='top'>";
echo "			<select  style=\"width:250px\" name='list_vicio_pac' class='Texto2'  id='list_vicio_pac' multiple='multiple' size='7'>";	
						
							echo "<option>VICIO/FRECUENCIA</option>";

						while ($r_vic_pac = mysql_fetch_array($r_vicio_pac))
						{
							echo "<option value='$r_vic_pac[0]-$r_vic_pac[1]'>$r_vic_pac[0] - $r_vic_pac[1]</option> ";	
						}
echo "            </select>";
echo "        </td>";


echo "     </tr>";

echo "	   <tr valign='top'><td></td><td class ='Texto3' align='right'>Eliminar Vicio:</p></td>";
echo "	   <td><input type='submit' class='boton' name='btn_del_vicio' id='btn_del_vicio' value='Eliminar Vicio' /></td>";

echo "     </td></tr>";

echo "	   <tr valign='top'><td></td><td class ='Texto3' align='right'>Modificar Vicio: </td>";
echo "	   <td><input type='submit' class='boton' name='btn_mod_vicio' id='btn_mod_vicio' value='Modificar Vicio' /></td>";
echo "     </td></tr>";

echo "    </table><br>";
//*********************************************************************************************************
//**************************************VICIO OK***********************************************************
//*********************************************************************************************************


//*********************************************************************************************************
//**************************************PATOLOGIA***********************************************************
//*********************************************************************************************************

	
$p = split ('-',$list_pato_pac);
//************************************************************************************************Info. pato   
//******************************************************************************Busca Tipo pato
$sql_pato = "select * from tipo_patologia";
$r_pato = mysql_query($sql_pato,$link);
$info_pato = mysql_fetch_array ($r_pato);
//**********************************************************************************************
//******************************************************************************Agrega pato
$ana_remota = $_SESSION['ana_remota'];
if($btn_pato)
{
$sql_add_pat_pac = "insert into ar_patologia values('$tipo_pato','$ana_remota')";
mysql_query($sql_add_pat_pac,$link);	
$error_pato =mysql_errno();
//echo "Error Pato:".$error_pato."<br>";
	switch($error_pato)		//Error Cirugia
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>PATOLOGIA YA REGISTRADA EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE PATOLOGIA</span></p>";
		break;
	}
}
//// echo $sql_add_pat_pac."<br>";
//**********************************************************************************************
//******************************************************************************Borra pato
if($btn_del_pato)
{
$sql_del_pat_pac = "delete from ar_patologia where id_patologia = (select id_patologia from tipo_patologia where desc_patologia = '$p[0]') and id_ana_remota = $ana_remota";
mysql_query($sql_del_pat_pac,$link);	
}
//// echo $sql_del_pat_pac."<br>";
//**********************************************************************************************
//******************************************************************************Lista patos Pac
$sql_pato_pac = "select desc_patologia from ar_patologia, tipo_patologia where id_ana_remota = '$ana_remota' and tipo_patologia.id_patologia = ar_patologia.id_patologia";
$r_pato_pac = mysql_query($sql_pato_pac,$link);
//// echo $sql_pato_pac."<br>";
//**********************************************************************************************

echo "	<table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='3' bgcolor='#638cb5'><span class='Texto3'>PATOLOGIAS";
echo "        </span><hr /></td>";

echo "      </tr>";
echo "      <tr>";
echo "        <td width='30%'>";
echo "          <span class='Texto3'>Nueva Patologia<hr></span>";
echo "          <span class='Texto3'>Tipo de Patologia: <br></span>";
echo "            <select  style=\'width:250px\' name='tipo_pato' class='Texto2' id='tipo_pato'>";

						echo "<option>Patologia</option> ";		
						
						while ($r_pat = mysql_fetch_array($r_pato))
						{
							echo "<option value=$r_pat[0]>$r_pat[1]</option> ";	
						}
echo "            </select>";
echo "    		  <p><input type='submit' class='boton' name='btn_pato' id='btn_pato' value='Agregar Patologia' onclick='window.location.href=\"#pato\"'/>";
echo "			  <br><span class='Texto3'> </span>";
echo "			  <br>";
echo "        </td>";
echo "        <td valign='top' width='15%' align='right'>";
echo "          <p class='Texto3'>Patologias del Paciente:</p></td>";
echo "          <td td valign='top' >";
echo "			<select  style=\"width:250px\" name='list_pato_pac' class='Texto2' id='list_pato_pac' multiple='multiple' size='7'>";	

						while ($r_pat_pac = mysql_fetch_array($r_pato_pac))
						{
							echo "<option value='$r_pat_pac[0]'>$r_pat_pac[0]</option> ";	
						}
echo "            </select>";
echo "        </td>";
echo "     </tr>";
echo "	   <tr valign='top'><td></td><td class ='Texto3' align='right'>Eliminar Patologia:</p></td>";
echo "	   <td><input type='submit' class='boton' name='btn_del_pato' id='btn_del_pato' value='Eliminar Patologia' /></td>";

echo "     </td></tr>";

echo "    </table><br>";


//*********************************************************************************************************
//**************************************PATOLOGIA OK***********************************************************
//*********************************************************************************************************

//*********************************************************************************************************
//**************************************CIRUGIA***********************************************************
//*********************************************************************************************************

	
$c = split ('-',$list_ciru_pac);
//************************************************************************************************Info. Cirugia   
//******************************************************************************Busca Tipo cirugia
$sql_ciru = "select * from tipo_cirugia";
$r_ciru = mysql_query($sql_ciru,$link);
$info_ciru = mysql_fetch_array ($r_ciru);
//// echo $sql_ciru."<br>";
//**********************************************************************************************
//******************************************************************************Agrega cirugia
$ana_remota = $_SESSION['ana_remota'];
if($btn_ciru)
{
$sql_add_ciru_pac = "insert into ar_cirugia values('$tipo_ciru','$ana_remota')";
mysql_query($sql_add_ciru_pac,$link);	
$error_ciru =mysql_errno();
//echo "Error Cirugia:".$error_ciru."<br>";

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
//// echo $sql_add_ciru_pac."<br>";
//**********************************************************************************************
//******************************************************************************Borra cirugia
if($btn_del_ciru)
{
$sql_del_ciru_pac = "delete from ar_cirugia where id_cirugia = (select id_cirugia from tipo_cirugia where desc_cirugia = '$c[0]') and id_ana_remota = $ana_remota";
mysql_query($sql_del_ciru_pac,$link);	
echo "<p class='Texto'><span class='Texto'>CIRUGIA \"$c[0]\" ELIMINADA</span></p>";
}
//// echo $sql_del_ciru_pac."<br>";
//**********************************************************************************************
//******************************************************************************Lista cirus Pac
$sql_ciru_pac = "select desc_cirugia from ar_cirugia, tipo_cirugia where id_ana_remota = '$ana_remota' and tipo_cirugia.id_cirugia = ar_cirugia.id_cirugia";
$r_ciru_pac = mysql_query($sql_ciru_pac,$link);
//// echo $sql_ciru_pac."<br>";
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
echo "            <select  style=\'width:250px\' name='tipo_ciru' class='Texto2' id='tipo_ciru'>";

						echo "<option>cirugia</option> ";		
						
						while ($r_cirug = mysql_fetch_array($r_ciru))
						{
							echo "<option value=$r_cirug[0]>$r_cirug[1]</option> ";	
						}
echo "            </select>";
echo "    		  <p><input type='submit' class='boton' name='btn_ciru' id='btn_ciru' value='Agregar Cirugia'/>";
echo "			  <br><span class='Texto3'></span>";
echo "			  ";
echo "        </td>";

echo "        <td valign='top' width='15%'>";
echo "          <p class='Texto3'>Cirugias del Paciente:</p></td>";
echo "          <td td valign='top'>";
echo "			<select  style=\"width:250px\" name='list_ciru_pac' class='Texto2' id='list_ciru_pac' multiple='multiple' size='7'>";	
						

						while ($r_cirug_pac = mysql_fetch_array($r_ciru_pac))
						{
							echo "<option value='$r_cirug_pac[0]'>$r_cirug_pac[0]</option> ";	
						}
echo "            </select>";
echo "        </td>";

echo "	   <tr valign='top'><td></td><td class ='Texto3' align='right'>Eliminar Cirugia: </p></td>";
echo "	   <td><input type='submit' class='boton' name='btn_del_ciru' id='btn_del_ciru' value='Eliminar Cirugia' /></td>";

echo "     </td></tr>";

echo "    </table>";


//*********************************************************************************************************
//**************************************CIRUGIA OK***********************************************************
//*********************************************************************************************************

//echo "</form>";
?>
  </div>
</div>
    
  </div>
</div>

<script type="text/javascript">
<!--
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("ana_remota");
//-->
</script>
</body>
</html>

