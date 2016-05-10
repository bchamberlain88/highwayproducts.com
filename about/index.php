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
 * @copyright Highway Products Inc. 2015
 *
 */
include_once('../_includes/meta.inc.php');
include_once('../_includes/quote.php'); ?>

<div class='container'>
    <div class='slider-container'>
        <div class='slider'>
            <?php pageSlides('_about', 3); ?>
        </div>
    </div>
    <div class='selectors-container'>
        <ul class='selectors'>
            <!-- jquery will append the slide selectors -->
        </ul>
    </div>
    <div class='wrapper fs'>
        <div class='full-content'>
            <ul class='breadcrumbs' itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
                    <a class='animate' href='<?php echo DIR_ROOT; ?>' itemprop="item">
                        <i class='home-icon fa fa-home'></i> <span itemprop="name">Highway Products</span> <i class='fa fa-angle-right'></i>
                    </a>
                <meta itemprop="position" content="1" />
                </li>
                <li class="lastCrumb">About Us</li>
            </ul>
            <p>Highway Products, Inc. is located in southern Oregon just 37 miles north of the California state line in the small town of White City. Rogue Valley is surrounded by snow-capped mountains and mesa-topped buttes of Upper and Lower Table Rocks. Nearby is the City of Medford and world-renowned Crater Lake. Our cozy 50,000 sq ft facility is located on 10 acres of industrial property, allowing for plenty of future growth. We welcome our customers to stop by and see our plant 
            when in the area. There's plenty of parking for RVs and we'd love to show off our plant. Most are dazzled by our clean shop floors and are unaware of the many products we make.<br><br>
            Our simple goal: give our customers the best bang for their buck in everything we do!
            To maintain this goal we must keep our staff well trained in the latest technologies as well as the latest software and equipment available. Our well rounded engineering staff of six are always busy building our next custom tool boxes, flatbeds, service bodies, or developing new products for our customers. Our diverse product lines include standard and custom lines of semi as well as pickup truck boxes, 
            cab protectors, guards, truck flatbeds, RV tow bodies, ramps, cargo slides, and service bodies as well. We are well known for our custom fabrication capability. Plus, we often step out of our domain to build other products for our customers' needs.<br><br>One of our big advantages is being a family owned organization. This allows us to make quick decisions with your values in mind. Our exceptional service, products, and lifetime warranties keep our customers 
            coming back again and again. This also forces us to make every effort to give you the highest quality product made, or we put our cherished customers return business in jeopardy. The Gros family and their dedicated staff promise to work hard for you, your customer, your company, or your friends. We know your success and ours depend on it. That will always be the plan.<br /><br /></p>
            See our family of brands:<br /><br />
            <ul class="aboutList">
                <li><a target="_blank" class="animate" href="http://pavati.com/">Pavati</a></li>
                <li><a target="_blank" class="animate" href="http://www.pavatimarine.com/">Pavati Marine</a></li>
                <li><a target="_blank" class="animate" href="http://www.800toolbox.com/">1-800-TOOLBOX</a></li>
            </ul>
        </div>
    </div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php include_once('../_includes/footer.inc.php'); ?>