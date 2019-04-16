<?php
	
	$nombre = "Francisco";
	$apellido = "moore";
	$nombre = strtolower($nombre);
	$apellido = strtolower($apellido);
	//echo "<br><br><hr>";
	

// 	$nombre = trim($nombre);
// 	$apellido = trim($apellido);

	$l_nom = strlen($nombre);
	$l_ap = strlen($apellido);
	
	do
	{
	  	$l_ap = strlen($apellido);
		$pos = strpos($apellido," ");
		if ($pos<>"0"){
		$ape1 = substr($apellido,0,$pos);
		$ape2 = substr($apellido,$pos+1,$l_ap);
		$apellido = $ape1.$ape2;
		$pos = strpos($apellido," ");
		}
	//	echo $apellido."<br>";
	//	echo $pos."<br>";
		
	}while ($pos<>"0");

	
	$i = 0;
	
	do
	{
		$nombre_usr = substr($nombre,0,($l_nom-($l_nom-($i+1))));
//		$apellido_usr = substr($apellido,0,$l_ap);
		$apellido_usr = $apellido;		
		$nuevo_usuario = $nombre_usr.$apellido_usr;
		
		$sql_usr_name = "select count(id_usuario) from usuario where usuario = '$nuevo_usuario'";
		$r_sql_usr_name = mysql_query($sql_usr_name,$link);
		$info_usr_name = mysql_fetch_array($r_sql_usr_name);
		
		$i++;
		
	} while($info_usr_name[0]<>"0");
	
 

?>