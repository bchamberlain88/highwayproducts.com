<?php

/**
 *
 * Global search function for the site.
 * Search for products and packages, return
 * results in real time on any page.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

// include global variables
include_once( './_includes/globals.inc.php' );
// connect to the database
include_once( './_includes/connect.inc.php' );
// include global functions
include_once( './_includes/functions.inc.php' );
include_once( './_includes/meta.inc.php' ); 
include_once( './_includes/quote.php' ); 
include_once( './_includes/newsletter.php' ); ?>
<div class='container'>
    <a class='scroll-slider'>
        <span class='fa fa-arrow-down'></span>
    </a>
    <div class='wrapper fs'>
        <div class='left-content' style="line-height: 26px;">
            <ul class='breadcrumbs' itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"><a class='animate' href='<?php echo DIR_ROOT; ?>' itemprop="item">
                    <i class='home-icon fa fa-home'></i> <span itemprop="name">Highway Products</span> <i class='fa fa-angle-right'></i>
                </a>
                <meta itemprop="position" content="1" />
                </li>
                <li>Search</li>
            </ul>
<div class="search-bar">
<form method="GET" name="search-bar" action="<?php echo $_SERVER['$SCRIPT_NAME'] ?>">
<input type="text" name="p" class="static-search-input"></input>
<input type="submit" value="Submit">
</form>
</div>
<?php 
// set query var
if(isset($_GET['p'])) {
    $query = mysql_real_escape_string( $_GET['p'] );
}
// explode the query into an array of words
$words = explode( ' ', $query );
// create an empty array to house the search results
$results = array();

/**
 *
 * Rearrange the order of array items in order
 * of greatest to lowest key provided
 *
 * @param array $array : the array to rearrange the order of
 * @param number $key  : the value we will order the array by
 * @return             : output array in the newly arranged order
 *
 */

function aasort ( $array, $key ) {
	// create empty array for the new order
    $sorter = array();
    // create dulicate array in new order
    $ret = array();
    // reset the order of the provided array before starting
    reset( $array );
    // push each key into the sorter array
    foreach ( $array as $ii => $va ) {
        $sorter[$ii] = $va[$key];
    }
    // sort the keys in order
    asort( $sorter );
    // push the new order into the return array
    foreach ( $sorter as $ii => $va ) {
        $ret[$ii] = $array[$ii];
    }
    // reorder the provided array
    $array = $ret;
    // all finished- return the array
    return $array;
}
// perform a check on each word in query
foreach( $words as $word ) {
	// check if word exists
	if( $word == '' ) {
		// there's no word - no need to do anything
	} else {
		// make sure the word is at least 2 characters long
		if( strlen( $word ) > 2 ) {
			// the word is at least 2 characters long - continue checking it
			// check the database for products that are similar to this word
			$checkName = mysql_query( "SELECT * FROM product_categories_items WHERE is_visible = 1 AND search_tags LIKE '%$word%' OR name LIKE '%$word%'" );

			// perform a check on each match that was found
			while( $return = mysql_fetch_assoc( $checkName ) ) {
				// set the likeness percentage to zero
				$percent = 0;
				// get the parent of the found product
				$getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $return['parent'] . "'" );
				$parent = mysql_fetch_assoc($getParent);
				// check to see if the matching product has a thumbnail
				if( $return['thumbnail'] == 'null' ) {
					// no set thumbnail - use the default
					$thumb = DIR_IMAGES . '_products/product-thumb.jpg';
				} elseif($return['is_base'] == 1) {
					//if it's a base category, remove the unneccessary directory
					$thumb = DIR_IMAGES . '_products/' . $return['parent'] . '/' . $return['selector'] . '/' . $return['thumbnail'];
				} else {
					// the product has a thumbnail
					$thumb = DIR_IMAGES . '_products/' . $parent['parent'] . '/' . $parent['selector'] . '/' . $return['selector'] . '/' . $return['thumbnail'];
				}
				// explode the products search tags into an array - seperate by spaces
				$tags = explode( ' ', $return['search_tags'] );
				// set the likeness zounter to -1 (will determine if the query word is close enough to a search tag to warrant a result)
				$shortest = -1;
				// perform a check on each search tag the product has
				foreach( $tags as $tag ) {
					// the likeness between the query word and the search tag
					$lev = levenshtein( $word, $tag );
					// likeness = 0 - exact match
					if( $lev == 0 ) {
						// the closest word is the tag
						$closest = $tag;
						// set likeness to 0 for exact match
						$shortest = 0;
						break;
					}
					// likeness != 0 - close match
					if( $lev <= $shortest || $shortest = 0 ) {
						// find the closest tag to the query word
						$closest = $tag;
						// set the likeness
						$shortest = $lev;
					}
					// check the likeness
					if( $shortest == 0 ) {
						// it was an exact match - get percentage of similarity
						$percent = $percent + similar_text( $tag, $word );
					} else {
						// it was a close match - get percentage of similarity
						$percent = $percent + similar_text( $tag, $closest );
					}
				}
				// create an array containing all the returned information of the search result
				$info = array( 'id' => $return['id'], 'likeness' => round( $percent ), 'thumbnail' => $thumb, 'selector' => $return['selector'], 'name' => $return['name'], 'description' => $return['description'] );
				// push the info results into the results array
				array_push( $results, $info );
			}
		} else {
			// the word is less than 2 characters - wait before checking
		}
	}
}

