

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(Images/FEAP-Fondo.jpg);
	background-repeat: no-repeat;
	background-position:center;
}
-->
</style>
<link href="Estilos.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>



</head>


<?php 

	session_start();
	include('conexion.php');
	$ficha = $_SESSION['ficha'];
	
	
echo "<body>";

echo "<form action='$PHP_SELF' method='post'>";

echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2'>";
echo "      <p class='Texto'>Ficha Paciente</p>";
$paciente_rut = $_SESSION['id_pac'];
$id_ficha = $_SESSION['id_ficha'];
echo "        </p>";

//****************************************************************************************************************
//************************************************************************************************Info. Pacientes   
//******************************************************************************Busca Paciente
$sql_paciente = "select * from paciente where rut_pac = '$paciente_rut'";
$r_paciente = mysql_query($sql_paciente,$link);
$info_paciente = mysql_fetch_array ($r_paciente);
$f = split ('-',$info_paciente[6]);

//**********************************************************************************************
echo "    <table width='100%' border='0'>";
echo "      <tr class='Texto3'>";
echo "        <td>NOMBRE</td>";
echo "        <td>APELLIDO</td>";
echo "        <td>RUT</td>";
echo "        <td>DIRECCION</td>";
echo "        <td>TELEFONO</td>";
echo "        <td>F. NECIMIENTO</td>";
echo "        </tr>";
echo "      <tr class='Texto2'>";
echo "        <td>$info_paciente[1]</td>";
echo "        <td>$info_paciente[2]</td>";
echo "        <td>$info_paciente[0]</td>";
echo "        <td>$info_paciente[3]</td>";
echo "        <td>$info_paciente[4] - $info_paciente[5]</td>";
echo "        <td>$f[2]-$f[1]-$f[0]</td>";
echo "        </tr>";
echo "    </table>";


//****************************************************************************************************************


$id_eva_kine = $_SESSION['id_eva_kine'];
//------------------------------------------------------------------------------------ID DOLOR-------
if ($_SESSION['usr']=="add")
{
$sql_id_dolor="select max(id_dol) from dolor_ek";
$r_id_dolor = mysql_query($sql_id_dolor,$link);
$info_id_dolor = mysql_fetch_array ($r_id_dolor);

if ($info_id_dolor[0] == 'NULL')
{
	$nuevo_id_dolor="1";
}	
else
{
	$nuevo_id_dolor=$info_id_dolor[0]+1;
}

 $_SESSION['id_dolor'] = $nuevo_id_dolor;
 $id_dolor = $_SESSION['id_dolor'];

// echo $sql_id_dolor."<br>";
// echo $nuevo_id_dolor."<br>";
// echo $info_id_dolor[0]."<br>";
//-------------------------------------------------------------------------------FIN ID DOLOR---------
//------------------------------------------------------------------------------------ID PALPACION-------

	$sql_id_palpa="select max(id_pal) from palpacion_ek";
	$r_id_palpa = mysql_query($sql_id_palpa,$link);
	$info_id_palpa = mysql_fetch_array ($r_id_palpa);
	
	if ($info_id_palpa[0] == 'NULL')
	{
	$nuevo_id_palpa="1";
	}
	else
	{
	$nuevo_id_palpa=$info_id_palpa[0]+1;
	}


$_SESSION['id_palpa'] = $nuevo_id_palpa;
$id_palpa = $_SESSION['id_palpa'];

// echo $sql_id_palpa."<br>";
// echo $nuevo_id_palpa."<br>";
// echo $info_id_palpa[0]."<br>";
//-------------------------------------------------------------------------------FIN PALPACION---------
//------------------------------------------------------------------------------------ID INSPECCION-------

	$sql_id_insp="select max(id_insp) from inspeccion_ek";
	$r_id_insp = mysql_query($sql_id_insp,$link);
	$info_id_insp = mysql_fetch_array ($r_id_insp);
	
	if ($info_id_insp[0] == 'NULL')
	{
		$nuevo_id_insp="1";
	}
	else
	{
		$nuevo_id_insp=$info_id_insp[0]+1;
	}

$_SESSION['id_insp'] = $nuevo_id_insp;
$id_insp = $_SESSION['id_insp'];
}
// echo $sql_id_insp."<br>";
// echo $nuevo_id_insp."<br>";
// echo $info_id_insp[0]."<br>";
//-------------------------------------------------------------------------------FIN INSPECCION---------  
else
{
 if(!$btn_guardar)
 {
	

$sql_eva_kine = "select * from eva_kine where id_ek = (select id_ek from ficha where id_ficha='$id_ficha')";
$r_eva_kine = mysql_query($sql_eva_kine,$link);
$info_eva_kine = mysql_fetch_array($r_eva_kine);

		$id_dolor = $info_eva_kine[3];
		$id_palpa = $info_eva_kine[1];
		$id_insp  = $info_eva_kine[2];
		$id_eva_kine = $info_eva_kine[0];
		$txt_observaciones_gen = $info_eva_kine[4];


$sql_dolor_ek = "select * from dolor_ek where id_dol = '$id_dolor'";
$r_dolor_ek = mysql_query($sql_dolor_ek,$link);
$info_dolor_ek = mysql_fetch_array($r_dolor_ek);

		$list_dolor = $info_dolor_ek[1];
		$txt_aparicion = $info_dolor_ek[2];
		$txt_caracteristica = $info_dolor_ek[3];


$sql_palpa_ek = "select * from palpacion_ek where id_pal = '$id_palpa'";
$r_palpa_ek = mysql_query($sql_palpa_ek,$link);
$info_palpa_ek = mysql_fetch_array($r_palpa_ek);

		$txt_sensibilidad=$info_palpa_ek[1];
		$list_temperatura= $info_palpa_ek[2];
		$txt_inflamacion= $info_palpa_ek[3];


$sql_insp_ek = "select * from inspeccion_ek where id_insp = '$id_insp'";
$r_insp_ek = mysql_query($sql_insp_ek,$link);
$info_insp_ek = mysql_fetch_array($r_insp_ek);

		$txt_piel			= $info_insp_ek[1];
		$txt_volumen		= $info_insp_ek[2];
		$txt_cicatriz		= $info_insp_ek[3];
		$txt_deformidad		= $info_insp_ek[4];
		$txt_observaciones	= $info_insp_ek[5];


}


}


