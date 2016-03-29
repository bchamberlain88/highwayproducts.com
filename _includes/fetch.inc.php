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
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

// include globals
include_once( 'globals.inc.php' );

$p = $_GET['p'];
$getProduct = mysql_query("SELECT * FROM product_categories_items WHERE selector = '".$p."'");
$product = mysql_fetch_assoc($getProduct);

$getParent = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$product['parent']."'");
$parent = mysql_fetch_assoc($getParent);

$slide = DIR_IMAGES.'_products/'.$parent['parent'].'/'.$parent['selector'].'/'.$product['selector'].'/_slides/'.$product['selector'].'-slide-1.jpg';
$thumb = $slide = DIR_IMAGES.'_products/'.$parent['parent'].'/'.$parent['selector'].'/'.$product['selector'].'/'.$product['selector'].'-thumb.jpg';

if(url_exists($slide) === true && url_exists($thumb) === true) {
	$image = $slide;
} else if(url_exists($slide) === true && url_exists($thumb) === false) {
	$image = $slide;
} else if(url_exists($slide) === false && url_exists($thumb) === true) {
	$image = $thumb;
} else if(url_exists($slide) === false && url_exists($thumb) === false) {
	$image = 'http://www.highwayproducts.com/_assets/_images/_products/product-thumb.jpg';
}


?>

<div class='fetch-content'>
	<div class='fetch-banner'>
		<img src='<?php echo $image; ?>' />
	</div>
	<div class='fetch-info'>
		<h2 class='fetch-title'><?php 
	        if($product['is_hot'] == 1){ echo("<span class='hot-item' itemprop='condition' content='hot'>hot</span>"); }
	        if($product['is_new'] == 1){ echo("<span class='new-item' itemprop='condition' content='new'>new</span>"); }
	        if($product['is_onsale'] == 1){ echo("<span class='sale-item' itemprop='condition' content='sale'>sale</span>"); }
	        echo $product['name']; ?>
	    </h2>
	    <ul class='ratings small clear'>
            <?php $rating = rating( 'product', $p ); ?>
            <?php printStars( $rating['average'] ); ?>
            <label><?php echo $rating['average']; ?> out of 5 stars</label>
        </ul>
	</div>
</div>