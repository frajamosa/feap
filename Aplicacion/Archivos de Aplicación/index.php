<?php

	
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>FEAP - ACCESO AL SISTEMA</title>";
echo "<link href='Estilos.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>";
echo "<!--";
echo "body {";
echo "	background-image: url(Images/FEAP-800X600.jpg);";
echo "	background-repeat: no-repeat;";
echo "	background-position:center";

echo "}";
echo "#Div1 {";
echo "	position:absolute;";
echo "	left:30%;";
echo "	top:65%;";
echo "	width:270px;";
echo "	height:100px;";
echo "	z-index:1;";
echo "}";
echo "#apDiv1 {";
echo "	position:absolute;";
echo "	left:0%;";
echo "	top:90%;";
echo "	width:100%;";
echo "	height:28px;";
echo "	z-index:2;";
echo "}";
echo "-->";
echo "</style>";
echo "</head>";	


	session_start();
	session_destroy();
	include('conexion.php'); 
	session_start();
	$_SESSION['titulo']	= "1";
	$_SESSION['titulo2']	= "0";	


	if ($btn_enviar)
{
	$sql_usuario = "select * from usuario where usuario = '$txt_usuario' and pass_usuario = '$txt_pass'";
	$r_usuario = mysql_query($sql_usuario,$link);
	$user = mysql_fetch_array ($r_usuario);
	//echo $sql_usuario;
	if($user[0]==0)
	{
		echo "<div class='Texto2'><center>";
		echo "  <strong>Error en Usuario/Contraseña</strong><br/>";
		echo "  <strong>Reintente</strong><br />";
		echo "	<hr>";
		echo "</center></div>";
	}
	else
	{
		$sql_permiso = "select id_permiso from usuario where usuario = '$user[1]'";
		$r_permiso = mysql_query($sql_permiso,$link);
		$permiso = mysql_fetch_array ($r_permiso);
		//echo $sql_permiso;
		//echo $permiso[0];
		
		echo "<div class='Texto2'><center>";
		echo "  <strong>Bienvenido $user[1]</strong><br />";
		echo "	<hr>";
		echo "</center></div>";
		$_SESSION['permiso'] = $permiso[0];
		$_SESSION['usr_name'] = $user[1];
		
		echo "<meta http-equiv='refresh' content='1;URL=menu_marcos.php'>";
	}
}




echo "<body>";

echo "	<div id='Div1'>";
echo "  <center>";

echo "    <form id='form1' name='form1' action='$PHP_SELF' method='get'>";
echo "      <table border='0' align='center'>";
echo "        <tr>";
echo "          <td align='right' class='Texto3'>Usuario:</td>";
echo "          <td><input type='text' name='txt_usuario' id='txt_usuario' /></td>";
echo "        </tr>";
echo "        <tr>";
echo "          <td align='right' class='Texto3'>Contraseña:</td>";
echo "          <td><input type='password' name='txt_pass' id='txt_pass' /></td>";
echo "        </tr>";
echo "        <tr>";
echo "          <td colspan='2' align='center' class='Texto'><input type='submit' name='btn_enviar' id='btn_enviar' value='Entrar' /></td>";
echo "        </tr>";
echo "      </table>";
echo "	</form>";


echo "  </center>";
echo "</div>";

echo "<div class='Texto2' id='apDiv1'><center>";
echo "  <hr />";
echo "  Sitio optimizado para Internet Explorer 6.0 o superior<br />";
echo "  Resolución mínima 800 x 600";
echo "</center></div>";
echo "</body>";
echo "</html>";
?>