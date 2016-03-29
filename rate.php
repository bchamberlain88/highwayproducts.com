<?php

/**
 *
 * @author    Sebastian Inman @sebastian_inman
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2014
 *
 */

require_once('../_includes/connect.inc.php');

/**
 *
 * Add a new product rating value to the database
 *
 * @param integer $rating : the numeric value of the rating [1-5]
 * @param string $product : the selector of the product being rated
 *
 */

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

$array = json_decode(stripcslashes($_POST['data']), true);

$selector = $array[0];
$rating   = $array[1];
$ipAddr   = getUserIP();
$date     = date('Y-m-d');

mysql_query("INSERT INTO product_ratings (selector, rating, ip_address, rated_date) VALUES ('$selector', '$rating', '$ipAddr', '$date')");

?>