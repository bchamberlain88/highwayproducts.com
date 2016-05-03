<?php

/**
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

/**
 *
 * Get filemtime by remote link instead of relative
 *
 * @param string $uri : link to asset to get filemtime of
 *
 */

function filemtime_remote($uri)
{
    $uri = parse_url($uri);
    $handle = @fsockopen($uri['host'],80);
    if(!$handle)
        return 0;

    fputs($handle,"GET $uri[path] HTTP/1.1\r\nHost: $uri[host]\r\n\r\n");
    $result = 0;
    while(!feof($handle))
    {
        $line = fgets($handle,1024);
        if(!trim($line))
            break;

        $col = strpos($line,':');
        if($col !== false)
        {
            $header = trim(substr($line,0,$col));
            $value = trim(substr($line,$col+1));
            if(strtolower($header) == 'last-modified')
            {
                $result = strtotime($value);
                break;
            }
        }
    }
    fclose($handle);
    return $result;
}


/**
 *
 * Check for page urls set to be redirected
 *
 * @param string $host : combination of $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
 *
 */

function checkForRedirects($host) {
	if($host == $_SERVER['SERVER_NAME'] . '/order/') {
 		redirect('contact');
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/testimonials/') {
 		redirect('reviews');
 	}
}


/**
 *
 * Create acronym out of string
 *
 * @param string $name : string to create acronym out of
 *
 */

function makeAcro($name) {
	$words = explode(" ", $name);
	$acronym = "";
	foreach ($words as $w) {
	  $acronym .= $w[0];
	  $acronym = strtoupper($acronym);
	}
	return $acronym;
}

/**
 *
 * Redirect to a specific page
 *
 * @param string $url : url to redirect to
 *
 */

function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . DIR_ROOT . $url . '"';
    $string .= '</script>';
    header( 'HTTP/1.1 301 Moved Permanently' );
    echo $string;
    die;
}

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
 	if($selector == 'pro-pickup-pack') {
 		redirect('pickup-pack-standard');
 	}
 	if($pageType == 'product'){
 		$checkPage = mysql_query("SELECT * FROM product_categories_items WHERE selector = '".$selector."'");
 		if(mysql_num_rows($checkPage) > 0 || strpos($_SERVER['REQUEST_URI'],'sent') !== false){
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
 					//set selector-specific redirects here
 					if($selector == 'pro-pickup-pack')
 					{
 						redirect('pickup-pack-standard');
 					}
 					if($selector == 'custom-storage-boxes')
 					{
 						redirect('custom-tool-box');
 					}
 					// the product does not exist, 404 error
 					header( 'HTTP/1.1 404 Not Found' );
					// header( 'Location: ' . DIR_ROOT . 'error/404/' );
					redirect('error/404/');
				}
			}
 		}
 	}
 }

/**
 *
 * Check for set meta title attribute for page
 * 
 *
 * @param string $product_selector : current url of the page minus the directory root
 * @return : meta title for page
 *
 */

function titleExists($product_selector) {
	$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	if(strpos($host,'search') !== false) {
 			$pageTitle = 'Search results for: "' . $_GET['p'] . $_GET['static-search'] . '" at Highway Products'; 
 			return $pageTitle;
 		}
	$checkPage = mysql_query("SELECT * FROM product_categories_items WHERE selector = '".$product_selector."' and meta_title is not null"); 	
	$checkSub = mysql_query("SELECT * FROM product_categories_sub WHERE url = '".$product_selector."' and meta_title is not null"); 
	$checkCat = mysql_query("SELECT * FROM product_categories_main WHERE url = '".$product_selector."' and meta_title is not null"); 
	if(mysql_num_rows($checkPage) > 0){
		if(strpos($host,'gallery') !== false) {
 			$rCheckPage = mysql_fetch_assoc( $checkPage );
 			$pageTitle = $rCheckPage['meta_title'];
 			$pageTitle = 'Gallery | ' . $pageTitle; 
 			return $pageTitle;
 		} else {
 			$rCheckPage = mysql_fetch_assoc( $checkPage );
 			return $rCheckPage['meta_title'];
 		}
 	}
 	if(mysql_num_rows($checkSub) > 0){
 		if(strpos($host,'gallery') !== false) {
 			$rCheckSub = mysql_fetch_assoc( $checkSub );
 			$subTitle = $rCheckSub['meta_title'];
 			$subTitle = 'Gallery | ' . $subTitle; 
 			return $subTitle;
 		} else {
 			$rCheckSub = mysql_fetch_assoc( $checkSub );
 			return $rCheckSub['meta_title'];
 		}
 	}
 	if(mysql_num_rows($checkCat) > 0){
 		if(strpos($host,'gallery') !== false) {
 			$rCheckSub = mysql_fetch_assoc( $checkCat );
 			$catTitle = $rCheckPage['meta_title'];
 			$catTitle = 'Gallery | ' . $catTitle; 
 			return $catTitle;
 		} else {
 			$rCheckCat = mysql_fetch_assoc( $checkCat );
 			return $rCheckCat['meta_title'];
 		}
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/about/') {
 		return 'About Us | Highway Products, Inc';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/reviews/') {
 		return 'Reviews | Highway Products, Inc';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/order/') {
 		return 'How to Buy | Highway Products, Inc';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/warranty/') {
 		return 'Warranty | Highway Products, Inc';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/contact/') {
 		return 'Contact Us | Highway Products, Inc';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/closeout/') {
 		return 'Closeout Section | Highway Products, Inc';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/careers/') {
 		return 'Careers | Highway Products, Inc';
 	}
}

/**
 *
 * Check for set meta description attribute for page
 * 
 *
 * @param string $product_selector : current url of the page minus the directory root
 * @return : meta title for page
 *
 */

