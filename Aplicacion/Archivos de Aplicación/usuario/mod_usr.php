<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";

session_start();
include('../conexion.php'); 

echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin título</title>";
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
echo "<script src='SpryAssets/SpryValidationRadio.js' type='text/javascript'></script>";
echo "<link href='SpryAssets/SpryValidationRadio.css' rel='stylesheet' type='text/css' />";
echo "</head>";

echo "<body>";
echo "<form action='$PHP_SELF' method='post'>";

//*****************************************************************************
//**************************Almacenamiento de Registros************************
//*****************************************************************************
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


//echo "$txt_usr";
$id_usr = $_SESSION['id_usr']; //Id_usuario
////echo $id_usr;
	


if($btn_guardar and (rutOK($txt_rut2))==True and strcmp($txt_pass,$txt_pass2)=="0" and strlen($txt_pass)>="6")//Modifica**************************
{
	
	//Usuario*********************
	$sql_actualiza = "update usuario set pass_usuario='$txt_pass', nombre='$txt_nombre', id_permiso='$tipo_usr', apellido='$txt_apellido', rut='$txt_rut2'  where id_usuario=$id_usr";
	mysql_query ($sql_actualiza,$link);
	//echo $sql_actualiza."<br>";
	$error =mysql_errno();
//	echo $error;
	switch($error)
	{
	case 0:
	echo "	<script language='javascript'>alert('Usuario Modificado Exitosamente');</script>";
	$txt_usr= "";
	$txt_pass 	= "";
	$txt_pass2 	= "";
	$txt_nombre = "";
	$txt_apellido = "";
	$txt_rut2 = "";
	$txt_usr="";
	if ($_SESSION['usr']=="mod")
	{
	 	unset($_SESSION['usr']);
		echo "<meta http-equiv='refresh' content='0;URL=../informe/reg_usr.php'>";
	}
	
	//Permisos
	$p_0="";
	$p_1="";
	break;
	case 1062:
 	echo "	<script language='javascript'>alert('El Usuario ingresado ya se encuentra Registrado');</script>";
	break;
	}
}

//*****************************************************************************
/*
	$txt_usuario= "";
	$txt_pass 	= "";
	$txt_nombre = "";
	$txt_apellido = "";
	$txt_rut2 = "";
	$txt_pasword ="";
	$txt_usr="";
	
	//Permisos
	$p_0="";
	$p_1="";
*/
//*****************************************************************************


//*****************************************************************************
//**************Registro / Modificaci�n / Eliminaci�n de Usuario***************
//*****************************************************************************
	echo "<p class='Texto3'><span class='Texto'>Modificación de Usuario</span><hr></p>";

  
//Consulta de Usuarios
$sql_usuario = "select * from usuario";
$r_usuario = mysql_query($sql_usuario,$link);

echo "<p class='Texto3'><span class='Texto'>Seleccione Usuario \t \t</span>";


//ListBox con Usuarios Registrados
echo "<select name='lstbx_usuarios' onchange='this.form.submit()'>";
if ($_SESSION['usr']=='mod') // Viene de Modificar paciente del informe **No Borrar**
 {
	$lstbx_usuarios = $_SESSION['id_usr'];
	echo "<option value='pac'>".$_SESSION['id_usr']."</option> ";
 }
 else
 {
	echo "<option>usuario</option> ";	
 }

	while ($t = mysql_fetch_array($r_usuario))
	{
		echo "<option value=$t[0]>$t[1]</option> ";	
	}

echo "</select></p>";
if (!$btn_guardar)
{
	//Informcion Usuario*******************************************************
	$_SESSION['id_usr']=$lstbx_usuarios;
	$sql_usr_info = "select * from usuario where id_usuario = $lstbx_usuarios";
	$r_usuario = mysql_query($sql_usr_info,$link);
	$info_usr = mysql_fetch_array ($r_usuario);
	
	////echo $sql_usr_info;

	$txt_usr = $info_usr[1];
	$txt_pass = $info_usr[2];
	$txt_nombre = $info_usr[3];
	$txt_apellido = $info_usr[5];
	$txt_rut2 = $info_usr[6];
	
}
	
	////echo $info_usr[3];
	
	//**************************************************************************
	
	//Informacion de Permisos***************************************************
	$sql_usr_per = "select id_permiso from usuario where usuario = '$txt_usr'";
	$r_per = mysql_query($sql_usr_per,$link);	
	$permiso_usr = mysql_fetch_array ($r_per);
	

