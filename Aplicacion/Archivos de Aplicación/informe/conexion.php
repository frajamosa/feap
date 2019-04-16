<?php	

function Conectarse() 
{ 
   if (!($link=mysql_connect("localhost","fmoore","francisco"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("fe",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
} 

$link=Conectarse(); 
//echo "BDC.<br>"; 


//mysql_close($link); //cierra la conexion 

?>