function descExists($product_selector) {
	$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	if(strpos($host,'search') !== false) {
		$pageDesc = 'Search results for: \'' . $_GET['p'] . '\' at Highway Products';
		return $pageDesc;
	}
	$checkPage = mysql_query("SELECT * FROM product_categories_items WHERE selector = '".$product_selector."' and meta_title is not null"); 	
	$checkSub = mysql_query("SELECT * FROM product_categories_sub WHERE url = '".$product_selector."' and meta_title is not null"); 
	$checkCat = mysql_query("SELECT * FROM product_categories_main WHERE url = '".$product_selector."' and meta_title is not null"); 
	if(mysql_num_rows($checkPage) > 0){
		if(strpos($host,'gallery') !== false) {
 			$rCheckPage = mysql_fetch_assoc( $checkPage );
 			$pageDesc = $rCheckPage['meta_description'];
 			$pageDesc = $pageDesc . ' Here you will find videos and pictures of this product.';
 			return $pageDesc;
 		} else {
 			$rCheckPage = mysql_fetch_assoc( $checkPage );
 			return $rCheckPage['meta_description'];
 		}
 	}
 	if(mysql_num_rows($checkSub) > 0){
 		if(strpos($host,'gallery') !== false) {
 			$rCheckSub = mysql_fetch_assoc( $checkSub );
 			$subDesc = $rCheckSub['meta_description'];
 			$subDesc = $subDesc . ' Here you will find videos and pictures of this product.';
 			return $subDesc;
 		} else {
 			$rCheckSub = mysql_fetch_assoc( $checkSub );
 			return $rCheckSub['meta_description'];
 		}
 	}
 	if(mysql_num_rows($checkCat) > 0){
 		if(strpos($host,'gallery') !== false) {
 			$rCheckCat = mysql_fetch_assoc( $checkCat );
 			$catDesc = $rCheckCat['meta_description'];
 			$catDesc = $catDesc . ' Here you will find videos and pictures of this product.';
 			return $catDesc;
 		} else {
 			$rCheckCat = mysql_fetch_assoc( $checkCat );
 			return $rCheckCat['meta_description'];
 		}
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/about/') {
 		return 'Our diverse product lines include standard and custom lines of semi as well as pickup truck boxes, cab protectors, guards, truck flatbeds, RV tow bodies, ramps, cargo slides, and service bodies as well. We are the leader and very well known for our custom capability.';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/contact/') {
 		return "Do you have any questions or comments about our products or services? Don't hold back! Our sales team is happy to help with any concerns you may have. Just fill out the form below and press the submit button to send your message off to us, and we will respond to your message as soon as we can!";
 	}
 	 if($host == $_SERVER['SERVER_NAME'] . '/order/') {
 		return 'Placing a custom order is as easy as filling out an online form, and sending it to one of our sales representatives!';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/reviews/') {
 		return 'Here at Highway Products Inc. we do out best to make our customers happy! Here is what some of those customers have to say.';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/warranty/') {
 		return 'Highway Products Inc. makes warranties and refunds easy! Our warranty covers everything from defects in workmanship, to lost keys!';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/closeout/') {
 		return 'Here you can view a list of our reduced-price closeout items';
 	}
 	if($host == $_SERVER['SERVER_NAME'] . '/careers/') {
 		return 'Join our team!';
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
		header( 'HTTP/1.1 301 Moved Permanently' );
		header( 'Location: ' . DIR_ROOT . $redirect['url_new'] );
	} else {
		// there is no match - see if the path exists at all
		header( 'HTTP/1.1 404 Not Found' );
		header( 'Location: ' . DIR_ROOT . '404' );
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
	$url .= '?s='. $s . '&amp;d=' . $d . '&amp;r=' . $r;
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
			    echo "</a></h2></li>";
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
				//trim selector so leading / trailing spaces do not break query
				$selectorTrimmed = trim($selector);
				// select the current related product from the database
				$getRelated = mysql_query( 'SELECT * FROM product_categories_items WHERE selector = "' . $selectorTrimmed . '"' );
				$related = mysql_fetch_assoc($getRelated);
				// select the sub category and main category of the current related product
				$getCategory = mysql_query( 'SELECT * FROM product_categories_sub WHERE selector = "' . $related['parent'] . '"' );
				$category = mysql_fetch_assoc($getCategory);
				if($category === false) {
					$getMainRelated = mysql_query( 'SELECT * FROM product_categories_main WHERE selector = "' . $related['parent'] . '"' );
					$mainRelated = mysql_fetch_assoc($getMainRelated);
				}
				// check if the product has a thumbnail
				if( $related['thumbnail'] == 'null' ) {
					// no thumnail - use the default
					$path = DIR_IMAGES . '_products/product-thumb.jpg';
				} elseif( $related['is_base'] == '1' )
 						{
					// base-level product
					// if main-level parent
 					if($category === false) {
					$path = DIR_IMAGES . '_products/' . $mainRelated['selector'] . '/' . $selectorTrimmed . '/' . $related['thumbnail']; } else {
					$path = DIR_IMAGES . '_products/' . $category['parent'] . '/' . $selectorTrimmed . '/' . $related['thumbnail'];
					}
				} else {
					// has a thumbnail
					$path = DIR_IMAGES . '_products/' . $category['parent'] . '/' . $related['parent'] . '/' . $selectorTrimmed . '/' . $related['thumbnail'];
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
			        echo "</a></h2></li>";
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

function slideText( $source = 'product', $selector, $slide, $financed ) {
	// select the product text from the supplied slide
	$getSlide = mysql_query( "SELECT * FROM product_slides WHERE is_visible = 1 AND selector = '" . $selector . "' AND slide = '" . $slide . "'" );
	// check the number of slides returned
	if ($financed == 1 && $slide == 1) { ?>
			<div class="product-slide-info">
                    <div class="product-slide-buttons">
                        <h1 class="main-product-slide-cat">Financing Available</h1>
                        <a class="product-slide-link financed fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                    </div><!-- product-slide-buttons -->
                </div>
                <?php }
		
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
		// select the provided product from the database
		$getProduct = mysql_query( 'SELECT * FROM product_categories_items WHERE selector = "' . $selector . '"' );
		$product = mysql_fetch_assoc($getProduct);
		// get the product's sub category and main category
		$getParent = mysql_query( 'SELECT * FROM product_categories_sub WHERE selector = "' . $product['parent'] . '"' );
		$parent = mysql_fetch_assoc($getParent);
		$slideTitle = "";
		// get the directory for the products slide images
		if($product['is_base'] == 1) {
			//if product has no sub-category
			$path = './_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_slides/';
		} else {
			$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_slides/';
		}
	}elseif( $source == 'category' ) {
		// select the provided product from the database
		$getProduct = mysql_query( 'SELECT * FROM product_categories_main WHERE url = "' . $selector . '"' );
		$product = mysql_fetch_assoc($getProduct);
		// get the directory for the products slide images
		$path = './_assets/_images/_products/' . $product['selector'] . '/_slides/';
	}elseif( $source == 'sub' ) {
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
				// the slide is an image
				// initialize counter
				$i++;
				// get the extension of the current slide
				$ext = '.' . end( explode( '.', $slide ) );
				$imgsource = str_replace('./_assets/_images/', DIR_IMAGES, $path);
				$imgname = $product['selector'] . '-slide-' . $i . $ext;
				$imagepath = str_replace('./_assets/_images/', DIR_IMAGES, $path);
				$iamgesrc = $product['selector'] . '-slide-' . $i . $ext;
				$getSlideTitle = mysql_query("SELECT * FROM product_slides WHERE is_visible = 1 AND selector = '".$selector."' AND slide = '".$i."'");
				$slideTitle = mysql_fetch_assoc($getSlideTitle);
				$placeholderSource = "data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==";
				if( $limit == 0 ) {
					// echo out the slide
					echo "<div class='slide animate slow' data-slide='" . $i . "'>";
					if($slideTitle['title'] != ""){
						echo "<div class='product-slide-info'>
					    <div class='product-slide-buttons'>
					    <h1 class='main-product-slide-cat'>".$slideTitle['title']."</h1>
					    <a class='product-slide-link' href='".DIR_ROOT.$slideTitle['link']."'>More Information <i class='fa fa-angle-right'></i></a>
					    <a class='product-slide-link fill get-quote-plox'>Get a Quote <i class='fa fa-angle-right'></i></a>
					    </div>
					    </div>";
					}
					// echo the slides text out
					if($product['is_financed'] == 1 && $i == 1) {
						echo slideText( $source, $selector, $i, 1 );
					} else {
						echo slideText( $source, $selector, $i, 0 );
					}
					echo "<img class='";
					if( SET_LAZY_LOAD == 'true' ) {
						if( $i == 1 ) {
						echo "now' alt='" . $product['meta_keywords'] . ' ' . $i . "' title='" . $product['meta_keywords'] . ' ' . $i . "' src='" . $imgsource . $imgname . '?' . filemtime_remote($imgsource . $imgname) . "' />";
					} else {
						echo "delayLoad lazy' alt='" .  $product['meta_keywords'] . ' ' . $i . "' title='" . $product['meta_keywords'] . ' ' . $i . "' src='" . $placeholderSource . "' data-original='" . $imgsource . $imgname . '?' . filemtime_remote($imgsource . $imgname) . "' />";
					} 
				}
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
					if($product['is_financed'] == 1 && $i == 1) {
						echo slideText( $source, $selector, $i, 1 );
					} else {
						echo slideText( $source, $selector, $i, 0 );
					}
					echo "<img class='";
					if( SET_LAZY_LOAD == 'true' ) {
						if($i > 1){
							echo "delayLoad lazy";
						}
					}
					echo "'alt='" . $product['name'] . "' src='" . $placeholderSource . "' data-original='" . $imgsource . "' />";
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
					echo "src='./serve.php?source=".$imgdir."&amp;image=".$slide."&amp;thumb=1' /></div>";
				} else {
					// the limit is greater than 0
					if( $i > $limit ) {
						// number of results has exceeded limit - stop returning results
					} else {
						// echo out the slide
						if( $dir == "_about" ) {
							echo "<div class='slide animate slow' data-slide='" . $i . "'><img class='lazy' alt='About Slide " . $i . "' title='About Highway Products " . $i . "' src='../serve.php?source=".$imgdir."&amp;image=".$slide."&amp;thumb=1' /></div>";
						} else {
							echo "<div class='slide animate slow' data-slide='" . $i . "'><img class='lazy' src='./serve.php?source=".$imgdir."&amp;image=".$slide."&amp;thumb=1' /></div>";
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
		echo "<li><a class='tst-ctrl testimonial-ctrl-left' id='left'><i class='fa fa-lg fa-chevron-left'></i></a></li>";
		echo "<li><a class='tst-ctrl testimonial-ctrl-right' id='right'><i class='fa fa-lg fa-chevron-right'></i></a></li>";
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
					echo "<img alt='Customer review: " . $testimonial['name'] . "' src='" . $avatar . "' />";
				echo "</div>";
				echo "<div class='testimonial-content'>";
					echo "<b>" . $testimonial['name'] . ", <label>" . $testimonial['position'] . " <i>at</i> " . $testimonial['company'] . "</label></b>";
					// add product name above testimonial if it has one
					if( $testimonial['selector'] != 'null' ) {
						$getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $testimonial['selector'] . "'" );
						$product = mysql_fetch_assoc( $getProduct );
						echo "<a class='testimonial-link animate' href='" . DIR_ROOT . $product['selector'] . "'><i class='fa fa-tag'></i>" . $product['name'] . "</a>";
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
					echo "<img alt='Product review by " . $testimonial['name'] . "' src='" . $avatar . "' />";
				echo "</div>";
				echo "<div class='testimonial-content'>";
					echo "<b>" . $testimonial['name'] . ", <label>" . $testimonial['company'] . "</label></b>";
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
				if($source == 'base_product') {
					//if it's a product with no sub, remove extra parent dir
					$path = './_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/';
				} else {
					$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/';
				}
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
					//if the item has a sub-header
					echo '<h2 class="feature-header">' . $feature['name'] . "</h2>";
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
					$image_src = 'product-thumb.jpg';
				} else {
					// set thumbnail source to first image in directory
					if($source == 'base_product') {
						//if it's a product with no sub, remove extra parent dir
						$imgThumbSrc = DIR_IMAGES . '_products/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/_thumbnails/' . $feature['selector'] . '-1_thumb.jpg';
						$imgsrc = DIR_IMAGES . '_products/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/' . $feature['selector'] . '-1.jpg';
						$image_dir = DIR_IMAGES . '_products/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/';
						$image_src = $feature['selector'] . '-1.jpg';
					} else {
						$imgThumbSrc = DIR_IMAGES . '_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/_thumbnails/' . $feature['selector'] . '-1_thumb.jpg';
						$imgsrc = DIR_IMAGES . '_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/' . $feature['selector'] . '-1.jpg';
						$image_dir = DIR_IMAGES . '_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/';
						$image_src = $feature['selector'] . '-1.jpg';
					}
				}
				echo"'>";
				echo "<a class='image-container animate'>";
				echo "<img alt='" . $product['meta_keywords'] . ' ' . $i . "' title='" . $product['meta_keywords'] . ' ' . $i . "' class='animate lb mag-feature";
				if( SET_LAZY_LOAD == 'true' ) {
					echo " lazy";
				}
				echo "' data-group='" . $selector . "-features' data-id='" . $i . "' data-source='serve.php?source=".$image_dir."&amp;image=".$image_src."&amp;thumb=1' data-mfp-src='".$image_dir.$image_src."' src='".$imgThumbSrc."' />";
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
				//set data id to global for static features in index
				$GLOBALS['feat_data_id'] = $i;
			} 
		}else {
			// we've gone over the limit - stop returning features
		}
	} else {
			// feature does not match this product - do nothing
	}
	}
}

/**
 *
 * Create a list of product accessories with images
 *
 * 
 *
 */

function accessories( $accessory_selector ) {
	// select accessory info for the selector
	$getAccessories = mysql_query( "SELECT * FROM product_accessories WHERE selector = '" . $accessory_selector . "'" );
	// set accessory counter to zero
	$i = 0;
	// perform check on each found feature
	while( $rAccessories = mysql_fetch_assoc( $getAccessories ) ) {
		// echo out each feature as a list item
		echo "<li class='feature";
		if($feature['has_video'] == 1){
			echo ' video';
		}
		echo "' id='feature-" . $i . "'>";
		echo "<div class='media-container accessory ft small animate'>";
		echo "<a class='image-container animate'>";
		echo "<img alt='" . $rAccessories['meta_keywords'] . ' ' . $i . "' title='" . $rAccessories['meta_keywords'] . ' ' . $i . "' class='animate lb mag-feature";
		if( SET_LAZY_LOAD == 'true' ) {
			echo " lazy";
		}
		echo "' data-group='" . $accessory_selector . "-features' data-id='" . $i . "' data-source='serve.php?source=".DIR_IMAGES. '_accessories' . $accessory_selector . "/&amp;image=" . $accessory_selector . "&amp;thumb=1' data-mfp-src='" . DIR_IMAGES . '_accessories' . '/' . $accessory_selector . '/' . $accessory_selector .'.jpg' . "' src='". DIR_IMAGES . '_accessories' . '/' . $accessory_selector . '/_thumbnails/' . $accessory_selector . '_thumb.jpg' ."' />";
		echo "</a>";
		if($rAccessories['has_video'] == 1){
			echo "<a class='feature-video lb video' data-type='".$rAccessories['video_type']."' data-code='".$rAccessories['video_code']."'><span class='fa fa-play'></span>Video Demonstration</a>";
		}
		echo "</div>";
		echo "<div class='feature-info accessory'>";
		echo "<h2>" . $rAccessories['name'] . "</h2>";
		echo "<p class='accessory-desc'>" . $rAccessories['description'] . "</p>";
		echo "</div>";
		echo "</li>";	
	}
}

/**
 *
 * Array trimming function
 * 
 */

function trim_value(&$value) 
{ 
    $value = trim($value); 
}

/**
 *
 * Create a list of closeout products
 * 
 */

function closeout() {
	$getCloseout = mysql_query('SELECT * FROM closeout');
	$rCloseout = mysql_fetch_assoc($getCloseout);
	// set accessory counter to zero
	$i = 0;
	// perform check on each found feature
	while( $rCloseout = mysql_fetch_assoc( $getCloseout ) ) {
		$i++;
		if($rCloseout['sold'] == 1 || $rCloseout['visible'] == 0) {
			continue;
		}
		// echo out each feature as a list item
		echo "<hr>";
		echo "<li class='feature' id='feature-" . $i . "'>";
		echo "<h2 class='closeout-header'>" . $rCloseout['description'] . "</h2>";
		if(empty($rCloseout['dimensions'])){

		} else {
			echo "<h2 class='closeout-header'>Dimensions: " . $rCloseout['dimensions'] . "</h2>";
		}
		if($rCloseout['combo'] == 1) {
			// explode the item num into an array
			$items = explode( ',', $rCloseout['item_num'] );
			$len = count($items);
			array_walk($items, 'trim_value');
			$comboName = $items[0] . '-combo';
			echo "<h2 class='closeout-header'>Item Numbers "; 
			if($len == 2 ) {
				echo $items[0] . ' and ' . $items[1]; 
			} else {
				$i = 0;
				foreach ($items as $item) {
					if($i == $len - 1) {
						echo 'and ' . $item;
					} else {
						echo $item . ', ';
						$i++;
					}
				}
			}
			echo "</h2>";
			echo "<p class='accessory-desc closeout-desc'><a class='pdf-link' target='_blank' href=". DIR_IMAGES . '_closeout' . '/' . $comboName . '/' . $comboName .'.pdf' . ">View PDF</a></p>" . '<br />';
		} else {
		echo "<h2 class='closeout-header'>Item No. " . $rCloseout['item_num'] . "</h2>";
		echo "<p class='accessory-desc closeout-desc'><a class='pdf-link' target='_blank' href=". DIR_IMAGES . '_closeout' . '/' . $rCloseout['item_num'] . '/' . $rCloseout['item_num'] .'.pdf' . ">View PDF</a></p>" . '<br />';
		}
		echo "<h2 class='closeout-header'>";
		if ($rCloseout['msrp'] == 0.00) { 
		} else { echo "MSRP: <span class='msrp'>$" . $rCloseout['msrp'] . "</span>";
		}
		echo " Price: $" . $rCloseout['price'] . "</h2>"; 
		echo "<div class='media-container closeout-blueprint ft small animate'>";
		echo "<a class='image-container animate'>";
		echo "<img alt='Closeout " . $i . "' title='Closeout " . $i . "' class='animate lb mag-feature closeout";
		if( SET_LAZY_LOAD == 'true' ) {
			echo " lazy";
		}
		if($rCloseout['combo'] == 1) {
			echo "'d ata-source='serve.php?source=".DIR_IMAGES. '_closeout/' . $comboName . "/&amp;image=" . $comboName . '.jpg' . "&amp;thumb=1' data-mfp-src='" . DIR_IMAGES . '_closeout' . '/' . $comboName . '/' . $comboName .'.jpg' . "' src='". DIR_IMAGES . '_closeout' . '/' . $comboName . '/' . $comboName . '.jpg' ."' />";
		} else {
			echo "' data-source='serve.php?source=".DIR_IMAGES. '_closeout' . $rCloseout['item_num'] . "/&amp;image=" . $rCloseout['item_num'] . '.jpg' . "&amp;thumb=1' data-mfp-src='" . DIR_IMAGES . '_closeout' . '/' . $rCloseout['item_num'] . '/' . $rCloseout['item_num'] .'.jpg' . "' src='". DIR_IMAGES . '_closeout' . '/' . $rCloseout['item_num'] . '/' . $rCloseout['item_num'] . '.jpg' ."' />";
		}
		echo "</a>";
		echo "</div>";
		echo "<div class='feature-info accessory closeout'>";
		if($rCloseout['combo'] == 1) {
			closeoutThumbs($rCloseout['id'],$comboName);
		} else {
			closeoutThumbs($rCloseout['id']);
		}
		echo "</div>";
		echo "</li>";	
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
		//check if it has an associated gallery video
		$hasGalVideo = mysql_query( "SELECT * FROM product_videos WHERE selector = '" . $selector . "'" );
		$rHasGalVideo = mysql_fetch_assoc($hasGalVideo);
		// get the products parent information
		$getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $product['parent'] . "'" );
		$parent = mysql_fetch_assoc( $getParent );
		// set the path for the products gallery
		if($product['is_base'] == 1) {
		$path = './_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$convPath2 = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$thumbPath = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/_thumbnails/';
		} else {
		$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$convPath2 = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$thumbPath = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/_thumbnails/';
		}
	} else if ( $source = 'category' ) {
		// select the product from the database
		$getProduct = mysql_query( "SELECT * FROM product_categories_sub WHERE url = '" . $selector . "'" );
		$product = mysql_fetch_assoc( $getProduct );
		// set the path for the products gallery
		$path = './_assets/_images/_products/' . $product['parent'] . '/' . $product['selector'] . '/_gallery/';
		$convPath2 = '/_assets/_images/_products/' . $product['parent'] . '/' . $product['selector'] . '/_gallery/';
		$thumbPath = '/_assets/_images/_products/' . $product['parent'] . '/' . $product['selector'] . '/_gallery/_thumbnails/';
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
		if($file != "." and $file != ".." and $file != "Thumbs.db" and $file != "_thumbnails"){
			$ctime = filectime($data_path . $file) . "," . $file;
			$list[$ctime] = $file;
		}
	}
	closedir($dir);
	natsort($list);
	foreach($list as $image){
		$i++;
		$dirCheck = BASE_THUMBNAIL . $thumbPath;
		//create directory if it doesn't exist
		if (!file_exists($dirCheck)) {
    		mkdir($dirCheck, 0755, true);
			}
		//get sha1 hash of image
		$currentHash = (sha1_file($path . $image));
		//separate parts of image name
		$thumbImage =  $image;
		$path_parts = pathinfo($thumbImage);
		$matchedImageName = $path_parts['filename'];
		//set rest of thumbnail conversion path
		$smallThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize 97x ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_sm' . '.' . $path_parts['extension'];
		$medThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize 265x ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_med' . '.' . $path_parts['extension'];
		$checkHash = mysql_query( "SELECT * FROM thumbnail_compare WHERE thumbhash = '" . $currentHash . "' and imgname = '" . $matchedImageName . "' and selector = '" . $selector . "'" );
		 if(mysql_num_rows($checkHash)>0) {
		 	//matched with hash, do nothing
		 } else {
		 	//convert image to thumbnails
			exec($smallThumb);
			exec($medThumb);
			$addHash = mysql_query("INSERT INTO thumbnail_compare (thumbhash, selector, imgname) VALUES ('$currentHash','$selector','$matchedImageName')");
		}
		if($i <= $limit){
			echo "<a ";
			if($i == 1) {echo "id='thumbAnchor' ";}
			echo "class='side-gallery-img dv-3'>";
				echo "<div class='image animate'>";
					echo "<img alt='" . $product['meta_keywords'] . ' ' . $i . "' title='" . $product['meta_keywords'] . ' ' . $i . "' class='animate lb magnific";
					if( SET_LAZY_LOAD == 'true' ) {
						echo " lazy";
					}
					echo "' data-group='" . $selector . "' data-id='" . $i . "' data-source='./serve.php?source=".$path."&amp;image=".$image."&amp;thumb=1' data-mfp-src='".$path.$image."' itemprop='image' src='" . $path . '_thumbnails/' . $path_parts['filename'] . '_sm' . '.' . $path_parts['extension'] ."' />";
				echo "</div>";
			echo "</a>";
		} else { 
		//limit reached 
		}
	}
	if($i > $limit && $i > 0 || $rHasGalVideo !== false && mysql_num_rows($rHasGalVideo) > 0){
		echo "<span class='categories'><a class='animate' href='".DIR_ROOT."gallery/".$selector."'>View More Images</a></span>";
	}
	if(empty($list)){
		echo "<span class='categories'><p>There are no gallery images at this time.</p></span>";
	}
}

