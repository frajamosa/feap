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
echo "	background-image: url(../Images/FEAP-Fondo.jpg);";
echo "	background-repeat: no-repeat;";
echo "	background-position:center;";
echo "}";
echo "-->";
echo "</style>";
echo "<link href='../Estilos.css' rel='stylesheet' type='text/css' />";
echo "<script src='SpryAssets/SpryValidationTextField.js' type='text/javascript'></script>";
echo "<link href='SpryAssets/SpryValidationTextField.css' rel='stylesheet' type='text/css' />";
echo "</head>";

echo "<body>";
echo "<form action='$PHP_SELF' method='post'>";

//*******************************************************




function rutOK($r)
{
	$r=strtoupper(ereg_replace('\.|,|-','',$r));
	$sub_rut=substr($r,0,strlen($r)-1);
	$sub_dv=substr($r,-1);
	$x=2;
	$s=0;
	for ( $i=strlen($sub_rut)-1;$i>=0;$i-- )
	{
		if ( $x >7 )
		{
			$x=2;
		}
		$s += $sub_rut[$i]*$x;
		$x++;
	}
	$dv=11-($s%11);
	if ( $dv==10 )
	{
		$dv='K';
	}
	if ( $dv==11 )
	{
		$dv='0';
	}
	if ( $dv==$sub_dv )
	{
		return true;
	}
	else
	{
		return false;
	}
}

//*******************************************************

//*****************************************************************************
//**************************Almacenamiento de Registros************************
//*****************************************************************************
$_SESSION['id_pac']= $txt_rut;
$txt_fnac=$txt_a.$txt_m.$txt_d;
//echo $txt_fnac;


if(($btn_guardar) and rutOK($txt_rut)==True) //Agrega**************************
{
 	
	//Id Ana_Remota*************************
	$sql_id_ar="select max(id_ana_remota) from ana_remota";
	$r_id_ar = mysql_query($sql_id_ar,$link);
	$info_id_ar = mysql_fetch_array ($r_id_ar);
	$nuevo_id_ar=$info_id_ar[0] +1;
	
	//***********************************
	//Registra paciente*******************
	$sql_insertar = "insert into paciente values ('$txt_rut','$txt_nmbr','$txt_apell','$txt_dir','$txt_tel1','$txt_tel2','$txt_fnac','$txt_mail','0')";
	mysql_query ($sql_insertar,$link);
	//echo $sql_insertar;
	

	//Condicion Error********************
	$error =mysql_errno();
//	echo $error;
if (rutOK($txt_rut)==True)
{
	switch($error)
	{
	case 0:
	echo "	<script language='javascript'>alert('Paciente Registrado Exitosamente');</script>";
	$sql_insertar_ana_remo = "insert into ana_remota values ('$nuevo_id_ar','$txt_rut')";
	mysql_query ($sql_insertar_ana_remo,$link);	
	
	 	if ($_SESSION['list'])
 	{
 	 	$_SESSION['list']="2";
 	 	$_SESSION['id_pac']= $txt_rut;
 	 	$_SESSION['pac_nuevo']="1";
		echo "<meta http-equiv='refresh' content='0;URL=../ficha/add/ficha.php'>";
	}
	
	$txt_rut		= "";
 	$txt_rut2		= "";
 	$txt_apell 		= "";
 	$txt_apellido 	= "";
 	$txt_nmbr 		= "";
 	$txt_nombre 	= "";	
 	$txt_tel1		= "";
 	$txt_telefono1	= "";
 	$txt_tel2		= "";
 	$txt_telefono2	= "";
 	$txt_dir		= "";
 	$txt_direccion	= "";
 	$txt_fnac		= "";
 	$txt_fnacimiento= "";
 	$txt_mail = "";

	break;
	case 1062:
 	echo "	<script language='javascript'>alert('El rut ingresado ya se encuentra Registrado');</script>";
	break;
	}
	//***********************************
}
	
	
}


//*****************************************************************************
	


//*****************************************************************************

//echo "$txt_rut";
//echo $id_pac;
$id_pac = $_SESSION['id_pac'];

//*****************************************************************************
//**************Registro / Modificación / Eliminación de paciente***************
//*****************************************************************************
	echo "<p class='Texto3'><span class='Texto'>Registro de Nuevo Paciente</span><hr></p>";

	

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
echo " <input type='text' name='txt_apell' value='$txt_apell'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";


echo "    <tr>";
echo "      <td class='Texto3'>Rut</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield3'>";
echo " <input type='text' name='txt_rut'  maxlength='10' value='$txt_rut'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "      <td class='Texto2'>ej. 12345678-9</td>";	
if(rutOK($txt_rut)==False and $btn_guardar)
{
	echo "	<script language='javascript'>alert('Error en campo Rut');</script>";	
}
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono1</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield4'>";
echo " <input type='text' name='txt_tel1' value='$txt_tel1' maxlength='10'/>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono2</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield5'>";
echo " <input type='text' name='txt_tel2' value='$txt_tel2' maxlength='10'>      ";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Correo @</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield5'>";
echo " <input type='text' name='txt_mail' value='$txt_mail'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Direccion</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield6'>";
echo " <input type='text' name='txt_dir' value='$txt_dir' maxlength='150'>      ";
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
echo "      <td class='Texto2'>dia - mes - aÃ±o</td>";
echo "    </tr>";
echo "  </table>";
echo "<br>";


		echo "    <input type='submit' class='boton' name='btn_guardar' id='btn_guardar' value='Guardar' />";
	echo "    <input type='submit' class='boton' name='btn_cancelar' id='btn_cancelar' value='Cancelar' onclick='window.open(\"../menu_marcos.php\",\"_parent\")' />";
	
	if ($btn_guardar and $error == '0')
	{
	 
	 	echo "<br><br>";
	 	echo "<span class ='Texto3'>Si desea crear una Ficha presione el botón<br><br></span>";
		echo "    <input type='submit' class='boton' name='btn_crea_ficha'  value='Crear Ficha' onclick='window.open(\"../ficha/add/fichas_marcos.php\",\"_parent\")' />";
	}
	
	echo "  </p>";
	echo "</form>";
?>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield7");
//-->
</script>
</body>
</html>