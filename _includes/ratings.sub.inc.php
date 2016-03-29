<?php

/**
 *
 * Feel like cheating? Run this file in your browser
 * to fake ratings for each available product. This script
 * will generate a rating of either 4 or 5 stars and append
 * it to each product between 20 and 150 times. To avoid 
 * making the illegitimacy painfully obvious, if the script
 * has already 'voted' on a product more than x times, it 
 * ignores that product.
 *
 * @author    Sebastian Inman @sebastian_inman
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2014
 *
 */
echo 'test';
// connect to the database
include_once( 'connect.inc.php' );
// set a nullified ip address
$ipAddress = '0.0.0.0';
// database timestamp for today. format: Year-Month-Day
$ratedDate = date( 'Y-m-d' );
// should we empty the ratings first? default: true [true | false]
$emptyFirst = false;
// check if the ratings need to be emptied first
if( $emptyFirst == true ) {
	// empty = true. empty the ratings table
	mysql_query( 'TRUNCATE TABLE product_ratings' );
}
// get all available products
$products = mysql_query( 'SELECT * FROM product_categories_sub' );
// perform a check on each product available
while( $product = mysql_fetch_assoc( $products ) ) {
	// get the selector for this product
	$selector = $product['selector'];
	echo $selector;
	// set a random number of votes to append between 20 and 150
	$randVotes = rand( 20, 150 );
	// select the votes that already exist for this product
	$ratings = mysql_query( 'SELECT * FROM product_ratings WHERE selector = "' . $selector . '"' );
	// how many votes already exist?
	if( mysql_num_rows( $ratings ) > 0 ) {
		// the product already has some votes - no need to add more
	} else {
		// this product is lonely and has no votes - let's add some
		for( $i = 0; $i < $randVotes; $i++ ) {
			// generate a not so random rating - either 4 or 5
			$randRating = 5;
			// insert each of the new ratings into the database
			mysql_query( 'INSERT INTO product_ratings (selector, rating, ip_address, rated_date) VALUES ("' . $selector . '", "' . $randRating . '", "' . $ipAddress . '", "' . $ratedDate . '")' );
		}
	}
}

?>