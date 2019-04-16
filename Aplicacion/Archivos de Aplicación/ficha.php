


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
	$txt_frec=""; 
	$btn_agrega_vicio = "name='btn_vicio' id='btn_vicio' value='Agregar Vicio'";
	$txt_nuevo_vicio = "Nuevo Vicio:";
echo "<body>";

echo "<form action='$PHP_SELF' method='post'>";


echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2'>";
echo "      <p class='Texto'>Ficha Paciente</p>";



if ($_SESSION['id_int'])
{
	$flag = "1";
}
      

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


//echo $_SESSION['usr'];
if ($_SESSION['usr']<> "add")
{
				 if(!$lst_pacientes )
				 {
					$titulo = "Seleccione Paciente";
					$disabled = "";
					echo "<p class='Texto3'>$titulo<select name='lst_pacientes' id='lst_pacientes' onchange='this.form.submit()' $disabled><option value = 'Paciente'>Paciente</option> ";	
					
							while ($r_pac = mysql_fetch_array($r_paciente))
						{
							echo "<option value=$r_pac[0]>$r_pac[2] $r_pac[1] - $r_pac[0]</option> ";	
						}
					echo "          </select>";
					
				  }
				  if ($lst_pacientes)
				  {
				 	if ($lst_pacientes <> "Paciente")
					{
					 
					$_SESSION['id_pac'] = $lst_pacientes;
					$paciente_rut = $_SESSION['id_pac'];
					
					}
				  }
					// echo $nuevo_paciente;
					$paciente_rut = $_SESSION['id_pac'];
					////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//******************************************************************************Busca Ficha
					$sql_ficha = "select id_ficha, fec_ficha from ficha where rut_pac = '$paciente_rut' order by fec_ficha";
					$r_ficha = mysql_query($sql_ficha,$link);
					// echo $sql_ficha;
					//**********************************************************************************************
					 if(!$lst_ficha and $lst_pacientes)
					 {
						$titulo_k = "Seleccione Ficha";
						$disabled_k = "";
						echo"<p class='Texto3'>$titulo_k <select name='lst_ficha' id='lst_ficha' onchange='this.form.submit()' $disabled_k><option value = 'kinesiologo'>Ficha</option> ";	
					 	while ($r_fic = mysql_fetch_array($r_ficha))
							{
								echo "<option value=$r_fic[0]>$r_fic[0] - $r_fic[1]</option> ";	
							}
						echo "          </select>";
					}
					if ($lst_ficha)
					{
					 	if ($lst_ficha <> "Ficha")
						{
						 
						$_SESSION['id_ficha'] = $lst_ficha;
						$id_ficha = $_SESSION['id_ficha'];
						
						}
						$titulo_k = "Ficha Seleccionadao";
						$disabled_k = "disabled = 'diasbled'";
						$primer_value_k = "<option value = '$id_ficha'>$id_ficha</option> ";	
					}
							
					if ($lst_pacientes)
					{			
						echo "<input type='hidden' name='lst_pacientes' value='$paciente_rut'/>";
						$id_ficha = $_SESSION['id_ficha'];
					}
						
					////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else
{
					if($btn_fic)
					{
					 	$_SESSION['nuevo_pac']="1";
						echo "<meta http-equiv='refresh' content='0;URL=add_paciente.php'>";
						
					} 
					if ($_SESSION['nuevo_pac']=="1")
						 	{
								$lst_pacientes = $_SESSION['id_pac'];
							}
					 if (!$_SESSION['id_pac'] or !$btn_n_ficha and $flag<>"1")
					 {
						
					
						 if(!$lst_pacientes)
						 {
							$titulo = "Seleccione Paciente";
							$disabled = "";
							echo "<p class='Texto3'>$titulo<select name='lst_pacientes' id='lst_pacientes' onchange='this.form.submit()' $disabled><option value = 'Paciente'>Paciente</option> ";	
							
									while ($r_pac = mysql_fetch_array($r_paciente))
								{
									echo "<option value=$r_pac[0]>$r_pac[2] $r_pac[1] - $r_pac[0]</option> ";	
								}
							echo "          </select>";
							$nuevo_paciente = "<input type='submit' class='boton' name='btn_fic' value='Nuevo Paciente'/>";
													
						}
						
						if ($lst_pacientes)
						{
						 	
						 	if ($lst_pacientes <> "Paciente")
							{
							 
							$_SESSION['id_pac'] = $lst_pacientes;
							$paciente_rut = $_SESSION['id_pac'];
							
							}
						}
							echo $nuevo_paciente;
							$paciente_rut = $_SESSION['id_pac'];
							////////////////////////////////////////////////////////////////////////////////////////////////////////////
							 if(!$lst_kine and $lst_pacientes)
							 {
								$titulo_k = "Seleccione Kinesiologo";
								$disabled_k = "";
								echo"<p class='Texto3'>$titulo_k <select name='lst_kine' id='lst_kine' onchange='this.form.submit()' $disabled_k><option value = 'kinesiologo'>kinesiologo</option> ";	
							 	while ($r_kine = mysql_fetch_array($r_kinesiologo))
									{
										echo "<option value=$r_kine[0]>$r_kine[2] $r_kine[1] - $r_kine[0]</option> ";	
									}
								echo "          </select>";
							}
							if ($lst_kine)
							{
							 	if ($lst_kine <> "kinesiologo")
								{
								 
								$_SESSION['id_kine'] = $lst_kine;
								$kinesiologo_rut = $_SESSION['id_kine'];
								
								}
								$titulo_k = "Kinesiologo Seleccionado";
								$disabled_k = "disabled = 'diasbled'";
								$primer_value_k = "<option value = '$kinesiologo_rut'>$kinesiologo_rut</option> ";	
							}
									
							if ($lst_pacientes)
							{			
								echo "<input type='hidden' name='lst_pacientes' value='$paciente_rut'/>";
								$kinesiologo_rut = $_SESSION['id_kine'];
							}
								
							////////////////////////////////////////////////////////////////////////////////////////////////////////////
							 if(!$lst_int and $lst_kine)
							 {
								$titulo_int = "Seleccione internista";
								$disabled_int = "";
								echo"<p class='Texto3'>$titulo_int <select name='lst_int' id='lst_int' onchange='this.form.submit()' $disabled_int><option value = 'internista'>Internista</option> ";	
							 	while ($r_int = mysql_fetch_array($r_internista))
									{
										echo "<option value=$r_int[0]>$r_int[2] $r_int[1] - $r_int[0]</option> ";	
									}
								echo "          </select>";
							}
							if ($lst_int)
							{
								
							 	if ($lst_int <> "internista")
								{
								$sql_internista = "select * from interno where rut_int = '$lst_int'";
								$r_internista = mysql_query($sql_internista,$link);
								$r_int = mysql_fetch_array($r_internista);
								
								$_SESSION['id_int'] = $lst_int;
								$internista_rut = $_SESSION['id_int'];
								
								}
								$titulo_int = "Internista Seleccionado";
								$disabled_int = "disabled = 'diasbled'";
								$primer_value_int = "<option value = '$r_int[0]'>$r_int[1] $r_int[2]</option> ";	
							}
									
							if ($lst_kine)
							{
							
								
								echo "<input type='hidden' name='lst_pacientes' value='$paciente_rut'/>";
								echo "<input type='hidden' name='lst_kine' value='$kinesiologo_rut'/>";
								$internista_rut = $_SESSION['id_int'];
							}
						
						
					}
	
}


echo "        </p>";

if($_SESSION['id_pac'])
{
	$paciente_rut = $_SESSION['id_pac'];
	$kinesiologo_rut = $_SESSION['id_kine'];
	$internista_rut = $_SESSION['id_int'];
}


//****************************************************************************************************************
//************************************************************************************************Info. Pacientes   
//******************************************************************************Busca Paciente
$sql_paciente = "select * from paciente where rut_pac = '$paciente_rut'";
$r_paciente = mysql_query($sql_paciente,$link);
$info_paciente = mysql_fetch_array ($r_paciente);
$f = split ('-',$info_paciente[6]);

//**********************************************************************************************
if($_SESSION['usr']<>"add")
{
//******************************************************************************Busca Kinesiologo
$sql_kinesiologo = "select * from kinesiologo where rut_k = (select rut_k from ficha where id_ficha = '$lst_ficha')";
$r_kinesiologo = mysql_query($sql_kinesiologo,$link);
$info_kinesiologo = mysql_fetch_array ($r_kinesiologo);

//**********************************************************************************************
//******************************************************************************Busca Internista
$sql_internista = "select * from interno where rut_int = (select rut_int from ficha where id_ficha = '$lst_ficha')";
$r_internista = mysql_query($sql_internista,$link);
$info_internista = mysql_fetch_array ($r_internista);

//**********************************************************************************************	
}
else
{
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
}




echo "    <table width='100%' border='0'>";
echo "<tr><td class='Texto' colspan='6'>Paciente<hr></td></tr>";
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
echo "        </tr><br>";
echo "    </table>";
echo "    <table width='80%' border='0'>";
echo "		<tr><td class='Texto' colspan='2'>Kinesiologo<hr></td><td class='Texto' colspan='2'>Internista<hr></td>";
if($_SESSION['id_int'] and $lst_int)
{
echo "		  <td rowspan ='3'><center><input type='submit' class='boton' name='btn_n_ficha'  value='Crear Ficha' /></center></td>";	
}
if (!$lst_int)
{
echo "		  <td rowspan ='3'><center><input type='submit' class='boton' name='btn_n_ficha'  value='Ficha Creada' disabled='disabled'/></center></td>";
}
echo "		</tr>";
echo "      <tr class='Texto3'>";
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
echo "    </table>";



//****************************************************************************************************************
   
?>
    <p class="Texto4">&nbsp;</p></td>
  </tr>
</table>

<div id="ana_remota" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Anaeva Remota</div>
  <div class="CollapsiblePanelContent">



<?php   
//*******************************************************************************************************************************************
//-------------------------------------------------------------------------------------------------------------------------------------------
//**************************************INICIO ANAEVA REMOTA*********************************************************************************
//-------------------------------------------------------------------------------------------------------------------------------------------
//*******************************************************************************************************************************************  
$paciente_rut = $_SESSION['id_pac'];
//------------------------------------------------------------------------------------ID FICHA---------------
if ($_SESSION['usr']=="add")
{
	$sql_id_ficha="select max(id_ficha) from ficha";
	$r_id_ficha = mysql_query($sql_id_ficha,$link);
	$info_id_ficha = mysql_fetch_array ($r_id_ficha);

	
	if ($info_id_ficha[0] == 'NULL')
	{
	$nuevo_id_ficha="1";
	}
	else
	{
	$nuevo_id_ficha=$info_id_ficha[0]+1;
	}
	
 	// echo $sql_n_id_ficha."<br>";
 	// echo $nuevo_n_id_ficha."<br>";
// 	// echo $info_n_id_ficha[0]."<br>";


$_SESSION['ficha'] = $nuevo_id_ficha;//*******************************************

//// echo $sql_id_ficha."<br>";
//echo "FICHA ".$nuevo_id_ficha."<br>";
//-------------------------------------------------------------------------------FIN ID FICHA----------------
//------------------------------------------------------------------------------------ID ANAEVA ACTUAL-------
if($_SESSION['usr']=="add")

 	
	$sql_id_ana_act="select max(id_ana_act) from ana_actual";
	$r_id_ana_act = mysql_query($sql_id_ana_act,$link);
	$info_id_ana_act = mysql_fetch_array ($r_id_ana_act);

	
	if ($info_id_ana_act[0] == 'NULL')
	{
	$nuevo_id_ana_act="1";
	}
	else
	{
	$nuevo_id_ana_act=$info_id_ana_act[0]+1;
	}
	
 	// echo $sql_n_id_ana_act."<br>";
 	// echo $nuevo_n_id_ana_act."<br>";
// 	// echo $info_n_id_ana_act[0]."<br>";




$_SESSION['ana_actual'] = $nuevo_id_ana_act;//*******************************************

//// echo $sql_id_ana_act."<br>";
//echo "ANA ACT ".$nuevo_id_ana_act."<br>";
//-------------------------------------------------------------------------------FIN ID ANAEVA ACTUAL---------
//------------------------------------------------------------------------------------ID E. KINE-------

	$sql_id_eva_kine="select max(id_ek) from eva_kine";
	$r_id_eva_kine = mysql_query($sql_id_eva_kine,$link);
	$info_id_eva_kine = mysql_fetch_array ($r_id_eva_kine);
	if ($info_id_eva_kine[0] == 'NULL')
	{
	$nuevo_id_eva_kine="1";
	}
	else
	{
	$nuevo_id_eva_kine=$info_id_eva_kine[0]+1;
	}





$_SESSION['id_eva_kine'] = $nuevo_id_eva_kine;//********************************************
	

// // echo $sql_id_eva_kine."<br>";
//echo "EVA KINE ".$nuevo_id_eva_kine."<br>";
// // echo $info_id_eva_kine[0]."<br>";

//-------------------------------------------------------------------------------FIN ID ID E. KINE--------- 
//------------------------------------------------------------------------------------ID E. POSTURAL--



	$sql_id_eva_post="select max(id_eva_post) from eva_postural";
	$r_id_eva_post = mysql_query($sql_id_eva_post,$link);
	$info_id_eva_post = mysql_fetch_array ($r_id_eva_post);
	if ($info_id_eva_post[0] == 'NULL')
	{
	$nuevo_id_eva_post="1";
	}
	else
	{
	$nuevo_id_eva_post=$info_id_eva_post[0]+1;
	}

	
$_SESSION['id_eva_post'] = $nuevo_id_eva_post;//**********************************************
	

// // echo $sql_id_eva_post."<br>";
//echo "EVA POST ".$nuevo_id_eva_post."<br>";
// // echo $info_id_eva_post[0]."<br>";

//-------------------------------------------------------------------------------FIN ID ID E. POSTURAL-- 
//------------------------------------------------------------------------------------ID R. ARTICULAR-

		$sql_id_r_artic="select max(id_rng_art) from rng_articular";
		$r_id_r_artic = mysql_query($sql_id_r_artic,$link);
		$info_id_r_artic = mysql_fetch_array ($r_id_r_artic);
		if ($info_id_r_artic[0] == 'NULL')
		{
		$nuevo_id_r_artic="1";
		}
		else
		{
		$nuevo_id_r_artic=$info_id_r_artic[0]+1;
		}
	

$_SESSION['id_r_artic'] = $nuevo_id_r_artic;//**********************************************


	
// // echo $sql_id_r_artic."<br>";
//echo "RNG ART ".$id_r_artic."<br>";
// // echo $info_id_r_artic[0]."<br>";

//-------------------------------------------------------------------------------FIN ID R. ARTICULAR-
//------------------------------------------------------------------------------------ID A. MUSCULAR-

		$sql_id_a_musc="select max(id_aco_musc) from acor_muscular";
		$r_id_a_musc = mysql_query($sql_id_a_musc,$link);
		$info_id_a_musc = mysql_fetch_array ($r_id_a_musc);
		if ($info_id_a_musc[0] == 'NULL')
		{
		$nuevo_id_a_musc="1";
		}
		else
		{
		$nuevo_id_a_musc=$info_id_a_musc[0]+1;
		}
	
	
	
	
$_SESSION['id_a_musc'] = $nuevo_id_a_musc;//**********************************************



// // echo $sql_id_a_musc."<br>";
//echo "ACO MUSC ".$id_a_musc."<br>";
// // echo $info_id_a_musc[0]."<br>";

//-------------------------------------------------------------------------------FIN ID A. MUSCULAR-
//------------------------------------------------------------------------------------ID FZA. MUSCULAR-


		$sql_id_fza_musc="select max(id_fza_musc) from fza_muscular";
		$r_id_fza_musc = mysql_query($sql_id_fza_musc,$link);
		$info_id_fza_musc = mysql_fetch_array ($r_id_fza_musc);
		if ($info_id_fza_musc[0] == 'NULL')
		{
		$nuevo_id_fza_musc="1";
		}
		else
		{
		$nuevo_id_fza_musc=$info_id_fza_musc[0]+1;
		}


	
$_SESSION['id_fza_musc'] = $nuevo_id_fza_musc;//**********************************************


	
// // echo $sql_id_fza_musc."<br>";
//echo "FZA MUSC ".$id_fza_musc."<br>";
// // echo $info_id_fza_musc[0]."<br>";

//-------------------------------------------------------------------------------FIN ID FZA. MUSCULAR-
//------------------------------------------------------------------------------------ID E. EUROLOGICA--


	$sql_id_eva_neuro="select max(id_eva_neuro) from eva_neuro";
	$r_id_eva_neuro = mysql_query($sql_id_eva_neuro,$link);
	$info_id_eva_neuro = mysql_fetch_array ($r_id_eva_neuro);
	if ($info_id_eva_neuro[0] == 'NULL')
	{
	$nuevo_id_eva_neuro="1";
	}
	else
	{
	$nuevo_id_eva_neuro=$info_id_eva_neuro[0]+1;
	}
	
$_SESSION['id_eva_neuro'] = $nuevo_id_eva_neuro;//**********************************************
	

// // echo $sql_id_eva_neuro."<br>";
//echo "EVA NEURO".$nuevo_id_eva_neuro."<br>";
// // echo $info_id_eva_neuro[0]."<br>";

//-------------------------------------------------------------------------------FIN ID ID E. NEUROLOGICA-- 
//------------------------------------------------------------------------------------ID P. FUNCIONAL---


	$sql_id_p_func="select max(id_pf) from prueba_funcional";
	$r_id_p_func = mysql_query($sql_id_p_func,$link);
	$info_id_p_func = mysql_fetch_array ($r_id_p_func);
	if ($info_id_p_func[0] == 'NULL')
	{
	$nuevo_id_p_func="1";
	}
	else
	{
	$nuevo_id_p_func=$info_id_p_func[0]+1;
	}


	
$_SESSION['id_p_func'] = $nuevo_id_p_func;//**********************************************
	

// // echo $sql_id_p_func."<br>";
//echo "P. FUNC".$nuevo_id_p_func."<br>";
// // echo $info_id_p_func[0]."<br>";

//-------------------------------------------------------------------------------FIN ID ID P. FUNCIONAL---
//------------------------------------------------------------------------------------ID TRATAMIENTO------


	$sql_id_trata="select max(id_trat) from tratamiento";
	$r_id_trata = mysql_query($sql_id_trata,$link);
	$info_id_trata = mysql_fetch_array ($r_id_trata);
	if ($info_id_trata[0] == 'NULL')
	{
	$nuevo_id_trata="1";
	}
	else
	{
	$nuevo_id_trata=$info_id_trata[0]+1;
	}




	
$_SESSION['id_trata'] = $nuevo_id_trata;//**********************************************
	

// // echo $sql_id_trata."<br>";
//echo "TRATAM".$nuevo_id_trata."<br>";
// // echo $info_id_trata[0]."<br>";

//-------------------------------------------------------------------------------FIN ID ID TRATAMIENTO------
$id_ana_act = $_SESSION['ana_actual'];
$id_eva_kine = $_SESSION['id_eva_kine'];
$id_eva_post = $_SESSION['id_eva_post'];
$id_eva_neuro = $_SESSION['id_eva_neuro'];
$id_p_func = $_SESSION['id_p_func'];
$id_tratamiento = $_SESSION['id_trata'];
$id_fza_musc = $_SESSION['id_fza_musc'];
$id_a_musc = $_SESSION['id_a_musc'];
$id_r_artic = $_SESSION['id_r_artic'];
}


if($btn_n_ficha)
{
//******************************************************************************CREA FICHA
//--ANA ACTUAL--
$sql_ana_act="insert into ana_actual (id_ana_act) values ('$id_ana_act')";

//--EVA KINE--
$sql_eva_kine="insert into eva_kine (id_ek) values ('$id_eva_kine')";

//--FZA MUSUCLAR--
$sql_fza_musc="insert into fza_muscular (id_fza_musc) values ('$id_fza_musc')";

//--EVA NEURO--
$sql_eva_neuro="insert into eva_neuro (id_eva_neuro) values ('$id_eva_neuro')";

//--TRATAMIENTO--
$sql_trata="insert into tratamiento (id_trat) values ('$id_tratamiento')";

//--EVA POST--
$sql_eva_post="insert into eva_postural (id_eva_post) values ('$id_eva_post')";


mysql_query($sql_ana_act,$link);
mysql_query($sql_eva_kine,$link);
mysql_query($sql_fza_musc,$link);
mysql_query($sql_eva_neuro,$link);
mysql_query($sql_trata,$link);
mysql_query($sql_eva_post,$link);

$id_ficha = $_SESSION['ficha'];
$sql_ficha = "insert into ficha  (id_ficha,
									rut_int,
									rut_k,
									rut_pac,
									fec_ficha,
									id_ana_act,
									id_ek,
									id_fza_musc,
									id_eva_neuro,
									id_trat,
									id_eva_post) 
				values('$id_ficha',
						'$internista_rut',
						'$internista_rut',
						'$paciente_rut',
						'1111-11-11',
						'$id_ana_act',
						'$id_eva_kine',
						'$id_fza_musc',
						'$id_eva_neuro',
						'$id_tratamiento',
						'$id_eva_post')";
$r_ficha = mysql_query($sql_ficha,$link);
 echo $sql_ficha;

}
else
{
	
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
		
}
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
	////// echo $sql_ar."<br>";
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
//// echo $sql_add_vic_pac."<br>";
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