//----------------------------------------------------------------------------------------AGREGAR-------
if($btn_guardar)
{
 echo $_SESSION['usr'];
if ($_SESSION['usr']=="add")
{
$sql_add_dol_pac = "insert into dolor_ek values('$id_dolor','$list_dolor','$txt_aparicion','$txt_caracteristica')";
mysql_query($sql_add_dol_pac,$link);
$error_dol =mysql_errno();

$sql_add_pal_pac = "insert into palpacion_ek values('$id_palpa','$txt_sensibilidad','$list_temperatura','$txt_inflamacion')";
mysql_query($sql_add_pal_pac,$link);
$error_pal =mysql_errno();

$sql_add_insp_pac = "insert into inspeccion_ek values('$id_insp','$txt_piel','$txt_volumen','$txt_cicatriz','$txt_deformidad','$txt_observaciones')";
mysql_query($sql_add_insp_pac,$link);
$error_insp =mysql_errno();

$sql_add_e_kine_pac = "update eva_kine set 	id_pal='$id_palpa',
											id_insp='$id_insp',
											id_dol='$id_dolor',
											obs_ingreso_ek='$txt_observaciones_gen'
										where id_ek = '$id_eva_kine'";
mysql_query($sql_add_e_kine_pac,$link);
$error_ekine =mysql_errno();

	switch($error_dol)		//Error Dolor
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>DOLOR YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE EXAMEN</span></p>";
		break;
	}
		switch($error_pal)		//Error PALPACION
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>PALPACION YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE EXAMEN</span></p>";
		break;
	}
		switch($error_insp)		//Error INSPECCION
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>INSPECCION YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE EXAMEN</span></p>";
		break;
	}
		switch($error_ekine)		//Error E_KINE
	{ 
		case 1062:
		echo "<p><span class='ALERTA'>EKINE YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>SELECCIONE EXAMEN</span></p>";
		break;
	}
	
}
}
if ($_SESSION['usr']=="mod")
{
 echo "modificacion";
$sql_add_dol_pac = "update dolor_ek set nivel_dol_ek='$list_dolor',
										aparicion_dol_ek='$txt_aparicion',
										caracteristicas_dol_ek='$txt_caracteristica'
									where id_dol = '$id_dolor'";
mysql_query($sql_add_dol_pac,$link);
$error_dol =mysql_errno();

$sql_add_pal_pac = "update palpacion_ek set sensibilidad_pal_ek='$txt_sensibilidad',
											temperatura_pal_ek='$list_temperatura',
											inflamacion_pal_ek='$txt_inflamacion' 
										where id_pal='$id_palpa'";
mysql_query($sql_add_pal_pac,$link);
$error_pal =mysql_errno();

$sql_add_insp_pac = "update inspeccion_ek set piel_insp_ek='$txt_piel',
											  volumen_insp_ek='$txt_volumen',
											  cicatriz_insp_ek='$txt_cicatriz',
											  deformidad_insp_ek='$txt_deformidad',
											  obs_insp_ek='$txt_observaciones' 
										  where id_insp='$id_insp'";
mysql_query($sql_add_insp_pac,$link);
$error_insp =mysql_errno();	
}
//   echo $sql_add_dol_pac."<br>";
//   echo $sql_add_pal_pac."<br>";
//   echo $sql_add_insp_pac."<br>";
//   echo $sql_add_e_kine_pac."<br>";


