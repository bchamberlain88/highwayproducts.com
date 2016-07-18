<?php

/**
 *
 * About Highway Products. Telling the story of 
 * the company and the people who work here, including
 * a small timeline showing dates of important events
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2016
 *
 */
include_once('../_includes/meta.inc.php');
include_once('../_includes/quote.php'); 
include_once('../_includes/newsletter.php');
?>

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
                <li>Reviews</li>
            </ul>
<p>
<hr>
<?php
$getReviews = mysql_query( "SELECT * FROM reviews" );
while( $reviews = mysql_fetch_assoc( $getReviews ) ) {
    echo $reviews['review'];
    echo "<br /><br />";
    echo $reviews['author'];
    echo "<br /><br /><hr><br /><br />";
}
?>
</p>
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
        <?php include_once('../_includes/sidebar_signup.php'); ?>
    </div>
    </div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php include_once('../_includes/footer.inc.php'); ?>