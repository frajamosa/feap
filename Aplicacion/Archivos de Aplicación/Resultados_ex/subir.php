<?php
//formulario de upload por jorge luis martinez
//http://miscodigos.jlmnetwork.com/
echo $adjunto."<br>";
echo $adjunto_name."<br>";
$extension = explode(".",$adjunto_name);
$num = count($extension)-1;
if($extension[$num] == "zip")
{
if($adjunto_size < 30000)
{
if(!copy($adjunto, $adjunto_name))
{
echo "error al copiar el adjunto";
}
else
{
echo "adjunto subido con exito";
}
}
else
{
echo "el adjunto supera los 30kb";
}
}
else
{
echo "el formato de adjunto no es valido, solo .zip";
}
?>