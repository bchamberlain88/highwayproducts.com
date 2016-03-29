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
include_once( './globals.inc.php' );
// connect to the database
include_once( './connect.inc.php' );
// include global functions
include_once( './functions.inc.php' );
// receive the sent query variable from javascript function
$query = mysql_real_escape_string( $_GET['p'] );
// explode the query into an array of words
$words = explode( '-', $query );
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
// echo each result item into the results list
foreach( $results_u as $result ) { ?>
	<li class='search-result <?php if($result['likeness'] > 10){ echo "related"; } ?>' data-product='<?php echo $result['id']; ?>' data-likeness='<?php echo $result['likeness']; ?>'>
		<a href='<?php echo DIR_ROOT . $result['selector']; ?>'>
		<div class='result-image'>
			<img src='<?php echo $result['thumbnail']; ?>' />
			<ul class="ratings small search-rating disabled">
                <?php $rating = rating( 'product', $result['selector'] ); ?>
                <?php printStars( $rating['average'] ); ?>
            </ul>
		</div>
		<div class='result-info'>
			<h2 class='animate'><?php echo $result['name']; ?></h2>
			<p><?php echo $result['description'] ?></p>
		</div>
		</a>
	</li>
<?php } ?>