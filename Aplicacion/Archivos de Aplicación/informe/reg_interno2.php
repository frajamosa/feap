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
echo "	background-position:center";
echo "}";
echo "#apDiv1 {";
echo "	position:absolute;";
echo "	left:80%;";
echo "	top:90%;";
//echo "	width:140px;";
//echo "	height:50px;";
echo "	z-index:1;";
echo "}";
echo "-->";
echo "</style>";
echo "<link href='../Estilos_I.css' rel='stylesheet' type='text/css' />";
echo "</head>";
echo "<form action='$PHP_SELF' method='post'>";






		$titulo = "REGISTRO DE INTERNOS";
		$boton = "Internista";
		//******************************************************************************Busca Interno
		$sql_interno = "select * from interno where vigencia_int = '1' order by apellido_int";
		$resultado = mysql_query($sql_interno,$link);
		//**********************************************************************************************






echo "<body onload='window.print()'>";

echo "<td><img src='../Images/FEAP-200x100.jpg' align='left' /><td>";
echo "<img src='../Images/uss.jpg' align='right' />";
echo "<br><br><br><span class='Texto3_I' ><center>$titulo</center>";	
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

echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td colspan='5'><hr /></td>";
echo "  </tr>";

$i = "4";
while ($info = mysql_fetch_array($resultado))
{
 if ($i =="4")
 {
	echo "  <tr class='Texto$i' bgcolor='#0066FF'>";
	$i="5";
}
else
{
	echo "  <tr class='Texto$i' bgcolor='red'>";
	$i="4";	
}

echo "    <td valign='middle'>$info[1]</td>";
echo "    <td valign='middle'>$info[2]</td>";
echo "    <td valign='middle'>$info[0]</td>";
echo "    <td valign='middle'>$info[3]</td>";
echo "    <td valign='middle'>$info[4]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td colspan='5'><hr /></td>";
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
//echo "  <input type='submit' name='btn_imprime' id='btn_imprime' value='Imprimir Informe' />";
echo "";
$fecha = date("M d, Y g:i:s");
echo "<div id='apDiv1' class='Texto3'>$fecha</div>";

echo "<p>&nbsp;</p>";
echo "</body>";
echo "</form>";
echo "</html>";
?>