/**
 *
 * Generate thumbnails for closeout
 *
 *@param string $itemNum : the directory name passed from the closeout function
 */

function closeoutThumbs($id,$comboName) {
	// select the product from the database
	$getCloseout = mysql_query( "SELECT * FROM closeout where id = '" . $id . "'" );
	$rCloseout = mysql_fetch_assoc($getCloseout);
	// set the path for the products gallery
	// check if the path exists
	//while() {
	if($rCloseout['combo'] == 1) {
		$path = '../_assets/_images/_closeout/' . $comboName . '/JPEG/';
	} else {
		$path = '../_assets/_images/_closeout/' . $rCloseout['item_num'] . '/JPEG/';
	}
		//echo $path . '<br />';
		//echo 'itemNum is: ' . $itemNum . '<br />';
		$i = 0;
		$dir = opendir($path);
		$list = array();
		while($file = readdir($dir)){

			if($file != "." and $file != ".." and $file != "Thumbs.db" and $file != "	_thumbnails"){
			//echo 'current file is: ' . $file . '<br />';	
				$ctime = filectime($data_path . $file) . "," . $file;	
				$list[$ctime] = $file;	
			}
		}
		closedir($dir);
		natsort($list);
		//print_r($list);
		foreach($list as $image){
			$i++;
			//echo 'current image is: ' . $image . '<br />';	
			echo "<a class='";
			if($i == 1) {
				echo "first ";
			}
			echo "side-gallery-img dv-3'>";
				echo "<div class='image animate'>";
					echo "<img alt='Closeout Gallery " . $i . "' title='Closeout Gallery " . $i . "' class='animate lb magnific";
					if( SET_LAZY_LOAD == 'true' ) {
						echo " lazy";
					}
					if($rCloseout['combo'] == 1) {
						echo "' data-group='" . $comboName . "' data-id='" . $i . "' data-source='./serve.php?source=" . DIR_IMAGES . '_closeout/' . $comboName . '/JPEG/' . "&amp;image=".$image."&amp;thumb=1' data-mfp-src='". DIR_IMAGES . '_closeout/' . $comboName . '/JPEG/' . $image."' itemprop='image' src='" . DIR_IMAGES . '_closeout/' . $comboName . '/JPEG/' . $image ."' />";
					} else {
						echo "' data-group='" . $rCloseout['item_num'] . "' data-id='" . $i . "' data-source='./serve.php?source=" . DIR_IMAGES . '_closeout/' . $rCloseout['item_num'] . '/JPEG/' . "&amp;image=".$image."&amp;thumb=1' data-mfp-src='". DIR_IMAGES . '_closeout/' . $rCloseout['item_num'] . '/JPEG/' . $image."' itemprop='image' src='" . DIR_IMAGES . '_closeout/' . $rCloseout['item_num'] . '/JPEG/' . $image ."' />";
					}
				echo "</div>";
			echo "</a>";
		}
	//}
}


