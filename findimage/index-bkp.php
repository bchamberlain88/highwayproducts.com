<?php error_reporting(E_ALL^E_NOTICE); session_start(); ob_start(); 
include("./connect.php"); include("./functions.php");

$directory = "./Images/";
list_files($directory);

?>