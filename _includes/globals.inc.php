<?php

/**
 *
 * Define all global variables that will be used
 * throughout the website and begin sessions.
 * Include database connection configuration.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

// connect to the primary database
include_once( 'connect.inc.php' );
// include global functions and classes
require_once( 'functions.inc.php' );

// query search for all global settings
$getSettings = mysql_query( 'SELECT * FROM global_settings' );
// add each setting into an array
while( $settings = mysql_fetch_assoc( $getSettings ) ) {
    $setting[$settings['setting']] = $settings['value'];
}

// get page variable for current product
if( $_GET['p'] ) {
	// select the products meta info from database
	$getMeta = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $_GET['p'] . "'" );
	// make sure the product exists
	if( mysql_num_rows( $getMeta ) > 0 ) {
		// the product exists - get the meta settings
		$meta = mysql_fetch_assoc( $getMeta );
		// check to see if the product already has a meta title
		if( $meta['meta_title'] != '' && $meta['meta_title'] != 'null' ) {
			// there is already a meta title - use it
			$meta_title = strip_tags( $meta['meta_title'] );
		} else {
			// no preset meta title - use the products name
			$meta_title = strip_tags( $meta['name'] ) . ' - Highway Products Inc.';
		}
		// check to see if the product already has a meta description
		if( $meta['meta_description'] != '' && $meta['meta_description'] != 'null' ) {
			// there is already a meta description - use it
			$meta_description = substr( strip_tags( $meta['meta_description'] ), 0, strrpos( substr( strip_tags( $meta['meta_description'] ), 0, 160), '. ' ) ) . '.';
		} else {
			// no preset meta description - use the products description
			$meta_description = substr( strip_tags( $meta['description'] ), 0, strrpos( substr( strip_tags( $meta['description'] ), 0, 160), '. ' ) ) . '.';
		}
	} else {
		// this isn't a valid product - revert to default meta settings
		$meta_title = strip_tags( $setting['site_default_title'] );
		$meta_description = strip_tags( $setting['site_default_description'] );
	}
} else {
	// not viewing a page with variables - use default meta settings
	$meta_title = strip_tags( $setting['site_default_title'] );
	$meta_description = strip_tags( $setting['site_default_description'] );
}

/* 
 *
 * Define global links to common directories that are
 * required by the site - assets and php config files.
 *
 */

// full url of the current page being viewed
define( 'DIR_URL', 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] );
// website root must be changed before launch
define( 'DIR_ROOT', 'http://www.highwayproducts.com/' );
// root sans http://
define( 'DIR_ROOT_TRIM', 'www.highwayproducts.com/' );
// root directory for all included php configuration files
define( 'DIR_INCLUDES', DIR_ROOT . '_includes/' );
// root directory for all media assets required by website
define( 'DIR_ASSETS', DIR_ROOT . '_assets/' );
// root directory for all image files
define( 'DIR_IMAGES', DIR_ASSETS . '_images/' );
// root directory for all pdfs
define( 'DIR_PDFS', DIR_ASSETS . '_pdfs/' );
// root directory for all stlyesheets required by website
define( 'DIR_STYLES', DIR_ASSETS . '_styles/' );
// root directory for all javascript files required by website
define( 'DIR_SCRIPTS',DIR_ASSETS . '_scripts/' );



/* 
 *
 * Define all the global meta settings for the website
 * for search engine optimization.
 *
 */