/**
 *
 * Loop out first three images of gallery for "gallery image"
 *
 * @param string $source   : determines if its a product or package. default: product [product | package]
 * @param string $selector : select gallery images for the selected product
 * @param number $limit    : limit the number of images to be shown - default = 9
 * @return                 : products thumbnail gallery
 *
 */

function galleryImageThumbs( $source = 'product', $selector, $limit = 3 ) {
	if( $source == 'product' ) {
		// select the product from the database
		$getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $selector . "'" );
		$product = mysql_fetch_assoc( $getProduct );
		//check if it has an associated gallery video
		$hasGalVideo = mysql_query( "SELECT * FROM product_videos WHERE selector = '" . $selector . "'" );
		$rHasGalVideo = mysql_fetch_assoc($hasGalVideo);
		// get the products parent information
		$getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $product['parent'] . "'" );
		$parent = mysql_fetch_assoc( $getParent );
		// set the path for the products gallery
		if($product['is_base'] == 1) {
		$path = './_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$convPath2 = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$thumbPath = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/_thumbnails/';
		} else {
		$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$convPath2 = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$thumbPath = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/_thumbnails/';
		}
		// check if the path exists
		$i = 0;
		$dir = opendir($path);
		$list = array();
		while($file = readdir($dir)){
			if($file != "." and $file != ".." and $file != "Thumbs.db" and $file != "_thumbnails"){
				$ctime = filectime($data_path . $file) . "," . $file;
				$list[$ctime] = $file;
			}
		}
		closedir($dir);
		natsort($list);
		foreach($list as $image){
			$i++;
			$dirCheck = BASE_THUMBNAIL . $thumbPath;
			//create directory if it doesn't exist
			if (!file_exists($dirCheck)) {
    			mkdir($dirCheck, 0755, true);
				}
			//get sha1 hash of image
			$currentHash = (sha1_file($path . $image));
			//separate parts of image name
			$thumbImage =  $image;
			$path_parts = pathinfo($thumbImage);
			$matchedImageName = $path_parts['filename'];
			//set rest of thumbnail conversion path
			$smallThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize 97x ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_sm' . '.' . $path_parts['extension'];
			$medThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize 265x ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_med' . '.' . $path_parts['extension'];
			$checkHash = mysql_query( "SELECT * FROM thumbnail_compare WHERE thumbhash = '" . $currentHash . "' and imgname = '" . $matchedImageName . "' and selector = '" . $selector . "'" );
		 	if(mysql_num_rows($checkHash)>0) {
		 		//matched with hash, do nothing
		 	} else {
		 		//convert image to thumbnails
				exec($smallThumb);
				exec($medThumb);
				$addHash = mysql_query("INSERT INTO thumbnail_compare (thumbhash, selector, imgname) VALUES ('$currentHash','$selector','$matchedImageName')");
			}
			if($i <= $limit){
				echo "<a class='side-gallery-img dv-3'>";
					echo "<div class='image animate'>";
						echo "<img alt='" . $product['meta_keywords'] . ' ' . $i . "' title='" . $product['meta_keywords'] . ' ' . $i . "' class='animate lb magnific";
				if( SET_LAZY_LOAD == 'true' ) {
					echo " lazy";
				}
				echo "' data-group='" . $selector . "' data-id='" . $i . "' data-source='./serve.php?source=".$path."&amp;image=".$image."&amp;thumb=1' data-mfp-src='".$path.$image."' itemprop='image' src='" . $path . '_thumbnails/' . $path_parts['filename'] . '_med' . '.' . $path_parts['extension'] ."' />";
				echo "</div>";
				echo "</a>";
			} else { 
				echo "<img alt='" . $product['meta_keywords'] . ' ' . $i . "' title='" . $product['meta_keywords'] . ' ' . $i . "' class='no-display magnific' data-mfp-src='".$path.$image."' />";
			}
		}
		if($i > $limit && $i > 0 || $rHasGalVideo !== false && mysql_num_rows($rHasGalVideo) > 0){
			echo "<div class='view-gallery-link'><a target='_blank' class='animate' href='".DIR_ROOT."gallery/".$selector."'>View Gallery</a></div>";
		}
		if(empty($list)){
			// echo "<span class='categories'><p>There are no gallery images at this time.</p></span>";
		}
	}
	if( $source == 'link' ) {
		echo 'product selector is: ' . $selector . '<br />';
		// select the product from the database
		$getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $selector . "'" );
		$product = mysql_fetch_assoc( $getProduct );
		//check if it has an associated gallery video
		$hasGalVideo = mysql_query( "SELECT * FROM product_videos WHERE selector = '" . $selector . "'" );
		$rHasGalVideo = mysql_fetch_assoc($hasGalVideo);
		// get the products parent information
		$getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $product['parent'] . "'" );
		$parent = mysql_fetch_assoc( $getParent );
		// set the path for the products gallery
		if($product['is_base'] == 1) {
			$path = './_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/';
			$convPath2 = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/';
			$thumbPath = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/_thumbnails/';
		} else {
			$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
			$convPath2 = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
			$thumbPath = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/_thumbnails/';
		}
		// check if the path exists
		$i = 0;
		$dir = opendir($path);
		$list = array();
		while($file = readdir($dir)){
			if($file != "." and $file != ".." and $file != "Thumbs.db" and $file != "_thumbnails"){
				$ctime = filectime($data_path . $file) . "," . $file;
				$list[$ctime] = $file;
			}
		}
		if(!empty($list)){ ?>
			<a target="_blank" class='product-slide-link gallery-link' href="<?php echo DIR_ROOT . 'gallery/' . $selector ?>">View Gallery <i class='fa fa-angle-right'></i></a>
		<?php }
	}
}


