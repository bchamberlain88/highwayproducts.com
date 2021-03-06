<?php

/**
 *
 * @author    Sebastian Inman @sebastian_inman
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2014
 *
 */

/**
 *
 * Check if the current url is a page that exists
 * If it doesn't, throw a 404 error
 *
 * @param string $base : the base url of the site. default: DIR_ROOT ('www.highwayproducts.com')
 * @param string $page : the page parameter determining the product being viewed
 * @return             : redirect to the current url if necessary
 *
 */

 function pageExists($pageType, $selector) {
 	if($pageType == 'product'){
 		$checkPage = mysql_query("SELECT * FROM product_categories_items WHERE selector = '".$selector."'");
 		if(mysql_num_rows($checkPage) > 0){
 			// the product exists, keep user on this page
 		}else{
 			$checkSub = mysql_query("SELECT * FROM product_categories_sub WHERE url = '".$selector."'");
 			if(mysql_num_rows($checkSub) > 0){
 				// the sub page exists, keep user on this page
 			}else{
 				$checkCat = mysql_query("SELECT * FROM product_categories_main WHERE url = '".$selector."'");
 				if(mysql_num_rows($checkCat) > 0){
 					// the cat page exists, keep user on this page
 				}else{
 					// the product does not exist, 404 error
 					header( 'HTTP/1.1 404 Not Found' );
					header( 'Location: ' . DIR_ROOT . 'error/404/' );
				}
			}
 		}
 	}
 }




/**
 *
 * Encrypt provided string with a custom hash
 *
 * @param string $string : the string to be encrypted
 * @return               : encrypted string
 *
 */

function encryptString( $string ) {
	$hash = 'iUb8qLpJm1DX8zQ52yhuKv';
	$encode = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $hash ), $string, MCRYPT_MODE_CBC, md5( md5( $hash ) ) ) );
	return $encode;
}

