<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";

session_start();
include('../conexion.php'); 

echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin tÃ­tulo</title>";
echo "<style type='text/css'>";
echo "<!--";
echo "body {";
echo "	background-image: url(Images/FEAP-Fondo.jpg);";
echo "	background-repeat: no-repeat;";
echo "	background-position:center;";
echo "}";
echo "-->";
echo "</style>";
echo "<link href='../Estilos.css' rel='stylesheet' type='text/css' />";
echo "</head>";

echo "<body>";
echo "<form action='$PHP_SELF' method='post'>";

//*******************************************************

function dv($r,&$d)
{
	$s=1;
	for($m=0;$r!=0;$r/=10)
	{
		$s=($s+$r%10*(9-$m++%6))%11;	
	}
	$d = chr($s?$s+47:75);
}

function rutOK ($rut,&$nuevo_rut)
{
 	$r1 = stripos($rut,'.');
	while ($r1 == True)
	{
		$r2 = substr($rut,0,$r1);
		$r3 = substr($rut,$r1+1,10);
		
		$rut = $r2.$r3;
		$r1 = stripos($rut,'.');
	}
	// - *********
		
	$x1 = stripos($rut,'-');

		$r2 = substr($rut,0,$largo - 2);
		$r3 = substr($rut,$x1+1,1);
	

// 	echo "<br>r2";	
//  	echo $r2;
//  	echo "<br>r3";
//  	echo $r3;
//  	echo "<br>";


	if ($x1 <> 0)
	{
	$rut = $r2.$r3;		
	}
	
	$largo = strlen($rut);
	
// 	echo $rut;
// 	echo "<br>";
// 	echo $largo;
	
	
	
	switch ($largo)
	{
		case 8:
			$r1 = substr($rut,0,1);
			$r2 = substr($rut,1,3);
			$r3 = substr($rut,4,3);
			$r4 = substr($rut,7,1);
			break;
		case 9:
			$r1 = substr($rut,0,2);
			$r2 = substr($rut,2,3);
			$r3 = substr($rut,5,3);
			$r4 = substr($rut,8,1);
			break;
		case 10:
			$r1 = substr($rut,0,3);
			$r2 = substr($rut,3,3);
			$r3 = substr($rut,6,3);
			$r4 = substr($rut,9,1);
			break;
		default:
			$r1 = "er";
			$r2 = "r";
			$r3 = "o";
			$r4 = "r";
			
	}
	
	$rut2 = $r1.$r2.$r3."-".$r4;
	$r = split('-',$rut2);
	dv($r[0],&$rx);

	if ($r4 == $rx)
	{
		$nuevo_rut = $r1.".".$r2.".".$r3."-".$r4;	
	}
	else
	{
		$nuevo_rut = "Error";
	}

}

//*******************************************************

//*****************************************************************************
//**************************Almacenamiento de Registros************************
//*****************************************************************************
$txt_n_rut_int ="";
//echo "<br>".$txt_inter_rut;
rutok($txt_inter_rut,&$txt_n_rut_int);
//echo "<br>".$txt_n_rut_int;

if($btn_del_si)//Elimina****************************
{
	
	$sql_elimina = "delete from interno where rut_int = '$id_inter'";
	mysql_query ($sql_elimina,$link);
	//echo $sql_elimina."<br>";

}
//*****************************************************************************

	$txt_inter_rut2= "";
	$txt_inter_apell 	= "";
	$txt_inter_nombre = "";
	$txt_inter_apellido ="";
	$txt_inter_rut="";
	$txt_inter_telefono="";
	$txt_inter_tel="";
	

//*****************************************************************************

//echo "$txt_inter_rut";
//echo $id_inter;
$id_inter = $_SESSION['id_inter'];

//*****************************************************************************
//**************Registro / Modificación / Eliminación de interno***************
//*****************************************************************************

	echo "<p class='Texto3'><span class='Texto'>Eliminar interno</span><hr></p>";

//Consulta de internos
$sql_interno = "select * from interno";
$r_interno = mysql_query($sql_interno,$link);

echo "<p class='Texto3'><span class='Texto'>Seleccione interno \t \t</span>";

//ListBox con internos Registrados
echo "<select name='lstbx_internos' onchange='this.form.submit()'>";

echo "<option>internos</option> ";	

	while ($j = mysql_fetch_array($r_interno))
	{
		echo "<option value=$j[0]>$j[1] $j[2]</option> ";	
	}

echo "</select></p>";

	//Informcion interno*******************************************************
	$_SESSION['id_inter']=$lstbx_internos;
	$sql_inter_info = "select * from interno where rut_int = '$lstbx_internos'";
	$r_interno = mysql_query($sql_inter_info,$link);
	$info_inter = mysql_fetch_array ($r_interno);
	
	//echo $sql_inter_info;

	$txt_inter_rut2 = $info_inter[0];
	$txt_inter_nombre = $info_inter[1];
	$txt_inter_apellido = $info_inter[2];
	$txt_inter_telefono = $info_inter[3];
	
	//echo $info_inter[3];
	
//*****************************************************************************
//*****************************************************************************

echo "  <table border='0'>";


echo "    <tr>";
echo "      <td class='Texto3'>Nombre</td>";
echo "      <td class='Texto2'>$txt_inter_nombre     ";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Apellido</td>";
echo "      <td class='Texto2'>$txt_inter_apellido    ";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Rut</td>";
echo "      <td class='Texto2'>$txt_inter_rut2      ";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono</td>";
echo "      <td class='Texto2'>$txt_inter_telefono     ";
echo "      </span></td>";
echo "    </tr>";
echo "  </table>";
echo "<br>";

	
	echo "<p class='Texto3'><span class='Texto'>Eliminar interno</span></p>";
	echo "    <input type='submit' name='btn_del_si' value='Si'/>";
	echo "    <input type='submit' name='btn_del_no' value='No' onclick='window.open(\"../menu_marcos.php\",\"_parent\")'/>";
	echo "  </p>";
	echo "</form>";

	
echo "</body>";
echo "</html>";


?>