//------------------------------------------------------------------------------------FIN AGREGAR-------

echo "    <p class='Texto4'>&nbsp;</p></td>";
echo "  </tr>";
echo "</table>";
echo "<div id='eva_kine' class='CollapsiblePanel'>";
echo "  <div class='CollapsiblePanelTab' tabindex='0'>Evaluación Kinesiológica</div>";
echo "  <div class='CollapsiblePanelContent'>";
echo "    <table width='100%' border='0'>";
echo "      <tr>";
echo "        <td colspan='2' class='Texto3'>DOLOR";
echo "        <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td width='10%' class='Texto3'>Nivel de Dolor</td>";
echo "        <td width='90%'>";
echo "          <select name='list_dolor' id='list_dolor'>";
if($list_dolor or $_SESSION['usr']<>"add")
{
echo "            <option value='$list_dolor' selected='selected'>$list_dolor</option>";
}
else
{
echo "            <option value='0' selected='selected'>0</option>";	
}

echo "            <option value='1'>1</option>";
echo "            <option value='2'>2</option>";
echo "            <option value='3'>3</option>";
echo "            <option value='4'>4</option>";
echo "            <option value='5'>5</option>";
echo "            <option value='6'>6</option>";
echo "            <option value='7'>7</option>";
echo "            <option value='8'>8</option>";
echo "            <option value='9'>9</option>";
echo "            <option value='10'>10</option>";
echo "          </select>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Aparici�n</td>";
echo "        <td>";
echo "          <input type='text' name='txt_aparicion' id='txt_aparicion' value='$txt_aparicion'/>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Caracteristicas</td>";
echo "        <td>";
echo "          <textarea name='txt_caracteristica' id='txt_caracteristica' cols='100' rows='3'>$txt_caracteristica</textarea>";
echo "        </td>";
echo "      </tr>";
echo "    </table>";
echo "      <table width='100%' border='0'>";
echo "      <tr>";
echo "        <td colspan='2' class='Texto3'>PALPACION";
echo "          <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td width='10%' class='Texto3'>Temperatura</td>";
echo "        <td width='90%'>";
echo "          <p class='Texto3'>";
echo "            <select name='list_temperatura' id='list_temperatura'>";
if ($_SESSION['usr']<>"add")
{
echo "              <option value='$list_temperatura'>$list_temperatura</option>";
$select = "";
}
else
{
$select = "selected='selected'";
}
echo "              <option value='22'>22</option>";
echo "              <option value='22,5'>22,5</option>";
echo "              <option value='23'>23</option>";
echo "              <option value='23,5'>23,5</option>";
echo "              <option value='24'>24</option>";
echo "              <option value='24,5'>24,5</option>";
echo "              <option value='25'>25</option>";
echo "              <option value='25,5'>25,5</option>";
echo "              <option value='26'>26</option>";
echo "              <option value='26,5'>26,5</option>";
echo "              <option value='27'>27</option>";
echo "              <option value='27,5'>27,5</option>";
echo "              <option value='28'>28</option>";
echo "              <option value='28,5'>28,5</option>";
echo "              <option value='29'>29</option>";
echo "              <option value='29,5'>29,5</option>";
echo "              <option value='30'>30</option>";
echo "              <option value='30,5'>30,5</option>";
echo "              <option value='31'>31</option>";
echo "              <option value='31,5'>31,5</option>";
echo "              <option value='32'>32</option>";
echo "              <option value='32,5'>32,5</option>";
echo "              <option value='33'>33</option>";
echo "              <option value='33,5'>33,5</option>";
echo "              <option value='34'>34</option>";
echo "              <option value='34,5'>34,5</option>";
echo "              <option value='35'>35</option>";
echo "              <option value='35,5'>35,5</option>";
echo "              <option value='36'>36</option>";
echo "              <option value='36,5'>36,5</option>";
echo "              <option value='37' $select >37</option>";
echo "              <option value='37,5'>37,5</option>";
echo "              <option value='38'>38</option>";
echo "              <option value='38,5'>38,5</option>";
echo "              <option value='39'>39</option>";
echo "              <option value='39,5'>39,5</option>";
echo "              <option value='40'>40</option>";
echo "              <option value='40,5'>40,5</option>";
echo "              <option value='41'>41</option>";
echo "              <option value='41,5'>41,5</option>";
echo "              <option value='42'>42</option>";
echo "              <option value='42,5'>42,5</option>";
echo "              <option value='43'>43</option>";
echo "              <option value='43,5'>43,5</option>";
echo "            </select>";
echo "            °C</p>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Sensibilidad</td>";
echo "        <td>";
echo "          <input type='text' name='txt_sensibilidad' id='txt_sensibilidad' value='$txt_sensibilidad' />";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Inflamación</td>";
echo "        <td>";
echo "          <textarea name='txt_inflamacion' id='txt_inflamacion' cols='100' rows='3'>$txt_inflamacion</textarea>";
echo "        </td>";
echo "      </tr>";
echo "    </table>";
echo "        </table>";
echo "      <table width='100%' border='0'>";
echo "      <tr>";
echo "        <td colspan='2' class='Texto3'>INSPECCION";
echo "        <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td width='10%' class='Texto3'>Piel</td>";
echo "        <td width='90%'>";
echo "          <p class='Texto3'>";
echo "            <input type='text' name='txt_piel' id='txt_piel' size='30' value='$txt_piel'/>";
echo "          </p>";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Volumen</td>";
echo "        <td>";
echo "          <input type='text' name='txt_volumen' id='txt_volumen' size='30' value='$txt_volumen'/>";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Cicatriz</td>";
echo "        <td>";
echo "          <input type='text' name='txt_cicatriz' id='txt_cicatriz' size='30' value='$txt_cicatriz'/>";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Deformidad</td>";
echo "        <td>";
echo "          <textarea name='txt_deformidad' id='txt_deformidad' cols='100' rows='3'>$txt_deformidad</textarea>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Observaciones</td>";
echo "        <td>";
echo "          <textarea name='txt_observaciones' id='txt_observaciones' cols='100' rows='3'>$txt_observaciones</textarea>";
echo "        </td>";
echo "      </tr>";
echo "    </table>";
echo "          <table width='100%' border='0'>";
echo "      <tr>";
echo "        <td colspan='2' class='Texto3'>OBSERVACIONES GENERALES";
echo "          <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td width='10%' class='Texto3'>Observaciones</td>";
echo "        <td width='90%'>";
echo "          <textarea name='txt_observaciones_gen' id='txt_observaciones_gen' cols='100' rows='3'>$txt_observaciones_gen</textarea>";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "      <td colspan='2' align='center'>";
echo "        <p>&nbsp;</p>";
echo "        <p>";
echo "          <input type='submit' class='boton' name='btn_guardar' id='btn_guardar' value='Guardar E. Kinesiologica'/>";
echo "        </p>";
echo "        <p>&nbsp;</p></td>";
echo "      </tr>";
echo "    </table>";
echo "  </div>";
echo "</div>";
echo "</form>";


