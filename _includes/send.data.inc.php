<?php

require_once('connect.inc.php');

$array = json_decode(stripcslashes($_POST['data']), true);

$date    = date('F d, Y @ g:i:s a');
$name    = $array[0];
$email   = $array[1];
$phone   = $array[2];
$message = mysql_real_escape_string($array[3]);
$pageurl = $array[4];

function getUserIP(){
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];
	if(filter_var($client, FILTER_VALIDATE_IP)){
		$ip = $client;
	}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
		$ip = $forward;
	}else{
		$ip = $remote;
	}
	return $ip;
}

$ipaddress = getUserIP();

mysql_query("INSERT INTO contact_messages (date, name, email, phone, message, ipaddress, page) VALUES ('$date', '$name', '$email', '$phone', '$message', '$ipaddress', '$pageurl')");

?>