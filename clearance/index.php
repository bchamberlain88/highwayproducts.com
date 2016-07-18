<?php

/**
 *
 * 
 * Clearance section for reduced-price items.  Draws information from clearance table.  Directories are selected based on item number or first item number in combo plus "-combo".
 * 
 *
 * @author    Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2016
 *
 */
session_start();
include_once('../_includes/meta.inc.php');
include_once('../_includes/quote.php'); 
include_once('../_includes/newsletter.php');
?>
<div class='container'>
    <a class='scroll-slider'>
        <span class='fa fa-arrow-down'></span>
    </a>
    <div class='wrapper fs'>
        <div class='left-content'>
            <ul class='breadcrumbs'>
                <li><a class='animate' href='<?php echo DIR_ROOT; ?>'>
                    <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                </a></li>
                <li style="padding-top: 2px;">
                    <a class='lastCrumb animate'>Clearance</a>
                </li>
            </ul>
            <h1>Clearance Products</h1>
            <p class="product-copy four_eighty">Here you can view a list of our reduced-price clearance items.</p>
        <ul class="feature-list accessory">
            <?php 
            //get clearance information.  Function links to clearanceThumbs function
                clearance();
            ?> 
        </ul>
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
        <?php include_once('../_includes/sidebar_signup.php'); ?>
    </div>
    </div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php include_once('../_includes/footer.inc.php'); ?>