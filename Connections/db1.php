<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db1 = "localhost";
$database_db1 = "scenograph";
$username_db1 = "archipublic";
$password_db1 = "aPub&8302";
$db1 = mysql_connect($hostname_db1, $username_db1, $password_db1) or trigger_error(mysql_error(),E_USER_ERROR); 
?>