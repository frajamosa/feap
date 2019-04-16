<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";

session_start();
include('../conexion.php');
//$id_ficha = $_SESSION['id_ficha'];
$id_ficha = $_SESSION['id_ficha'];

echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Ficha No. $id_ficha  -  FEAP  -  Universidad San Sebastian</title>";
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



//info Ficha
	$sql_ficha = "select * from ficha  where id_ficha = '$id_ficha'";
	$r_ficha = mysql_query($sql_ficha,$link);
	$info_ficha = mysql_fetch_array($r_ficha);
	
//	echo $sql_ficha;
//info Paciente
	$sql_pac = "select * from paciente  where rut_pac = '$info_ficha[9]'";
	$r_pac = mysql_query($sql_pac,$link);
	$info_pac = mysql_fetch_array($r_pac);
	
	//echo $sql_pac;
//info_ar
	$sql_ar = "select * from ana_remota  where rut_pac = '$info_ficha[9]'";
	$r_ar = mysql_query($sql_ar,$link);
	$info_ar = mysql_fetch_array($r_ar);
	
	//echo $sql_ar;
//vicio	
	$sql_ar_v = "select * from ar_vicio where id_ana_remota = '$info_ar[0]'";
	$r_ar_v = mysql_query($sql_ar_v,$link);
	//$info_ar_v = mysql_fetch_array($r_ar_v);
	
	//echo $sql_ar_v;
//patologia
	$sql_ar_p = "select * from ar_patologia where id_ana_remota = '$info_ar[0]'";
	$r_ar_p = mysql_query($sql_ar_p,$link);
	//$info_ar_p = mysql_fetch_array($r_ar_p);
	
	//echo $sql_ar_p;
//cirugia
	$sql_ar_c = "select * from ar_cirugia where id_ana_remota = '$info_ar[0]'";
	$r_ar_c = mysql_query($sql_ar_c,$link);
	//$info_ar_c = mysql_fetch_array($r_ar_c);
	
//	echo $sql_ar_c;
	
//info Ana Actual
	$sql_aa = "select * from ana_actual  where id_ana_act = '$info_ficha[7]'";
	$r_aa = mysql_query($sql_aa,$link);
	$info_aa = mysql_fetch_array($r_aa);	
	
	//echo $sql_aa;
//cirugia_aa
	$sql_aa_c = "select * from aa_cirugia where id_ana_act = '$info_aa[0]'";
	$r_aa_c = mysql_query($sql_aa_c,$link);
	//$info_aa_c = mysql_fetch_aaray($r_aa_c);
	
	//echo $sql_aa_c;
//protesis_aa
	$sql_aa_p = "select * from aa_protesis where id_ana_act = '$info_aa[0]'";
	$r_aa_p = mysql_query($sql_aa_p,$link);
	//$info_aa_p = mysql_fetch_aaray($r_aa_p);
	
	//echo $sql_aa_c;
//examen
	$sql_aa_ex_pac = "select * from aa_examen where id_ana_act = '$info_aa[0]'";
	$r_aa_ex_pac = mysql_query($sql_aa_ex_pac,$link);	
		
	//echo $sql_aa_ex_pac;
	
//Eva Kine
	$sql_eva_kine = "select * from eva_kine where id_ek = '$info_ficha[8]'";
	$r_sql_eva_kine = mysql_query ($sql_eva_kine, $link);
	$info_eva_kine = mysql_fetch_array ($r_sql_eva_kine);

	$sql_dolor = "select * from dolor_ek where id_dol = '$info_eva_kine[3]'";
	$r_sql_dolor = mysql_query ($sql_dolor, $link);
	$info_dolor = mysql_fetch_array ($r_sql_dolor);
	
	$sql_palpacion = "select * from palpacion_ek where id_pal = '$info_eva_kine[1]'";
	$r_sql_palpacion = mysql_query ($sql_palpacion, $link);
	$info_palpacion = mysql_fetch_array ($r_sql_palpacion);
	
	$sql_inspeccion = "select * from inspeccion_ek where id_insp = '$info_eva_kine[2]'";
	$r_sql_inspeccion = mysql_query ($sql_inspeccion, $link);
	$info_insp = mysql_fetch_array ($r_sql_inspeccion);

