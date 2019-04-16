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

		$boton = "Paciente";
		$colspan="8";	
		
//*********************************************************************************************
echo "      <CENTER><input type='submit' class='boton2' name='btn_all' value='MOSTRAR TODOS LOS PACIENTES REGISTRADOS' />";
$var_alta1 = "<td bgcolor='#e9e9e9'>ALTA</td>";	

if ($_SESSION['usr']=="mod")
{
	$btn_all="1";	
}


if ($btn_all)
{

	$btn_alta = "1";
	$btn_baja = "1";
	unset($_SESSION['usr']);

}

if($btn_alta)
{
 	//******************************************************************************Busca Pacientes
	$sql_paciente = "select * from paciente where alta_pac = '1' order by apellido_pac";
	$resultado = mysql_query($sql_paciente,$link);
	//****************************************************************************************	
	echo "      <input type='submit' class='boton2' name='btn_baja'  value='OCULTAR PACIENTES DE ALTA' />";
	$_SESSION['imprimir_info']="alta";

}
if ($btn_baja)
{	
	//******************************************************************************Busca Pacientes
	$sql_paciente = "select * from paciente where alta_pac = '0' order by apellido_pac";
	$resultado = mysql_query($sql_paciente,$link);
	//****************************************************************************************	
	echo "      <input type='submit' class='boton2' name='btn_alta' value='MOSTRAR PACIENTES DE ALTA' />";	
	$_SESSION['imprimir_info']="baja";
}

if($btn_all)
{
	//******************************************************************************Busca Pacientes
	$sql_paciente = "select * from paciente order by apellido_pac";
	$resultado = mysql_query($sql_paciente,$link);
	//****************************************************************************************
	$_SESSION['imprimir_info']="todo";	
}

$_SESSION['reg_paciente']=$sql_paciente;
echo "</CENTER>";

echo "<body>";

echo "<span class='Texto3'>Registro de Pacientes";	
echo "</span>";
echo "<hr />";
echo "<center><table border='0' width='100%' >";
echo "  <tr>";
echo "    <td colspan='$colspan'><span class='Texto4'>";
echo "    </span>      <hr /></td>";
echo "  </tr>";
echo "  <tr class='Texto3'><center>";
echo "    <td bgcolor='#e9e9e9'>APELLIDO</td>";
echo "    <td>NOMBRE</td>";
echo "    <td bgcolor='#e9e9e9'>RUT</td>";

echo "    <td>F. DE NACIMIENTO</td>";
echo "    <td bgcolor='#e9e9e9'>TELEFONO</td>";
echo "    <td>CORREO E.</td>";

echo $var_alta1;

echo "    <td>ACCION</td>";
echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td colspan='$colspan'><hr /></td>";
echo "  </tr>";


while ($info = mysql_fetch_array($resultado))
{

	if ($info[8]==true)
	{
		$alta = "Si";
		$color_alta = "#c9c9c9";
		$class_alta = "Info_1";
			
	}
	else
	{
		$alta = "No";
		$color_alta = "#e9e9e9";
		if($btn_all)
		{
			$class_alta = "Info_2";
		}
		else
		{
			$class_alta = "Info_1";
		}
		
	}	
	$var_alta2 ="    <td valign='middle' bgcolor='$color_alta'>$alta</td>";


echo "  <tr class='$class_alta'>";
echo "    <td valign='middle' bgcolor='#e9e9e9'>$info[2]</td>";
echo "    <td valign='middle' bgcolor=''>$info[1]</td>";
echo "    <td valign='middle' bgcolor='#e9e9e9'>$info[0]</td>";

$f = split ('-',$info[6]);
echo "    <td valign='middle' bgcolor=''>$f[2]-$f[1]-$f[0]</td>";	
echo "    <td valign='middle' bgcolor='#e9e9e9'>$info[4]-$info[5]</td>";
echo "    <td valign='middle' bgcolor=''>$info[7]</td>";

echo $var_alta2;


echo "    <td>";
echo "      <CENTER><input type='submit' class='boton2' name='btn_mod' id='btn_mod' value='Modificar $boton-$info[0]' /></CENTER>";
//echo "      <input type='submit' class='boton2' name='btn_del' id='btn_del' value='Eliminar $boton-$info[0]' />";
echo "    </td>";
echo "  </tr>";
echo "  <tr class='Texto4'>";
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
echo "  <input type='submit' class='boton' name='btn_imprime' id='btn_imprime' value='Imprimir Informe' onclick='window.open(\"reg_paciente2.php\",\"_blank\")'/>";
echo "";
echo "<p>&nbsp;</p>";
echo "</body>";
echo "</form>";
echo "</html>";
?>