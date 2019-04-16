<?php
session_start();
$permiso = $_SESSION['permiso'];





//echo "<form action='$PHP_SELF' method='post'>";	
//echo $permiso;


echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin título</title>";
echo "<style type='text/css'>";
echo "<!--";
echo "body {";
echo "	background-image: url(Images/FEAP-Fondo.jpg);";
echo "	background-repeat: no-repeat;";
echo "	background-position:center;";
echo "}";
echo "-->";
echo "</style>";
echo "<link href='Estilos.css' rel='stylesheet' type='text/css' />";
echo "<script src='SpryAssets/SpryAccordion.js' type='text/javascript'></script>";
echo "<script src='SpryAssets/SpryTabbedPanels.js' type='text/javascript'></script>";
echo "<link href='SpryAssets/SpryAccordion.css' rel='stylesheet' type='text/css' />";
echo "<link href='SpryAssets/SpryTabbedPanels.css' rel='stylesheet' type='text/css' />";
echo "</head>";

echo "<body>";


echo "US->".substr("$permiso",4,1)."-";
echo "KI->".substr("$permiso",3,1)."-";
echo "INT->".substr("$permiso",2,1)."-";
echo "INF->".substr("$permiso",1,1)."-";
echo "PAC->".substr("$permiso",0,1)."-";


