<?php

/**
 *
 * This is a little hack to resolve 404 errors when
 * switching over to the new website. There will be some
 * backlinks coming in from other sites, leading to old
 * product url's. This will cross reference the page being
 * requested to a database full of old links that we used
 * to have. If a new link exists for it, 303 redirect to it.
 * Other wise, just return that nasty 404.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

require_once('../_includes/globals.inc.php'); 

// trying to load a product?
if( $_GET['p'] ) {
    // check if the page exists or needs to be redirected
    checkRedirect( DIR_ROOT, dirname( $_SERVER['PHP_SELF'] ), $_GET['p'] );
} else{ 
    // 303 redirect to the new products page
    header( 'HTTP/1.1 301 Moved Permanently' );
    header( 'Location: ' . DIR_ROOT . 'products/' );
} ?>