//EVA POST
	$sql_add_eva_post_pac = "select * from eva_postural where id_eva_post = '$info_ficha[3]'";
	$r_eva_post = mysql_query($sql_add_eva_post_pac,$link);
	$info_eva_post = mysql_fetch_array($r_eva_post);

//RNG ARTICULAR
	$sql_id_articulacion = "select * from rng_articular where id_rngo_art = $info_ficha[2]";
	$r_id_articulacion = mysql_query($sql_id_articulacion,$link);
	
//ACO MUSC
	$sql_id_musculo = "select * from acor_muscular where id_aco_musc = '$info_ficha[11]'";
	$r_id_musculo = mysql_query($sql_id_musculo,$link);
	
//FZA MUSC
	$sql_id_fza = "select * from fza_muscular where id_fza_musc = '$info_ficha[3]'";
	$r_id_fza = mysql_query($sql_id_fza,$link);
	$info_fza = mysql_fetch_array($r_id_fza);
	
//MIOTOMA
	$sql_id_mio = "select * from en_miotoma where id_eva_neuro ='$info_ficha[4]'";
	$r_id_mio = mysql_query($sql_id_mio,$link);
	
//DERMATOMA
	$sql_id_derma = "select * from en_dermatoma where id_eva_neuro = '$info_ficha[4]'";
	$r_id_derma = mysql_query($sql_id_derma,$link);
	
//REFLEJO
	$sql_id_ref = "select * from en_reflejo where id_eva_neuro = '$info_ficha[4]'";
	$r_id_ref = mysql_query($sql_id_ref,$link);
//P FUNC
	$sql_id_p_func = "select * from prueba_funcional where id_pf = '$info_ficha[12]'";
	$r_id_p_func = mysql_query($sql_id_p_func,$link);
//TRATAMIENTO
	$sql_id_trata = "select * from tratamiento where id_trat = '$info_ficha[10]'";
	$r_id_trata = mysql_query($sql_id_trata,$link);
	$info_trata = mysql_fetch_array($r_id_trata);
	
