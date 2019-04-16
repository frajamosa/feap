<?php
session_start();
	unset($_SESSION['list']);
	$_SESSION['titulo'] = "1";
	$_SESSION['titulo2']= "0";
	$_SESSION['list'] = "0";
	unset($_SESSION['ip_pac2']);
	unset($_SESSION['usr']);
	unset($_SESSION['id_kine']);
	unset($_SESSION['id_int']);
	unset($_SESSION['pac_nuevo']);
	unset($_SESSION['ficha']);
	unset($_SESSION['reg_paciente_flag']);


if ($_SESSION['permiso']=="A")
{
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Frameset//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>FEAP - MENU PRINCIPAL</title>";
echo "<link href='Estilos.css' rel='stylesheet' type='text/css' />";
echo "</head>";
echo "<frameset rows='96,*' cols='*' framespacing='0' frameborder='no' border='0'>";
echo "  <frameset rows='*' cols='162,*' framespacing='0' frameborder='no' border='0'>";
echo "		<frame src='logo.php' name='leftFrame' scrolling='No' noresize='noresize' id='leftFrame' title='leftFrame' />";
echo "		<frameset rows='*' cols='*,268' framespacing='0' frameborder='no' border='0'>";
echo "		<frame src='titulo.php' name='topFrame' scrolling='No' noresize='noresize' id='topFrame' title='topFrame' />";
echo "		<frame src='marco_id_usr.php' name='rightFrame' scrolling='No' noresize='noresize' id='rightFrame' title='rightFrame' />";
echo "	</frameset>";
echo "	</frameset>";
echo "  <frame src='Menu_adm.html' name='mainFrame' id='mainFrame' title='mainFrame'  frameborder = '1'/>";
echo "</frameset>";
echo "<noframes><body>";
echo "</body></noframes>";
echo "</html>";
}
else
{
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Frameset//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>FEAP - MENU PRINCIPAL</title>";
echo "<link href='Estilos.css' rel='stylesheet' type='text/css' />";
echo "</head>";
echo "<frameset rows='96,*' cols='*' framespacing='0' frameborder='no' border='0'>";
echo "  <frameset rows='*' cols='162,*' framespacing='0' frameborder='no' border='0'>";
echo "		<frame src='logo.php' name='leftFrame' scrolling='No' noresize='noresize' id='leftFrame' title='leftFrame' />";
echo "		<frameset rows='*' cols='*,268' framespacing='0' frameborder='no' border='0'>";
echo "		<frame src='titulo.php' name='topFrame' scrolling='No' noresize='noresize' id='topFrame' title='topFrame' />";
echo "		<frame src='marco_id_usr.php' name='rightFrame' scrolling='No' noresize='noresize' id='rightFrame' title='rightFrame' />";
echo "	</frameset>";
echo "	</frameset>";
echo "  <frame src='Menu_usr.html' name='mainFrame' id='mainFrame' title='mainFrame'  frameborder = '1'/>";
echo "</frameset>";
echo "<noframes><body>";
echo "</body></noframes>";
echo "</html>";	
}



?>

