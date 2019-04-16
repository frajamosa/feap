<?php

	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";

session_start();
include('../conexion.php');

echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin título</title>";
echo "<link href='../Estilos.css' rel='stylesheet' type='text/css' />";
echo "</head>";
echo "<form action='$PHP_SELF' method='post'>";






		$titulo = "Registro de Usuarios";
		$boton = "Usuario";
		//******************************************************************************Busca Interno
		$sql_usuario = "select * from usuario order by id_usuario";
		$resultado = mysql_query($sql_usuario,$link);
		//**********************************************************************************************






echo "<body>";

echo "<span class='Texto3'>$titulo";	
echo "</span>";
echo "<hr />";
echo "<p>&nbsp;</p>";
echo "<table border='0' width='100%' >";
echo "  <tr>";
echo "    </span>      <hr /></td>";
echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td>USUARIO</td>";
echo "    <td>PASSWORD</td>";
echo "    <td>NOMBRE</td>";

echo "    <td>PERMISO</td>";		

echo "    <td>ACCION</td>";
echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td colspan='5'><hr /></td>";
echo "  </tr>";


while ($info = mysql_fetch_array($resultado))
{
echo "  <tr class='Texto4'>";
echo "    <td valign='middle'>$info[1]</td>";
echo "    <td valign='middle'>$info[2]</td>";
echo "    <td valign='middle'>$info[3]</td>";

if ($info[4]=="A")
{
echo "    <td valign='middle'>Administrador del Sistema</td>";	
}
if ($info[4]=="U")
{
echo "    <td valign='middle'>Usuario del Sistema</td>";	
}


echo "    <td>";
echo "      <input type='submit'  class='boton2'name='btn_mod' id='btn_mod' value='Modificar $boton-$info[0]' />";
//echo "      <br />";
//echo "      <input type='submit' class='boton2' name='btn_del' id='btn_del' value='Eliminar $boton-$info[0]' />";
echo "    </td>";
echo "  </tr>";
echo "  <tr class='Texto4'>";
echo "    <td colspan='5'><hr /></td>";
echo "  </tr>";	
}


if($btn_mod)
{

			$f3 = split ('-',$btn_mod);
			$_SESSION['id_usr'] = $f3[1];
			$_SESSION['usr']= "mod";
			$_SESSION['usr_info']= "mod";
			//echo $info[0];
			echo "	<meta http-equiv='refresh' content='0;URL=../usuario/mod_usr.php'>";
			

}


echo "</table>";

echo "";
echo "  <br />";
echo "  <input type='submit' class='boton' name='btn_imprime' id='btn_imprime' value='Imprimir Informe' onclick='window.open(\"reg_interno2.php\",\"_blank\")'/>";
echo "";
echo "<p>&nbsp;</p>";
echo "</body>";
echo "</form>";
echo "</html>";
?>