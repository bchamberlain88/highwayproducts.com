<?php

/**
 *
 * Careers page.  Static page which has links to various pdfs which are within the same dir.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
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
                <li>Careers</li>
            </ul>
<div class="jobIntro">
<p>
Interested in starting a career with a company that cares about you and working with people who share the same interests?<br /><br />
</p>
<p>
Highway Products is looking for professionals to join our team immediately in White City, Oregon. Highway Products builds the highest quality toolboxes on the market and the world's first 100% aluminum wakeboard boat via our sister company Pavati Wake Boats. We are a company that takes great pride in the quality of our work. If you want a career opportunity that will challenge you and always push you to reach new levels, we want to talk to you.<br /><br />
</p>
<p>
Please explore our job listings:<br /><br />
</p>
</div>
<div class="jobOffer">
<img class="jobImg" src="Welder-Job-Listing.jpg">
<p>
Highway Products is in search of welders to join us in building the highest quality toolboxes on Earth. As a welder for Highway Products you will be dedicated to and responsible for the quality and outward appearance of your work, ultimately being delivered to the customers anticipating the best built toolboxes they've ever laid eyes on. Styles of welding include both Mig &amp; Tig and compensation is top of the line with a benefit package to match.<br /><br />
<a href="HPIWeldingJobAd.pdf" target="_blank">Download Job Listing</a>
</p>
</div>
<div class="jobOffer">
<img class="jobImg" src="Welders-Assitant.jpg">
<p>
Highway Products is in search of a welding assistant to join us in building the highest quality toolboxes on Earth. As a welding assistant for Highway Products you will be dedicated to and responsible for helping the workflow of our welding team by handling a variety of small tasks as well as welding as duty calls. The qualified candidate should have experience welding and be confident in their ability to do so. If you're interested in getting your foot in the door, with great opportunities to advance, this job's the one for you.<br /><br />
<a href="HPIWeldingAssistantJobAd.pdf" target="_blank">Download Job Listing</a>
</p>
</div>
<div class="jobOffer">
<img class="jobImg" src="PowderCoatJob.jpg">
<p>
Highway Products is looking for experienced powder coaters to join our team immediately in White City, Oregon. As a powder coater for Highway Products, you will be responsible for the application of a variety of powder coats to a quality standard that is unmatched in the industry. We take great pride in the quality of our work, and our customers appreciate that when they're on the job.<br /><br />
<a href="HPIPowderCoaterJobAd.pdf" target="_blank">Download Job Listing</a>
</p>
</div>
<div class="jobOffer">
<img class="jobImg" src="PainterJob.jpg">
<p>
Highway Products is looking for experienced painters to join our team immediately in White City, Oregon. Our painters at Highway Products are responsible for the application of a variety of paints to a quality standard that is unmatched in the industry. We take great pride in the quality of our work, and our customers appreciate that when they're on the job.<br /><br />
<a href="HPIPainterJobAd.pdf" target="_blank">Download Job Listing</a>
</p>
</div>
<div class="leftSpacer">
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
        <?php include_once('../_includes/sidebar_signup.php'); ?>
    </div>
    </div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php include_once('../_includes/footer.inc.php'); ?>