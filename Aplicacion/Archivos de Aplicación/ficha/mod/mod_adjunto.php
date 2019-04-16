<?php
session_start();
include('../../conexion.php');

echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin título</title>";
echo "<link href='../../Estilos.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>";
echo "<!--";
echo "body {";
echo "	background-image: url(../../Images/FEAP-Fondo.jpg);";
echo "	background-repeat: no-repeat;";
echo "	background-position:center;";
echo "}";
echo "-->";
echo "</style></head>";

if ($lst_examen)
{
 	$info_rex = split('-',$lst_examen);
	$_SESSION['id_aa_ex'] = $info_rex[0]; //--> Entrega id_aa_examen
	$_SESSION['tipo_rex'] = $info_rex[1];
	echo "existe";
	echo "<br>Id_aa_ex: ".$_SESSION['id_aa_ex'];
	echo "<br>Id_examen: ".$_SESSION['tipo_rex'];
//	echo $lst_examen;

	
}                        
$id_aa_ex = $_SESSION['id_aa_ex'];
$tipo_ex = $_SESSION['tipo_rex'];


echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data'>";
//******************************************************************************Lista Examen
$sql_aa_ex_pac = "select desc_examen, aa_examen.id_aa_examen, tipo_examen.id_examen from aa_examen, tipo_examen where id_ana_act = '$ana_actual' and tipo_examen.id_examen = aa_examen.id_examen order by tipo_examen.id_examen";
$r_aa_ex_pac = mysql_query($sql_aa_ex_pac,$link);
//echo "Lista Examen: ".$sql_aa_ex_pac."<br>";
//*********************************************************************************

//******************************************************************************Adjuntar Resultado Examen
if ($btn_add_rex3)
 { 	
  	$sql_id_rex = "select max(id_resultado_ex) from resultado_examen";
	$r_id_rex = mysql_query($sql_id_rex,$link);
	$info_aa_rex = mysql_fetch_array ($r_id_rex);
	$id_aa_rex = $info_aa_rex[0]+1;
  
	$extension = explode(".",$file_adjunto_name);
	$file_adjunto_name = $id_aa_ex."-".$id_aa_rex."-".$tipo_ex.".".$extension[1];
	$sql_aa_rex_adj = "insert into resultado_examen values ('0','$file_adjunto_name','$txt_obs2','$id_aa_ex')";
	
 
//	 echo $file_adjunto_name."<br>";

	if($file_adjunto_size < 30000000)
	{
		if(!copy($file_adjunto, "../../Examenes/".$file_adjunto_name))
		{
			echo "error al copiar el archivo";
		}
		else
		{
			echo "archivo subido con exito";
			$r_aa_rex_adj = mysql_query($sql_aa_rex_adj,$link);
		}
	}
	else
	{
		echo "el archivo supera los 30kb";
	}
 }
// echo "Error resultad_examen: ".$error_ex =mysql_errno();
// echo $sql_aa_rex_adj."<br>";
// echo $file_adjunto_name."<br>";
//*********************************************************************************
//******************************************************************************Lista Resultado Examen
$sql_aa_rex_pac = "select * from resultado_examen where id_aa_examen = '$id_aa_ex' ";
$r_aa_rex_pac = mysql_query($sql_aa_rex_pac,$link);
//echo "Lista R. Examen: ".$sql_aa_rex_pac."<br>";
//*********************************************************************************

echo "<body>";
echo "<table border='0'>";
echo "  <tr>";
echo "    <td colspan='4' class='Texto3'>AGREGAR / MODIFICAR RESULTADOS";
echo "    <hr /></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td class='Texto4'>EXAMEN</td>";
echo "    <td>&nbsp;</td>";
echo "    <td class='Texto4'>RESULTADO</td>";
echo "    <td>&nbsp;</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td rowspan='5' valign='top'>";
echo "      <select name='lst_examen' size='7' id='lst_examen' onclick='this.form.submit()'>";
				while ($lista_examen_pac = mysql_fetch_array($r_aa_ex_pac))
				{
				 $value_lst = $lista_examen_pac[1]."-".$lista_examen_pac[2];
					echo "<option value='$value_lst'>$lista_examen_pac[0]</option> ";	
				}
echo "      </select>";

echo "    </td>";
echo "    <td rowspan='5'>&gt;&gt;&gt;</td>";
echo "    <td rowspan='5' valign='top'>";
echo "      <select name='lst_resultado' size='7' id='lst_resultado'>";
				while ($lista_r_examen_pac = mysql_fetch_array($r_aa_rex_pac))
				{
				 $txt_obs_ext= substr("$lista_r_examen_pac[2]",0,30)."...";
					echo "<option value='$lista_r_examen_pac[0]'>$lista_r_examen_pac[1] - $txt_obs_ext</option> ";	
				}
echo "      </select>";
echo "    </td>";
echo "    <td>&nbsp;</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td><input type='submit' name='btn_add_rex2' id='btn_add_rex2' value='Agregar mas Resultados' /></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td>&nbsp;</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td><input type='submit' name='btn_mod_rex2' id='btn_mod_rex2' value='Modificar / Eliminar Resultado' /></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td>&nbsp;</td>";
echo "  </tr>";
echo "</table>";
echo "<p>&nbsp;</p>";

