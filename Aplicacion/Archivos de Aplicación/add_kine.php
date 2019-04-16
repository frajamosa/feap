<?php

session_start();
include('conexion.php'); 

echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin título</title>";
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
$txt_n_rut ="";
rutok($txt_rut2,&$txt_n_rut);
//echo "<br>".$txt_n_rut;

if($btn_guardar and $_SESSION['usr']=="add" and !($txt_n_rut=="Error")) //Agrega**************************
{
	
	//Registra kinesiologo*******************
	$sql_insertar = "insert into kinesiologo values ('$txt_n_rut','$txt_nmbr','$txt_apell','$txt_tel')";
	mysql_query ($sql_insertar,$link);
	$error =mysql_errno();
	if ($error==0)
	{
	echo "	<script language='javascript'>alert ('Kinesiologo Registrado')</script>";	
	}
	else
	{
		switch($error)
		{
		case 1062:
		echo "	<script language='javascript'>alert ('Este Rut ya ha sido Registrado');</script>";	
		break;
	
		}
	}
	$txt_rut2= "";
	$txt_nombre = "";
	$txt_apellido ="";
	$txt_telefono="";

	
	

	//echo $sql_insertar;
	//***********************************
	
}
if($btn_guardar and $_SESSION['usr']=="mod")//Modifica**************************
{
	
	//kinesiologo*********************
	$sql_actualiza = "update kinesiologo set rut_k='$txt_n_rut',nombre_k='$txt_nmbr',apellido_k='$txt_apell',telefono_k='$txt_tel' where rut_k = '$id_kine'";
	mysql_query ($sql_actualiza,$link);
	$error =mysql_errno();
	//echo $sql_actualiza."<br>";

}

if($btn_del_si and $_SESSION['usr']=="del")//Elimina****************************
{
	
	$sql_elimina = "delete from kinesiologo where rut_k = '$id_kine'";
	mysql_query ($sql_elimina,$link);
	$error =mysql_errno();
	//echo $sql_elimina."<br>";

}
//*****************************************************************************

	

//*****************************************************************************

//echo "$txt_rut";
//echo $id_kine;
$id_kine = $_SESSION['id_kine'];

//*****************************************************************************
//**************Registro / Modificaci�n / Eliminaci�n de kinesiologo***************
//*****************************************************************************
if ($_SESSION['usr']=="add")
{
	echo "<p class='Texto3'><span class='Texto'>Registro de Nuevo kinesiologo</span></p>";
}

if($_SESSION['usr']=="mod")
{
	echo "<p class='Texto3'><span class='Texto'>Modificación de kinesiologo</span></p>";
}

if($_SESSION['usr']=="del")
{
	echo "<p class='Texto3'><span class='Texto'>Eliminar kinesiologo</span></p>";
}

if ($_SESSION['usr']=="mod" or $_SESSION['usr']=="del")
{
  
//Consulta de kinesiologos
$sql_kinesiologo = "select * from kinesiologo";
$r_kinesiologo = mysql_query($sql_kinesiologo,$link);

echo "<p class='Texto3'><span class='Texto'>Seleccione kinesiologo \t \t</span>";

//ListBox con kinesiologos Registrados
echo "<select name='lstbx_kinesiologos' onchange='this.form.submit()'>";
if($_SESSION['usr_info']=="mod")
{
$id_kine = 	$_SESSION['id_kine']; 
echo "<option value=$id_kine>Modificar Kinesiologo Rut: $id_kine</option> ";	
}
else
{
echo "<option>Kinesiologo</option> ";		
}
	while ($t = mysql_fetch_array($r_kinesiologo))
	{
		echo "<option value=$t[0]>$t[1] $t[2]</option> ";	
	}

echo "</select></p>";

	//Informcion kinesiologo*******************************************************
	
	if($_SESSION['usr_info']=="mod")
	{
		$id_kine = $_SESSION['id_kine'];
		$sql_kine_info = "select * from kinesiologo where rut_k = '$id_kine'";
	}
	else
	{
		$_SESSION['id_kine']=$lstbx_kinesiologos;
		$sql_kine_info = "select * from kinesiologo where rut_k = '$lstbx_kinesiologos'";	
	}
	
	
	$r_kinesiologo = mysql_query($sql_kine_info,$link);
	$info_kine = mysql_fetch_array ($r_kinesiologo);
	
	//echo $sql_kine_info;

	$txt_rut2 = $info_kine[0];
	$txt_nombre = $info_kine[1];
	$txt_apellido = $info_kine[2];
	$txt_telefono = $info_kine[3];
	
	//echo $info_kine[3];
	
}

//*****************************************************************************
//*****************************************************************************

echo "  <table border='0'>";


// echo "    <tr>";
// echo "      <td class='Texto3'>Nombre</td>";
// echo "      <td class='Texto2'><span class='Texto3'>";
// echo "        <input type='text' name='txt_nmbr' value='$txt_nombre'>      ";
// echo "      </span></td>";
// echo "    </tr>";

// echo "    <tr>";
// echo "      <td class='Texto3'>Apellido</td>";
// echo "      <td class='Texto2'><span class='Texto3'>";
// echo "        <input type='text' name='txt_apell' value=$txt_apellido>      ";
// echo "      </span></td>";
// echo "    </tr>";
// 
// echo "    <tr>";
// echo "      <td class='Texto3'>Rut</td>";
// echo "      <td class='Texto2'><span class='Texto3'>";
// echo "        <input type='text' name='txt_rut' id='txt_rut' value=$txt_rut2 >      ";
// echo "      </span></td>";
// echo "      <td class='Texto2'>ej. 12.345.678-9</td>";	
// if($txt_n_rut=="Error" and $btn_guardar)
// {
// 	echo "      <td class='Texto2'> - *Rut Erroneo*</td>";	
// }
// 
// echo "    </tr>";
// 
// echo "    <tr>";
// echo "      <td class='Texto3'>Telefono</td>";
// echo "      <td class='Texto2'><span class='Texto3'>";
// echo "        <input type='text' name='txt_tel' id='txt_rut' value=$txt_telefono >      ";
// echo "      </span></td>";
// echo "    </tr>";
// echo "  </table>";


echo "    <tr>";
echo "      <td class='Texto3'>Nombre</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield1'>";
echo " <input type='text' name='txt_nombre' value='$txt_nombre'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Apellido</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield2'>";
echo " <input type='text' name='txt_apellido' value='$txt_apellido'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Rut</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield3'>";
echo " <input type='text' name='txt_rut2' value='$txt_rut2'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "      <td class='Texto2'>ej. 12.345.678-9</td>";	
if($txt_n_rut=="Error" and $btn_guardar)
{
	echo "	<script language='javascript'>alert('Error en campo Rut');</script>";	
}

echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield4'>";
echo " <input type='text' name='txt_telefono' value='$txt_telefono'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";
echo "  </table>";
echo "<br>";

if($_SESSION['usr']=="del")
{
	
	echo "<p class='Texto3'><span class='Texto'>Eliminar kinesiologo</span></p>";
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
</body>
</html>