// sort the results array in order of likeness
$results_u = aasort( $results, 'likeness' );
$isitempty = empty($results_u);
// echo $isitempty;
if(empty($results_u)) { ?>
    <li class='search-result-static'>
        <div class='result-info'>
            <p>Sorry, your search returned no results.</p>
        </div>
    </li>
<?php }
foreach( $results_u as $result ) { ?>
	<li class='search-result-static <?php if($result['likeness'] > 10){ echo "related"; } ?>' data-product='<?php echo $result['id']; ?>' data-likeness='<?php echo $result['likeness']; ?>'>
		<a href='<?php echo DIR_ROOT . $result['selector']; ?>'>
		<div class='result-image'>
			<img alt="<?php echo $result['name']?>" title="<?php echo $result['name']?>" src='<?php echo $result['thumbnail']; ?>' />
		</div>
		<div class='result-info'>
			<h2 class='animate'><?php echo $result['name']; ?></h2>
			<p><?php echo substr($result['description'], 0, 200) . '...'; ?></p>
		</div>
		</a>
	</li>
<?php } ?>
    <div class="leftBiggerSpacer">
    </div>
</div>
<div class='right-content'>
        <?php // include addthis api if sharing is allowed
        if( SET_SHARING == 'true' ) { ?>
            <h2 class=''>Share this page</h2>
            <div class='addthis_sharing_toolbox'></div>
            <div class='side-sep'></div>
        <?php } ?>

        <?php // show facebook like box if allowed
        if( SET_FACEBOOK_LIKES == 'true' ) { ?>
            <!-- facebook likebox -->
            <div class='fb-like' data-href='<?php echo DIR_URL; ?>' data-layout='standard' data-action='like' data-show-faces='true' data-share='false'></div>
            <!-- end facebook likebox -->
            <div class='side-sep'></div>
        <?php } ?>
        <h1 class='qa'>Have A Question?</h1>
        <p>If you have any questions about this product, our sales team is more than happy to help!</p>
        <span class='categories'>
            <a class='animate' href='<?php echo DIR_ROOT; ?>contact/'>Contact Our Sales Team</a>
        </span>
        <div class='side-sep'></div>
        <ul class='callout-features'>
            <?php
            // check if product has financing available
            if( $product['is_financed'] == 1 ) { ?>
                <li class='callout-feature' itemprop='offerDetails' itemscope itemtype='http://data-vocabulary.org/Offer'>
                    <i class='circle fa fa-check'></i>
                    <span itemprop='condition' content='Financing now available'>Financing now available!</span>
                </li>
            <?php } ?>
            <li class='callout-feature'>
                <i class='circle fa fa-check'></i>
                Best value guaranteed
            </li>
            <li class='callout-feature'>
                <i class='circle fa fa-check'></i>
                Absolutely no sales tax
            </li>
            <li class='callout-feature'>
                <i class='circle fa fa-check'></i>
                Fast and reliable shipping
            </li>
            <li class='callout-feature'>
                <i class='circle fa fa-check'></i>
                Transferable Lifetime Warranty
            </li>
            <li class='callout-feature'>
                <i class='circle fa fa-check'></i>
                100% hand assembled in the United States
            </li>
        </ul>
        <div class='side-sep'></div>
        <div class='badges'>
            <img alt='Based in Oregon, Highway Products has no sales tax on all purchases!' src='<?php echo DIR_IMAGES; ?>_misc/no-taxes-in-oregon.png' />
            <img alt='Highway Products is a U.S. Veteran owned business' src='<?php echo DIR_IMAGES; ?>_misc/veteran-owned-business.png' />
        </div>
        <div class='side-sep'></div>
        <div class='testimonials'>
            <h1>Customer Reviews</h1>
            <!-- load the products testimonials - limit: 3 -->
            <?php productTestimonials( $product_selector, SET_LIMIT_PRODUCT_TESTIMONIALS ); ?>
        </div>
        <?php
        $input_id  = 0;
        $aweber_id = 0;
        $aweber_js = 0;
        $getSales = mysql_query("SELECT * FROM sales_team");
        while($sales = mysql_fetch_assoc($getSales)){
            $sales_covers = explode(', ', $sales['products_covered']);
            if(in_array($category['selector'], $sales_covers)){
                $input_id  = $sales['input_id'];
                $aweber_id = $sales['aweber_id'];
                $aweber_js = $sales['aweber_js'];
            }
        } ?>
        <?php include_once('./_includes/sidebar_signup.php'); ?>
    </div>
    </div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php include_once('./_includes/footer.inc.php'); ?>