if(substr("$permiso",4,1)<>9 or substr("$permiso",3,1)<>9 or substr("$permiso",2,1)<>9)
{
	echo "<div id='Accordion1' class='Accordion' tabindex='0'>";
	echo "  <div class='AccordionPanel'>";
	echo "    <div class='AccordionPanelTab'>PANEL DE CONTROL</div>";
	echo "    <div class='AccordionPanelContent'> ";
	echo "      <div id='TabbedPanels1' class='TabbedPanels'>";
	echo "        <ul class='TabbedPanelsTabGroup'>";
	echo "          <li class='TabbedPanelsTab' tabindex='1'>Usuarios</li>";
	echo "          <li class='TabbedPanelsTab' tabindex='0'>Kinesiólogo</li>";
	echo "          <li class='TabbedPanelsTab' tabindex='2'>Internista</li>";
	echo "        </ul>";
	echo "        <div class='TabbedPanelsContentGroup'>";
	echo "          <div class='TabbedPanelsContent'>";	
	echo "              <table border='0' height='100%'>";
	
if(substr("$permiso",4,1)<>9)
	{
	echo "<form action='$PHP_SELF' method='post'><tr><td align='right'><input type='submit' name='btn_add_usr' value='Registrarr' onclick='window.open(\"usuario/usuarios_marcos_add.php\",\"_parent\")'/></td><td><span class='Texto2'>Registrar nuevo usuario y Autorizaciones relacionadas</span></td></tr></form>";
	echo "<form action='$PHP_SELF' method='post'><tr><td align='right'><input type='submit' name='btn_mod_usr' value='Modificar' onclick='window.open(\"usuario/usuarios_marcos_mod.php\",\"_parent\")'/></td><td><span class='Texto2'>Modificar opciones de usuario</span></td></tr></form>"; 
	echo "<form action='$PHP_SELF' method='post'><tr><td align='right'><input type='submit' name='btn_del_usr' value='Eliminar'  onclick='window.open(\"usuario/usuarios_marcos_del.php\",\"_parent\")'/></td><td><span class='Texto2'>Eliminar usuario</span></td></tr></fom>";
	 
	 

	 
		if ($btn_add_usr)
		{
			$_SESSION['usr'] = "add";	
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="1";
		}	
		if ($btn_mod_usr)
		{
			$_SESSION['usr'] = "mod";
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="1";	
		}
		if ($btn_del_usr)
		{
			$_SESSION['usr'] = "del";
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="1";	
		}
	}
		
	echo "</table>";
	
	
	
	
	echo "</div>";
	echo "          <div class='TabbedPanelsContent'>";
	echo "              <table border='0'>";
	
	
	if(substr("$permiso",3,1)<>9)
	{
	$txt_kine_add = "<tr><td align='right'><input type='submit' name='btn_add_kine' value='Registrar' onclick='window.open(\"kinesiologo/kinesiologos_marcos_add.php\",\"_parent\")'/></td><td><span class='Texto2'>Registrar Kinesiólogo...............................</span></td></tr>";
	$txt_kine_mod = "<tr><td align='right'><input type='submit' name='btn_mod_kine' value='Modificar' onclick='window.open(\"kinesiologo/kinesiologos_marcos_mod.php\",\"_parent\")'/></td><td><span class='Texto2'>Modificar Kinesiólogo</span></td></tr>";
	//$txt_kine_del = "<tr><td align='right'><input type='submit' name='btn_del_kine' value='Eliminar'  onclick='window.open(\"kinesiologo/kinesiologos_marcos_del.php\",\"_parent\")'/></td><td><span class='Texto2'>Eliminar Kinesiólogo </span></td></tr>";
	 
	 
	 switch(substr("$permiso",3,1))		//Kinesiologo
	{ 
		case 9:
		break;
		case 1:
		break;
		case 2:
	 		echo $txt_kine_add;
		break;
		case 3:
			 echo $txt_kine_add;
			 echo $txt_kine_mod;
		break;
		case 4:
			 echo $txt_kine_add;
			 echo $txt_kine_mod;
			 echo $txt_kine_del;
		break;
	}
	 
		if ($btn_add_kine)
		{
			//$_SESSION['usr'] = "add";
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="2";
				
		}	
		if ($btn_mod_kine)
		{
			//$_SESSION['usr'] = "mod";	
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="2";
		}
		if ($btn_del_kine)
		{
			//$_SESSION['usr'] = "del";	
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="2";
		}
	}               

	
	
	echo "              </table>";
	echo "          </div>";
	
	
	echo "          <div class='TabbedPanelsContent'>";
	echo "              <table border='0'>";
	
	if(substr("$permiso",2,1)<>9)
	{
	$txt_inter_add = "<tr><td align='right'><input type='submit' name='btn_add_inter' value='Registrar' onclick='window.open(\"internista/internistas_marcos_add.php\",\"_parent\")'/></td><td><span class='Texto2'>Registrar Internista</span></td></tr>";
	$txt_inter_mod = "<tr><td align='right'><input type='submit' name='btn_mod_inter' value='Modificar' onclick='window.open(\"internista/internistas_marcos_mod.php\",\"_parent\")'/></td><td><span class='Texto2'>Modificar Internista</span></td></tr>";
	//$txt_inter_del = "<tr><td align='right'><input type='submit' name='btn_del_inter' value='Eliminar'  onclick='window.open(\"internista/internistas_marcos_del.php\",\"_parent\")'/></td><td><span class='Texto2'>Eliminar Internista </span></td></tr>";
	 
	 
	 switch(substr("$permiso",2,1))		//internista
	{ 
		case 9:
		break;
		case 1:
		break;
		case 2:
	 		echo $txt_inter_add;
		break;
		case 3:
			 echo $txt_inter_add;
			 echo $txt_inter_mod;
		break;
		case 4:
			 echo $txt_inter_add;
			 echo $txt_inter_mod;
			 echo $txt_inter_del;
		break;
	}
	 
		if ($btn_add_inter)
		{
			//$_SESSION['usr'] = "add";	
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="3";
		}	
		if ($btn_mod_inter)
		{
			//$_SESSION['usr'] = "mod";	
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="3";
		}
		if ($btn_del_inter)
		{
			//$_SESSION['usr'] = "del";	
			$_SESSION['titulo']="2";
			$_SESSION['titulo2']="3";
		}
	}               
	
	echo "              </table>";
	echo "          </div>";
	echo "        </div>";
	echo "      </div>";
	echo "      <br />";
	echo "    </div>";
	echo "  </div>";
}


//*******************************************************************************************************************************************
//-------------------------------------------------------------------------------------------------------------------------------------------
//**************************************INICIO MODULO FICHA ELECTRONICA*******************************************************************************
//-------------------------------------------------------------------------------------------------------------------------------------------
//*******************************************************************************************************************************************  