function image_crypt( $action, $string ) {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = "iUb8qLpJm1DX8zQ52yhuKv";
	$secret_iv = "DX8zQ52yhuKviUb8qLpJm1";
	$key = hash( "sha256", $secret_key );
	$iv = substr( hash( "sha256", $secret_iv ), 0, 16 );

	if( $action == "encrypt" ) {
		$output = openssl_encrypt( $string, $encrypt_method, $key, 0, $iv );
		$output = base64_encode( $output );
	} else if( $action == "decrypt" ) {
		$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}

function url_exists($url) {
    if (!$fp = curl_init($url)) return false;
    return true;
}

function truncateMeta( $meta, $length ) {
	return substr( $meta, 0, strrpos( substr( $meta, 0, $length), ' ' ) );
}

/**
 *
 * Check if the current url is active - if not redirect to the right page
 * Used to make sure links from old site don't die
 *
 * @param string $base : the base url of the site. default: DIR_ROOT ('www.highwayproducts.com')
 * @param string $page : the page parameter determining the product being viewed
 * @return             : redirect to the current url if necessary
 *
 */

function checkRedirect( $base, $dir, $page ) {
	// set the path of the current page
	$path = str_replace( '/', '', $dir ) . '/' . $page;
	// get any paths from the database that match
	$getPaths = mysql_query( "SELECT * FROM page_redirects WHERE url_old = '" . $path . "'" );
	// are there any matches?
	if( mysql_num_rows( $getPaths ) > 0 ) {
		// there's a match - start the redirect
		$redirect = mysql_fetch_assoc( $getPaths );
		header( 'HTTP/1.1 303 See Other' );
		header( 'Location: ' . DIR_ROOT . $redirect['url_new'] );
	} else {
		// there is no match - see if the path exists at all
		header( 'HTTP/1.1 404 Not Found' );
		header( 'Location: ' . DIR_ROOT . 'error/404/' );
	}
}




/**
 *
 * Get either a Gravatar URL or complete image tag for a supplied email address.
 *
 * @param string $email : the supplied email address
 * @param string $s     : size of avatar in pixeles. defaults to '80' [1 - 2048]
 * @param string $d     : default imageset to use. defaults to 'mm' [404 | mm | identicon | monsterid | wavatar]
 * @param string $r     : maximum image rating. defaults to 'pg' [g | pg | r | x]
 * @param boolean $img  : defaults to false. [true - returns complete image tag | false - returns image url]
 * @param array $atts   : optional, additional key/value attributes to include in the image tag
 * @return              : string containing either just a url or a complete image tag with the users Gravatar
 *
 */

function gravatar( $email, $s = 80, $d = 'mm', $r = 'pg', $img = false, $atts = array() ){
	// set the base url for the avatar
	$url = 'http://www.gravatar.com/avatar/';
	// encrypt the email address and append it to the base url
	$url .= md5( strtolower( trim( $email ) ) );
	// append size, imageset, and rating to the base url
	$url .= '?s='. $s . '&d=' . $d . '&r=' . $r;
	// should we return just the url or an img element?
	if( $img ) {
		// return an img element!
		$url = '<img src="' . $url . '"';
		// apply attributes to img element
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	// not an img element - return the image url!
	return $url;
}




/**
 *
 * Sperates a group of key words seperated by ',' | ', ' into a string
 *
 * @param string $keys : the supplied email address
 * @return             : string with words seperated by spaces
 *
 */

function keywords( $keys ) {
    return str_replace( ',', ', ', str_replace( ' ', '', $keys ) );
}




/**
 *
 * Seperate the category array into individual categories
 *
 * @param array $cats : the categories seperated by ', '
 * @return            : each category as a link
 *
 */

function categories( $cats ) {
	// explode the categories into an array
	$categories = explode( ', ', $cats );
	// run function for each category
	foreach( $categories as $category ) {
		// echo out the category
		echo "<a class='animate' itemprop='category' cotnent='" . $category . "' >" . $category . "</a>";
	}
}




/**
 *
 * Return an entered MySQL timestamp date in a 'Month Day, Year' format
 *
 * @param string $date : the supplied MySQL timestamp date
 * @param format       : Month Day, Year - F d, Y
 * @return             : string containing the newly formatted date
 *
 */

function fixDate( $date ) {
	$time = strtotime( $date );
	return date( 'F d, Y', $time );
}




/**
 *
 * Return just the year from an entered MySQL timestamp date
 *
 * @param string $date : the supplied MySQL timestamp date
 * @param format       : Year - Y
 * @return             : string containing the provided dates year
 *
 */

function getYear( $date ) {
	$time = strtotime( $date );
	return date( 'Y', $time );
}




/**
 *
 * Returns a list of featured products from the MySQL database
 *
 * @param number $l : limits the number of results returned
 * @return          : list items for each product with an 'is_featured' value of 1
 *
 */

function allProducts() {

	$getMain = mysql_query( 'SELECT * FROM product_categories_main ORDER BY oid' );
	while( $main = mysql_fetch_assoc( $getMain ) ) {

		if( $main['is_visible'] == 1 ) {

			echo '<div class="all-products-main-container">';
			echo '<h1>' . $main['category'] . '</h1>';

			$getCat = mysql_query( 'SELECT * FROM product_categories_sub WHERE parent = "' . $main['selector'] . '" ORDER BY oid' );
			while( $cat = mysql_fetch_assoc( $getCat ) ) {

				echo '<ul class="products-main-sub">';
				echo '<h2>' . $cat['name'] . '</h2>';

				$getItem = mysql_query( 'SELECT * FROM product_categories_items WHERE parent = "' . $cat['selector'] . '"' );
				while( $item = mysql_fetch_assoc( $getItem ) ) {

					if($item['is_visible'] == true){
						echo '<li style="clear:both;"><a class="animate" href="'.DIR_ROOT.'products/'.$item['selector'].'">';
						if($item['is_hot'] == 1){ echo("<span class='hot-item'>hot</span>"); }
	                    if($item['is_new'] == 1){ echo("<span class='new-item'>new</span>"); }
	                    if($item['is_onsale'] == 1){ echo("<span class='sale-item'>sale</span>"); }
	                    echo $item['name'];
						echo '</a></li>';
					}

				}

				echo '</ul>';

			}

			echo '</div>';

		} else {

			// this list of products can't be seen by the public - keep it hidden, keep it safe

		}

	}

}



/**
 *
 * Returns a list of featured products from the MySQL database
 *
 * @param number $l : limits the number of results returned
 * @return          : list items for each product with an 'is_featured' value of 1
 *
 */

function featuredProducts( $l ) {
	// set counter to zero
	$i = 0;
	// select all products with an 'is_featured' value of 1
	$a = mysql_query( 'SELECT * FROM product_categories_items WHERE is_featured = 1 ORDER BY rand()' );
	// perform a check on every returned product
	while( $ab = mysql_fetch_assoc( $a ) ) {
		// initialize counter
		$i++;
		if( $i > $l ) {
			// number of results has exceeded limit - stop returning results
		} else {
			// the number of results has no yet exceeded the limit - return the results
			// get the sub category and main category of the returned product
			$b = mysql_query( 'SELECT * FROM product_categories_sub WHERE selector = "' . $ab['parent'] . '"' );
			$ba = mysql_fetch_assoc($b);
			// create the image path for the returned products thumbnail
			$path = DIR_IMAGES . '_products/' . $ba['parent'] . '/' . $ab['parent'] . '/' . $ab['selector'] . '/' . $ab['thumbnail'];
			// echo out the elements containing the results information if it's allowed to be publicly shown
			if($ab['is_visible'] == 1){
				echo "<li class='related-product'>
						<a href='".DIR_ROOT.$ab['selector']."'>
			            <img alt='Featured product: ".$ab['name']."' src='".$path."'/>
			            </a>
			            <h2><a class='animate' href='".DIR_ROOT.$ab['selector']."'>";
			            if($ab['is_hot'] == 1){ echo("<span class='hot-item'>hot</span>"); }
			            if($ab['is_new'] == 1){ echo("<span class='new-item'>new</span>"); }
			            if($ab['is_onsale'] == 1){ echo("<span class='sale-item'>sale</span>"); }
			    echo $ab['name'];
			    echo "</a></li>";
			} else {
				// the product is not supposed to be shown - keep it hidden, keep it safe
			}
	    }
	}
}




/**
 *
 * Returns a list of products that are similar to the provided product
 *
 * @param string $selector : the selector for the provided product
 * @param number $limit    : the limit of products to show. defaults to 9
 * @return                 : list items for each product related to the selector
 *
 */

function relatedProducts( $selector, $limit = 9 ) {
	// select the provided product from the database
	$a = mysql_query( 'SELECT * FROM product_categories_items WHERE selector = "' . $selector . '"' );
	$ab = mysql_fetch_assoc( $a );
	// explode related products into an array
	$b = explode( ', ', $ab['related'] );
	// randomize the array to mix things up a bit
	$c = array_rand( $b, count( $b ) );
	// set counter to -1
	$i = -1;
	// make sure there are related products to show
	if( count( $b ) > 1 ) {
		// return each related product
		foreach( $c as $d ){
			// initialize counter
			$i++;
			// make sure we don't go over the limit
			if( $i <= $limit || $limit == 0 ) {
				// the limit hasn't been reached - keep going
				// get the selector for this product
				$selector = $b[$c[$i]];
				// select the current related product from the database
				$getRelated = mysql_query( 'SELECT * FROM product_categories_items WHERE selector = "' . $selector . '"' );
				$related = mysql_fetch_assoc($getRelated);
				// select the sub category and main category of the current related product
				$getCategory = mysql_query( 'SELECT * FROM product_categories_sub WHERE selector = "' . $related['parent'] . '"' );
				$category = mysql_fetch_assoc($getCategory);
				// check if the product has a thumbnail
				if( $related['thumbnail'] == 'null' ) {
					// no thumnail - use the default
					$path = DIR_IMAGES . '_products/product-thumb.jpg';
				} else {
					// has a thumbnail - use that sucker!
					$path = DIR_IMAGES . '_products/' . $category['parent'] . '/' . $related['parent'] . '/' . $selector . '/' . $related['thumbnail'];
				}
				// echo out the elements containing the results information if it's allowed to be public
				if($related['is_visible'] == 1){
					echo "<li class='related-product'>
							<a class='animate' href='".DIR_ROOT.$related['selector']."'>
			                <img alt='".$ab['name']." related product: ".$related['name']."' src='".$path."'/>
			                </a><h2><a class='animate' href='".DIR_ROOT.$related['selector']."'>";
			                if($related['is_hot'] == 1){ echo("<span class='hot-item'>hot</span>"); }
			                if($related['is_new'] == 1){ echo("<span class='new-item'>new</span>"); }
			                if($related['is_onsale'] == 1){ echo("<span class='sale-item'>sale</span>"); }
			        echo $related['name'];
			        echo "</a></li>";
		    	} else {
		    		// the product isn't meant to be public - keep it hidden
		    	}
		    } else {
		    	// limit was reached - don't return any more products
		    }
		}
	} else {
		// there are no products to show
		echo "<li><p>No related products to show at this time</p></li>";
	}
}




/**
 *
 * Grab the text for the provided slide image
 *
 * @param string $source   : determines if its a product or package. default: product [product | package]
 * @param string $selector : the selector for the provided slide text
 * @param number $slide    : the identifying number for the slide to grab text for
 * @return                 : large text for the selected slide
 *
 */

function slideText( $source = 'product', $selector, $slide ) {
	// select the product text from the supplied slide
	$getSlide = mysql_query( "SELECT * FROM product_slides WHERE is_visible = 1 AND selector = '" . $selector . "' AND slide = '" . $slide . "'" );
	// check the number of slides returned
	if( mysql_num_rows( $getSlide ) > 0 ) {
		// a slide was found - continue
		// return the slides information
		$slides = mysql_fetch_assoc( $getSlide );
		// echo out the slides text
		echo "<h1 class='product-slide-header'>" . $slides['copy'] . "</h1>";
	} else {
		// no slides were dount - kill the function
	}
}




/**
 *
 * Generate a slideshow of images for the provided product
 *
 * @param string $source   : determines if its a product or package. default: product [product | package]
 * @param string $selector : the selector for the provided product
 * @param number $limit    : set the limit of slides to show
 * @return                 : slides from the products image directory
 *
 */

function slides( $source = 'product', $selector, $limit ) {

	echo "<div class='slides-timer'>";
		echo "<div class='slides-elapsed'></div>";
	echo "</div>";

	// check the slide source
	if( $source == 'product' ) {
		// pull slides for the product
		// select the provided product from the database
		$getProduct = mysql_query( 'SELECT * FROM product_categories_items WHERE selector = "' . $selector . '"' );
		$product = mysql_fetch_assoc($getProduct);
		// get the products sub category and main category
		$getParent = mysql_query( 'SELECT * FROM product_categories_sub WHERE selector = "' . $product['parent'] . '"' );
		$parent = mysql_fetch_assoc($getParent);
		$slideTitle = "";
		// get the directory for the products slide images
		$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_slides/';
	}elseif( $source == 'category' ) {
		// select the provided product from the database
		$getProduct = mysql_query( 'SELECT * FROM product_categories_main WHERE url = "' . $selector . '"' );
		$product = mysql_fetch_assoc($getProduct);
		// get the directory for the products slide images
		$path = './_assets/_images/_products/' . $product['selector'] . '/_slides/';
	}elseif( $source == 'sub' ) {
		// pull slides for the product
		// select the provided product from the database
		$getProduct = mysql_query( 'SELECT * FROM product_categories_sub WHERE url = "' . $selector . '"' );
		$product = mysql_fetch_assoc($getProduct);
		// get the directory for the products slide images
		$path = './_assets/_images/_products/' . $product['parent'] . '/' . $product['selector'] . '/_slides/';
	}
	// set counter to 0
	$i = 0;
	// check that the directory exists
	if( is_dir( $path ) ) {
		// directory exists - open the directory
		$handle = opendir( $path );
		// perform check for each slide
		while( $slide = readdir( $handle ) ) {
			// check if slide is an image or directory
			if( $slide != "." && $slide != ".." && $slide != "Thumbs.db" ) {
				// the slide is an image - show that sucker!
				// initialize counter
				$i++;
				// get the extension of the current slide
				$ext = '.' . end( explode( '.', $slide ) );
				$imgsource = str_replace('./_assets/_images/', DIR_IMAGES, $path) . $product['selector'] . '-slide-' . $i . $ext;
				// the limit is set to 0

				$imagepath = str_replace('./_assets/_images/', DIR_IMAGES, $path);
				$iamgesrc = $product['selector'] . '-slide-' . $i . $ext;

				$getSlideTitle = mysql_query("SELECT * FROM product_slides WHERE is_visible = 1 AND selector = '".$selector."' AND slide = '".$i."'");
				$slideTitle = mysql_fetch_assoc($getSlideTitle);

				if( $limit == 0 ) {
					// echo out the slide
					echo "<div class='slide animate slow' data-slide='" . $i . "'>";

						if($slideTitle['title'] != ""){
						echo "<div class='product-slide-info'>
					                     	<h1 class='main-product-slide-cat'>".$slideTitle['title']."</h1>
					                     	<div class='product-slide-buttons'>
					                            <a class='product-slide-link' href='".DIR_ROOT.$slideTitle['link']."'>More Information <i class='fa fa-angle-right'></i></a>
					                            <a class='product-slide-link fill get-quote-plox'>Get a Quote <i class='fa fa-angle-right'></i></a>
					                     	</div>
					                     </div>";
					            }

						// echo the slides text out
						echo slideText( $source, $selector, $i );
						echo "<img class='";
						if( SET_LAZY_LOAD == 'true' ) {
							echo "lazy";
						}
						echo "' src='" . $imgsource . "' />";
					echo "</div>";
				} else {
					// the limit is greater than 0
					if( $i > $limit ) {
						// number of results has exceeded limit - stop returning results
					} else {
						// echo out the slide
						echo "<div class='slide animate slow' data-slide='" . $i . "'>";

							if($slideTitle['title'] != ""){
							echo "<div class='product-slide-info'>
						                     	<h1 class='main-product-slide-cat'>".$slideTitle['title']."</h1>
						                     	<div class='product-slide-buttons'>
						                            <a class='product-slide-link' href='".DIR_ROOT.$slideTitle['link']."'>More Information <i class='fa fa-angle-right'></i></a>
						                            <a class='product-slide-link fill get-quote-plox'>Get a Quote <i class='fa fa-angle-right'></i></a>
						                     	</div>
						                     </div>";
						            }

							// echo the slides text out
							echo slideText( $source, $selector, $i );
							echo "<img class='";
							if( SET_LAZY_LOAD == 'true' ) {
								if($i > 1){
									echo "lazy";
								}
							}
							echo "' src='serve.php?source=".image_crypt('encrypt', $path)."&image=".image_crypt('encrypt', $imagesrc)."&thumb=1' />";
						echo "</div>";
					}
				}
			}
		}
		// close connection to the directory
		closedir( $handle );
	} else {
		// directory does not exist - show placeholder image
		echo "<div class='slide animate slow";
		if( SET_LAZY_LOAD == 'true' ) {
			echo " lazy";
		}
		echo "'><img src='http://placehold.it/1900x650' /></div>";
	}

}




/**
 *
 * Generate a slideshow of images for the provided directory
 *
 * @param string $dir   : the directory that contains the slides
 * @param number $limit : set the limit of slides to show
 * @return              : slides from the provided directory
 *
 */

function pageSlides( $dir, $limit ) {
	// set counter to 0
	$i = 0;
	// set the path for the slides
	$path = '../_assets/_images/' . $dir . '/_slides/';
	// check if the directory exists
	if( is_dir( $path ) ) {
		// directory exists - open it
		$handle = opendir( $path );
		// perform check for each slide found
		while( $slide = readdir( $handle ) ) {
			// check if slide is image or directory
			if( $slide != '.' && $slide != '..' && $slide != "Thumbs.db" ) {
				// the slide is an image - show that sucker!
				// initialize counter
				$i++;
				$imgsource = DIR_IMAGES . $dir . '/_slides/' . $slide;
				$imgdir = DIR_IMAGES . $dir . '/_slides/';
				// the limit is set to 0
				if( $limit == 0 ) {
					// echo out the slide
					echo "<div class='slide animate slow' data-slide='" . $i . "'>";
					echo "<img ";
					if($i > 1){
						echo "class='lazy' ";
					}
					echo "src='./serve.php?source=".image_crypt('encrypt', $imgdir)."&image=".image_crypt('encrypt', $slide)."&thumb=1' /></div>";
				} else {
					// the limit is greater than 0
					if( $i > $limit ) {
						// number of results has exceeded limit - stop returning results
					} else {
						// echo out the slide
						if( $dir == "_about" ) {
							echo "<div class='slide animate slow' data-slide='" . $i . "'><img class='lazy' src='../serve.php?source=".image_crypt('encrypt', $imgdir)."&image=".image_crypt('encrypt', $slide)."&thumb=1' /></div>";
						} else {
							echo "<div class='slide animate slow' data-slide='" . $i . "'><img class='lazy' src='./serve.php?source=".image_crypt('encrypt', $imgdir)."&image=".image_crypt('encrypt', $slide)."&thumb=1' /></div>";
						}
					}
				}
			}
		}
		// close connection to the directory
		closedir( $handle );
	} else {
		// directory does not exist - show placeholder image
		echo "<div class='slide animate slow'><img class='lazy' src='http://placehold.it/1900x650' /></div>";
	}
}




/**
 *
 * Generate a product rating out of 5 stars
 *
 * @param string $source   : determines if its a product or package. default: product [product | package]
 * @param string $selector : the selector for the product being rated
 * @return                 : products rating
 *
 */

function rating( $source = 'product', $selector ) {
	// select the product needing the rating
	if( $source == 'product' ) {
		$getRatings = mysql_query( 'SELECT * FROM product_ratings WHERE selector = "' . $selector . '"' );
	} else {
		$getRatings = mysql_query( 'SELECT * FROM package_ratings WHERE selector = "' . $selector . '"' );
	}
	// get the total number of ratings on this product
	$numRatings = mysql_num_rows( $getRatings );
	// set the initial sum to 0
	$sumRatings = 0;
	// update the sum for each product rating found
	while( $return = mysql_fetch_assoc( $getRatings ) ) {
		// the sum equals the previous sum plus this sum
		$sumRatings = $sumRatings + $return['rating'];
	}
	// get the average rating - divide number of ratings by the sum
	$average = round( $sumRatings / $numRatings );
	// check if the average is somehow greater than 5 stars
	if( $average > 5 ) {
		// the average somehow managed to be greater than 5 - set it back to 5 stars
		$average = 5;
	}
	// create an array with the rating info [average, number of ratings]
	$ratingInfo = array('average' => $average, 'ratings' => $numRatings);
	// return the array
	return $ratingInfo;
}




/**
 *
 * Create the visual star ratings for the product
 *
 * @param number $rating : the number of stars to print out of 5
 * @return               : products rating
 *
 */

function printStars( $rating ) {
	// echo out 5 star elements
	for( $i = 0; $i < 5; $i++ ) {
		// open up the star element
		echo "<li class='fa fa-lg fa-star animate";
		if( $i < $rating ) {
			// add 'filled' class to each star less than than the products rating
			echo ' filled';
		}
		// close up the star element
		echo"' data-star='".( $i+1 )."'></li>";
	}
}




/**
 *
 * Create a timeline of HPI past events ordered by date
 *
 * @return : events list
 *
 */

function timeline() {
	// get each timeline event
	$getEvents = mysql_query( 'SELECT * FROM about_timeline ORDER BY date DESC' );
	// echo out each event onto the timeline
	while( $event = mysql_fetch_assoc( $getEvents ) ) {
		// open up that event element
		echo "<div class='timeline-event'>";
		echo "<h2>" . $event['event'] . "</h2>";
		echo "<label><i class='fa fa-clock-o'></i>" . fixDate( $event['date'] ) . "</label>";
		// check if the event has a thumbnail
		if( $event['event_thumbnail'] == 'null') {
			// event has no thumbnail - don't show one
		} else {
			// event has a thumbnail! - show that sucker!
			echo "<img src='" . $event['event_thumbnail'] . "' />";
		}
		echo "<p>" . $event['description'] . "</p>";
		echo "</div>";
		// close up that event element
	}
}




/**
 *
 * Create a list of testimonials that have been approved
 *
 * @param string $selector : select testimonials for selected product - default = null
 * @param number $limit    : limit the number of testionials to be shown
 * @return                 : testimonials
 *
 */

function testimonials( $source = 'product', $selector = null, $limit ) {
	// set counter to zero
	$i = 0;
	// select all testimonials that are approved and visible
	if( $source == 'all' || $source == 'product' ) {
		if( $selector == null ) {
			// no secific product selector - don't limit the selection
			$getTestimonials = mysql_query( 'SELECT * FROM product_testimonials WHERE is_approved = 1 AND is_visible = 1 ORDER BY rand()' );
		} else {
			// limit the selection to the selected product
			$getTestimonials = mysql_query( 'SELECT * FROM product_testimonials WHERE is_approved = 1 AND is_visible = 1 AND selector = "' . $selector . '" ORDER BY rand()' );
		}
	} elseif ( $source == 'package' ) {
		if( $selector == null ) {
			// no secific product selector - don't limit the selection
			$getTestimonials = mysql_query( 'SELECT * FROM product_packages_testimonials WHERE is_approved = 1 AND is_visible = 1 ORDER BY rand()' );
		} else {
			// limit the selection to the selected product
			$getTestimonials = mysql_query( 'SELECT * FROM product_packages_testimonials WHERE is_approved = 1 AND is_visible = 1 AND selector = "' . $selector . '" ORDER BY rand()' );
		}
	}
	// count the number of testimonials available
	$count = mysql_num_rows( $getTestimonials );
	// add controls if there's more than one testimonial
	if( $count > 1 ) {
		echo "<a class='tst-ctrl testimonial-ctrl-left' id='left'><i class='fa fa-lg fa-chevron-left'></i></a>";
		echo "<a class='tst-ctrl testimonial-ctrl-right' id='right'><i class='fa fa-lg fa-chevron-right'></i></a>";
	}
	// make sure there is at least one testimonial to show
	if( $count >= 1 ) {
		// check each testimonial that's found
		while( $testimonial = mysql_fetch_assoc( $getTestimonials ) ) {
			// initialize counter
			$i++;
			if( $i > $limit ) {
				// number of results has exceeded limit - stop returning results
			} else {
				// check if the user has ana avatar
				if( $testimonial['avatar'] == 'null' ) {
					// no set avatar - use gravatar
					$avatar = gravatar( $testimonial['email'] );
				} else {
					// the user has an avatar - use it
					$avatar = DIR_IMAGES . '_misc/_avatars/' . $testimonial['avatar'];
				}
				// number of results hasn't exceeded the limit yet - return results
				echo "<div class='testimonial ";
				// check if it's the first testimonial
				if( $i == 1 ){
					// first testimonial - make it active
					echo "active ";
				}
				// if the count is less than one, add 'full' class
				if( $count <= 1 ) {
					echo "full ";
				}
				echo "' id='testimonial-" . $i . "'>";
				echo "<div class='testimonial-badge'>";
					echo "<img alt='Customer testimonial: " . $testimonial['name'] . "' src='" . $avatar . "' />";
				echo "</div>";
				echo "<div class='testimonial-content'>";
					echo "<b>" . $testimonial['name'] . ", <label>" . $testimonial['position'] . " <i>at</i> <a href='" . $testimonial['website'] . "' target='new'>" . $testimonial['company'] . "</a></label></b>";
					// add product name above testimonial if it has one
					if( $testimonial['selector'] != 'null' ) {
						$getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $testimonial['selector'] . "'" );
						$product = mysql_fetch_assoc( $getProduct );
						echo "<a class='testimonial-link animate' href='" . DIR_ROOT . "products/" . $product['selector'] . "'><i class='fa fa-tag'></i>" . $product['name'] . "</a>";
					}
					echo "<p>" . $testimonial['testimonial'] . "</p>";
				echo "</div>";
				echo "</div>";
			}
		}
	} else {
		// there aren't any testimonials
	}
}




/**
 *
 * Create a list of testimonials for the sidebar that have been approved
 *
 * @param string $selector : select testimonials for selected product - default = null
 * @param number $limit    : limit the number of testionials to be shown
 * @return                 : sidebar testimonials
 *
 */

function productTestimonials( $selector = null, $limit = 3 ) {
	// set counter to zero
	$i = 0;
	// select all testimonials that are approved and visible
	if( $selector == null ) {
		// no secific product selector - don't limit the selection
		$getTestimonials = mysql_query( 'SELECT * FROM product_testimonials WHERE is_approved = 1 AND is_visible = 1 ORDER BY rand()' );
	} else {
		// limit the selection to the selected product
		$getTestimonials = mysql_query( 'SELECT * FROM product_testimonials WHERE is_approved = 1 AND is_visible = 1 AND selector = "' . $selector . '" ORDER BY rand()' );
	}
	// check each testimonial that's found
	while( $testimonial = mysql_fetch_assoc( $getTestimonials ) ) {
		// initialize counter
		$i++;
		if( $i <= $limit || $limit == 0 ) {
			// number of results hasn't exceeded limit - return results
			// check if the user has ana avatar
			if( $testimonial['avatar'] == 'null' ) {
				// no set avatar - use gravatar
				$avatar = gravatar( $testimonial['email'] );
			} else {
				// the user has an avatar - use it
				$avatar = DIR_IMAGES . '_misc/_avatars/' . $testimonial['avatar'];
			}
			// echo out the testimonials
			echo "<div class='testimonial-side' id='testimonial-" . $i . "' itemprop='review' itemscope itemtype='http://data-vocabulary.org/Review-aggregate'>";
				echo "<div class='testimonial-badge'>";
					echo "<img alt='Product testimonial by " . $testimonial['name'] . "' src='" . $avatar . "' />";
				echo "</div>";
				echo "<div class='testimonial-content'>";
					echo "<b>" . $testimonial['name'] . ", <label> <a class='animate' href='" . $testimonial['website'] . "' target='new'>" . $testimonial['company'] . "</a></label></b>";
					echo "<p>" . $testimonial['testimonial'] . "</p>";
				echo "</div>";
			echo "</div>";
		} else {
			// we've exceeded the limit - stop returning testimonials
		}
	}
	// there are no testimonials for this product - hella lame!
	if( mysql_num_rows( $getTestimonials ) == 0 ) {
		echo "<p>It looks like no one has written a testimonial for this product yet. Be the first one to write a review!</p>";
	}
}




/**
 *
 * Create a list of product features with images
 *
 * @param string $source   : determines if its a product or package. default: product [product | package]
 * @param string $selector : select features for the selected product
 * @param number $limit    : limit the number of features to be shown
 * @return                 : list of features
 *
 */

function features( $source = 'product', $selector, $limit = 0 ) {
	// set feature counter to zero
	$i = 0;
	// select feature info for the selector
	$getFeatures = mysql_query( "SELECT * FROM product_features WHERE is_visible = 1 ORDER BY oid ASC" );
	// get product information based on the current feature
	$getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $selector . "'" );
	$product = mysql_fetch_assoc( $getProduct );
	// get the products parent information
	$getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $product['parent'] . "'" );
	$parent = mysql_fetch_assoc( $getParent );
	// perform check on each found feature
	while( $feature = mysql_fetch_assoc( $getFeatures ) ) {
		// explode parents into an array
		$parents = explode( ', ', $feature['parent'] );
		if( in_array( $selector, $parents ) ) {
			// initialize feature counter
			$i++;
			// make sure we haven't exceeded the limit
			if( $i <= $limit || $limit == 0 ) {
				// we haven't gone over the limit yet - keep going
				// get the directory for the features images
				$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/';
				// check that the directory exists
				if( is_dir( $path ) ) {
					// set image counter to zero
					$j = 0;
					// the features image directory exists
					$handle = opendir( $path );
					// perform check for each image found
					while( $image = readdir( $handle ) ) {
						// check if file is image or directory
						if( $image != '.' && $image != '..' && $image != "Thumbs.db" ) {
							// initialize image counter
							$j++;
						}
					}
					// close connection to the directory
					closedir( $handle );
				} else {
					// the features image directory does not exist
				}
				if($feature['is_header'] == 1){
					//echo "<li class='header";
					//echo "' data-feature='".$feature['selector']."' id='feature-" . $i . "'>";
					//echo "<div class='feature-info'>";
						echo '<h2 class="feature-header">' . $feature['name'] . "</h2>";
						//echo "<p>" . $feature['description'] . "</p>";
					//echo "</div>";
				//echo "</li>";
				} else {
				// echo out each feature as a list item
				echo "<li class='feature";
				if($feature['has_video'] == 1){
					echo ' video';
				}
				echo "' data-feature='".$feature['selector']."' id='feature-" . $i . "'>";
					echo "<div class='media-container ft small animate";
					// check if it's a collection of images or just one
					if( $j > 1 ) {
						// is a collection, add class
						/* echo " collection"; */
					}
					if( $j == 0 ) {
						// set thumbnail to default placeholder
						$imgsrc = DIR_IMAGES . '_products/product-thumb.jpg';
						$image_dir = DIR_IMAGES . '_products/';
						$image_src = 'product-thumg.jpg';
					} else {
						// set thumbnail source to first image in directory
						$imgsrc = DIR_IMAGES . '_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/' . $feature['selector'] . '-1.jpg';
						$image_dir = DIR_IMAGES . '_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/';
						$image_src = $feature['selector'] . '-1.jpg';
					}
					echo"'>";
						echo "<a class='image-container animate'>";
							// echo "<i class='animate fa fa-lg fa-picture-o'></i>";
							// echo "<span class='animate'>View Image";
							// plural or singular images?
							// if( $j > 1 ) {
								// echo "s";
							// }
							// echo "</span>";
							echo "<img alt='" . $product['name'] . " Feature - " . $feature['name'] . "' class='animate lb";
							if( SET_LAZY_LOAD == 'true' ) {
								echo " lazy";
							}
							echo "' data-group='" . $selector . "-features' data-id='" . $i . "' data-source='serve.php?source=".image_crypt('encrypt', $image_dir)."&image=".image_crypt('encrypt', $image_src)."&thumb=1' src='serve.php?source=".image_crypt('encrypt', $image_dir)."&image=".image_crypt('encrypt', $image_src)."&thumb=1' />";
						echo "</a>";
						if($feature['has_video'] == 1){
							echo "<a class='feature-video lb video' data-type='".$feature['video_type']."' data-code='".$feature['video_code']."'><span class='fa fa-play'></span>Video Demonstration</a>";
						}
					echo "</div>";
					echo "<div class='feature-info'>";
						echo "<h2>" . $feature['name'] . "</h2>";
						echo "<p>" . $feature['description'] . "</p>";
					echo "</div>";
				echo "</li>";
				$GLOBALS['feat_data_id'] = $i;
			} }else {
			// we've gone over the limit - stop returning features
				$GLOBALS['feat_data_id'] = $i;
		}
		} else {
			// feature does not match this product - do nothing
		}
	}
}




