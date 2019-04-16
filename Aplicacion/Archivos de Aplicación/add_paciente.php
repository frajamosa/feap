<?php

session_start();
include('conexion.php'); 




echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin t√≠tulo</title>";
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
$txt_fnac=$txt_a.$txt_m.$txt_d;
//echo $txt_fnac;

if(($btn_guardar or $btn_fic) and $_SESSION['usr']=="add" and !($txt_n_rut=="Error")) //Agrega**************************

{

	//Id Ana_Remota*************************
	$sql_id_ar="select max(id_ana_remota) from ana_remota";
	$r_id_ar = mysql_query($sql_id_ar,$link);
	$info_id_ar = mysql_fetch_array ($r_id_ar);
	$nuevo_id_ar=$info_id_ar[0] +1;
	//***********************************
	//Registra paciente*******************
	$sql_insertar = "insert into paciente values ('$txt_n_rut','$txt_nmbr','$txt_apellido','$txt_direccion','$txt_telefono1','$txt_telefono2',$txt_fnac)";
	mysql_query ($sql_insertar,$link);
	$error =mysql_errno();
	
	switch ($error)
	{
		case 1062:
			echo "	<script language='javascript'>alert ('Este Paciente ya ha sido Registrado');</script>";	
		break;
		
		case 0:
			$sql_insertar_ana_remo = "insert into ana_remota values ('$nuevo_id_ar','$txt_n_rut')";
			mysql_query ($sql_insertar_ana_remo,$link);
			if(!$btn_fic)
			{
			echo "	<script language='javascript'>alert ('Este Paciente ha sido Registrado con Exito');</script>";	
			}
			if ($btn_fic)
			{
				$_SESSION['id_pac']= $txt_n_rut;	
				echo "	<script language='javascript'>alert ('Este Paciente para la ficha ha sido Registrado con Exito');</script>";	
				// $_SESSION['nuevo_pac']="2";
				echo "<meta http-equiv='refresh' content='0;URL=ficha.php'>";
			}
			
		break;
	}

	//echo $sql_insertar;
	//echo $error;


}

if($btn_guardar and $_SESSION['usr']=="mod")//Modifica**************************
{
	
	//paciente*********************
	$sql_actualiza = "update paciente set rut_pac='$txt_n_rut',nombre_pac='$txt_nmbr',apellido_pac='$txt_apellido',telefono1_pac='$txt_telefono1',telefono2_pac='$txt_telefono2', f_nac_pac='$txt_fnac' where rut_pac = '$id_pac'";
	mysql_query ($sql_actualiza,$link);
	//echo $sql_actualiza."<br>";
	
}

if($btn_del_si and $_SESSION['usr']=="del")//Elimina****************************
{
	
	$sql_elimina = "delete from ana_remota where rut_pac = '$id_pac'";
	mysql_query ($sql_elimina,$link);
	$sql_elimina2 = "delete from paciente where rut_pac = '$id_pac'";
	mysql_query ($sql_elimina2,$link);
	
		switch ($error)
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
	
	
	//echo $sql_elimina."<br>";

}
//*****************************************************************************

	$txt_rut2		= "";
	$txt_apellido 		= "";
	$txt_nmbr 		= "";	
	$txt_telefono1	= "";;
	$txt_telefono2	= "";
	$txt_direccion	= "";
	$txt_fnac		= "";
	$txt_fnacimiento= "";
//*****************************************************************************

//echo "$txt_rut";
//echo $id_pac;
$id_pac = $_SESSION['id_pac'];

//*****************************************************************************
//**************Registro / ModificaciÛn / EliminaciÛn de paciente***************
//*****************************************************************************
if ($_SESSION['usr']=="add")
{
	echo "<p class='Texto3'><span class='Texto'>Registro de Nuevo paciente</span></p>";
}

if($_SESSION['usr']=="mod")
{
	echo "<p class='Texto3'><span class='Texto'>Modificaci√≥n de paciente</span></p>";
}

if($_SESSION['usr']=="del")
{
	echo "<p class='Texto3'><span class='Texto'>Eliminar paciente</span></p>";
}

