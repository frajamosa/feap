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
$imprimir_info = $_SESSION['imprimir_info'];

switch ($imprimir_info)
{
	case "alta":
	$titulo = "REGISTRO DE PACIENTES EN ALTA";
	$colspan="7";
	$var_alta1 = "<td>ALTA</td>";	
	break;
	case "baja":
	$titulo = "REGISTRO DE PACIENTES EN ATENCION";
	$colspan="7";
	$var_alta1 = "<td>ALTA</td>";	
	break;
	case"todo":
	$titulo = "REGISTRO DE PACIENTES";
	$colspan="7";
	$var_alta1 = "<td>ALTA</td>";
	break;
}
		
		$boton = "Paciente";	
		
	 	//******************************************************************************Busca Pacientes
		$sql_paciente = $_SESSION['reg_paciente'];
 		$resultado = mysql_query($sql_paciente,$link);
 		//**********************************************************************************************






echo "<body onload='window.print()'>";

echo "<td><img src='../Images/FEAP-200x100.jpg' align='left' /><td>";
echo "<img src='../Images/uss.jpg' align='right' />";
echo "<br><br><br><span class='Texto3_I' ><center>$titulo</center>";	
echo "</span>";

echo "<center><table border='0' width='100%' >";
echo "  <tr>";
echo "    </span>      <hr /></td>";
echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td>APELLIDO</td>";
echo "    <td>NOMBRE</td>";
echo "    <td>RUT</td>";

echo "    <td>F. DE NACIMIENTO</td>";
echo "    <td>TELEFONO</td>";
echo "    <td>CORREO E.</td>";


	echo $var_alta1;

echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td colspan='$colspan'><hr /></td>";
echo "  </tr>";


$i = "4";
while ($info = mysql_fetch_array($resultado))
{
 if ($i =="4")
 {
	echo "  <tr class='Texto$i' >";
	$i="5";
}
else
{
	echo "  <tr class='Texto$i' >";
	$i="4";	
}
if ($info[8]==true)
	{
		$alta = "Si";
			
	}
	else
	{
		$alta = "No";
		
	}	
$var_alta2 ="    <td valign='middle' bgcolor='$color_alta'>$alta</td>";
echo "    <td valign='middle'>$info[2]</td>";
echo "    <td valign='middle'>$info[1]</td>";
echo "    <td valign='middle'>$info[0]</td>";

$f = split ('-',$info[6]);
echo "    <td valign='middle'>$f[2]-$f[1]-$f[0]</td>";	
echo "    <td valign='middle'>$info[4]-$INFO[5]</td>";
echo "    <td valign='middle'>$info[6]</td>";

echo $var_alta2; 

echo "  </tr>";
echo "  <tr>";
echo "    <td colspan='$colspan'><hr /></td>";
echo "  </tr>";	
}


if($btn_mod)
{

			$f3 = split ('-',$btn_mod);
			$_SESSION['id_pac'] = $f3[1]."-".$f3[2];
			$_SESSION['usr']= "mod";
			$lstbx_pacientes = $_SESSION['id_pac'];
			echo "	<meta http-equiv='refresh' content='0;URL=../paciente/mod_paciente.php'>";

}

// if($btn_del)
// {
// 
// 			$f3 = split ('-',$btn_del);
// 			$_SESSION['id_pac'] = $f3[1]."-".$f3[2];
// 			$_SESSION['usr']= "del";
// 			$lstbx_pacientes = $_SESSION['id_pac'];
// 			echo "	<meta http-equiv='refresh' content='0;URL=../paciente/del_paciente.php'>";
// 
// }



echo "</table></center>";
echo "";
echo "  <br />";

//echo "  <input type='submit' name='btn_imprime' id='btn_imprime' value='Imprimir Informe' onclick='window.open(\"reg_paciente.php\",\"_blank\")'/>";
echo "";
$fecha = date("M d, Y g:i");
echo "<div id='apDiv1' class='Texto3'>$fecha</div>";
echo "<p>&nbsp;</p>";
echo "</body>";
echo "</form>";
echo "</html>";
?>