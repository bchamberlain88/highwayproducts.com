<?php

/**
 * Warranty info page
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
        <div class='left-content'>
            <ul class='breadcrumbs'>
                <li><a class='animate' href='<?php echo DIR_ROOT; ?>'>
                    <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                </a></li>
                <li class="lastCrumb">Warranty</li>
            </ul>
<h2>Warranties and Returns Made Easy</h2>
<h3>Our Simple Promise to You:</h3>
<p>
<br />
Dear Customer,
In 1980, over 30 years ago, we first opened our doors at Highway Products, Inc. We soon found out the hard way that no matter what we do or how hard we try, sometimes a part gives up prematurely. And, that even the best engineering fails on occasion and in certain situations. We also found out, to our surprise, we're human! We found out that you, our customers, are very smart and realize everyone makes mistakes. But first, you were most interested in how our products performed. And second, if there was a problem, how are WE going to handle it?<br /><br />

So we decided to take the pressure off our valued customer and put it where it should be, ON US! Thus, we are giving our customer a simple "Lifetime Warranty". No fine print to read, hidden rules or warranty cards to fill out, and no receipts needed for returns or service. So, if this is your first purchase from Highway Products, Inc., please read and believe the following: If we make a mistake, it will be our goal to fix or replace any defective products as fast as possible and Make You Happy!<br /><br />

All of our standard products come with a Lifetime Warranty against defects in workmanship. One of the reasons we can offer Lifetime Warranties on our standard products is because we've witnessed many years of product abuse and used this information to continually improve these products. As well, we also promise to do our best to give you the same warranty for custom products we make just for you. Highway Products is the largest custom tool box manufacturer on the planet and we build these boxes by the thousands. Our custom products are designed by our top level engineers, so you get the best we can give.<br /><br />

Your warranty will include locking mechanisms, hinges, gas props, weather strip, and most other materials we use. And, we'll give you free tech support on any problem you have. Plus, we'll replace lost keys, free. Naturally we cannot cover things like paint chips, light bulbs, abuse, minor adjustments that you can easily make yourself, and normal wear and tear.<br /><br />

If the product you bought from Highway Products does not meet your expectations, we want to know so we can help you with it and make it better. All our products are a "Work in Progress", meaning, we are continually changing and improving them. Mostly, product improvements come from our customers suggestions!<br /><br />

Custom made products are not easily resellable. Unless we goofed on something, we cannot normally give refunds. To avoid any problems on custom products, we'll create a product drawing for you to look at, make changes if necessary, and get your approval before we start production. We've found this proven method rarely has problems.<br />
If you need large quantities, we'll build you the first one (first article) and send it to you, before we start production. This will insure that you get what you asked for.<br /><br />

Our goal is: "You get a great product the first time!" We want you to buy from us again, recommend us to others, even brag about us, and show you Highway Products is: "A Name You Can Trust." Thank you for buying or considering our products. Without you we are nothing!<br /><br />

Gene Gros<br />
President, Highway Products, Inc.<br /><br />

P.S. Feel free to ask for me if you don't think we're performing up to your standards. I'll personally take care of it. That's a promise. Made in the USA is not just a buzz word here at Highway Products. It means incredible performance! We guarantee it!
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