/**
 *
 * Generate thumbnails exclusively for features
 *
 * 
 * @param string $selector : generate thumbnails for features linked to this selector
 * @return                 : _thumbnails dir inside features dir
 *
 */

function makeFeatureThumbs( $selector) {
	// select the product from the database
	$getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $selector . "'" );
	$product = mysql_fetch_assoc( $getProduct );
	// get the products parent information
	$getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $product['parent'] . "'" );
	$parent = mysql_fetch_assoc( $getParent );
	//get info for feature path
	$getFeatureInfo = mysql_query( "SELECT selector FROM product_features where parent like '%" . $selector . "%'" );
	//loop through features
	while( $feature = mysql_fetch_assoc( $getFeatureInfo ) ) {
		if ($product['is_base'] == 1) {
			$featPath = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/' ;
			$featDirPath = BASE_THUMBNAIL . '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/' ;
		} else {
			$featPath = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/' ;
			$featDirPath = BASE_THUMBNAIL . '/_assets/_images/_products/'. $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_features/' . $feature['selector'] . '/' ;
		}
		// check if feature path exists
		$i = 0;
		$featDir = opendir($featDirPath);
		$featList = array();

		while($featFile = readdir($featDir)){
			if($featFile != "." and $featFile != ".." and $featFile != "Thumbs.db"){
				$featctime = filectime($data_path . $featFile) . "," . $featFile;
				$featList[$featctime] = $featFile;
			}
		}
		closedir($featDir);
		krsort($featList);

		foreach($featList as $featImage){
			$i++;
			$featThumbDirCheck = BASE_THUMBNAIL . $featPath . '_thumbnails/';
			$featDirCheck = BASE_THUMBNAIL . $featPath;
			//create directory if it doesn't exist
			if (!file_exists($featDirCheck)) {
    			mkdir($featDirCheck, 0755, true);
    			echo 'feature directory created for ' . $selector . '<br />';
			}
			if (!file_exists($featThumbDirCheck)) {
    			mkdir($featThumbDirCheck, 0755, true);
			}
			//get sha1 hash of image
			$featCurrentHash = (sha1_file($featDirPath . $featImage));
			//separate parts of image name
			$thumbFeatImage =  $featImage;
			$feat_path_parts = pathinfo($thumbFeatImage);
			$currentFile = $feat_path_parts['filename'];
			//set rest of thumbnail conversion path
			$featThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $featPath . $feat_path_parts['filename'] . '.' . $feat_path_parts['extension'] . ' -resize 210x ' . BASE_THUMBNAIL . $featPath . '_thumbnails/' . $feat_path_parts['filename'] . '_thumb' . '.' . $feat_path_parts['extension'];
				exec($featThumb);
				$addHash = mysql_query("INSERT INTO thumbnail_compare (thumbhash, selector, imgname) VALUES ('$featCurrentHash','$selector','$currentFile')");
				echo $selector . ' ' . $feature['selector'] . ' feature thumbnail created' . '<br />';
		}
	}
}