?>



<form id="form1" name="form1" method="post" action="">
  <table border="0" align="center">
    <tr>
      <td align="center"><input name="btn_a_remota" type="button" class="boton" id="btn_a_remota" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha.php');return document.MM_returnValue" value="A. REMOTA" /></td>
      <td align="center"><input name="btn_a_actual" type="submit" class="boton" id="btn_a_actual" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha7.php');return document.MM_returnValue" value="A. ACTUAL" /></td>
      <td align="center"><input name="btn_e_kine" type="submit" class="boton" id="btn_e_kine" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha2.php');return document.MM_returnValue" value="E. KINESIOLOGICA"kinesiologos_marcos.php","_self")"/></td>
      <td align="center"><input name="btn_e_postural" type="submit" class="boton" id="btn_e_postural" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha3.php');return document.MM_returnValue" value="E. POSTURAL" /></td>
    </tr>
    <tr>
      <td align="center"><input name="btn_r_articular" type="submit" class="boton" id="btn_r_articular" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha4.php');return document.MM_returnValue" value="R. ARTICULAR" /></td>
      <td align="center"><input name="btn_aco_musc" type="submit" class="boton" id="btn_aco_musc" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha4.php');return document.MM_returnValue" value="ACO. MUSCULAR" /></td>
      <td align="center"><input name="btn_fza_musc" type="submit" class="boton" id="btn_fza_musc" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha4.php');return document.MM_returnValue" value="FZA. MUSCULAR" /></td>
      <td align="center"><input name="btn_e_neuro" type="submit" class="boton" id="btn_e_neuro" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha5.php');return document.MM_returnValue" value="E. NEUROLOGICA" /></td>
    </tr>
    <tr>
      <td align="center"><input name="btn_p_func" type="submit" class="boton" id="btn_p_func" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha5.php');return document.MM_returnValue" value="P. FUNCIONALES" /></td>
      <td align="center"><input name="btn_tratamiento" type="submit" class="boton" id="btn_tratamiento" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha6.php');return document.MM_returnValue" value="TRATAMIENTO" /></td>
      <td align="center"><input name="btn_otros" type="submit" class="boton" id="btn_otros" onclick="MM_goToURL('parent.frames[\'mainFrame\']','ficha6.php');return document.MM_returnValue" value="OTROS" /></td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
  
  
</form>
<script type="text/javascript">
<!--
var CollapsiblePanel3 = new Spry.Widget.CollapsiblePanel("eva_kine");
//-->
</script>
</body>
</html>

