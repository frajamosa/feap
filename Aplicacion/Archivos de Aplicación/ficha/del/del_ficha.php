<?php

session_start();
include('../../conexion.php');




echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin título</title>";
echo "<style type='text/css'>";
echo "<!--";
echo "body {";
echo "	background-image: url(../../Images/FEAP-Fondo.jpg);";
echo "	background-repeat: no-repeat;";
echo "	background-position:center;";
echo "}";
echo "-->";
echo "</style>";
echo "<link href='../../Estilos.css' rel='stylesheet' type='text/css' />";
echo "</head>";




echo "<form action='$PHP_SELF' method='post'>";



echo "<body class='Texto3'>";

echo "ELIMINAR FICHA";
echo "<hr />";


//******************************************************************************Busca Pacientes
if($list_paciente)
{
	$sql_paciente2 = "select * from paciente  where rut_pac = '$list_paciente'";
	$r_paciente2 = mysql_query($sql_paciente2,$link);
}

$sql_paciente = "select * from paciente order by apellido_pac";
$r_paciente = mysql_query($sql_paciente,$link);
//**********************************************************************************************



echo "<table width='50%' border='0'>";
echo "  <tr>";
echo "    <td colspan='3' class='Texto4'>BUSCAR";
echo "    <hr /></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td class='Texto3'>PACIENTE</td>";
echo "    <td>";
echo "      <select name='list_paciente' id='list_paciente'>";
					if($list_paciente)
					{
					 	$r_pac2 = mysql_fetch_array($r_paciente2);
						echo "<option value=$r_pac2[0]>$r_pac2[2] $r_pac2[1] - $r_pac2[0]</option> ";	
					}
					while ($r_pac = mysql_fetch_array($r_paciente))
						{
							echo "<option value=$r_pac[0]>$r_pac[2] $r_pac[1] - $r_pac[0]</option> ";	
						}
echo "      </select>";
echo "    </td>";
echo "    <td>";
echo "      <input type='submit' class='boton' name='btn_busca_x_paciente' id='btn_busca_x_paciente' value='BUSCAR POR PACIENTE' />";
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td class='Texto3'>FECHA</td>";
echo "    <td>";
echo "      <input name='txt_d' type='text' id='txt_d' size='2' />";
echo "      -";
echo "      <input name='txt_m' type='text' id='txt_m' size='2' />";
echo "-";
echo "<input name='txt_a' type='text' id='txt_a' size='4' />";
echo "    </td>";
echo "    <td>";
echo "      <input type='submit' class='boton' name='btn_busca_x_fecha' id='btn_busca_x_fecha' value='BUSCAR POR FECHA' />";
echo "    </td>";
echo "  </tr>";
echo "</table>";

echo "<hr />";

echo "<p>&nbsp;</p>";



if ($btn_busca_x_paciente or $_SESSION['busca_ficha_pac'] and !$btn_busca_x_fecha)
{
		$rut_pac =  $list_paciente;
		$_SESSION['busca_ficha_pac'] = $rut_pac;
		
		//-----INFORMACION PACIENTE-----
		$sql_paciente = "select * from paciente where rut_pac = '$rut_pac'";
		$r_paciente = mysql_query($sql_paciente,$link);
		$info_paciente = mysql_fetch_array ($r_paciente);
		$f = split ('-',$info_paciente[6]);
		//------------------------------
		
		echo "<table width='100%' border='0'>";
		echo "  <tr>";
		echo "    <td colspan='4' class='Texto4'>PACIENTE";
		echo "    <hr /></td>";
		echo "  </tr>";
		echo "  <tr class='Texto3'>";
		echo "    <td>NOMBRE</td>";
		echo "    <td>APELLIDO</td>";
		echo "    <td>RUT</td>";
		echo "    <td>FECHA DE NACIEMIENTO</td>";
		echo "  </tr>";
		echo "  <tr class='Texto'>";
		echo "    <td>$info_paciente[1]</td>";
		echo "    <td>$info_paciente[2]</td>";
		echo "    <td>$info_paciente[0]</td>";
		echo "    <td>$f[2]-$f[1]-$f[0]</td>";
		echo "  </tr>";
		echo "</table>";
		
		echo "<br />";
}		
		
		
if ($btn_busca_x_fecha and !$btn_busca_x_paciente)
{
 		$_SESSION['busca_ficha_pac'] = "$txt_a-$txt_m-$txt_d";
		echo "<table width='100%' border='0'>";
		echo "  <tr>";
		echo "    <td colspan='3' class='Texto4'>FECHA";
		echo "    <hr /></td>";
		echo "  </tr>";
		echo "  <tr class='Texto3'>";
		echo "    <td>A�O</td>";
		echo "    <td>MES</td>";
		echo "    <td>DIA</td>";
		echo "  </tr>";
		echo "  <tr>";
		echo "    <td>$txt_a</td>";
		echo "    <td>$txt_m</td>";
		echo "    <td>$txt_d</td>";

		echo "  </tr>";
		echo "</table>";
		
		echo "<br />";
}


