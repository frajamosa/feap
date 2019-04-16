


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="Estilos.css" rel="stylesheet" type="text/css" />
<title>Documento sin título</title>
</head>

<body>


<?php
session_start();
$titulo = $_SESSION['titulo'];
$titulo2 = $_SESSION['titulo2'];

	switch($titulo)		
	{ 
		case 1:
		echo "<center><img src='Images/titulo/menu_p.jpg' width='588' height='48' align='top' /><br></center>";
		break;
		case 2:
		echo "<center><img src='Images/titulo/p_control.jpg' width='588' height='48' align='top' /><br></center>";
		break;
		case 3:
		echo "<center><img src='Images/titulo/ficha_electronica.jpg' width='588' height='48' align='top' /><br></center>";
		break;
		case 4:
		echo "<center><img src='Images/titulo/informes.jpg' width='588' height='48' align='top' /><br></center>";
		break;
	}
		switch($titulo2)		
	{ 
		case 1:
		echo "<center><img src='Images/titulo/usuario.jpg' width='353' height='29' align='top' /></center>";
		break;
		case 2:
		echo "<center><img src='Images/titulo/kinesiologo.jpg' width='353' height='29' align='top' /></center>";
		break;
		case 3:
		echo "<center><img src='Images/titulo/internista.jpg' width='353' height='29' align='top' /></center>";
		break;
		case 4:
		echo "<center><img src='Images/titulo/paciente.jpg' width='353' height='29' align='top' /></center>";
		break;
		case 5:
		echo "<center><img src='Images/titulo/ficha_atencion.jpg' width='353' height='29' align='top' /></center>";
		break;
		case 6:
		echo "<center><img src='Images/titulo/adjunto.jpg' width='353' height='29' align='top' /></center>";
		break;
	}

?>
</body>
</html>
