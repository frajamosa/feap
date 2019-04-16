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
rutok($txt_inter_rut,&$txt_n_rut_int);
//echo "<br>".$txt_n_rut_int;
if ($chbx_vigente <> "1")
{
	$chbx_vigente = "0";
}

if($btn_guardar and (rutOK($txt_rut2))==True)//Modifica**************************
{
	
	//interno*********************
	$sql_actualiza = "update interno set rut_int='$txt_rut2',nombre_int='$txt_nombre',apellido_int='$txt_apellido',telefono_int='$txt_telefono', correo_int ='$txt_mail' where rut_int = '$id_inter'";
	mysql_query ($sql_actualiza,$link);
//	echo $sql_actualiza."<br>";
//Condicion Error********************
	$error =mysql_errno();
//	echo $error;

if (rutOK($txt_rut2)==True)
{
	switch($error)
	{
	case 0:
	echo "	<script language='javascript'>alert('Interno Modificado Exitosamente');</script>";
 	$txt_rut2= "";
 	$txt_apellido 	= "";
 	$txt_nombre = "";
 	$txt_telefono="";
 	$txt_mail = "";
 	if ($_SESSION['usr']=="mod")
 	{
		unset($_SESSION['usr']);
		echo "<meta http-equiv='refresh' content='0;URL=../informe/reg_interno.php'>";
	}
	break;
	case 1062:
 	echo "	<script language='javascript'>alert('El rut ingresado ya se encuentra Registrado');</script>";
	break;
	}
	//***********************************
}
// else 
// {
// echo "	<script language='javascript'>alert('Error en campo Rut');</script>";	
// }


}

//*****************************************************************************

// 	$txt_inter_rut2= "";
// 	$txt_inter_apell 	= "";
// 	$txt_inter_nombre = "";
// 	$txt_inter_apellido ="";
// 	$txt_inter_rut="";
// 	$txt_inter_telefono="";
// 	$txt_inter_tel="";

	

//*****************************************************************************

//echo "$txt_inter_rut";
//echo $id_inter;
$id_inter = $_SESSION['id_inter'];

//*****************************************************************************
//**************Registro / Modificación / Eliminación de interno***************
//*****************************************************************************

	echo "<p class='Texto3'><span class='Texto'>ModificaciÃ³n de Interno</span><hr></p>";

  
//Consulta de internos
$sql_interno = "select * from interno  where vigencia_int = '1'";
$r_interno = mysql_query($sql_interno,$link);

echo "<p class='Texto3'><span class='Texto'>Seleccione interno \t \t</span>";

//ListBox con internos Registrados
echo "<select name='lstbx_internos' onchange='this.form.submit()'>";

if ($_SESSION['usr']=='mod') // Viene de Modificar paciente del informe **No Borrar**
 {
	$lstbx_internos = $_SESSION['id_inter'];
	echo "<option value='pac'>".$_SESSION['id_inter']."</option> ";	
 }
 else
 {
	echo "<option>internos</option> ";	
 }


	while ($j = mysql_fetch_array($r_interno))
	{
		echo "<option value=$j[0]>$j[1] $j[2]</option> ";	
	}

echo "</select></p>";

if(!$btn_guardar)
{
	//Informcion interno*******************************************************
	$_SESSION['id_inter']=$lstbx_internos;
	$sql_inter_info = "select * from interno where rut_int = '$lstbx_internos'";
	$r_interno = mysql_query($sql_inter_info,$link);
	$info_inter = mysql_fetch_array ($r_interno);
	
//	echo $sql_inter_info;

	$txt_rut2 = $info_inter[0];
	$txt_nombre = $info_inter[1];
	$txt_apellido = $info_inter[2];
	$txt_telefono = $info_inter[3];
	$txt_mail = $info_inter[4];
	if ($info_inter[5] == "1")
	{
		$chbx_vigente_check = "checked='checked'";
	}
	
	//echo $info_inter[3];
}


	


//*****************************************************************************
//*****************************************************************************
echo "  <table border='0'>";


echo "    <tr>";
echo "      <td class='Texto3'>Nombre</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield1'>";
echo " <input type='text' name='txt_nombre' value='$txt_nombre' />";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
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
echo " <input type='text' name='txt_rut2'  maxlength='10' value='$txt_rut2'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "      <td class='Texto2'>ej. 12345678-9</td>";	
if(rutOK($txt_rut2)==False and $btn_guardar)
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

echo "    <tr>";
echo "      <td class='Texto3'>Correo @</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield5'>";
echo " <input type='text' name='txt_mail' value='$txt_mail'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "    </tr>";



echo "  </table>";
echo "<br>";


	echo "    <input type='submit' class='boton' name='btn_guardar' id='btn_guardar' value='Guardar' />";
	echo "    <input type='submit' class='boton' name='btn_cancelar' id='btn_cancelar' value='Cancelar' onclick='window.open(\"../menu_marcos.php\",\"_parent\")' />";
	echo "  </p>";
	echo "</form>";
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