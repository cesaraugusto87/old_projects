<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_bd_inavi = "localhost";
$database_bd_inavi = "inavi";
$username_bd_inavi = "root";
$password_bd_inavi = "scaspc";
$bd_inavi = mysql_pconnect($hostname_bd_inavi, $username_bd_inavi, $password_bd_inavi) or trigger_error(mysql_error(),E_USER_ERROR); 

?>