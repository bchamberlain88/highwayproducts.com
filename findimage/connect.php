<?php $db_name = "highwayp_masterdb"; // name of database
$db_user = "highwayp_webdev";  // database username
$db_password = "V5p93xIZezYm"; // database password
$connection = mysql_connect("localhost", $db_user, $db_password);
$database = mysql_select_db($db_name, $connection);
mysql_set_charset("utf8",$connection); // set database character set
unset($db_password); unset($db_user); // unset database credentials  ?>