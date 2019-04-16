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
if ($chbx_vigente <> "1")
{
	$chbx_vigente = "0";
}

if($btn_guardar and (rutOK($txt_rut))==True)//Modifica**************************
{
	
	//kinesiologo*********************
	$sql_actualiza = "update kinesiologo set rut_k='$txt_rut',nombre_k='$txt_nombre',apellido_k='$txt_apellido',telefono_k='$txt_telefono', correo_k = '$txt_mail' where rut_k = '$id_kine'";
	mysql_query ($sql_actualiza,$link);
	//echo $sql_actualiza."<br>";
	
	//Condicion Error********************
	$error =mysql_errno();
//	echo $error;

	switch($error)
	{
	case 0:
	echo "	<script language='javascript'>alert('Kinesiologo Modificado Exitosamente');</script>";
 	$txt_rut= "";
 	$txt_apellido 	= "";
 	$txt_nombre = "";
 	$txt_telefono="";
 	$txt_mail = "";
 	if ($_SESSION['usr']=="mod")
 	{
		unset($_SESSION['usr']);
		echo "<meta http-equiv='refresh' content='0;URL=../informe/reg_kinesiologo.php'>";
	}
//	echo "<meta http-equiv='refresh' content='1;URL=mod_kine.php'>";	
	break;
	case 1062:
 	echo "	<script language='javascript'>alert('El rut ingresado ya se encuentra Registrado');</script>";
	}
	//***********************************
	
	

}


//*****************************************************************************

//echo "$txt_rut";
//echo $id_kine;
$id_kine = $_SESSION['id_kine'];

//*****************************************************************************
//**************Registro / Modificación / Eliminación de kinesiologo***************
//*****************************************************************************

echo "<p class='Texto3'><span class='Texto'>ModificaciÃ³n de Kinesiologo</span><hr></p>";

//echo $_SESSION['usr'];

//Consulta de kinesiologos
$sql_kinesiologo = "select * from kinesiologo where vigencia_k = '1'";
$r_kinesiologo = mysql_query($sql_kinesiologo,$link);

echo "<p class='Texto3'><span class='Texto'>Seleccione kinesiologo \t \t</span>";

//ListBox con kinesiologos Registrados
echo "<select name='lstbx_kinesiologos' onchange='this.form.submit()'>";


				if ($_SESSION['usr']=='mod') // Viene de Modificar Kinesiologo del informe **No Borrar**
				 {
					$lstbx_kinesiologos = $_SESSION['id_kine'];
					echo "<option value='pac'>".$_SESSION['id_kine']."</option> ";	
				 }
				 else
				 {
					echo "<option value='pac'>kinesiologos</option> ";	
				 }
				
				
				while ($t = mysql_fetch_array($r_kinesiologo))
				{
					echo "<option value=$t[0]>$t[1] $t[2]</option> ";	
				}

echo "</select></p>";

if (!$btn_guardar)
{
	//Informcion kinesiologo*******************************************************
	$_SESSION['id_kine']=$lstbx_kinesiologos;
	$sql_kine_info = "select * from kinesiologo where rut_k = '$lstbx_kinesiologos'";
	$r_kinesiologo = mysql_query($sql_kine_info,$link);
	$info_kine = mysql_fetch_array ($r_kinesiologo);
	
	//echo $sql_kine_info;

	$txt_rut = $info_kine[0];
	$txt_nombre = $info_kine[1];
	$txt_apellido = $info_kine[2];
	$txt_telefono = $info_kine[3];
	$txt_mail = $info_kine[4];
		if ($info_kine[5] == "1")
	{
		$chbx_vigente_check = "checked='checked'";
	}
	
	//echo $info_kine[3];
	


//*****************************************************************************	
}

//*****************************************************************************


echo "  <table border='0'>";


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
echo " <input type='text' name='txt_rut' maxlength='10' value='$txt_rut'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
echo "      <td class='Texto2'>ej. 12345678-9</td>";	
if(rutOK($txt_rut)==False and $btn_guardar)
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
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield5");
//-->
</script>
</body>
</html>