if ($btn_busca_x_paciente or $btn_busca_x_fecha)
{
if ($btn_busca_x_paciente)
{
$rut_pac = $_SESSION['busca_ficha_pac'];
$_SESSION['busca_ficha_pac'] = $rut_pac;
$sql_ficha = "select * from ficha where rut_pac = '$rut_pac'";
$r_ficha = mysql_query($sql_ficha,$link);
}
if($btn_busca_x_fecha)
{
$fecha = $_SESSION['busca_ficha_pac'];
 $sql_ficha = "select * from ficha where fec_ficha = '$fecha'";
$r_ficha = mysql_query($sql_ficha,$link);
 
} 
echo $sql_ficha;


echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='5' class='Texto4'>FICHAS";
echo "    <hr /></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td>FICHA N°</td>";
echo "    <td>FECHA DE ATENCION</td>";
echo "    <td>KINESIOLOGO</td>";
echo "    <td>INTERNISTA</td>";
echo "    <td>ACCION</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td colspan='5'><hr /></td>";
echo "  </tr>";

while ($info_ficha = mysql_fetch_array($r_ficha))
{
 		//----Kinesiologo
 		$sql_kine = "select nombre_k, apellido_k from kinesiologo where rut_k = '$info_ficha[6]'";
 		$r_kine = mysql_query($sql_kine, $link);
 		$info_kine = mysql_fetch_array($r_kine);
		//----Internista
 		$sql_inter = "select nombre_int, apellido_int from interno where rut_int = '$info_ficha[1]'";
 		$r_inter = mysql_query($sql_inter, $link);
 		$info_inter = mysql_fetch_array($r_inter);
 		//---Fecha de Atencion Ficha
 		$f2 = split ('-',$info_ficha[13]);
 		
 		
		echo "  <tr>";
		echo "    <td>$info_ficha[0]</td>";
		echo "    <td>$f2[2]-$f2[1]-$f2[0]</td>";
		echo "    <td>$info_kine[1], $info_kine[0]</td>";
		echo "    <td>$info_inter[1], $info_inter[0]</td>";
		echo "    <td>";
		echo "      <input type='submit' class='boton2' name='btn_ver' id='btn_ver' value='VER FICHA-$info_ficha[0]' />";
		echo "      <input type='hidden' name='h_ver' value='$info_ficha[0]' />";
		echo "      <input type='submit' class='boton2' name='btn_del' id='btn_del' value='ELIMINAR FICHA-$info_ficha[0]' />";
		echo "    </td>";
		echo "  </tr>";
		echo "  <tr>";
		echo "    <td colspan='5' class='Texto3'><hr /></td>";
		echo "  </tr>";
}

if ($btn_ver)
{
$f3 = split ('-',$btn_ver);
echo "boton Ver".$f3[1];	
}



if ($btn_del)
{

$f3 = split ('-',$btn_del); 
echo "boton Eliminar".$f3[1]."<br>";
//--Seleccion de id's a partir de ficha---
$sql_sel_ids = "select * from ficha where id_ficha = '$f3[1]'" ;
$r_sel_ids = mysql_query($sql_sel_ids,$link);
$ids_ficha = mysql_fetch_array($r_sel_ids);
 echo $error_ficha."ficha<br>"; 
 
//--Ana Actual---- $ids_ficha[7]
 $sql_del_ana = "delete from ana_actual where id_ana_act = '$ids_ficha[7]'";
 mysql_query($sql_del_ana);
 $error_xx =mysql_errno();
 echo $error_ana."ana<br>";
 
 
//Eva Kine--------$ids_ficha[8]
$sql_info_ek = "select * from eva_kine where id_ek = '$ids_ficha[8]'";
$r_info_ek = mysql_query($sql_info_ek.link);
$info_ek = mysql_fetch_array($r_info_ek);
 $error_kine =mysql_errno();
 echo $error_kine."kine<br>";
 echo $sql_info_ek;
//Dolor
 $sql_del_dol = "delete from dolor_ek where id_dol = '$info_ek[3]'";
 mysql_query($sql_del_dol);
  $error_dol =mysql_errno();
 echo $error_dol."dol<br>";
//Palpacion
 $sql_del_pal = "delete from palpacion_ek where id_pal = '$info_ek[1]'";
 mysql_query($sql_del_pal);
  $error_pal =mysql_errno();
 echo $error_pal."pal<br>";
//Inspeccion
 $sql_del_insp = "delete from inspeccion_ek where id_insp = '$info_ek[2]'";
 mysql_query($sql_del_insp);
  $error_insp =mysql_errno();
 echo $error_insp."insp<br>";
//EVAKINE
 $sql_del_ek = "delete from eva_kine where id_ek = '$ids_ficha[7]'";
 mysql_query($sql_del_ek);
  $error_evakine =mysql_errno();
 echo $error_evakine."evakine<br>";
 
//--Eva Postural---- $ids_ficha[3]
 $sql_del_epost = "delete from eva_postural where id_eva_post = '$ids_ficha[3]'";
 mysql_query($sql_del_epost);
  $error_epost =mysql_errno();
 echo $error_epost."epost<br>";
 
//--Rango Articular---- $ids_ficha[2]
 $sql_del_rng_art = "delete from rng_articular where id_rngo_art = '$ids_ficha[3]'";
 mysql_query($sql_del_rng_art); 
  $error_rng =mysql_errno();
 echo $error_rng."rng<br>";
 
//--Acortamiento Muscular---- $ids_ficha[11]
 $sql_del_acomusc = "delete from acor_muscular where id_aco_musc = '$ids_ficha[11]'";
 mysql_query($sql_del_acomusc); 
  $error_acor_musc =mysql_errno();
 echo $error_acor_musc."acor_musc<br>";
 
//--Fuerza Muscular---- $ids_ficha[5]
 $sql_del_fzamusc = "delete from fza_muscular where id_fza_musc = '$ids_ficha[5]'";
 mysql_query($sql_del_fzamusc);
  $error_fza =mysql_errno();
 echo $error_fza."fza<br>";

//--Eva Neuro---- $ids_ficha[4]
 $sql_del_eneuro = "delete from eva_neuro where id_eva_neuro = '$ids_ficha[4]'";
 mysql_query($sql_del_eneuro);
  $error_eneuro =mysql_errno();
 echo $error_eneuro."eneuro<br>";

//--Prueba Funcional---- $ids_ficha[12]
 $sql_del_pf = "delete from prueba_funcional where id_pf = '$ids_ficha[12]'";
 mysql_query($sql_del_pf);
  $error_pf =mysql_errno();
 echo $error_xx."xx<br>";

//--Tratamiento---- $ids_ficha[10]
 $sql_del_trat = "delete from tratamiento where id_trat = '$ids_ficha[10]'";
 mysql_query($sql_del_trat);
  $error_trat =mysql_errno();
 echo $error_trat."trat<br>";

//--Ficha---- $ids_ficha[0]
 $sql_del_ficha = "delete from ficha where id_ficha = '$ids_ficha[0]'";
 mysql_query($sql_del_ficha);
  $error_ficha =mysql_errno();
 echo $error_ficha."ficha<br>";
	
}



echo "</table>";
}


echo "<p>&nbsp;</p>";
echo "</body>";
echo "</form>";
echo "</html>";
?>