<?php

/**
 *
 * About Highway Products. Telling the story of 
 * the company and the people who work here, including
 * a small timeline showing dates of important events
 *
 * @author    Sebastian Inman @sebastian_inman
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2014
 *
 */

require_once( '../../_includes/globals.inc.php' );

 ?>

<!DOCTYPE html>
<html lang='en'>
<head>

<!--

This website was designed and developed by Sebastian Inman for Highway Products Inc.
All code and resources are copyright

@website  www.sebastianinman.com
@facebook www.facebook.com/sebastian.inman.design
@twitter  www.twitter.com/sebastian_inman                                                                                                                                

-->

    <!-- generic meta -->
    <meta charset='UTF-8'>
    <title>HPI - 404 (Page Not Found)</title>
    <meta name='robots' content='index, follow'>
    <base href='<?php echo META_BASE; ?>'>
    <meta name='author' content='<?php echo META_AUTHOR; ?>'>
    <meta name='description' content='Sorry, the requested page could not be found.'>
    <meta name='keywords' content='<?php echo META_KEYWORDS; ?>'>
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>

    <!-- google site verification -->
    <meta name='google-site-verification' content='<?php echo GOOGLE_VERIFY; ?>' />

    <!-- twitter meta -->
    <meta name='twitter:card' content='<?php echo TWITTER_CARD; ?>'>
    <meta name='twitter:site' content='<?php echo TWITTER_OWNER; ?>'>
    <meta name='twitter:creator' content='<?php echo TWITTER_CREATOR; ?>'>
    <meta name='twitter:title' content='<?php echo TWITTER_TITLE; ?>'>
    <meta name='twitter:description' content='<?php echo TWITTER_DESCRIPTION; ?>'>
    <meta name='twitter:url' content='<?php echo META_BASE; ?>'>
    <meta name='twitter:image:src' content='<?php echo TWITTER_IMAGE; ?>'>

    <!-- facebook meta -->
    <meta name='og:title' content='<?php echo FACEBOOK_TITLE; ?>'>
    <meta name='og:image' content='<?php echo FACEBOOK_IMAGE; ?>'>
    <meta name='og:url' content='<?php echo META_BASE; ?>'>
    <meta name='og:site-name' content='<?php echo FACEBOOK_TITLE; ?>'>
    <meta name='og:description' content='<?php echo FACEBOOK_DESCRIPTION; ?>'>

    <!-- desktop and mobile favicons -->
    <meta name='msapplication-TileColor' content='#2e373c'>
    <meta name='msapplication-TileImage' content='mstile-144x144.png'>
    <meta name="msapplication-config" content="<?php echo DIR_IMAGES; ?>_misc/_favicons/browserconfig.xml">
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-192x192.png' sizes='192x192'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-160x160.png' sizes='160x160'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-96x96.png' sizes='96x96'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-16x16.png' sizes='16x16'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-32x32.png' sizes='32x32'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-57x57.png' sizes='57x57'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-114x114.png' sizes='114x114'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-72x72.png' sizes='72x72'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-144x144.png' sizes='144x144'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-60x60.png' sizes='60x60'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-120x120.png' sizes='120x120'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-76x76.png' sizes='76x76'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-152x152.png' sizes='152x152'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-180x180.png' sizes='180x180'>
    <link rel="shortcut icon" href="<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon.ico">

    <!--[if lt IE 9]>
        <script src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->

    <!-- import Font Awesome by Dave Gandy - http://fontawesome.io -->
    <link href='//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' rel='stylesheet'  type='text/css'>
    <!-- import Google fonts :: Open Sans :: Light, Regular, Bold, Extra Bold -->
    <link href='http://fonts.googleapis.com/css?family=Reenie+Beanie|Open+Sans:200,400,700,800' rel='stylesheet' type='text/css'>
    <!-- reset all default browser styles -->
    <link href='<?php echo DIR_STYLES.'reset.min.css'; ?>' rel='stylesheet' type='text/css'>
    <!-- import all global page styles -->
    <link href='<?php echo DIR_STYLES.'style.min.css'; ?>' rel='stylesheet' type='text/css'>

</head>

<body>

<?php // include the global header
include_once('../../_includes/header.inc.php'); ?>

<div class='container'>
    <div class='slider-container'>
        <div class='slider'>
            <iframe class='player youtube' width="100%" height="0" src="//www.youtube.com/embed/yC1ztmO0Wx4?rel=0&loop=1&autoplay=1&playlist=yC1ztmO0Wx4" style='margin:0;min-height:100%;position:absolute;top:-30px;' frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class='selectors-container'></div>
    <div class='wrapper fs'>
        <div class='full-content'>
            <ul class='breadcrumbs'>
                <li><a class='animate' href='<?php echo DIR_ROOT; ?>'>
                    <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                </a></li>
                <li>404 (Page Not Found)</li>
            </ul>
            <h1 class='about'>The page you were looking for could not be found</h1>
            <p>
            It looks like you've stumbled upon a page that doesn't exist, or did exist at one point and doesn't anymore.
            The page may have been moved to another location, or may have been removed all together. Use the navigation at the
            top of the page to see if you can find what you were looking for, or if there was a specific product you were looking for, 
            use the search bar at the top of the page to search for your product. If you think you've reached this page and it was a mistake,
            feel free to email our webmaster and see if we can fix this issue.
            </p>
        </div>
    </div>

<?php include_once('../../_includes/footer.inc.php'); ?>