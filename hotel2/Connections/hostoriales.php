<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_hostoriales = "localhost";
$database_hostoriales = "historial";
$username_hostoriales = "root";
$password_hostoriales = "";
$hostoriales = mysql_pconnect($hostname_hostoriales, $username_hostoriales, $password_hostoriales) or die(mysql_error());
?>