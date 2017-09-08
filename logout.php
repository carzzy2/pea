<meta charset="utf-8">
<?php 
@session_start();
mysql_query("SET NAMES UTF8");
session_destroy();
echo "<META http-equiv='refresh' Content='0; URL=login.php'> ";
 ?>