if ($_SESSION['usr']=="mod" or $_SESSION['usr']=="del")
{
  		//Consulta de pacientes
		$sql_paciente = "select * from paciente";
		$r_paciente = mysql_query($sql_paciente,$link);
		
		echo "<p class='Texto3'><span class='Texto'>Seleccione paciente \t \t</span>";
		
		//ListBox con pacientes Registrados
		echo "<select name='lstbx_pacientes' onchange='this.form.submit()'>";
		
		
		
		if($_SESSION['usr_info']=="mod")
		{
		echo "<option value=$id_pac>Modificar Paciente Rut: $id_pac</option> ";	
		}
		else
		{
		echo "<option>pacientes</option> ";		
		}
		
			while ($t = mysql_fetch_array($r_paciente))
			{
				echo "<option value=$t[0]>$t[0] / $t[1] $t[2]</option> ";	
			}
		
		echo "</select></p>";
		
			//Informcion paciente*******************************************************
			if($_SESSION['usr_info']=="mod")
			{
				$id_pac = $_SESSION['id_pac'];
				$sql_pac_info = "select * from paciente where rut_pac = '$id_pac'";	
			}
			else
			{
				$_SESSION['id_pac']=$lstbx_pacientes;
				$sql_pac_info = "select * from paciente where rut_pac = '$lstbx_pacientes'";	
			}
			
			$r_paciente = mysql_query($sql_pac_info,$link);
			$info_pac = mysql_fetch_array ($r_paciente);
			
			//echo $sql_pac_info;
		
			$txt_rut2 = $info_pac[0];
			$txt_nmbr = $info_pac[1];
			$txt_apellido = $info_pac[2];
			$txt_direccion = $info_pac[3];
			$txt_telefono1 = $info_pac[4];
			$txt_telefono2 = $info_pac[5];
			$f = split ('-',$info_pac[6]);
			
			//echo $info_pac[3];
			
}

//*****************************************************************************
//*****************************************************************************

echo "  <table border='0'>";

echo "    <tr>";
echo "      <td class='Texto3'>Nombre</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield1'>";
echo " <input type='text' name='txt_nmbr' value='$txt_nmbr'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	
echo "    </tr>";


echo "    <tr>";
echo "      <td class='Texto3'>Apellido</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield2'>";
echo " <input type='text' name='txt_apellido' value='$txt_apellido'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Rut</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield3'>";
echo " <input type='text' name='txt_rut2' value='$txt_rut2' maxlength='12'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "      <td class='Texto2'>ej. 12.345.678-9</td>";	

			if($txt_n_rut=="Error" and $btn_guardar)
			{
				echo "	<script language='javascript'>alert('Error en campo Rut');</script>";	
			}
			
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono1</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield4'>";
echo " <input type='text' name='txt_telefono1' value='$txt_telefono1'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono2</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield5'>";
echo " <input type='text' name='txt_telefono2' value='$txt_telefono2'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Direccion</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield6'>";
echo " <input type='text' name='txt_direccion' value='$txt_direccion'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Fecha de Nacimiento</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield7'>";
echo "      <input   name='txt_d' type='text' size='1' maxlength='2' value='$f[2]'/>";
echo "      <input   name='txt_m' type='text' size='1' maxlength='2' value='$f[1]'/>";
echo "      <input   name='txt_a' type='text' size='3' maxlength='4' value='$f[0]'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>"; 
echo "      <td class='Texto2'>dia - mes - a√±o</td>";
echo "    </tr>";
echo "  </table>";
echo "<br>";

if($_SESSION['usr']=="del")
{
	
	echo "<p class='Texto3'><span class='Texto'>Eliminar paciente</span></p>";
	echo "    <input type='submit' name='btn_del_si' value='Si'/>";
	echo "    <input type='submit' name='btn_del_no' value='No' onclick='window.open(\"menu_marcos.php\",\"_parent\")'/>";
	echo "  </p>";
	echo "</form>";
}

else
{
 	if ($_SESSION['nuevo_pac']=="1")
	{
		echo "	  <input type='submit' name='btn_fic' value='Guardar y Crear Ficha'/>";	
				
		
	}
	else
	{
 	if ($_SESSION['usr_info']=="mod")
	{
		$redireccion = "onclick='window.open(\"menu_marcos.php\",\"_parent\")' ";
	}
	echo "    <input type='submit' name='btn_guardar' id='btn_guardar' value='Guardar' $redireccion/>";
	}
	
	echo "    <input type='submit' name='btn_cancelar' id='btn_cancelar' value='Cancelar' onclick='window.open(\"menu_marcos.php\",\"_parent\")' />";
	
	echo "  </p>";
	echo "</form>";
}
// echo "<script type='text/javascript'>";
// echo "<!--";
// echo "var sprytextfield1 = new Spry.Widget.ValidationTextField('sprytextfield1');";
// echo "var sprytextfield2 = new Spry.Widget.ValidationTextField('sprytextfield2');";
// echo "//-->";	
// echo "</body>";
// echo "</html>";
?>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");

//-->
</script>
</body>
</html>