echo "  <div class='AccordionPanel'>";//*********************************************************************************
echo "    <div class='AccordionPanelTab'>FICHA ELECTRONICA</div>";

	echo "      <div id='TabbedPanels2' class='TabbedPanels'>";
	echo "        <ul class='TabbedPanelsTabGroup'>";
	echo "          <li class='TabbedPanelsTab' tabindex='0'>Paciente</li>";
	echo "          <li class='TabbedPanelsTab' tabindex='0'>Ficha</li>";
	echo "        </ul>";
	echo "        <div class='TabbedPanelsContentGroup'>";
	echo "          <div class='TabbedPanelsContent'>";	
	echo "              <table border='0' height='100%'>";
	
	echo "<form action='$PHP_SELF' method='post'><tr><td align='right'><input type='submit' name='btn_add_pac' value='Nuevo Paciente' onclick='window.open(\"paciente/pacientes_marcos_add.php\",\"_parent\")'/></td><td><span class='Texto2'>Registrar nuevo Paciente</span></td></tr>";
	echo "<form action='$PHP_SELF' method='post'><tr><td align='right'><input type='submit' name='btn_mod_pac' value='Modificar Paciente' onclick='window.open(\"paciente/pacientes_marcos_mod.php\",\"_parent\")'/></td><td><span class='Texto2'>Modificar Paciente</span></td></tr>";

//Paciente

// 			 echo $txt_pac_add;
// 			 echo $txt_pac_mod;

			 //echo $txt_pac_del;

	
		if ($btn_add_pac)
		{
			//$_SESSION['usr'] = "add";	
			$_SESSION['titulo']="3";
			$_SESSION['titulo2']="4";
		}	
		if ($btn_mod_pac)
		{
			//$_SESSION['usr'] = "mod";
			$_SESSION['titulo']="3";
			$_SESSION['titulo2']="4";	
		}
	
	
	
	
			
	echo "</table>";
	echo "</div>";
	
	
	echo "          <div class='TabbedPanelsContent'>";
	echo "              <table border='0'>";
	if(substr("$permiso",0,1)<>9)
	{
	$txt_fic_add = "<tr><td align='right'><input type='submit' name='btn_add_fic' value='Nueva Ficha' onclick='window.open(\"fichas_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Nueva Ficha</span></td></tr>";
	$txt_fic_mod = "<tr><td align='right'><input type='submit' name='btn_mod_fic' value='Modificar' onclick='window.open(\"fichas_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Modificar Ficha</span></td></tr>";
	$txt_fic_del = "<tr><td align='right'><input type='submit' name='btn_del_fic' value='Eliminar'  onclick='window.open(\"del_fichas_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Eliminar Ficha </span></td></tr>";
	 
	 
	 switch(substr("$permiso",4,1))		//ficha
	{ 
		case 9:
		break;
		case 1:
		break;
		case 2:
	 		echo $txt_fic_add;
		break;
		case 3:
			 echo $txt_fic_add;
			 echo $txt_fic_mod;
		break;
		case 4:
			 echo $txt_fic_add;
			 echo $txt_fic_mod;
			 echo $txt_fic_del;
		break;
	}
	 
		if ($btn_add_fic)
		{
			$_SESSION['usr'] = "add";
			$_SESSION['id_pac']= "";
			$_SESSION['id_kine']= "";
			$_SESSION['id_int']= "";
			$_SESSION['titulo']="3";
			$_SESSION['titulo2']="5";	
		}	
		if ($btn_mod_fic)
		{
			$_SESSION['usr'] = "mod";
			$_SESSION['titulo']="3";
			$_SESSION['titulo2']="5";	
		}
		if ($btn_del_fic)
		{
			$_SESSION['usr'] = "del";
			$_SESSION['titulo']="3";
			$_SESSION['titulo2']="5";	
		}
	}               
	
	echo "              </table>";
	echo "          </div>";
	echo "        </div>";
	echo "    </div>";
/**
* 	echo "      </div>";
* 	echo "      <br />";
* 	echo "    </div>";
*/