//echo $sql_id_ref;
echo "<body>";
echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bgcolor='#99CCFF'>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>IDENTIFICACION DEL PACIENTE";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       NOMBRE ";
echo "    </th>";
echo "    <td width='70%' class='Texto4'>$info_pac[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       APELLIDO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_pac[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       FECHA DE NACIMIENTO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_pac[6]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       EDAD ";
echo "     </th>";
echo "    <td width='70%'>&nbsp;</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       RUT ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_ficha[9]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       DIRECCION ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_pac[3]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       TELEFONO 1 ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_pac[4]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       TELEFONO 2 ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_pac[5]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       CORREO E. ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_pac[7]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>ANAEVA REMOTA     </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>VICIOS";
echo "        ";
echo "    </th>";
echo "  </tr>";
while ($info_ar_v = mysql_fetch_array($r_ar_v))
{
 	$sql_ar_v_d = "select desc_vicio from tipo_vicio  where id_vicio = '$info_ar_v[0]'";
	$r_ar_v_d = mysql_query($sql_ar_v_d,$link);
	$info_ar_v_d = mysql_fetch_array($r_ar_v_d);
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       VICIO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_ar_v_d[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       FRECUENCIA ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_ar_v[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
while ($info_ar_p = mysql_fetch_array($r_ar_p))
{
  	$sql_ar_p_d = "select desc_patologia from tipo_patologia  where id_patologia = '$info_ar_p[0]'";
	$r_ar_p_d = mysql_query($sql_ar_p_d,$link);
	$info_ar_p_d = mysql_fetch_array($r_ar_p_d);
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>PATOLOGIAS";
echo "        ";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       PATOLOGIA ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_ar_p_d[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>CIRUGIAS        ";
echo "    </th>";
echo "  </tr>";
while ($info_ar_c = mysql_fetch_array($r_ar_c))
{
  	$sql_ar_c_d = "select desc_cirugia from tipo_cirugia  where id_cirugia = '$info_ar_c[0]'";
	$r_ar_c_d = mysql_query($sql_ar_c_d,$link);
	$info_ar_c_d = mysql_fetch_array($r_ar_c_d);

echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       CIRUGIA ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_ar_c_d[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>ANAEVA ACTUAL";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       ORIGEN DE LA LESION ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_aa[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       FARMACOS ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_aa[3]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       DIAGNOSTICO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_aa[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       OBSERVACIONES ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_aa[4]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>CIRUGIAS      ";
echo "    </th>";
echo "  </tr>";
while ($info_aa_c = mysql_fetch_array($r_aa_c))
{
  	$sql_aa_c_d = "select desc_cirugia from tipo_cirugia  where id_cirugia = '$info_aa_c[1]'";
	$r_aa_c_d = mysql_query($sql_aa_c_d,$link);
	$info_aa_c_d = mysql_fetch_array($r_aa_c_d);
	//echo $sql_aa_c_d;

echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       CIRUGIA ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_aa_c_d[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>PROTESIS          </th>";
echo "  </tr>";
while ($info_aa_p = mysql_fetch_array($r_aa_p))
{
  	$sql_aa_p_d = "select desc_protesis from tipo_protesis  where id_protesis = '$info_aa_p[0]'";
	$r_aa_p_d = mysql_query($sql_aa_p_d,$link);
	$info_aa_p_d = mysql_fetch_array($r_aa_p_d);
	//echo $sql_aa_c_d;
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       PROTESIS ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_aa_p_d[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>EXAMENES          </th>";
echo "  </tr>";

while ($info_aa_ex = mysql_fetch_array($r_aa_ex_pac))
{
  	$sql_aa_ex_d = "select desc_examen from tipo_examen  where id_examen = '$info_aa_ex[2]'";
  	$sql_aa_ex_r = "select * from resultado_examen  where id_aa_examen = '$info_aa_ex[0]'";
	$r_aa_ex_d = mysql_query($sql_aa_ex_d,$link);
	$r_aa_ex_r = mysql_query($sql_aa_ex_r,$link);
	$info_aa_ex_d = mysql_fetch_array($r_aa_ex_d);
//	echo $sql_aa_ex_d;

echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       EXAMEN ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_aa_ex_d[0]</td>";
echo "  </tr>";
while ($info_aa_ex_r = mysql_fetch_array($r_aa_ex_r))
{
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       RESULTADO ";
echo "     </th>";
$direccion_rex = "../Examenes/".$info_aa_ex_r[1];
//echo $direccion_rex;
echo "    <td width='70%' class='Texto4'><a href=$direccion_rex>$info_aa_ex_r[1]</a></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       OBSERVACION ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'class='Texto4'>$info_aa_ex_r[2]</td>";
echo "  </tr>";
}
}
echo "  <tr>";
echo "    <th colspan='2' align='left' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>EVALUACION KINESIOLOGICA";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>DOLOR          </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       NIVEL DE DOLOR ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_dolor[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       APARICION ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_dolor[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       CARACTERISTICAS ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_dolor[4]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>PALPACION          </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       TEMPERATURA ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_palpacion[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       SENSIBILIDAD  ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_palpacion[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       INFLAMACION ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_palpacion[3]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>INSPECCION          </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       PIEL ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_insp[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       VOLUMEN ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_insp[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       CICATRIZ ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_insp[3]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       DEFORMIDAD ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_insp[4]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       OBSERVACIONES ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_insp[5]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>OBSERVACIONES GENERALES          </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       OBSERVACIONES ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_eva_kine[4]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>EVALUACION POSTURAL";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       ANTERIOR ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_eva_post[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       POSTERIOR ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_eva_post[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       LATERAL ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_eva_post[3]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       OBSERVACIONES ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_eva_post[4]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>RANGO ARTICULAR";
echo "    </th>";
echo "  </tr>";
while ($id_articulacion = mysql_fetch_array ($r_id_articulacion))
{
  	$sql_rng_art = "select desc_articulacion from tipo_articulacion  where id_articulacion = '$id_articulacion[1]'";
	$r_rng_art = mysql_query($sql_rng_art,$link);
	$info_rng_art = mysql_fetch_array($r_rng_art);
//	echo $sql_rng_art;
	
if($info_rng_art[0]<>"Seleccione Articulacion")
{	
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       ARTICULACION ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_rng_art[0] </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       MOVIMIENTO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_articulacion[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       RANGO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_articulacion[3]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       ENDFEEL ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_articulacion[4]</td>";
echo "  </tr>";

echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
}

echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>ACORTAMIENTO MUSCULAR";
echo "    </th>";

while ($id_musculo = mysql_fetch_array ($r_id_musculo))
{
  	$sql_aco_musc = "select desc_musculo from tipo_musculo  where id_musculo = '$id_musculo[1]'";
	$r_aco_musc = mysql_query($sql_aco_musc,$link);
	$info_aco_musc = mysql_fetch_array($r_aco_musc);
	
if($info_aco_musc[0]<>"Seleccione Musculo")
{
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       MUSCULO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_aco_musc[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       IZQUIERDO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_musculo[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       DERECHO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_musculo[3]</td>";
echo "  </tr>";
}
}
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>FUERZA MUSCULAR";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       MOVIMIENTO MUSCULAR ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_fza[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       PORCENTAJE ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_fza[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>EVALUACION NEUROLOGICA";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>MIOTOMA          </th>";
echo "  </tr>";
while ($id_miotoma = mysql_fetch_array ($r_id_mio))
{
  	$sql_desc_mio = "select desc_miotoma from tipo_miotoma  where id_miotoma = '$id_miotoma[0]'";
	$r_desc_mio = mysql_query($sql_desc_mio,$link);
	$info_desc_mio = mysql_fetch_array($r_desc_mio);
	
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       MIOTOMA ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_desc_mio[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       ESTADO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_miotoma[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>DERMATOMA         </th>";
echo "  </tr>";
while ($id_dermatoma = mysql_fetch_array ($r_id_derma))
{
  	$sql_desc_derma = "select desc_dermatoma from tipo_dermatoma  where id_dermatoma = '$id_dermatoma[0]'";
	$r_desc_derma = mysql_query($sql_desc_derma,$link);
	$info_desc_derma = mysql_fetch_array($r_desc_derma);


echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       DERMATOMA ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_desc_derma[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       ESTADO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_dermatoma[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>REFLEJO         </th>";
echo "  </tr>";
while ($id_reflejo = mysql_fetch_array($r_id_ref))
{
  	$sql_desc_ref = "select desc_reflejo from tipo_reflejo  where id_reflejo = '$id_reflejo[0]'";
	$r_desc_ref = mysql_query($sql_desc_ref,$link);
	$info_desc_ref = mysql_fetch_array($r_desc_ref);
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       REFLEJO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_desc_ref[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       ESTADO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_reflejo[2]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
while ($id_p_func = mysql_fetch_array($r_id_p_func))
{
  	$sql_desc_p_func = "select desc_prueba from tipo_prueba  where id_prueba = '$id_p_func[0]'";
	$r_desc_p_func = mysql_query($sql_desc_p_func,$link);
	$info_desc_p_func = mysql_fetch_array($r_desc_p_func);
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto6' scope='row'>PRUEBAS FUNCIONALES";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       PRUEBA FUNCIONAL ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_desc_p_func[0]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       RESULTADO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$id_p_func[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto7' scope='row'>&nbsp;</th>";
echo "  </tr>";
}
echo "  <tr>";
echo "    <th colspan='2' align='left' class='Texto1' scope='row'>TRATAMIENTO";
echo "    </th>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       OBJETIVO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_trata[1]</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <th align='left' class='Texto7' scope='row'><blockquote>";
echo "       TRATAMIENTO ";
echo "     </th>";
echo "    <td width='70%' class='Texto4'>$info_trata[2]</td>";
echo "  </tr>";
echo "</table>";
echo "</body>";
echo "</html>";
?>