<?php
session_start();
$usuario = $_SESSION['usr_name'];
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<title>Documento sin título</title>";
echo "<link href='Estilos.css' rel='stylesheet' type='text/css' />";
echo "</head>";

echo "<body>";
echo "<div class='Texto2'><center>";
echo "  <strong>Usuario Actual<br> $usuario</strong><br />";
//echo "<br>";
echo "<td colspan='2' align='center' class='Texto'><input type='submit' name='btn_enviar' id='btn_enviar' value='Cerrar Sesión' onclick='window.open(\"index.html\",\"_parent\")'/>";
echo "</center></div>";
echo "</body>";
echo "</html>";
?>