/**
 *
 * Generate a gallery of thumbnails for the provided product
 *
 * @param string $source   : determines if its a product or package. default: product [product | package]
 * @param string $selector : select gallery images for the selected product
 * @param number $limit    : limit the number of images to be shown - default = 9
 * @return                 : products thumbnail gallery
 *
 */

function galleryThumbs( $source = 'product', $selector, $limit = 15 ) {
	if( $source == 'product' ) {
		// select the product from the database
		$getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $selector . "'" );
		$product = mysql_fetch_assoc( $getProduct );
		// get the products parent information
		$getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $product['parent'] . "'" );
		$parent = mysql_fetch_assoc( $getParent );
		// set the path for the products gallery
		$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
	} else if ( $source = 'category' ) {
		// select the product from the database
		$getProduct = mysql_query( "SELECT * FROM product_categories_sub WHERE url = '" . $selector . "'" );
		$product = mysql_fetch_assoc( $getProduct );
		// set the path for the products gallery
		$path = './_assets/_images/_products/' . $product['parent'] . '/' . $product['selector'] . '/_gallery/';
	} else if ( $source = 'package' ) {
		// select the package from the database
		$getPackage = mysql_query( "SELECT * FROM product_packages WHERE selector = '" . $selector . "'" );
		$package = mysql_fetch_assoc( $getPackage );
		$path = './_assets/_images/_packages/' . $package['selector'] . '/_gallery/';
	} else if ( $source = 'custom' ) {
		// select the custom product from the database
		$getCustom = mysql_query( "SELECT * FROM product_custom WHERE selector = '" . $selector . "'" );
		$custom = mysql_fetch_assoc( $getCustom );
		$path = './_assets/_images/_products/custom/' . $custom['selector'] . '/_gallery/';
	}

	// check if the path exists
	
	$i = 0;
	$dir = opendir($path);
	$list = array();
	while($file = readdir($dir)){
		if($file != "." and $file != ".." and $file != "Thumbs.db"){
			$ctime = filectime($data_path . $file) . "," . $file;
			$list[$ctime] = $file;
		}
	}
	closedir($dir);
	krsort($list);

	foreach($list as $image){
		$i++;
		if($i <= $limit){
			echo "<a class='side-gallery-img dv-3'>";
				echo "<div class='image animate'>";
					echo "<img alt='' class='animate lb";
					if( SET_LAZY_LOAD == 'true' ) {
						echo " lazy";
					}
					echo "' data-group='" . $selector . "' data-id='" . $i . "' data-source='./serve.php?source=".image_crypt('encrypt', $path)."&image=".image_crypt('encrypt', $image)."&thumb=1' itemprop='image' src='./serve.php?source=".image_crypt('encrypt', $path)."&image=".image_crypt('encrypt', $image)."&thumb=1' />";
				echo "</div>";
			echo "</a>";
		}else{

		}
	}

	if($i > $limit){
		echo "<span class='categories'><a class='animate' href='".DIR_ROOT."gallery/".$selector."'>View More Images</a></span>";
	}

}




