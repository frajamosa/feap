<?php

session_start();
include('conexion.php'); 




echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title></title>";
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
echo "</head>";

echo "<body>";
echo "<form action='$PHP_SELF' method='post'>";

//*****************************************************************************
//**************************Almacenamiento de Registros************************
//*****************************************************************************
//echo "$txt_usr";
$id_usr = $_SESSION['id_usr']; //Id_usuario
////echo $id_usr;
	


if($btn_guardar and $_SESSION['usr']=="add") //Agrega**************************
{
	//Id_Usuario*************************
	$sql_id_usr="select max(id_usuario) from usuario";
	$r_id_usr = mysql_query($sql_id_usr,$link);
	$info_id_usr = mysql_fetch_array ($r_id_usr);
	$nuevo_id_usr=$info_id_usr[0] +1;
	//***********************************
	
	//Registra Usuario*******************
	$sql_insertar = "insert into usuario values ($nuevo_id_usr,'$txt_usr','$txt_pass','$txt_nombre','$r_paciente$r_informes$r_internista$r_kinesiologo$r_usuario')";
	mysql_query ($sql_insertar,$link);
	$error =mysql_errno();
	echo $error;
	if ($error == "1062")
	{
		$obligatorio = "Campo Obligatorio *";
	}
	
	echo $sql_insertar;
	//***********************************

	
	
	
}
if($btn_guardar and $_SESSION['usr']=="mod")//Modifica**************************
{
	
	//Usuario*********************
	$sql_actualiza = "update usuario set usuario='$txt_usr', pass_usuario='$txt_pass', nombre='$txt_nmbr', id_permiso='$r_paciente$r_informes$r_internista$r_kinesiologo$r_usuario'  where id_usuario=$id_usr";
	mysql_query ($sql_actualiza,$link);
	//echo $sql_actualiza."<br>";

}

if($btn_del_si and $_SESSION['usr']=="del")//Elimina****************************
{
	
	$sql_elimina = "delete from usuario_permiso where usuario=(select usuario from usuario where id_usuario=$id_usr)";
	mysql_query ($sql_elimina,$link);
	//echo $sql_elimina."<br>";

}
//*****************************************************************************

	$txt_usuario= "";
	$txt_pass 	= "";
	$txt_nombre = "";
	$txt_pasword ="";
	$txt_usr="";
	
	//Permisos
	$p_0="";
	$p_1="";
	$p_2="";
	$p_3="";
	$p_4="";
	
	//Informes
	$i_0="";
	$i_1="";
	$i_2="";
	$i_3="";
	$i_4="";
	
	//Iternista
	$int_0="";
	$int_1="";
	$int_2="";
	$int_3="";
	$int_4="";
	
	//Kinesiologo
	$k_0="";
	$k_1="";
	$k_2="";
	$k_3="";
	$k_4="";
	
	//Usuario
	$u_0="";
	$u_1="";
	$u_2="";
	$u_3="";
	$u_4="";


//*****************************************************************************





//*****************************************************************************


//*****************************************************************************
//**************Registro / Modificaci�n / Eliminaci�n de Usuario***************
//*****************************************************************************
if ($_SESSION['usr']=="add")
{
	echo "<p class='Texto3'><span class='Texto'>Registro de Nuevo Usuario</span></p>";
}

if($_SESSION['usr']=="mod")
{
	echo "<p class='Texto3'><span class='Texto'>Modificación de Usuario</span></p>";
}

if($_SESSION['usr']=="del")
{
	echo "<p class='Texto3'><span class='Texto'>Eliminar Usuario</span></p>";
}

