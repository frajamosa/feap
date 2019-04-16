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
function ej_usr($nom,$ape,$link){

	$nombre = strtolower($nom);
	$apellido = strtolower($ape);
	//echo "<br><br><hr>";
	

// 	$nombre = trim($nombre);
// 	$apellido = trim($apellido);

	$l_nom = strlen($nombre);
	$l_ap = strlen($apellido);
	
	do
	{
	  	$l_ap = strlen($apellido);
		$pos = strpos($apellido," ");
		if ($pos<>"0"){
		$ape1 = substr($apellido,0,$pos);
		$ape2 = substr($apellido,$pos+1,$l_ap);
		$apellido = $ape1.$ape2;
		$pos = strpos($apellido," ");
		}
	//	echo $apellido."<br>";
	//	echo $pos."<br>";
		
	}while ($pos<>"0");


	
	$i = 0;
	
 	do
 	{

		$nombre_usr = substr($nombre,0,($l_nom-($l_nom-($i+1))));
//		$apellido_usr = substr($apellido,0,$l_ap);
		$apellido_usr = $apellido;		
		$nuevo_usuario = $nombre_usr.$apellido_usr;
		
		$sql_usr_name = "select count(id_usuario) from usuario where usuario = '$nuevo_usuario'";
		$r_sql_usr_name = mysql_query($sql_usr_name,$link);
		$info_usr_name = mysql_fetch_array($r_sql_usr_name);
		
		$i++;

 	} while($info_usr_name[0]<>"0");
 	

	return $nuevo_usuario;
	
}	

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
//echo strlen($txt_pass);
$id_usr = $_SESSION['id_usr']; //Id_usuario
////echo $id_usr;
	
	//Id_Usuario*************************
	$sql_id_usr="select max(id_usuario) from usuario";
	$r_id_usr = mysql_query($sql_id_usr,$link);
	$info_id_usr = mysql_fetch_array ($r_id_usr);
	$nuevo_id_usr=$info_id_usr[0] +1;
	//***********************************
	//Registra Usuario*******************
//	echo strcmp($txt_pass,$txt_pass2);
	
	if (($btn_guardar and strcmp($txt_pass,$txt_pass2)=="0") and (rutOK($txt_rut2))==True and strlen($txt_pass)>="6")
	{
	$sql_insertar = "insert into usuario values ($nuevo_id_usr,'$txt_usr','$txt_pass','$txt_nombre','$tipo_usr','$txt_apellido', '$txt_rut2')";
	mysql_query ($sql_insertar,$link);
	$error =mysql_errno();
//	echo $error."<br>";
	switch($error)
	{
	case 0:
	echo "	<script language='javascript'>alert('Usuario Registrado Exitosamente');</script>";
	$txt_usuario= "";
	$txt_pass 	= "";
	$txt_pass2 	= "";
	$txt_nombre = "";
	$txt_apellido = "";
	$txt_rut2 = "";
	$txt_pasword ="";
	$txt_usr="";
	
	//Permisos
	$p_0="";
	$p_1="";
	break;
	case 1062:
 	echo "	<script language='javascript'>alert('El Usuario ingresado ya se encuentra Registrado');</script>";
	break;
	}
	

//	echo $sql_insertar;	
	}	
	
	//***********************************

//*****************************************************************************

// 	$txt_usuario= "";
// 	$txt_pass 	= "";
// 	$txt_nombre = "";
// 	$txt_pasword ="";
// 	$txt_usr="";
// 	
// 	//Permisos
// 	$p_0="";
// 	$p_1="";

//*****************************************************************************


//*****************************************************************************
//**************Registro / Modificacin / Eliminacin de Usuario***************
//*****************************************************************************
	echo "<p class='Texto3'><span class='Texto'>Registro de Nuevo Usuario</span><hr></p>";
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
echo " <input type='text' name='txt_rut2'  maxlength='10' value='$txt_rut2' onblur=''>";
echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
echo "      </span><hr></td>";
echo "      <td class='Texto2'>ej. 12345678-9</td>";	
if(rutOK($txt_rut2)==False and $btn_guardar)
{
	echo "	<script language='javascript'>alert('Error en campo Rut');</script>";	
}

echo "    </tr>";	
//$n_usr = ej_usr($txt_nombre,$txt_apellido,$link);	
$n_usr = ej_usr($txt_nombre,$txt_apellido,$link);	
echo "<a name ='usuario'></a>";

if ($btn_ej_usr)
{
 $txt_usr = $n_usr; 
		echo "      <td class='Texto3'>Nombre de Usuario</td>";
		echo "      <td class='Texto2'>     <span class='Texto3'>";
		echo "  <p><span id='sprytextfield1'>";
		echo " <input type='text' name='txt_usr' value='$txt_usr' >";
		echo "  <span class='textfieldRequiredMsg'>*Campo Obligatorio*</span></span>";
		echo "      </span></td>";
		echo "    <td class='Texto2'><input type='submit' class='boton' name='btn_ej_usr' id='btn_ej_usr' value='Usuario Sugerido' /></td>";
		
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
		if(strlen($txt_pass)<"6" and $btn_guardar )
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
}
else
{
		echo "      <td class='Texto3'>Nombre de Usuario</td>";
		echo "      <td class='Texto2'>     <span class='Texto3'>";
		
		echo " <input type='text' name='txt_usr' value='$txt_usr' >";
		echo "      </span></td>";
		echo "    <td class='Texto2'><input type='submit' class='boton' name='btn_ej_usr' id='btn_ej_usr' value='Usuario Sujerido' /></td>";
			echo "    </tr>";
		echo "    <tr>";
		echo "      <td class='Texto3'>Contraseña</td>";
		echo "      <td class='Texto2'>        <span class='Texto3'>";

		echo " <input type='text' name='txt_pass' value='$txt_pass'>";

		echo "      </span></td>";
		echo "    </tr>";
		echo "    <tr>";
		echo "      <td class='Texto3'>Conf. Contraseña</td>";
		echo "      <td class='Texto2'>        <span class='Texto3'>";

		echo " <input type='text' name='txt_pass2' value='$txt_pass2'>";

		echo "      </span></td>";
		if(strcmp($txt_pass,$txt_pass2)<>"0" and $btn_guardar)
		{
		echo "	<script language='javascript'>alert('Las Contraseñas no coinciden');</script>";	
		}
		if(strlen($txt_pass)<"6" and $btn_guardar)
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
	echo "        <span class='Texto3'>";
		
		echo "        <label>";
		echo "          <input type='radio' name='tipo_usr' value='A' $p_0 />";
		echo "          Administrador</label>";
		echo "        <br />";
		
		echo "        <label>";
		echo "          <input type='radio' name='tipo_usr' value='U' $p_1 />";
		echo "          Restringido</label>";
		echo "        <br />";
	echo "		  </span>";
		echo "  </table>";
}


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
