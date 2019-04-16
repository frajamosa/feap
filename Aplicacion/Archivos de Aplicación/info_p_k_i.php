<?php


session_start();
include('conexion.php');

	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin título</title>";
echo "<link href='Estilos.css' rel='stylesheet' type='text/css' />";
echo "</head>";
echo "<form action='$PHP_SELF' method='post'>";





switch($_SESSION['tipo_info'])		
{ 
	case "paciente":
		$titulo = "PACIENTE";
		$boton = "Paciente";
		//******************************************************************************Busca Pacientes
		$sql_paciente = "select * from paciente order by apellido_pac";
		$resultado = mysql_query($sql_paciente,$link);
		//**********************************************************************************************
	break;
	case "kinesiologo":
		$titulo = "KINESIOLOGO";
		$boton = "Kinesiologo";		
		//******************************************************************************Busca Kinesiologo
		$sql_kinesiologo = "select * from kinesiologo order by apellido_k";
		$resultado = mysql_query($sql_kinesiologo,$link);
		//**********************************************************************************************
	break;
	case "interno":
		$titulo = "INTERNISTA";
		$boton = "Internista";
		//******************************************************************************Busca Interno
		$sql_interno = "select * from interno order by apellido_int";
		$resultado = mysql_query($sql_interno,$link);
		//**********************************************************************************************
	break;
}






echo "<body>";

echo "<span class='Texto3'>$titulo";	
echo "</span>";
echo "<hr />";
echo "<p>&nbsp;</p>";
echo "<table border='0' width='100%' >";
echo "  <tr>";
echo "    <td colspan='5'><span class='Texto4'>$titulo";
echo "    </span>      <hr /></td>";
echo "  </tr>";
echo "  <tr class='Texto3'>";
echo "    <td>NOMBRE</td>";
echo "    <td>APELLIDO</td>";
echo "    <td>RUT</td>";
if ($_SESSION['tipo_info']== "paciente")
{
echo "    <td>FECHA DE NACIMIENTO</td>";
}
else
{
echo "    <td>CONTACTO</td>";		
}
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
echo "    <td valign='middle'>$info[0]</td>";
if ($_SESSION['tipo_info']=="paciente")
{
$f = split ('-',$info[6]);
echo "    <td valign='middle'>$f[2]-$f[1]-$f[0]</td>";	
}
else
{
echo "    <td valign='middle'>$info[3]</td>";
}
echo "    <td>";
echo "      <input type='submit' name='btn_mod' id='btn_mod' value='Modificar $boton-$info[0]' />";
echo "      <br />";
echo "      <input type='submit' name='btn_del' id='btn_del' value='Eliminar $boton-$info[0]' />";
echo "    </td>";
echo "  </tr>";
echo "  <tr class='Texto4'>";
echo "    <td colspan='5'><hr /></td>";
echo "  </tr>";	
}


if($btn_mod)
{

switch($_SESSION['tipo_info'])		
{ 
	case "paciente":
			$f3 = split ('-',$btn_mod);
			$_SESSION['id_pac'] = $f3[1]."-".$f3[2];
			$_SESSION['usr']= "mod";
			$_SESSION['usr_info']= "mod";
			echo "	<meta http-equiv='refresh' content='0;URL=pacientes_marcos.php'>";
	break;
	case "kinesiologo":
			$f3 = split ('-',$btn_mod);
			$_SESSION['id_kine'] = $f3[1]."-".$f3[2];
			$_SESSION['usr']= "mod";
			$_SESSION['usr_info']= "mod";
			echo "	<meta http-equiv='refresh' content='0;URL=kinesiologos_marcos.php'>";
	break;
	case "interno":
			$f3 = split ('-',$btn_mod);
			$_SESSION['id_inter'] = $f3[1]."-".$f3[2];
			$_SESSION['usr']= "mod";
			$_SESSION['usr_info']= "mod";
			echo "	<meta http-equiv='refresh' content='0;URL=internistas_marcos.php'>";
	break;
}
}


echo "</table>";
echo "";
echo "  <br />";
echo "  <input type='submit' name='btn_imprime' id='btn_imprime' value='Imprimir Informe' />";
echo "";
echo "<p>&nbsp;</p>";
echo "</body>";
echo "</form>";
echo "</html>";
?>