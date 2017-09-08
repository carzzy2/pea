<meta charset="utf-8">
<?php
$host="localhost";
$user="root";
$pass="1234";
$dbname="pea";
mysql_connect($host,$user,$pass) or die ("ติดต่อ Host ไม่ได้!!");
mysql_select_db($dbname) or die ("ติดต่อ Database ไม่ได้!!");
mysql_query("SET NAMES UTF8");
$limit=10;

?>