if ($btn_add_rex2)
{
echo "<table border='0'>";
echo "  <tr>";
echo "    <td colspan='3' class='Texto3'>AGREGAR MAS RESULTADOS";
echo "    <hr /></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td class='Texto4'>Adjuntar Archivo</td>";
echo "    <td>";
echo "      <input type='file' name='file_adjunto' id='file_adjunto' />";
echo "    </td>";
echo "    <td rowspan='2'>";
echo "        <input type='submit' name='btn_add_rex3' id='btn_add_rex3' value='Agregar Resultado' />";
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td class='Texto4'>Observación</td>";
echo "    <td>";
echo "      <textarea name='txt_obs2' cols='100' rows='3' class='Texto2' id='txt_obs2'></textarea>";
echo "    </td>";
echo "  </tr>";
echo "</table>";	
}




if ($btn_mod_rex2)
{
 $_SESSION['nom_rex'] = $lst_resultado;
 echo "<br>Nolmbre Resultado: ".$_SESSION['nom_rex'];
 
}

if ($btn_mod_rex2 or $btn_ver or $btn_mod or $btn_up or $btn_del or $btn_mod_ok)
{
$id_resultado = $_SESSION['nom_rex'];
 //******************************************************************************Busca Archivo Resultado
$sql_fichero_rex = "select archivo_ex, obs_examen from resultado_examen where id_resultado_ex = '$id_resultado' ";
$r_fichero_rex = mysql_query($sql_fichero_rex,$link);
$fichero_rex= mysql_fetch_array($r_fichero_rex);
$nombre_fichero= $fichero_rex[0];
$obs_fichero = $fichero_rex[1];
echo "<br>Nolmbre Resultado: ".$fichero_rex[0];
echo "<br>Consulta: ".$sql_fichero_rex;
//*********************************************************************************
if ($btn_del)
{
 //******************************************************************************Elimina Archivo Resultado
$sql_del_fichero_rex = "delete from resultado_examen where id_resultado_ex = '$id_resultado' ";
$r_del_fichero_rex = mysql_query($sql_del_fichero_rex,$link);
//*********************************************************************************	
echo "<meta http-equiv='refresh' content='0;URL=mod_adjunto.php'>";
}

if ($btn_ver)
{
 	$path_archivo = "http://localhost/Examenes/".$fichero_rex[0];
 	fopen("$path_archivo","w");
	$x = fopen($path_archivo,'r');
	echo "Abre Archivo: ".$path_archivo;
	 echo "<br>fopen: ".$x;
}

if ($btn_mod or $btn_up or $btn_mod_ok)
{

 if ($btn_mod_ok)
 {
    $sql_act_adj = "update resultado_examen set obs_examen='$txt_obs3' where id_resultado_ex = '$id_resultado'";
	mysql_query($sql_act_adj,$link);
 }
if($btn_up) //--> Sube nuevo archivo con mismo nombre de fichero antiguo
{
	
	
 	$sql_act_adj = "update resultado_examen set archivo_ex='$nombre_fichero' where id_resultado_ex = '$id_resultado'";
	 //echo $nombre_fichero."<br>";
	 //echo $file_adjunto2_name."<br>";
	 //echo $file_adjunto2_size."<br>";


		if(!copy($file_adjunto2, "../../Examenes/".$nombre_fichero))
		{
			echo "error al copiar el archivo su tama�o debe ser menor a 2Mb";
		}
		else
		{
			echo "archivo subido con exito";
			$r_act_adj = mysql_query($sql_act_adj,$link);
		}
	
}
 //******************************************************************************Modifica Archivo Resultado
// $sql_mod_fichero_rex = "update resultado_examen set archivo_ex =";
// $r_mod_fichero_rex = mysql_query($sql_mod_fichero_rex,$link);
// $fichero_rex= mysql_fetch_array($r_mod_fichero_rex);
// echo "<br>Nolmbre Resultado: ".$fichero_rex[0];
// echo "<br>Consulta: ".$sql_mod_fichero_rex;

//*********************************************************************************
echo "<table border='0'>";
echo "  <tr>";
echo "    <td class='Texto4'>Seleccione Archivo</td>";
echo "    <td>";
echo "      <input type='file' name='file_adjunto2'/>";
echo "        <input type='submit' name='btn_up' value='Actualizar Archivo' />";
echo "    </td>";
echo "  </tr>";
echo "</table>";

}
echo "<table border='0'>";
echo "  <tr>";
echo "    <td colspan='3' class='Texto3'>MODIFICAR RESULTADO";
echo "    <hr /></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td class='Texto4'>Archivo Adjunto</td>";
echo "    <td>";
echo "      <p class='ALERTA'>$fichero_rex[0]";
echo "        <input type='submit' name='btn_ver' id='btn_ver' value='Ver' />";
echo "        <input type='submit' name='btn_mod' id='btn_mod' value='Cambiar' />";
echo "        <input type='submit' name='btn_del' id='btn_del' value='Eliminar' />";
echo "      </p>";
echo "    </td>";
echo "    <td rowspan='2'>";
echo "      <input type='submit' name='btn_mod_ok' id='btn_mod_ok' value='Guardar Modificaciones' />";
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td class='Texto4'>Observación</td>";
echo "    <td>";
echo "      <textarea name='txt_obs3' cols='100' rows='3' class='Texto2' id='txt_obs3'>$obs_fichero</textarea>";
echo "    </td>";
echo "  </tr>";
echo "</table>";	
}

echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";
echo "</body>";
echo "</form>";
echo "</html>";
?>