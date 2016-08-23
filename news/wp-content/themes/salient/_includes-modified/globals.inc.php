<?php

/* 

 *

 * Define global links to common directories that are

 * required by the site - assets and php config files.

 *

 */

//the phone number listed on the website
define( 'PHONE_NUMBER', '1-877-690-4679 (Toll free)');
define( 'PHONE_NUMBER_LINK', 'tel:+18776904679');

// full url of the current page being viewed

define( 'DIR_URL', 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] );

// website root must be changed before launch

define( 'DIR_ROOT', 'http://highwayproducts.com/' );

// root directory for all included php configuration files

define( 'DIR_INCLUDES', DIR_ROOT . '_includes-modified/' );

// root directory for all media assets required by website

define( 'DIR_ASSETS', DIR_ROOT . '_assets/' );

// root directory for all image files

define( 'DIR_IMAGES', DIR_ASSETS . '_images/' );

// root directory for all stlyesheets required by website

define( 'DIR_STYLES', '_includes-modified/' );

// root directory for all javascript files required by website

define( 'DIR_SCRIPTS', DIR_ROOT . '_includes-modified/' );









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

define( 'META_AUTHOR', 'Sebastian Inman' );

// plaintext email address for easy contact of the owner of the website - recommended but not necessary

define( 'META_CONTACT', $setting['site_default_email'] );

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