/**
 *
 * Display a video player for the selected product | package
 *
 * @param string $source   : determines if its a product or package. default: product [product | package]
 * @param string $selector : select video for the product | package
 * @return                 : embedded video player
 *
 */

function showVideo( $source = 'product', $selector ) {
	// select videos for the product
	if( $source == 'product' ) {
		$getVideos = mysql_query( "SELECT * FROM product_videos WHERE is_visible = 1 AND selector = '" . $selector . "' LIMIT 1" );
	} elseif( $source == 'package' ) {
		$getVideos = mysql_query( "SELECT * FROM product_packages_videos WHERE is_visible = 1 AND selector = '" . $selector . "' LIMIT 1" );
	} elseif( $source == 'sub' ) {
		$getVideos = mysql_query( "SELECT * FROM product_categories_sub WHERE url = '" . $selector . "' LIMIT 1" );
	}
	$video = mysql_fetch_assoc( $getVideos );
	// check if the product has any videos
	if( mysql_num_rows( $getVideos ) > 0 ) {
		// the product has a video!
		// embed a youtube video player
		if( $video['type'] == 'youtube' ) {
			echo "<iframe class='player youtube' width='100%' height='0' src='//www.youtube.com/embed/" . $video['code'] . "?rel=0&wmode=transparent' frameborder='0' allowfullscreen></iframe>";
		}
		// embed a vimeo video player
		if( $video['type'] == 'vimeo' ) {
			echo "<iframe class='player vimeo' src='//player.vimeo.com/video/" . $video['code'] . "?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff' width='100%' height='0' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
		}
	} else {
		// the product has no videos - do nothing
	}
}




/**
 *
 * Show financing banner if product is financed
 *
 * @param number $status : status of financing. defaults to '0' [0 | 1]
 * @return               : financing banner if available
 *
 */

function isFinanced( $status = 0 ) {
	// check the status
	if( $status == 0 ) {
		// status is zero - show nothing
	} else {
		// status is one - show banner
		echo "<div class='financing-banner'>";
			echo "<label>Financing Available</label>";
		echo "</div>";
	}
}

?>