if ($_SESSION['usr']=="mod" or $_SESSION['usr']=="del")
{
  
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
	$txt_pasword = $info_usr[2];
	$txt_nombre = $info_usr[3];
	
	////echo $info_usr[3];
	
	//**************************************************************************
	
	//Informacion de Permisos***************************************************
	$sql_usr_per = "select id_permiso from usuario where usuario = '$txt_usuario'";
	$r_per = mysql_query($sql_usr_per,$link);	
	$permiso_usr = mysql_fetch_array ($r_per);
	
/**
* 	//echo $sql_usr_per;
*  	//echo $permiso_usr[0];
*  	echo "<br>".substr("$permiso_usr[0]",2,1);
*  	echo "<br>".$permiso_usr[0];
*/

	switch(substr("$permiso_usr[0]",0,1))		//Paciente
	{ 
		case 9:
		$p_0="checked";
		break;
		case 1:
		$p_1="checked";
		break;
		case 2:
		$p_2="checked";
		break;
		case 3:
		$p_3="checked";
		break;
		case 4:
		$p_4="checked";
		break;
	}
	////echo $r_paciente;

	switch(substr("$permiso_usr[0]",1,1))		//Informes
	{ 
		case 9:
		$i_0="checked";
		break;
		case 1:
		$i_1="checked";
		break;
		case 2:
		$i_2="checked";
		break;
		case 3:
		$i_3="checked";
		break;
		case 4:
		$i_4="checked";
		break;
	}
	switch(substr("$permiso_usr[0]",2,1))		//Internista
	{ 
		case 9:
		$int_0="checked";
		break;
		case 1:
		$int_1="checked";
		break;
		case 2:
		$int_2="checked";
		case 3:
		$int_3="checked";
		case 4:
		$int_4="checked";
		break;
	}
	switch(substr("$permiso_usr[0]",3,1))		//Kinesiologo
	{ 
		case 9:
		$k_0="checked";
		break;
		case 1:
		$k_1="checked";
		break;
		case 2:
		$k_2="checked";
		break;
		case 3:
		$k_3="checked";
		break;
		case 4:
		$k_4="checked";
		break;
	}
	switch(substr("$permiso_usr[0]",4,1))		//Usuario
	{ 
		case 9:
		$u_0="checked";
		break;
		case 1:
		$u_1="checked";
		break;
		case 2:
		$u_2="checked";
		break;
		case 3:
		$u_3="checked";
		break;
		case 4:
		$u_4="checked";
		break;
	}

}
//*****************************************************************************
//*****************************************************************************




	echo "  <table border='0'>";
	echo "    <tr>";
	echo "      <td class='Texto3'>Nombre de Usuario</td>";
	echo "      <td class='Texto2'>        <span class='Texto3'>";
	echo "        <input type='text' name='txt_usr' id='txt_usr' value=$txt_usuario >      ";
	echo "      </span></td>";
	echo "<td class='Texto2'>*$obligatorio</td>";
	echo "    </tr>";
	echo "    <tr>";
	echo "      <td class='Texto3'>Contraseña</td>";
	echo "      <td class='Texto2'>        <span class='Texto3'>";
	echo "        <input type='text' name='txt_pass' id='txt_pass' value=$txt_pasword>      ";
	echo "      </span></td>";
	echo "    </tr>";
	echo "    <tr>";
	echo "      <td class='Texto3'>Nombre Completo</td>";
	echo "      <td class='Texto2'>        <span class='Texto3'>";
	echo "        <input type='text' name='txt_nmbr' id='txt_nombre' value='$txt_nombre'>      ";
	echo "      </span></td>";
	echo "    </tr>";
	echo "  </table>";

	echo "  <p class='Texto3'><span class='Texto'>Asignación de Permisos</span></p>";
	echo "  <table width='600' border='1' cellpadding='0' cellspacing='0'>";
	echo "    <tr>";
	echo "      <td valign='top' class='Texto3'>Paciente</td>";
	
	
	
	echo "      <td>";
	echo "        <span class='Texto3'>";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_paciente' value='9' $p_0 />";
	echo "          Sin Acceso</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_paciente' value='1' $p_1 />";
	echo "          Solo Lectura</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_paciente' value='2' $p_2 />";
	echo "          Agregar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_paciente' value='3' $p_3 />";
	echo "          Agregar / Modificar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_paciente' value='4' $p_4 />";
	echo "          Agregar / Modificar / Eliminar</label>        ";
	echo "        <br />      ";
	
	echo "        </span></td>";
	
	
	echo "      <td valign='top' class='Texto3'>Informes</td>";
	echo "      <td class='Texto2'>";
	echo "        <span class='Texto3'>";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_informes' value='9' $i_0 />";
	echo "          Sin Acceso</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_informes' value='1' $i_1 />";
	echo "          Solo Lectura</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_informes' value='2' $i_2 />";
	echo "          Agregar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_informes' value='3' $i_3 />";
	echo "          Agregar / Modificar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_informes' value='4' $i_4 />";
	echo "      Agregar / Modificar / Eliminar</label>";
	echo "      </span></td>";
	
	echo "    </tr>";
	
	echo "    <tr>";
	
	echo "      <td valign='top' class='Texto3'>Internista</td>";
	echo "      <td class='Texto2'>";
	echo "        <span class='Texto3'>";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_internista' value='9' $int_0/>";
	echo "          Sin Acceso</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_internista' value='1' $int_1 />";
	echo "          Solo Lectura</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_internista' value='2' $int_2 />";
	echo "          Agregar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_internista' value='3' $int_3 />";
	echo "          Agregar / Modificar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_internista' value='4' $int_4 />";
	echo "      Agregar / Modificar / Eliminar</label>";
	
	echo "      </span></td>";
	
	echo "      <td valign='top' class='Texto3'>Kinesiólogo</td>";
	echo "      <td class='Texto2'>";
	echo "        <span class='Texto3'>";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_kinesiologo' value='9' $k_0/>";
	echo "          Sin Acceso</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_kinesiologo' value='1' $k_1 />";
	echo "          Solo Lectura</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_kinesiologo' value='2' $k_2 />";
	echo "          Agregar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_kinesiologo' value='3' $k_3 />";
	echo "          Agregar / Modificar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_kinesiologo' value='4' $k_4 />";
	echo "      Agregar / Modificar / Eliminar</label>";
	
	echo "      </span></td>";
	echo "    </tr>";
	
	echo "    <tr>";
	
	echo "      <td valign='top' class='Texto3'>Usuario</td>";
	echo "      <td class='Texto2'>";
	echo "        <span class='Texto3'>";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_usuario' value='9' $u_0 />";
	echo "          Sin Acceso</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_usuario' value='1' $u_1 />";
	echo "          Solo Lectura</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_usuario' value='2' $u_2 />";
	echo "          Agregar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_usuario' value='3' $u_3 />";
	echo "          Agregar / Modificar</label>";
	echo "        <br />";
	
	echo "        <label>";
	echo "          <input type='radio' name='r_usuario' value='4' $u_4 />";
	echo "      Agregar / Modificar / Eliminar</label>";
	
	echo "      </span></td>";
	echo "      <td colspan='2'>&nbsp;</td>";
	echo "    </tr>";
	
	echo "  </table>";
	echo "  <p>";
	
	if($_SESSION['usr']=="del")
	{
		
		echo "<span class='Texto'>Eliminar Usuario</span>";
		echo "    <input type='submit' name='btn_del_si' value='Si'/>";
		echo "    <input type='submit' name='btn_del_no' value='No' onclick='window.open(\"menu_marcos.php\",\"_parent\")'/>";
		echo "  </p>";
		echo "</form>";
	}
	
	else
	{
		echo "    <input type='submit' name='btn_guardar' id='btn_guardar' value='Guardar' />";
		echo "    <input type='submit' name='btn_cancelar' id='btn_cancelar' value='Cancelar' onclick='window.open(\"menu_marcos.php\",\"_parent\")' />";
		echo "  </p>";
		echo "</form>";
	}
	
	
	
	



echo "</body>";
echo "</html>";


?>