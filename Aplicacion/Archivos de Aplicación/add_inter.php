<?php

session_start();
include('conexion.php'); 

echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
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
echo "<link href='Estilos.css' rel='stylesheet' type='text/css' />";
echo "<script src='SpryAssets/SpryValidationTextField.js' type='text/javascript'></script>";
echo "<link href='SpryAssets/SpryValidationTextField.css' rel='stylesheet' type='text/css' />";
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

if($btn_guardar and $_SESSION['usr']=="add" and !($txt_n_rut_int=="Error")) //Agrega**************************
{
	
	//Registra interno*******************
	$sql_insertar = "insert into interno values ('$txt_n_rut_int','$txt_inter_nmbr','$txt_inter_apell','$txt_inter_tel')";
	mysql_query ($sql_insertar,$link);
		$error =mysql_errno();
	//echo $sql_insertar;
	//***********************************
	
}
if($btn_guardar and $_SESSION['usr']=="mod")//Modifica**************************
{
	
	//interno*********************
	$sql_actualiza = "update interno set rut_int='$txt_n_rut_int',nombre_int='$txt_inter_nmbr',apellido_int='$txt_inter_apell',telefono_int='$txt_inter_tel' where rut_int = '$id_inter'";
	mysql_query ($sql_actualiza,$link);
		$error =mysql_errno();
	//echo $sql_actualiza."<br>";

}

if ($btn_guardar)	
{
	switch ($error)
	{
		case 1062:
			echo "	<script language='javascript'>alert ('Este Paciente ya fue Registrado');</script>";	
		break;
		
		case 0:
			if(!$btn_fic)
			{
			echo "	<script language='javascript'>alert ('Este Paciente ha sido Registrado con Exito');</script>";	
			}
			if ($btn_fic)
			{
				$_SESSION['id_pac']= $txt_n_rut;	
				echo "	<script language='javascript'>alert ('Este Paciente para la ficha ha sido Registrado con Exito');</script>";	
				echo "<meta http-equiv='refresh' content='1;URL=ficha.php'>";
			}
			
		break;
	}
}


if($btn_del_si and $_SESSION['usr']=="del")//Elimina****************************
{
	
	$sql_elimina = "delete from interno where rut_int = '$id_inter'";
	mysql_query ($sql_elimina,$link);
	$error_del =mysql_errno();
	//echo $sql_elimina."<br>";
			switch ($error_del)
	{
		
		case 0:
			$sql_insertar_ana_remo = "insert into ana_remota values ('$nuevo_id_ar','$txt_n_rut')";
			mysql_query ($sql_insertar_ana_remo,$link);
			if(!$btn_fic)
			{
			echo "	<script language='javascript'>alert ('Este Paciente ha sido Eliminado');</script>";	
			}
			if ($btn_fic)
			{
				$_SESSION['id_pac']= $txt_n_rut;	
				echo "	<script language='javascript'>alert ('Este Paciente para la ficha ha sido Registrado con Exito');</script>";	
				echo "<meta http-equiv='refresh' content='1;URL=ficha.php'>";
			}
			
		break;
	}

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
if ($_SESSION['usr']=="add")
{
	echo "<p class='Texto3'><span class='Texto'>Registro de Nuevo interno</span></p>";
}

if($_SESSION['usr']=="mod")
{
	echo "<p class='Texto3'><span class='Texto'>ModificaciÃ³n de interno</span></p>";
}

if($_SESSION['usr']=="del")
{
	echo "<p class='Texto3'><span class='Texto'>Eliminar interno</span></p>";
}

if ($_SESSION['usr']=="mod" or $_SESSION['usr']=="del")
{
		  
		//Consulta de internos
		$sql_interno = "select * from interno";
		$r_interno = mysql_query($sql_interno,$link);
		
		echo "<p class='Texto3'><span class='Texto'>Seleccione interno \t \t</span>";
		
		//ListBox con internos Registrados
		echo "<select name='lstbx_internos' onchange='this.form.submit()'>";
		if($_SESSION['usr_info']=="mod")
		{
		$id_inter = 	$_SESSION['id_inter']; 
		echo "<option value=$id_inter>Modificar Internista Rut: $id_inter</option> ";	
		}
		else
		{
		echo "<option>Internista</option> ";		
		}
			while ($j = mysql_fetch_array($r_interno))
			{
				echo "<option value=$j[0]>$j[1] $j[2]</option> ";	
			}
		
		echo "</select></p>";
		
			//Informcion interno*******************************************************
						
			if($_SESSION['usr_info']=="mod")
			{
				$id_inter = $_SESSION['id_inter'];
				$sql_inter_info = "select * from interno where rut_int = '$id_inter'";
			}
			else
			{
			$_SESSION['id_inter']=$lstbx_internos;
			$sql_inter_info = "select * from interno where rut_int = '$lstbx_internos'";
			}
			
			
			$r_interno = mysql_query($sql_inter_info,$link);
			$info_inter = mysql_fetch_array ($r_interno);
			
			//echo $sql_inter_info;
		
			$txt_inter_rut2 = $info_inter[0];
			$txt_inter_nombre = $info_inter[1];
			$txt_inter_apellido = $info_inter[2];
			$txt_inter_telefono = $info_inter[3];
			
			//echo $info_inter[3];
			
}

//*****************************************************************************
//*****************************************************************************

echo "  <table border='0'>";


echo "    <tr>";
echo "      <td class='Texto3'>Nombre</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield1'>";
echo "        <input type='text' name='txt_inter_nmbr' value='$txt_inter_nombre'>      ";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Apellido</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield2'>";
echo "        <input type='text' name='txt_inter_apell' value=$txt_inter_apellido>      ";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Rut</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield3'>";
echo "        <input type='text' name='txt_inter_rut' id='txt_rut' value=$txt_inter_rut2 >      ";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "      <td class='Texto2'>ej. 12.345.678-9</td>";	
if($txt_n_rut_int=="Error" and $btn_guardar)
{
	echo "	<script language='javascript'>alert('Error en campo Rut');</script>";
}

echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield4'>";
echo "        <input type='text' name='txt_inter_tel' id='txt_rut' value=$txt_inter_telefono >      ";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";
echo "  </table>";
echo "<br>";

if($_SESSION['usr']=="del")
{
	
	echo "<p class='Texto3'><span class='Texto'>Eliminar interno</span></p>";
	echo "    <input type='submit' name='btn_del_si' value='Si'/>";
	echo "    <input type='submit' name='btn_del_no' value='No' onclick='window.open(\"menu_marcos.php\",\"_parent\")'/>";
	echo "  </p>";
	echo "</form>";
}

else
{
 	if ($_SESSION['usr_info']=="mod")
	{
		$redireccion = "onclick='window.open(\"menu_marcos.php\",\"_parent\")' ";
	}
	echo "    <input type='submit' name='btn_guardar' id='btn_guardar' value='Guardar' $redireccion/>";
	echo "    <input type='submit' name='btn_cancelar' id='btn_cancelar' value='Cancelar' onclick='window.open(\"menu_marcos.php\",\"_parent\")' />";
	echo "  </p>";
	echo "</form>";
}
	
// echo "</body>";
// echo "</html>";
?>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
//-->
</script>