echo "	<table width='100%' border='0'>";
echo "      <tr>";
echo "        <td colspan='3'><span class='Texto3'>VICIOS";
echo "        </span><hr /></td>";

echo "      </tr>";
echo "      <tr>";

echo "        <td valign='top' width='15%'>";
echo "          <p class='Texto3'>Vicios del Paciente:</p></td>";
echo "          <td td valign='top' width='22%'>";
echo "			<select name='list_vicio_pac' class='Texto2' id='list_vicio_pac' multiple='multiple' size='7'>";	
						
							echo "<option>VICIO/FRECUENCIA</option>";

						while ($r_vic_pac = mysql_fetch_array($r_vicio_pac))
						{
							echo "<option value='$r_vic_pac[0]-$r_vic_pac[1]'>$r_vic_pac[0] - $r_vic_pac[1]</option> ";	
						}
echo "            </select>";
echo "        </td>";

echo "        <td>";
echo "          <span class='Texto3'>$txt_nuevo_vicio<hr></span>";
echo "          <span class='Texto3'>Tipo de Vicio: <br></span>";
echo "            <select name='tipo_vicio' class='Texto2' id='tipo_vicio'>";
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
echo "     </tr>";

echo "	   <tr><td class ='Texto3' align='right'>Eliminar Vicio: </td>";
echo "	   <td><input type='submit' class='boton' name='btn_del_vicio' id='btn_del_vicio' value='Eliminar Vicio' /></td>";
echo "     </td></tr>";