/**
 *
 * Generate thumbnail files and directories
 *
 * 
 * @param string $selector : generate thumbnails for gallery images linked to this selector
 * @return                 : _thumbnails dir inside gallery dir
 *
 */

function makeThumbs( $selector) {
	// select the product from the database
	$getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $selector . "'" );
	$product = mysql_fetch_assoc( $getProduct );
	// get the products parent information
	$getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $product['parent'] . "'" );
	$parent = mysql_fetch_assoc( $getParent );
	// set the path for the products gallery
	if($product['is_base'] == 1) {
		$path = './_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$convPath2 = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$thumbPath = '/_assets/_images/_products/' . $product['parent'] . '/' . $selector . '/_gallery/_thumbnails/';
	} else {
		$path = './_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$convPath2 = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/';
		$thumbPath = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $selector . '/_gallery/_thumbnails/';
	}

	// check if the path exists
	$i = 0;
	$dir = opendir($path);
	$list = array();
	while($file = readdir($dir)){
		if($file != "." and $file != ".." and $file != "Thumbs.db" and $file != "_thumbnails"){
			$ctime = filectime($data_path . $file) . "," . $file;
			$list[$ctime] = $file;
		}
	}
	closedir($dir);
	krsort($list);

	foreach($list as $image){
		$i++;
		$dirCheck = BASE_THUMBNAIL . $thumbPath;
		//create directory if it doesn't exist
		if (!file_exists($dirCheck)) {
    		mkdir($dirCheck, 0755, true);
		}
		//get sha1 hash of image
		$currentHash = (sha1_file($path . $image));
		//separate parts of image name
		$thumbImage =  $image;
		$path_parts = pathinfo($thumbImage);
		$matchedImageName = $path_parts['filename'];
		//set rest of thumbnail conversion path
		$smallThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize x68 ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_sm' . '.' . $path_parts['extension'];
		$medThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize x186 ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_med' . '.' . $path_parts['extension'];
		$qCheckHash = mysql_query( "SELECT * FROM thumbnail_compare WHERE thumbhash = '" . $currentHash . "' and imgname = '" . $matchedImageName . "' and selector = '" . $selector . "'" );
		$matchedImageName = $path_parts['filename'];
		if(mysql_num_rows($qCheckHash)>0) {
			//matched with hash, do nothing
		} else {
		 	//convert image to thumbnails
			exec($smallThumb);
			exec($medThumb);
			//insert image information
			$addHash = mysql_query("INSERT INTO thumbnail_compare (thumbhash, selector, imgname) VALUES ('$currentHash','$selector','$matchedImageName')");
		}
	}
	if(mysql_num_rows($qCheckHash)>0) {
	 	echo $selector . ' ' . $matchedImageName . ' already has thumbnails' . '<br />';
	} else {
		echo $selector . ' ' . $matchedImageName . ' thumbnails created' . '<br />';
	}
}

