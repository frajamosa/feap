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
echo "</head>";
echo "<form action='$PHP_SELF' method='post'>";






		$titulo = "Registro de Internos";
		$boton = "Internista";
		//******************************************************************************Busca Interno
		$sql_interno = "select * from interno where vigencia_int = '1' order by apellido_int";
		$resultado = mysql_query($sql_interno,$link);
		//**********************************************************************************************






echo "<body>";

echo "<span class='Texto3'>$titulo";	
echo "</span>";
echo "<hr />";
echo "<table border='0' width='100%' >";
echo "  <tr>";
echo "    </span>      <hr /></td>";
echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td>NOMBRE</td>";
echo "    <td>APELLIDO</td>";
echo "    <td>RUT</td>";

echo "    <td>TELEFONO</td>";	
echo "    <td>CORREO E.</td>";			

echo "    <td>ACCION</td>";
echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td colspan='6'><hr /></td>";
echo "  </tr>";


while ($info = mysql_fetch_array($resultado))
{
echo "  <tr class='Texto4'>";
echo "    <td valign='middle'>$info[1]</td>";
echo "    <td valign='middle'>$info[2]</td>";
echo "    <td valign='middle'>$info[0]</td>";

echo "    <td valign='middle'>$info[3]</td>";
echo "    <td valign='middle'>$info[4]</td>";
echo "    <td>";
echo "      <input type='submit'  class='boton2'name='btn_mod' id='btn_mod' value='Modificar $boton-$info[0]' />";
//echo "      <br />";
//echo "      <input type='submit' class='boton2' name='btn_del' id='btn_del' value='Eliminar $boton-$info[0]' />";
echo "    </td>";
echo "  </tr>";
echo "  <tr class='Texto4'>";
echo "    <td colspan='6'><hr /></td>";
echo "  </tr>";	
}


if($btn_mod)
{

			$f3 = split ('-',$btn_mod);
			$_SESSION['id_inter'] = $f3[1]."-".$f3[2];
			$_SESSION['usr']= "mod";
			$_SESSION['usr_info']= "mod";
			echo "	<meta http-equiv='refresh' content='0;URL=../internista/mod_inter.php'>";
			

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