//  	echo $sql_usr_per;
//   	echo $permiso_usr[0];
//   	echo "<br>".substr("$permiso_usr[0]",2,1);
//   	echo "<br>".$permiso_usr[0];



	switch("$permiso_usr[0]")
	{ 
		case "A":
		$p_0="checked";
		break;
		case "U":
		$p_1="checked";
		break;
	}

//*****************************************************************************
//*****************************************************************************




	echo "  <table border='0'>";
echo "    <tr>";
	echo "      <td class='Texto3'>Nombre</td>";
	echo "      <td class='Texto2'>        <span class='Texto3'>";
echo "  <p><span id='sprytextfield3'>";
echo " <input type='text' name='txt_nombre' value='$txt_nombre'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	echo "    </tr>";
	
	echo "    <tr>";
	echo "      <td class='Texto3'>Apellido</td>";
	echo "      <td class='Texto2'>        <span class='Texto3'>";
echo "  <p><span id='sprytextfield4'>";
echo " <input type='text' name='txt_apellido' value='$txt_apellido'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	echo "    </tr>";
	
echo "    <tr>";
echo "      <td class='Texto3'>Rut</td>";
echo "      <td class='Texto2'><span class='Texto3'>";
echo "  <p><span id='sprytextfield5'>";
echo " <input type='text' name='txt_rut2'  maxlength='10' value='$txt_rut2'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span><hr></td>";
echo "      <td class='Texto2'>ej. 12345678-9</td>";	
if(rutOK($txt_rut2)==False and $btn_guardar)
{
	echo "	<script language='javascript'>alert('Error en campo Rut');</script>";	
}

echo "    </tr>";	

	echo "    <tr>";
	echo "      <td class='Texto3'>Nombre de Usuario</td>";
	echo "      <td class='Texto2'>        <span class='Texto3'>";
echo "  <p><span id='sprytextfield1'>";
echo " <input type='text' name='txt_usr' value='$txt_usr' readonly='readonly'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	echo "    </tr>";
	echo "    <tr>";
	echo "      <td class='Texto3'>Contraseña</td>";
	echo "      <td class='Texto2'>        <span class='Texto3'>";
echo "  <p><span id='sprytextfield2'>";
echo " <input type='text' name='txt_pass' value='$txt_pass'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
	echo "    </tr>";
	echo "    <tr>";
	echo "      <td class='Texto3'>Conf. Contraseña</td>";
	echo "      <td class='Texto2'>        <span class='Texto3'>";
echo "  <p><span id='sprytextfield6'>";
echo " <input type='text' name='txt_pass2' value='$txt_pass2'>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span></td>";
if(strcmp($txt_pass,$txt_pass2)<>"0" and $btn_guardar)
{
	echo "	<script language='javascript'>alert('Las Contraseñas no coinciden');</script>";	
}
if(strlen($txt_pass)<"6" and $btn_guardar and $txt_pass<>"")
{
if (!$sql_insertar)
{
echo "	<script language='javascript'>alert('La contraseña debe tener como m�nimo 6 caracteres');</script>";		
}

}
	echo "    </tr>";
		
	echo "  </table>";
	
	
	echo "  <p class='Texto3'>&nbsp;</p>";
	echo "  <p class='Texto3'><span class='Texto'>Tipo de Usuario</span><hr></p>";
	echo "  <table width='600' border='0' cellpadding='0' cellspacing='0'>";
	echo "    <tr>";
	echo "      <td valign='top' class='Texto3'>Tipo</td>";
	
	
	
	echo "      <td>";
	echo "        <span class='Texto3' id='spryradio1'>";
	
	echo "        <label>";
	echo "          <input type='radio' name='tipo_usr' value='A' $p_0 />";
	echo "          Administrador</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='tipo_usr' value='U' $p_1 />";
	echo "          Restringido</label>";
	echo "        <br />";
	echo "		  <span class='radioRequiredMsg'>Campo Obligatorio</span></span>";
	echo "  </table>";
	echo "  <p>&nbsp;</p>";
	echo "  <p>";
	
	

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
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield6");
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1");
//-->
</script>


</body>
</html>
