<?php
require ("config.php");
$db=mysql_connect($dbhost,$dbuser,$dbpassword);
//echo"success to link to database server!"."<br/>";
mysql_select_db($dbdatabase,$db);
//echo"success to select database!"."<br/>";
?>