
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
body {
	background-image: url(../Images/FEAP-Fondo.jpg);
	background-repeat: no-repeat;
	background-position:center;
}
-->
</style>
<link href="../Estilos.css" rel="stylesheet" type="text/css" />
</head>

<?php
session_start();
include('../conexion.php');

echo "<form action='$PHP_SELF' method='post'>";

echo "<body class='Texto3'>";
?>

<script type="text/javascript">
<!--
function confimacion(B)
{
    if(confirm(B))
    {
        return true
    }
    else
    {
        A.style.filter="";
        return false
    }
}
//-->
</script>

<?php
echo "<table width='100%' class='Texto1' ><tr><td >BUSCAR - ELIMINAR POR KINESIOLOGO</td></tr></table>";

if ($btn_ver)
{
			$f3 = split ('-',$btn_ver);
			$_SESSION['id_ficha'] = $f3[1];
			$_SESSION['usr']= "ver";
echo "<meta http-equiv='refresh' content='0;URL=../informe/muestra_ficha.php'>";
			echo "ver";
}

//******************************************************************************Busca Pacientes
if($list_paciente)
{
	$sql_paciente2 = "select * from kinesiologo  where rut_k = '$list_paciente'";
	$r_paciente2 = mysql_query($sql_paciente2,$link);
}

$sql_paciente = "select * from kinesiologo order by apellido_k";
$r_paciente = mysql_query($sql_paciente,$link);
//**********************************************************************************************



echo "<table width='100%' border='0' bgcolor='#99CCFF'>";
echo "  <tr>";
echo "    <td colspan='3' class='Texto1'>BUSCAR";
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td class='Texto3'>KINESIOLOGO</td>";
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
echo "      <input type='submit' class='boton2' name='btn_busca_x_paciente' id='btn_busca_x_paciente' value='BUSCAR POR KINESIOLOGO' />";
echo "    </td>";
echo "  </tr>";

echo "</table>";



echo "<p>&nbsp;</p>";



if ($btn_busca_x_paciente or $_SESSION['busca_ficha_pac'] and !$btn_busca_x_fecha)
{
		$rut_pac =  $list_paciente;
		$_SESSION['busca_ficha_pac'] = $rut_pac;
		
		//-----INFORMACION PACIENTE-----
		$sql_paciente = "select * from kinesiologo where rut_k = '$rut_pac'";
		$r_paciente = mysql_query($sql_paciente,$link);
		$info_paciente = mysql_fetch_array ($r_paciente);
		$f = split ('-',$info_paciente[6]);
		//------------------------------
		
		echo "<table width='100%' border='0'>";
		echo "  <tr>";
		echo "    <td colspan='4' class='Texto1'>KINESIOLOGO";
		echo "    </td>";
		echo "  </tr>";
		echo "  <tr class='Texto7'>";
		echo "    <td>NOMBRE</td>";
		echo "    <td>APELLIDO</td>";
		echo "    <td>RUT</td>";
		echo "  </tr>";
		echo "  <tr class='Texto6'>";
		echo "    <td>$info_paciente[1]</td>";
		echo "    <td>$info_paciente[2]</td>";
		echo "    <td>$info_paciente[0]</td>";
		echo "  </tr>";
		echo "</table>";
		
		echo "<br />";
}		
		
	


