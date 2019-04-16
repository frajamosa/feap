<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";

session_start();
include('../conexion.php'); 

echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin tÃ­tulo</title>";
echo "<style type='text/css'>";
echo "<!--";
echo "body {";
echo "	background-image: url(Images/FEAP-Fondo.jpg);";
echo "	background-repeat: no-repeat;";
echo "	background-position:center;";
echo "}";
echo "-->";
echo "</style>";
echo "<link href='../Estilos.css' rel='stylesheet' type='text/css' />";
echo "</head>";

echo "<body>";
echo "<form action='$PHP_SELF' method='post'>";

//*******************************************************

function dv($r,&$d)
{
	$s=1;
	for($m=0;$r!=0;$r/=10)
	{
		$s=($s+$r%10*(9-$m++%6))%11;	
	}
	$d = chr($s?$s+47:75);
}

function rutOK ($rut,&$nuevo_rut)
{
 	$r1 = stripos($rut,'.');
	while ($r1 == True)
	{
		$r2 = substr($rut,0,$r1);
		$r3 = substr($rut,$r1+1,10);
		
		$rut = $r2.$r3;
		$r1 = stripos($rut,'.');
	}
	// - *********
		
	$x1 = stripos($rut,'-');

		$r2 = substr($rut,0,$largo - 2);
		$r3 = substr($rut,$x1+1,1);
	

// 	echo "<br>r2";	
//  	echo $r2;
//  	echo "<br>r3";
//  	echo $r3;
//  	echo "<br>";


	if ($x1 <> 0)
	{
	$rut = $r2.$r3;		
	}
	
	$largo = strlen($rut);
	
// 	echo $rut;
// 	echo "<br>";
// 	echo $largo;
	
	
	
	switch ($largo)
	{
		case 8:
			$r1 = substr($rut,0,1);
			$r2 = substr($rut,1,3);
			$r3 = substr($rut,4,3);
			$r4 = substr($rut,7,1);
			break;
		case 9:
			$r1 = substr($rut,0,2);
			$r2 = substr($rut,2,3);
			$r3 = substr($rut,5,3);
			$r4 = substr($rut,8,1);
			break;
		case 10:
			$r1 = substr($rut,0,3);
			$r2 = substr($rut,3,3);
			$r3 = substr($rut,6,3);
			$r4 = substr($rut,9,1);
			break;
		default:
			$r1 = "er";
			$r2 = "r";
			$r3 = "o";
			$r4 = "r";
			
	}
	
	$rut2 = $r1.$r2.$r3."-".$r4;
	$r = split('-',$rut2);
	dv($r[0],&$rx);

	if ($r4 == $rx)
	{
		$nuevo_rut = $r1.".".$r2.".".$r3."-".$r4;	
	}
	else
	{
		$nuevo_rut = "Error";
	}

}

//*******************************************************
//echo "$txt_rut";
//echo $id_pac;
$id_pac = $_SESSION['id_pac'];
//*****************************************************************************
//**************************Almacenamiento de Registros************************
//*****************************************************************************
$txt_fnac=$txt_a.$txt_m.$txt_d;
//echo $txt_fnac;


if ($btn_del_si)
{
	$sql_elimina = "delete from paciente where rut_pac = '$id_pac'";
	mysql_query ($sql_elimina,$link);
	echo $sql_elimina."<br>";
}	
	

//*****************************************************************************
	$txt_rut		= "";
	$txt_rut2		= "";
	$txt_apell 		= "";
	$txt_apellido 	= "";
	$txt_nmbr 		= "";
	$txt_nombre 	= "";	
	$txt_tel1		= "";
	$txt_telefono1	= "";
	$txt_tel2		= "";
	$txt_telefono2	= "";
	$txt_dir		= "";
	$txt_direccion	= "";
	$txt_fnac		= "";
	$txt_fnacimiento= "";	

//*****************************************************************************

//echo "$txt_rut";
//echo $id_pac;
$id_pac = $_SESSION['id_pac'];

//*****************************************************************************
//**************Registro / Modificación / Eliminación de paciente***************
//*****************************************************************************

	echo "<p class='Texto3'><span class='Texto'>Eliminar paciente</span><hr></p>";

//Consulta de pacientes
$sql_paciente = "select * from paciente";
$r_paciente = mysql_query($sql_paciente,$link);

echo "<p class='Texto3'><span class='Texto'>Seleccione paciente \t \t</span>";

//ListBox con pacientes Registrados
echo "<select name='lstbx_pacientes' onchange='this.form.submit()'>";


if ($_SESSION['usr']=='del') // Viene de Modificar paciente del informe **No Borrar**
 {
	$lstbx_pacientes = $_SESSION['id_pac'];
	echo "<option value='pac'>".$_SESSION['id_pac']."</option> ";	
 }
 else
 {
	echo "<option value='pac'>pacientes</option> ";	
 }


echo "<option>pacientes</option> ";	

	while ($t = mysql_fetch_array($r_paciente))
	{
		echo "<option value=$t[0]>$t[0] / $t[1] $t[2]</option> ";	
	}

echo "</select></p>";

	//Informcion paciente*******************************************************
	$_SESSION['id_pac']=$lstbx_pacientes;
	$sql_pac_info = "select * from paciente where rut_pac = '$lstbx_pacientes'";
	$r_paciente = mysql_query($sql_pac_info,$link);
	$info_pac = mysql_fetch_array ($r_paciente);
	
	//echo $sql_pac_info;

	$txt_rut2 = $info_pac[0];
	$txt_nombre = $info_pac[1];
	$txt_apellido = $info_pac[2];
	$txt_direccion = $info_pac[3];
	$txt_telefono1 = $info_pac[4];
	$txt_telefono2 = $info_pac[5];
	$f = split ('-',$info_pac[6]);
	
	//echo $info_pac[3];
	


//*****************************************************************************
//*****************************************************************************

echo "  <table border='0'>";


echo "    <tr>";
echo "      <td class='Texto3'>Nombre</td>";
echo "      <td class='Texto2'>$txt_nombre      ";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Apellido</td>";
echo "      <td class='Texto2'>$txt_apellido      ";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Rut</td>";
echo "      <td class='Texto2'>$txt_rut2      ";
echo "      </span></td>";	
if($txt_n_rut=="Error" and $btn_guardar)
{
	echo "      <td class='Texto2'> - Rut Erroneo</td>";	
}
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono1</td>";
echo "      <td class='Texto2'>$txt_telefono1   ";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Telefono2</td>";
echo "      <td class='Texto2'>$txt_telefono2      ";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Direccion</td>";
echo "      <td class='Texto2'>$txt_direccion      ";
echo "      </span></td>";
echo "    </tr>";

echo "    <tr>";
echo "      <td class='Texto3'>Fecha de Nacimiento</td>";
echo "      <td class='Texto2'>$f[2] - $f[1] - $f[0]";
echo "      </span></td>"; 
echo "    </tr>";
echo "  </table>";
echo "<br>";

	
	echo "<p class='Texto3'><span class='Texto'>Eliminar paciente</span></p>";
	echo "    <input type='submit' name='btn_del_si' value='Si'/>";
	echo "    <input type='submit' name='btn_del_no' value='No' onclick='window.open(\"../menu_marcos.php\",\"_parent\")'/>";
	echo "  </p>";
	echo "</form>";

	
echo "</body>";
echo "</html>";


?>