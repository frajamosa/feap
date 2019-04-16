<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_FE = "localhost";
$database_FE = "fe";
$username_FE = "admin";
$password_FE = "139752";
$FE = mysql_pconnect($hostname_FE, $username_FE, $password_FE) or trigger_error(mysql_error(),E_USER_ERROR); 
?>