if ($btn_busca_x_paciente or $btn_busca_x_fecha or $btn_del or $btn_kine_ord or $btn_int_ord or $btn_fec_ord or $btn_fec_ord2)
{
	if ($btn_busca_x_paciente or $btn_kine_ord or $btn_int_ord or $btn_fec_ord  or $btn_fec_ord2)
	{
	 if($btn_kine_ord)
	 {
		$sort = "order by rut_k";
	}
	 if($btn_int_ord)
	 {
		$sort = "order by rut_int";
	}
	 if($btn_fec_ord)
	 {
		$sort = "order by  fec_ficha ASC";
	}
		 if($btn_fec_ord2)
	 {
		$sort = "order by  fec_ficha DESC";
	}
	$rut_pac = $_SESSION['busca_ficha_pac'];
	$_SESSION['busca_ficha_pac'] = $rut_pac;
	$sql_ficha = "select * from ficha where rut_k = '$rut_pac' $sort";
	$r_ficha = mysql_query($sql_ficha,$link);
	}
	//echo $sql_ficha;
	
	
	echo "<table width='100%' border='0'>";
	echo "  <tr>";
	echo "    <td colspan='5' class='Texto1'>FICHAS";
	echo "    </td>";
	echo "  </tr>";
	echo "  <tr class='Texto7'>";
	echo "    <td  width='15%'>FICHA N°</td>";
	echo "    <td>FECHA DE ATENCION <input type='submit' class='boton4' name='btn_fec_ord'  value='v' /><input type='submit' class='boton4' name='btn_fec_ord2'  value='^' /></td>";
	echo "    <td><a href=\"ficha_x_paciente.php\">PACIENTE </a><input type='submit' class='boton4' name='btn_kine_ord'  value='v' /></td>";
	echo "    <td><a href=\"ficha_x_internista.php\">INTERNISTA </a><input type='submit' class='boton4' name='btn_int_ord'  value='v' /></td>";
	echo "    <td>ACCION</td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td colspan='5'><hr /></td>";
	echo "  </tr>";
	$tot="0";
	while ($info_ficha = mysql_fetch_array($r_ficha))
	{
			//----paciente
	 		$sql_inter = "select nombre_pac, apellido_pac from paciente where rut_pac = '$info_ficha[9]'";
	 		$r_inter = mysql_query($sql_inter, $link);
	 		$info_pac = mysql_fetch_array($r_inter);
			//----Internista
	 		$sql_inter = "select nombre_int, apellido_int from interno where rut_int = '$info_ficha[1]'";
	 		$r_inter = mysql_query($sql_inter, $link);
	 		$info_inter = mysql_fetch_array($r_inter);
	 		//---Fecha de Atencion Ficha
	 		$f2 = split ('-',$info_ficha[13]);
	 		
	 		
			echo "  <tr>";
			echo "    <td>$info_ficha[0]</td>";
			echo "    <td>$f2[2]-$f2[1]-$f2[0]</td>";
			echo "    <td>$info_pac[1], $info_pac[0]</td>";
			echo "    <td>$info_inter[1], $info_inter[0]</td>";
			echo "    <td>";
			echo "      <input type='submit' class='boton' name='btn_ver' id='btn_ver' value='VER FICHA-$info_ficha[0]' />";
			echo "      <input type='hidden' name='h_ver' value='$info_ficha[0]' />";
			echo "      <input type='submit' class='boton' name='btn_del' id='btn_del' value='ELIMINAR FICHA-$info_ficha[0]' />";
			echo "    </td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td colspan='5' class='Texto3'><hr /></td>";
			echo "  </tr>";
			$tot++;
	}
	
	
	
	
	
	if ($btn_del)
	{
	 if($btn_del == false)
	 {
	echo "si"	;
	}
	else
	{
		echo "no";
	}
	 echo "<br><br>$btn_del<br><br><hr>";
		$f3 = split ('-',$btn_del); 
		echo "boton Eliminar".$f3[1]."<br>";
		//--Seleccion de id's a partir de ficha---
		$sql_sel_ids = "select * from ficha where id_ficha = '$f3[1]'" ;
		$r_sel_ids = mysql_query($sql_sel_ids,$link);
		$ids_ficha = mysql_fetch_array($r_sel_ids);
		 echo $error_ficha."ficha<br>"; 
		 echo $sql_sel_ids."ficha<br>"; 
		 echo $ids_ficha[1]."fichas...";
		 //Eva Kine--------$ids_ficha[8]
		$sql_info_ek = "select * from eva_kine where id_ek = '$ids_ficha[8]'";
		$r_info_ek = mysql_query($sql_info_ek,$link);
		$info_ek = mysql_fetch_array($r_info_ek);
		 $error_kine =mysql_errno();
		echo $error_kine."kine<br>";
		echo $sql_info_ek."kine<br>";
		echo $info_ek[0]."kine...";
		
		 //AA EXAMEN--------$ids_ficha[8]
		$sql_info_aa_ex = "select id_aa_examen from aa_examen where id_ana_act = '$ids_ficha[7]'";
		$r_info_aa_ex = mysql_query($sql_info_aa_ex,$link);
		$info_aa_ex = mysql_fetch_array($r_info_aa_ex);
		 $error_exam =mysql_errno();
		echo $error_exam."kine<br>";
		echo $sql_info_aa_ex."kine<br>"; 
		echo $info_aa_ex[0]."aa_ex...";
		 
		$i = "-3";
		while ($i<"21")
		{
			
			switch($i)
			{
				case 1:	
				$sql="delete from rng_articular where id_rngo_art = '$ids_ficha[2]'";
				break;
				case 2:
				$sql="delete from prueba_funcional where id_pf = '$ids_ficha[12]'";
				break;
				
				case 3:
				$sql="delete from palpacion_ek where id_pal = '$info_ek[1]'";
				break;
				
				case 4:
				$sql="delete from inspeccion_ek where id_insp = '$info_ek[2]'";
				break;
				
				case 5:
				$sql="delete from dolor_ek where id_dol = '$info_ek[3]'";
				break;
				
				case 6:
				$sql= "delete from fza_muscular where id_fza_musc = '$ids_ficha[5]'";
				break;
				
				case 7:
				$sql= "delete from acor_muscular where id_aco_musc = '$ids_ficha[11]'";
				break;
				
				case 8:
				$sql="delete from en_reflejo where id_eva_neuro = '$ids_ficha[4]'";
				break;
				
				case 9:
				$sql="delete from en_miotoma where id_eva_neuro = '$ids_ficha[4]'";
				break;
				
				case 10:
				$sql="delete from en_dermatoma where id_eva_neuro = '$ids_ficha[4]'";
				break;
				
				case 11:
				$sql="delete from aa_protesis where id_eva_neuro = '$ids_ficha[4]'";
				break;
				
				case 12:
				$sql="delete from aa_cirugia where id_eva_neuro = '$ids_ficha[4]'";
				break;
				
				case 13:
				$sql="delete from eva_postural where id_eva_post = '$ids_ficha[3]'";
				break;
				
				
				case 14:
				$sql="delete from tratamiento where id_trat = '$ids_ficha[10]'";
				break;
				
				
				case 15:
				$sql="delete from resultado_examen where id_aa_examen = '$info_aa_ex[0]'";
				break;
				
				
				case 16:
				$sql= "delete from aa_examen where id_aa_examen = '$info_aa_ex[0]'";
				break;
				
				
				case 0:
				$sql="delete from ana_actual where id_ana_act = '$ids_ficha[7]'";
				break;
				
				
				case -2:
				$sql="delete from eva_kine where id_ek = '$ids_ficha[8]'";
				break;
				
				
				case -1:
				$sql= "delete from eva_neuro where id_eva_neuro = '$ids_ficha[4]'";
				break;
				
				
				case -3:
				$sql="delete from ficha where id_ficha = '$f3[1]'";
				break;
		
			}//end switch
			
			//$r_sql=mysql_query($sql);
			$info_sql= mysql_fetch_array($r_sql);
			$error=mysql_errno();
			echo $error."<br>";
			echo $sql;
			$i++;
		
		}//end while
		
	}//end if btn_del
}

echo "<tr class='Texto7'><td>TOTAL DE ATENCIONES: $tot</td></tr>";
echo "</table>";


?>
<p>&nbsp;</p></body>


</form></html>