echo "	   <tr><td class ='Texto3' align='right'>Modificar Vicio: </td>";
echo "	   <td><input type='submit' class='boton' name='btn_mod_vicio' id='btn_mod_vicio' value='Modificar Vicio' /></td>";
echo "     </td></tr>";

echo "    </table>";
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

echo "	<table width='100%' border='0'>";
echo "      <tr>";
echo "        <td colspan='3'><span class='Texto3'>PATOLOGIAS";
echo "        </span><hr /></td>";

echo "      </tr>";
echo "      <tr>";

echo "        <td valign='top' width='15%'>";
echo "          <p class='Texto3'>Patologias del Paciente:</p></td>";
echo "          <td td valign='top' width='22%'>";
echo "			<select name='list_pato_pac' class='Texto2' id='list_pato_pac' multiple='multiple' size='7'>";	
						

						while ($r_pat_pac = mysql_fetch_array($r_pato_pac))
						{
							echo "<option value='$r_pat_pac[0]'>$r_pat_pac[0]</option> ";	
						}
echo "            </select>";
echo "        </td>";

echo "        <td>";
echo "          <span class='Texto3'>Nueva Patologia<hr></span>";
echo "          <span class='Texto3'>Tipo de Patologia: <br></span>";
echo "            <select name='tipo_pato' class='Texto2' id='tipo_pato'>";

						echo "<option>Patologia</option> ";		
						
						while ($r_pat = mysql_fetch_array($r_pato))
						{
							echo "<option value=$r_pat[0]>$r_pat[1]</option> ";	
						}