// the main title of the website - displayed in browser window
define( 'META_TITLE', $meta_title );
// sets the base url of the website - seo purposes
define( 'META_BASE', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
// just giving credit to myself for the development of the website
define( 'META_AUTHOR', 'Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain' );
// plaintext email address for easy contact of the owner of the website - recommended but not necessary
define( 'META_CONTACT', $setting['site_default_email'] );
//the phone number listed on the website
define( 'PHONE_NUMBER', '1-877-690-4679 (Toll free)');
define( 'PHONE_NUMBER_LINK', 'tel:+18776904679');
// automatically updating copyright information for the website and media
define( 'META_COPYRIGHT', 'Copyright &copy; ' . date( 'Y' ) );
// sets the description and overall feel of the website for search engines - seo purposes
define( 'META_DESCRIPTION', $meta_description );
// automatically updating revision date of content on the website
define( 'META_REVISED', date( 'F d, Y' ) );
// keywords that describe the site in a concise manner - seo purposes
define( 'META_KEYWORDS', $setting['site_default_keywords'] );




/* 
 *
 * Define all the global meta settings for social network
 * websites such as Facebook and Twitter.
 *
 */

// title of the website for sharing on Facebook
define( 'FACEBOOK_TITLE', $meta_title );
// description of the website for sharing on Facebook
define( 'FACEBOOK_DESCRIPTION', $meta_description );
// the default image for the website when sharing on Facebook
define( 'FACEBOOK_IMAGE', '' );
// the type of card to create when sharing on Twitter
define( 'TWITTER_CARD', 'summary' );
// title of the website for sharing on Twitter
define( 'TWITTER_TITLE', $meta_title );
// description of the website for sharing on Twitter
define( 'TWITTER_DESCRIPTION', $meta_description );
// the default image for the website when sharing on Twitter
define( 'TWITTER_IMAGE', '' );
// the Twitter username of the site owner
define( 'TWITTER_OWNER', '@' );
// the Twitter username of the developer of the site - yours truly
define( 'TWITTER_CREATOR', '@sebastian_inman' );
// base thumbnail conversion path
define( 'BASE_THUMBNAIL', '/home/highwayp/public_html/highwayproducts.com' );




/* 
 *
 * Define global settings for Google resources:
 * Analytics verification, Adsense verification, etc.
 *
 */

// Google verification code for Analytics
define( 'GOOGLE_VERIFY', $setting['google_analytics_verification'] );




/* 
 *
 * Define global settings for the entire site:
 * Query limits, commenting, timeouts, allowances, etc.
 *
 */

// turn social media sharing on or off. default: true [true | false]
define( 'SET_SHARING', $setting['allow_sharing'] );
// turn page commenting on or off. default: true [true | false]
define( 'SET_COMMENTS', $setting['allow_comments'] );
// turn page support commenting on or off. default: true [true | false]
define( 'SET_SUPPORT_COMMENTS', $setting['allow_support_comments'] );
// turn font size changing on or off. default: true [true | false]
define( 'SET_FONT_CHANGE', $setting['allow_font_change'] );
// limit the number of slides to be returned. default: 6 [0 = no limit]
define( 'SET_LIMIT_SLIDES', $setting['limit_slides'] );
// limit the number thumbnails in product galleries. default: 15 [0 = no limit]
define( 'SET_LIMIT_GALLERY_THUMBS', $setting['limit_gallery_thumbnails'] );
// limit the number of testmonials returned on product pages. default: 3 [0 = no limit]
define( 'SET_LIMIT_PRODUCT_TESTIMONIALS', $setting['limit_product_testimonials'] );
// limit the number of features returned on product pages. default: 0 [0 = no limit]
define( 'SET_LIMIT_PRODUCT_FEATURES', $setting['limit_product_features'] );
// limit the number of related products returned. default: 12 [0 = no limit]
define( 'SET_LIMIT_RELATED_PRODUCTS', $setting['limit_related_products'] );
// show or hide the shopping cart link. default: true [true | false]
define( 'SET_CART_BUTTON', $setting['show_shopping_cart'] );
// show or hide links to sister companies. default: true [true | false]
define( 'SET_SISTER_LINKS', $setting['show_sister_links'] );
// show or hide the facebook like box. default: true [true | false]
define( 'SET_FACEBOOK_LIKES', $setting['show_facebook_likes'] );
// show or hide the twitter feed. default: true [true | false]
define( 'SET_TWITTER_FEED', $setting['show_twitter_feed'] );
// lazy load images? default: true [true | false]
define( 'SET_LAZY_LOAD', $setting['lazy_load_images'] );

?>
