<?php

/**
 *
 * 
 * Display a list of accessories for a given product.
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
//get information based on session variable set on product page
$getProduct = mysql_query('SELECT * FROM product_categories_items WHERE selector = "'.$_SESSION['accessory_selector'].'" LIMIT 1');
$product = mysql_fetch_assoc($getProduct);
?>
<div class='container'>
    <a class='scroll-slider'>
        <span class='fa fa-arrow-down'></span>
    </a>
    <div class='wrapper fs'>
        <div class='left-content'>
            <ul class='breadcrumbs' class='breadcrumbs' itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a class='animate' href='<?php echo DIR_ROOT; ?>' itemprop="item">
                    <i class='home-icon fa fa-home'></i> <span itemprop="name">Highway Products</span> <i class='fa fa-angle-right'></i>
                    </a>
                <meta itemprop="position" content="1" />
                </li>
                <li>
                    <a class='animate' href='<?php echo DIR_ROOT . $_SESSION['accessory_selector']; ?>'><?php echo $product['name']; ?> 
                        <i class='fa fa-angle-right'></i>
                    </a>
                </li>
                <li class="lastCrumb">Accessories</li>
            </ul>
        <h1><?php echo $product['name']; ?> Accessories</h1>
        <ul class="feature-list accessory">
            <?php 
                accessories($_SESSION['accessory_selector']);
            ?> 
        </ul>
        <div class="leftSpacer"></div>
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
        <div class='sidebar-signup'>
            <h1 class="newsSign">Newsletter Signup</h1>
            <p>Receive special promotional offers, discount opportunities, and news updates!</p>
            <form class='newsletter-form sidebar-news aweber-form' data-submit='<?php echo $newsFormID; ?>'>
                <input required spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $newsEmailID; ?>' name='email' placeholder='Enter your email address' type='text' />
                <button class='button large secondary animate submit' type='submit'>Subscribe To Newsletter</button>
            </form>
            <div class="aweber AW-Form-<?php echo $newsFormID; ?>"></div>
            <!-- newsletter script -->
            <script type="text/javascript">(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//forms.aweber.com/form/99/<?php echo $newsFormID; ?>.js";
                fjs.parentNode.insertBefore(js, fjs);
                }(document, "script", "aweber-wjs-6bhepjf7u"));
            </script>
            <div id="hideSep" class='side-sep'></div>
            <h1 class="interProd">Interested in this product?</h1>
            <p>Click the button below to fill out a form and get a free quote from one of our sales representatves!</p>
            <button class='button large gold sidebar-quote animate submit get-quote-plox' type='submit'>
                <span class='fa fa-paper-plane'></span>
                Get a free quote
            </button>
        </div>
    </div>
    </div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php include_once('../_includes/footer.inc.php'); ?>