echo "            </select>";
echo "    		  <input type='submit' class='boton' name='btn_pato' id='btn_pato' value='Agregar Patologia'/>";
echo "			  <br><span class='Texto3'>Eliminar Patologia: </span>";
echo "			  <br><input type='submit' class='boton' name='btn_del_pato' id='btn_del_pato' value='Eliminar Patologia' />";
echo "        </td>";
echo "     </tr>";

echo "    </table>";

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

echo "	<table width='100%' border='0'>";
echo "      <tr>";
echo "        <td colspan='3'><span class='Texto3'>CIRUGIAS";
echo "        </span><hr /></td>";

echo "      </tr>";
echo "      <tr>";

echo "        <td valign='top' width='15%'>";
echo "          <p class='Texto3'>Cirugias del Paciente:</p></td>";
echo "          <td td valign='top' width='22%'>";
echo "			<select name='list_ciru_pac' class='Texto2' id='list_ciru_pac' multiple='multiple' size='7'>";	
						

						while ($r_cirug_pac = mysql_fetch_array($r_ciru_pac))
						{
							echo "<option value='$r_cirug_pac[0]'>$r_cirug_pac[0]</option> ";	
						}
echo "            </select>";
echo "        </td>";

echo "        <td>";
echo "          <span class='Texto3'>Nueva Cirugia<hr></span>";
echo "          <span class='Texto3'>Tipo de Cirugia: <br></span>";
echo "            <select name='tipo_ciru' class='Texto2' id='tipo_ciru'>";

						echo "<option>cirugia</option> ";		
						
						while ($r_cirug = mysql_fetch_array($r_ciru))
						{
							echo "<option value=$r_cirug[0]>$r_cirug[1]</option> ";	
						}
echo "            </select>";
echo "    		  <input type='submit' class='boton' name='btn_ciru' id='btn_ciru' value='Agregar Cirugia'/>";
echo "			  <br><span class='Texto3'>Eliminar Cirugia: </span>";
echo "			  <input type='submit' class='boton' name='btn_del_ciru' id='btn_del_ciru' value='Eliminar Cirugia' />";
echo "        </td>";
echo "     </tr>";

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
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("ana_remota");
//-->
</script>
</body>
</html>