/**
 *
 * Generate thumbnail files and directories for a static path
 *
 * 
 * @param string $selector : generate thumbnails for gallery images linked to this selector
 * @return                 : _thumbnails dir inside gallery dir
 *
 */

function makeSpecificThumbs($path) {
	// set specific path
	$path_base = BASE_THUMBNAIL . $path;
	$convPath2 = $path;
	$thumbPath = $path . '_thumbnails/';
	echo $path_base . '<br />';
	echo $convPath2 . '<br />';
	echo $thumbPath . '<br />';

	// check if the path exists
	$i = 0;
	$dir = opendir($path_base);
	$list = array();
	while($file = readdir($dir)){
		if($file != "." and $file != ".." and $file != "Thumbs.db" and $file != "_thumbnails"){
			$ctime = filectime($data_path . $file) . "," . $file;
			$list[$ctime] = $file;
		}
	}
	closedir($dir);
	krsort($list);

	foreach($list as $image){
		$i++;
		$dirCheck = BASE_THUMBNAIL . $thumbPath;
		//create directory if it doesn't exist
		if (!file_exists($dirCheck)) {
    		mkdir($dirCheck, 0755, true);
		}
		//get sha1 hash of image
		$currentHash = (sha1_file($path_base . $image));
		//separate parts of image name
		$thumbImage =  $image;
		$path_parts = pathinfo($thumbImage);
		$matchedImageName = $path_parts['filename'];
		//set rest of thumbnail conversion path
		$smallThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize x68 ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_sm' . '.' . $path_parts['extension'];
		$medThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize x186 ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_med' . '.' . $path_parts['extension'];
		$qCheckHash = mysql_query( "SELECT * FROM thumbnail_compare WHERE thumbhash = '" . $currentHash . "' and imgname = '" . $matchedImageName . "' and selector = '" . $selector . "'" );
		$matchedImageName = $path_parts['filename'];
		//convert image to thumbnails
		exec($smallThumb);
		exec($medThumb);
		//insert image information
		$addHash = mysql_query("INSERT INTO thumbnail_compare (thumbhash, selector, imgname) VALUES ('$currentHash','$selector','$matchedImageName')");
		echo 'thumbnail for ' . $selector . ' ' . $matchedImageName .' created' . ' at ' . $thumbPath . '<br />';	
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
		if( $video['type'] == 'youtube' && $video['bottom_padding'] == 1 ) {
			echo "<div id='video'></div><iframe style='border: 0;' class='player youtube bottom' height='0' src='//www.youtube.com/embed/" . $video['code'] . "?rel=0&amp;wmode=transparent' allowfullscreen></iframe>";
		}
		elseif( $video['type'] == 'youtube' ) {
			echo "<div id='video'></div><iframe style='border: 0;' class='player youtube' height='0' src='//www.youtube.com/embed/" . $video['code'] . "?rel=0&wmode=transparent' allowfullscreen></iframe>";
		}
		// embed a vimeo video player
		if( $video['type'] == 'vimeo' && $video['bottom_padding'] == 1 ) {
			echo "<div id='video'></div><iframe class='player vimeo bottom' src='//player.vimeo.com/video/" . $video['code'] . "?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff' width='100%' height='0' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
		}
		elseif( $video['type'] == 'vimeo' ) {
			echo "<div id='video'></div><iframe class='player vimeo' src='//player.vimeo.com/video/" . $video['code'] . "?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff' width='100%' height='0' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
		}
	} else {
		// the product has no videos - do nothing
	}
}

?>