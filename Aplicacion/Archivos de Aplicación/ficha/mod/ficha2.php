

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="../../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(../../Images/FEAP-Fondo.jpg);
	background-repeat: no-repeat;
	background-position:center;
}
-->
</style>
<link href="../../Estilos.css" rel="stylesheet" type="text/css" />


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
	include('../../conexion.php');
	
	
echo "<body>";

echo "<form action='$PHP_SELF' method='post'>";

echo "<table width='100%' border='0'>";
echo "  <tr>";
echo "    <td colspan='2'>";
echo "      <p class='Texto'>Ficha Paciente</p>";

$paciente_rut 	= $_SESSION['id_pac']	;
$id_ficha 		= $_SESSION['id_ficha'];
$id_eva_kine 	= $_SESSION['id_eva_kine'];
$id_dolor = $_SESSION['id_dolor'];
$id_palpacion = $_SESSION['id_palpa'];
$id_inspeccion = $_SESSION['id_insp'];

echo "        </p>";

//----------------------------------------------------------------------------------------AGREGAR-------
if($btn_guardar)
{ 
$sql_add_ek_pac = "update eva_kine set obs_ingreso_ek = '$txt_observaciones_gen' where id_ek = '$id_eva_kine'";
mysql_query($sql_add_ek_pac,$link);

$sql_add_dol_pac = "update dolor_ek set nivel_dol_ek = '$list_dolor', aparicion_dol_ek = '$txt_aparicion', caracteristicas_dol_ek = '$txt_caracteristica' where id_dol = '$id_dolor'";
mysql_query($sql_add_dol_pac,$link);
$error_dol =mysql_errno();


$sql_add_pal_pac = " update palpacion_ek set sensibilidad_pal_ek = '$txt_sensibilidad', temperatura_pal_ek= $list_temperatura, inflamacion_pal_ek='$txt_inflamacion' where id_pal= '$id_palpacion'"; 
mysql_query($sql_add_pal_pac,$link);
$error_pal =mysql_errno();
//echo $sql_add_pal_pac;
$sql_add_insp_pac = "update inspeccion_ek set piel_insp_ek='$txt_piel', volumen_insp_ek='$txt_volumen', cicatriz_insp_ek='$txt_cicatriz', deformidad_insp_ek='$txt_deformidad', obs_insp_ek='$txt_observaciones' where id_insp = '$id_inspeccion'";
mysql_query($sql_add_insp_pac,$link);
$error_insp =mysql_errno();
//echo $sql_add_insp_pac;

	switch($error_dol)		//Error Dolor
	{ 
	 	case 0:
//	 	echo "ok";
	 	break;
		case 1062:
		echo "<p><span class='ALERTA'>DOLOR YA REGISTRADO EN ESTE PACIENTE</span></p>";
		break;
		case 1264:
		echo "<p><span class='ALERTA'>1264</span></p>";
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


//****************************************************************************************************************
//************************************************************************************************Info. Pacientes   
//******************************************************************************Busca Paciente
$sql_paciente = "select * from paciente where rut_pac = '$paciente_rut'";
$r_paciente = mysql_query($sql_paciente,$link);
$info_paciente = mysql_fetch_array ($r_paciente);
$f = split ('-',$info_paciente[6]);

//**********************************************************************************************
echo "    <table width='100%' border='0' bgcolor='#638cb5'>";
echo "      <tr class='Texto3' 	bgcolor='#CC3333' b>";
echo "        <td>NOMBRE</td>";
echo "        <td>APELLIDO</td>";
echo "        <td>RUT</td>";
echo "        <td>DIRECCION</td>";
echo "        <td>TELEFONO</td>";
echo "        <td>F. NECIMIENTO</td>";
echo "        </tr>";
echo "      <tr class='Texto3'>";
echo "        <td>$info_paciente[1]</td>";
echo "        <td>$info_paciente[2]</td>";
echo "        <td>$info_paciente[0]</td>";
echo "        <td>$info_paciente[3]</td>";
echo "        <td>$info_paciente[4] - $info_paciente[5]</td>";
echo "        <td>$f[2]-$f[1]-$f[0]</td>";
echo "        </tr>";
echo "    </table><hr>";



//****************************************************************************************************************

//--------------------------------------------------Busca info


$sql_eva_kine = "select * from eva_kine where id_ek = '$id_eva_kine'";
$r_sql_eva_kine = mysql_query ($sql_eva_kine, $link);
$info_eva_kine = mysql_fetch_array ($r_sql_eva_kine);

$id_palpacion 	= $info_eva_kine[1];
$id_inspeccion 	= $info_eva_kine[2];
$id_dolor	 	= $info_eva_kine[3];

$_SESSION['id_dolor']= $id_dolor;
$_SESSION['id_palpa']=$id_palpacion;
$_SESSION['id_insp']=$id_inspeccion;


//echo $sql_eva_kine;
//echo $info_eva_kine[3];

$sql_dolor = "select * from dolor_ek where id_dol = '$id_dolor'";
$r_sql_dolor = mysql_query ($sql_dolor, $link);
$info_dolor = mysql_fetch_array ($r_sql_dolor);

$sql_palpacion = "select * from palpacion_ek where id_pal = '$id_palpacion'";
$r_sql_palpacion = mysql_query ($sql_palpacion, $link);
$info_palpacion = mysql_fetch_array ($r_sql_palpacion);

$sql_inspeccion = "select * from inspeccion_ek where id_insp = '$id_inspeccion'";
$r_sql_inspeccion = mysql_query ($sql_inspeccion, $link);
$info_inspeccion = mysql_fetch_array ($r_sql_inspeccion);

$sql_eva_kine = "select * from eva_kine where id_ek = '$id_eva_kine'";
$r_sql_eva_kine = mysql_query ($sql_eva_kine, $link);
$info_eva_kine = mysql_fetch_array ($r_sql_eva_kine);





//  echo $sql_dolor;
//  echo $info_dolor[2];
//  echo $sql_palpacion;
//  echo $info_palpacion[2];
//  echo $sql_inspeccion;
//  echo $info_inspeccion[2];
//  ECHO $sql_eva_kine;

//    echo $sql_add_dol_pac."<br>";
//    echo $sql_add_pal_pac."<br>";
//    echo $sql_add_insp_pac."<br>";
//    echo $sql_add_e_kine_pac."<br>";



//------------------------------------------------------------------------------------FIN AGREGAR-------

echo "  </tr>";
echo "</table>";
echo "<div id='eva_kine' class='CollapsiblePanel'>";
echo "  <div class='CollapsiblePanelTab' tabindex='0'>Evaluación Kinesiológica</div>";
echo "  <div class='CollapsiblePanelContent'>";
echo "    <table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='2' class='Texto3' bgcolor='#638cb5'>DOLOR";
echo "        <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td width='10%' class='Texto3'>Nivel de Dolor</td>";
echo "        <td width='90%'>";
echo "          <select name='list_dolor' id='list_dolor'>";

if ($info_dolor[0]<>NULL)
{
echo "            <option value='$info_dolor[1]' selected='selected'>$info_dolor[1]</option>";
}
else
{
echo "            <option value='$list_dolor' selected='selected'>$list_dolor</option>";	
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
echo "          <input type='text' name='txt_aparicion' id='txt_aparicion' value='$info_dolor[2]'/>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Caracteristicas</td>";
echo "        <td>";
echo "          <textarea name='txt_caracteristica' id='txt_caracteristica' cols='100' rows='3'>$info_dolor[3]</textarea>";
echo "        </td>";
echo "      </tr>";
echo "    </table><br>";



echo "      <table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='2' class='Texto3'  bgcolor='#638cb5'>PALPACION";
echo "          <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td width='10%' class='Texto3'>Temperatura</td>";
echo "        <td width='90%'>";
echo "          <p class='Texto3'>";
echo "            <select name='list_temperatura' id='list_temperatura'>";

echo "              <option value='$list_temperatura'>$list_temperatura</option>";

if ($info_palpacion[0]<>NULL)
{
	echo "              <option value='$info_palpacion[2]'>$info_palpacion[2]</option>";
}


echo "              <option value='22'>22</option>";
echo "              <option value='22.5'>22.5</option>";
echo "              <option value='23'>23</option>";
echo "              <option value='23.5'>23.5</option>";
echo "              <option value='24'>24</option>";
echo "              <option value='24.5'>24.5</option>";
echo "              <option value='25'>25</option>";
echo "              <option value='25.5'>25.5</option>";
echo "              <option value='26'>26</option>";
echo "              <option value='26.5'>26.5</option>";
echo "              <option value='27'>27</option>";
echo "              <option value='27.5'>27.5</option>";
echo "              <option value='28'>28</option>";
echo "              <option value='28.5'>28.5</option>";
echo "              <option value='29'>29</option>";
echo "              <option value='29.5'>29.5</option>";
echo "              <option value='30'>30</option>";
echo "              <option value='30.5'>30.5</option>";
echo "              <option value='31'>31</option>";
echo "              <option value='31.5'>31.5</option>";
echo "              <option value='32'>32</option>";
echo "              <option value='32.5'>32.5</option>";
echo "              <option value='33'>33</option>";
echo "              <option value='33.5'>33.5</option>";
echo "              <option value='34'>34</option>";
echo "              <option value='34.5'>34.5</option>";
echo "              <option value='35'>35</option>";
echo "              <option value='35.5'>35.5</option>";
echo "              <option value='36'>36</option>";
echo "              <option value='36.5'>36.5</option>";
echo "              <option value='37'>37</option>";
echo "              <option value='37.5'>37.5</option>";
echo "              <option value='38'>38</option>";
echo "              <option value='38.5'>38.5</option>";
echo "              <option value='39'>39</option>";
echo "              <option value='39.5'>39.5</option>";
echo "              <option value='40'>40</option>";
echo "              <option value='40.5'>40.5</option>";
echo "              <option value='41'>41</option>";
echo "              <option value='41.5'>41.5</option>";
echo "              <option value='42'>42</option>";
echo "              <option value='42.5'>42.5</option>";
echo "              <option value='43'>43</option>";
echo "              <option value='43.5'>43.5</option>";
echo "            </select>";
echo "            °C</p>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Sensibilidad</td>";
echo "        <td>";
echo "          <input type='text' name='txt_sensibilidad' id='txt_sensibilidad' value='$info_palpacion[1]' />";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Inflamación</td>";
echo "        <td>";
echo "          <textarea name='txt_inflamacion' id='txt_inflamacion' cols='100' rows='3'>$info_palpacion[3]</textarea>";
echo "        </td>";
echo "      </tr>";
echo "    </table>";
echo "        </table><br>";


echo "      <table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='2' class='Texto3'  bgcolor='#638cb5'>INSPECCION";
echo "        <hr /></td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td width='10%' class='Texto3'>Piel</td>";
echo "        <td width='90%'>";
echo "          <p class='Texto3'>";
echo "            <input type='text' name='txt_piel' id='txt_piel' size='30' value='$info_inspeccion[1]'/>";
echo "          </p>";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Volumen</td>";
echo "        <td>";
echo "          <input type='text' name='txt_volumen' id='txt_volumen' size='30' value='$info_inspeccion[2]'/>";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Cicatriz</td>";
echo "        <td>";
echo "          <input type='text' name='txt_cicatriz' id='txt_cicatriz' size='30' value='$info_inspeccion[3]'/>";
echo "       </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Deformidad</td>";
echo "        <td>";
echo "          <textarea name='txt_deformidad' id='txt_deformidad' cols='100' rows='3'>$info_inspeccion[4]</textarea>";
echo "        </td>";
echo "      </tr>";
echo "      <tr>";
echo "        <td class='Texto3'>Observaciones</td>";
echo "        <td>";
echo "          <textarea name='txt_observaciones' id='txt_observaciones' cols='100' rows='3'>$info_inspeccion[5]</textarea>";
echo "        </td>";
echo "      </tr>";
echo "    </table><br>";
echo "          <table width='100%' border='0' bgcolor='#99CCFF'>";
echo "      <tr>";
echo "        <td colspan='2' class='Texto3'  bgcolor='#638cb5'>OBSERVACIONES GENERALES";
echo "          <hr /></td>";
echo "      </tr>";
echo "      <tr >";
echo "        <td width='10%' class='Texto3'>Observaciones</td>";
echo "        <td width='90%'>";
echo "          <textarea name='txt_observaciones_gen' id='txt_observaciones_gen' cols='100' rows='3'>$info_eva_kine[4]</textarea>";
echo "       </td>";
echo "      </tr>";
echo "    </table><br>";

echo "          <table width='100%' border='0'>";
echo "      <tr>";
echo "      <td colspan='2' align='center'>";

echo "          <input type='submit' class='boton2' name='btn_guardar' id='btn_guardar' value='Guardar E. Kinesiologica'/>";
echo "        </p>";
echo "        <p>&nbsp;</p></td>";
echo "      </tr>";
echo "    </table>";
echo "  </div>";
echo "</div>";
echo "</form>";

?>




<script type="text/javascript">
<!--
var CollapsiblePanel3 = new Spry.Widget.CollapsiblePanel("eva_kine");
//-->
</script>
</body>
</html>

