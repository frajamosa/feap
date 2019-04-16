<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
session_start();
include('../conexion.php'); 

echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Eliminación de Usuarios</title>";
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
echo "</head>";

echo "<body>";
echo "<form action='$PHP_SELF' method='post'>";

//*****************************************************************************
//**************************Almacenamiento de Registros************************
//*****************************************************************************
// //echo "$txt_usr";
$id_usr = $_SESSION['id_usr']; //Id_usuario
// ////echo $id_usr;
// echo $id_usr;


if($btn_del)//Elimina****************************
{
	
	$sql_elimina = "delete from usuario where id_usuario='$id_usr'";
	mysql_query ($sql_elimina,$link);
// 	echo $sql_elimina."<br>";
	$error =mysql_errno();
//	echo $error;
	switch($error)
	{
	case 0:
	echo "	<script language='javascript'>alert('Usuario Eliminado Exitosamente');</script>";
	$txt_usuario= "";
	$txt_pass 	= "";
	$txt_nombre = "";
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


}
//*****************************************************************************
//*****************************************************************************
//**************Registro / Modificación / Eliminación de Usuario***************
//*****************************************************************************
	echo "<p class='Texto3'><span class='Texto'>Eliminar Usuario</span><hr></p>";

//Consulta de Usuarios
$sql_usuario = "select * from usuario";
$r_usuario = mysql_query($sql_usuario,$link);

echo "<p class='Texto3'><span class='Texto'>Seleccione Usuario \t \t</span>";

//ListBox con Usuarios Registrados
echo "<select name='lstbx_usuarios' onchange='this.form.submit()'>";
echo "<option>Usuarios</option> ";	

	while ($t = mysql_fetch_array($r_usuario))
	{
		echo "<option value=$t[0]>$t[1]</option> ";	
	}

echo "</select></p>";

	//Informcion Usuario*******************************************************
	$_SESSION['id_usr']=$lstbx_usuarios;
	$sql_usr_info = "select * from usuario where id_usuario = $lstbx_usuarios";
	$r_usuario = mysql_query($sql_usr_info,$link);
	$info_usr = mysql_fetch_array ($r_usuario);
	
	////echo $sql_usr_info;

	$txt_usuario = $info_usr[1];
	$txt_nombre = $info_usr[3];
	$txt_apellido = $info_usr[5];
	$txt_rut = $info_usr[6];
	
	////echo $info_usr[3];
	
	//**************************************************************************
	
	//Informacion de Permisos***************************************************
	$sql_usr_per = "select id_permiso from usuario where usuario = '$txt_usuario'";
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
	echo "      <td class='Texto2'>";
	echo "      $txt_nombre      ";
	echo "      </span></td>";
	echo "    </tr>";
	echo "    <tr>";
	echo "      <td class='Texto3'>Apelido</td>";
	echo "      <td class='Texto2'>";
	echo "      $txt_apellido      ";
	echo "      </span></td>";
	echo "    </tr>";
	echo "      <td class='Texto3'>Rut<br><hr></td>";
	echo "      <td class='Texto2'>";
	echo "      $txt_rut<br><hr>      ";
	echo "      </span></td>";
	echo "    </tr>";
	echo "    <tr>";
	echo "      <td class='Texto3'>Nombre de Usuario</td>";
	echo "      <td class='Texto2'>";
	echo "        $txt_usuario      ";
	echo "        <type='hidden' name='txt_usuario2' value='$txt_usuario'>      ";
	echo "      </span></td>";
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
	echo "          <input type='radio' name='tipo_usr' value='A' $p_0 disabled='disabled' />";
	echo "          Administrador</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='tipo_usr' value='U' $p_1 disabled='disabled'/>";
	echo "          Restringido</label>";
	echo "        <br />";

	echo "  </table>";
	echo "  <p>&nbsp;</p>";
	echo "  <p>";
	
		
		echo "<p class='Texto3'><span class='Texto'>Eliminar Usuario</span></p>";
		echo "    <input type='submit' class='boton' name='btn_del' value='Si'/>";
		echo "    <input type='submit' class='boton' name='btn_cancelar' value='No' onclick='window.open(\"../menu_marcos.php\",\"_parent\")'/>";
		echo "  </p>";
		echo "</form>";
	
	
	



echo "</body>";
echo "</html>";


?>