echo "  </div>";
echo "  <div class='AccordionPanel'>";
echo "    <div class='AccordionPanelTab'>INFORMES</div>";
echo "    <div class='AccordionPanelContent'>";

	echo "              <table border='0'>";
	
	if(substr("$permiso",1,1)<>9)
	{
	$txt_inf_1 = "<tr><td align='right'><input type='submit' name='btn_1_inf' value='Fichas por Paciente' onclick='window.open(\"informe/ficha_x_paciente_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Fichas que el paciente registra</span></td></tr>";
	$txt_inf_2 = "<tr><td align='right'><input type='submit' name='btn_2_inf' value='Kinesiologos Registrados' onclick='window.open(\"informe/reg_kinesiologo_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Lista los Kinesiologos Registrados</span></td></tr>";
	$txt_inf_3 = "<tr><td align='right'><input type='submit' name='btn_3_inf' value='Internos Registrados'  onclick='window.open(\"informe/reg_interno_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Lista los Internos Registrados </span></td></tr>";
	$txt_inf_4 = "<tr><td align='right'><input type='submit' name='btn_4_inf' value='Pacientes Registrados'  onclick='window.open(\"informe/reg_paciente_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Lista los Pacientes Registrados </span></td></tr>";
	$txt_inf_5 = "<tr><td align='right'><input type='submit' name='btn_5_inf' value='Usuarios Registrados'  onclick='window.open(\"5_informes_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Lista los Usuarios Registrados </span></td></tr>";
	$txt_inf_6 = "<tr><td align='right'><input type='submit' name='btn_6_inf' value='Fichas por Periodo'  onclick='window.open(\"6_informes_marcos.php\",\"_parent\")'/></td><td><span class='Texto2'>Lista las fichas registradas en un periodo determiando </span></td></tr>";


	 
	 
	 echo $txt_inf_1;
	 echo $txt_inf_2;
	 echo $txt_inf_3;
	 echo $txt_inf_4;
	 echo $txt_inf_5;
 	 echo $txt_inf_6;

	if($btn_2_inf or $btn_3_inf or $btn_4_inf)
	{
	 	if ($btn_2_inf)
	 	{
		$_SESSION['tipo_info']="kinesiologo";	
		}
		if ($btn_3_inf)
		{
			$_SESSION['tipo_info']="interno";
		}
		if ($btn_4_inf)
		{
			$_SESSION['tipo_info']="paciente";
		}
	$_SESSION['usr_info']="mod";
	}



// 	 switch(substr("$permiso",1,1))		//Informe
// 	{ 
// 		case 9:
// 		break;
// 		case 1:
// 		break;
// 		case 2:
// 	 		echo $txt_inf_1;
// 		break;
// 		case 3:
// 			 echo $txt_inf_1;
// 			 echo $txt_inf_2;
// 		break;
// 		case 4:
// 			 echo $txt_inf_7;
// 			 echo $txt_inf_2;
// 			 echo $txt_inf_3;
// 		break;
// 	}
// 	 
// 		if ($btn_7_inf)
// 		{
// 			$_SESSION['usr'] = "add";
// 			$_SESSION['id_pac']= "";
// 			$_SESSION['id_kine']= "";
// 			$_SESSION['id_int']= "";
// 			$_SESSION['titulo']="3";
// 			$_SESSION['titulo2']="5";
// 			$_SESSION['tipo_info']="paciente";	
// 		}	
// 		if ($btn_mod_inf)
// 		{
// 			$_SESSION['usr'] = "mod";
// 			$_SESSION['titulo']="3";
// 			$_SESSION['titulo2']="5";	
// 		}
// 		if ($btn_del_inf)
// 		{
// 			$_SESSION['usr'] = "del";
// 			$_SESSION['titulo']="3";
// 			$_SESSION['titulo2']="5";	
// 		}
	}                	

	echo "              </table>";


echo "  </div>";
echo "</div>";
echo "</div>";

//, {enableAnimation:false}
?>



<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2");

//-->
</script>



	</body>
</html>

<?php
	echo "</form>";
?>
