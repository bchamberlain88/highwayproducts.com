<?php

/**
 *
 * Highway Products homepage.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */
session_start();
if($_GET['q']){
$product_selector = $_GET['q']; 
}
include_once('./_includes/meta.inc.php');
include_once('./_includes/quote.php');
include_once('./_includes/newsletter.php');
 ?>

<?php // include facebook api if allowed
if( SET_FACEBOOK_LIKES == 'true' ) { ?>
    <!-- include facebook likebox script -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=823890097631011&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- end facebook likebox script -->
<?php }

if($_GET['q']){ /* THIS IS WHEN VIEWING A SPECIFIC PRODUCT FROM HERE DOWN */
$product_selector = $_GET['q']; 
?>

<div class='container sb' itemscope itemtype='http://data-vocabulary.org/Product'>
    <?php if($product_selector){

    $getMainCat = mysql_query('SELECT * FROM product_categories_main WHERE url = "'.$product_selector.'"');
    if(mysql_num_rows($getMainCat) > 0){
        $mainCat = mysql_fetch_assoc($getMainCat); ?>

    <!-- pickup-trucks -->    

    <?php if($product_selector == 'aluminum-pickup-truck-accessories') { ?>
         <div class='wrapper fs'>
            <div class='menu-content'>
                <?php include( './_includes/dropdown_truck_acc.php' ); ?>
            </div>
        </div>

        <!-- semi-trucks -->

        <?php } elseif($product_selector == 'aluminum-semi-truck-accessories') { ?>
         <div class='wrapper fs'>
            <div class='menu-content'>
                 <?php include( './_includes/dropdown_semi_trucks.php' ); ?>
             </div>
        </div>

                <!-- hunting-accessories -->

        <?php } elseif($product_selector == 'hunting-accessories') { ?>
            <div class='wrapper fs'>
                <div class='menu-content'>
                    <ul class='nav-list'>
                        <div class='list active no-shadow' data-list='flatbeds' id='list-flatbeds'>
                            <div class='wrapper items'>
                                <?php
                                $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "hunting-accessories" ORDER BY oid ASC');
                                $num_items = mysql_num_rows($getItems);
                                while($item = mysql_fetch_assoc($getItems)){
                                    $getSub = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$item['parent']."' LIMIT 1");
                                    $sub = mysql_fetch_assoc($getSub); ?>
                                    <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
                                        <div class='item-block-content'>
                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' .$sub['parent'] . '/' . $item['parent'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg'; ?>' />
                                            <span><?php echo $item['name']; ?></span>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>

        <!-- law-enforcement -->

        <?php } elseif($product_selector == 'aluminum-law-enforcement-accessories') { ?>
            <div class='wrapper fs'>
                <div class='menu-content'>
                    <?php include( './_includes/dropdown_law_enforcement.php' ); ?>
                </div>
            </div>

        <!-- custom-fabrication -->

        <?php } elseif($product_selector == 'custom-aluminum-fabrication') { ?>
<div class='wrapper fs'>
            <div class='menu-content'>
                <?php include( './_includes/dropdown_custom_fabrication.php' ); ?>
             </div>
        </div>

        <!-- specialty-products -->

        <?php } elseif($product_selector == 'specialty-products') {
        redirect('custom-aluminum-fabrication');

        //all other main category pages

        } else {
            include_once( './_includes/main_cat_default.php' );
            } ?>
    <?php }else{
    $getSub = mysql_query('SELECT * FROM product_categories_sub WHERE url = "'.$product_selector.'"');
    if(mysql_num_rows($getSub) > 0){
        $sub = mysql_fetch_assoc($getSub);
        $getSubCat = mysql_query('SELECT * FROM product_categories_main WHERE selector = "'.$sub['parent'].'"');
        $returnSubCat = mysql_fetch_assoc($getSubCat); ?>

        <!-- service-bodies -->

        <?php if($product_selector == 'aluminum-truck-service-bodies') { ?>
            <div class='wrapper fs'>
                <div class='menu-content'>
                <?php include( './_includes/dropdown_service_bodies.php' ); ?>
                </div>
            </div>

        <!-- aluminum-flatbeds -->

        <?php } elseif($product_selector == 'aluminum-truck-flatbeds') { ?>
            <div class='wrapper fs'>
                <div class='menu-content'>
                    <?php include( './_includes/dropdown_aluminum_flatbeds.php' ); ?>
                </div>
            </div>

        <!-- pickup-packs -->

        <?php } elseif($product_selector == 'pickup-packs') { ?>
            <div class='wrapper fs'>
                <div class='menu-content'>
                    <?php include( './_includes/dropdown_pickup_packs.php' ); ?>
                </div>
            </div>

        <!-- tow-bodies -->

        <?php } elseif($product_selector == 'aluminum-tow-bodies') { ?>
            <div class='wrapper fs'>
                <div class='menu-content'>
                    <?php include( './_includes/dropdown_tow_bodies.php' ); ?>
                </div>
            </div>

        <!-- all other sub-category pages -->

        <?php } else {

            include_once( './_includes/sub_cat_default.php' );

        } ?>

    <?php } else {

    /*
     *
     * Visitor is viewing an individual product.
     * Load all information for the selected product.
     *
     */

    $getProduct = mysql_query('SELECT * FROM product_categories_items WHERE selector = "'.$product_selector.'" LIMIT 1');
    $product = mysql_fetch_assoc($getProduct);
    $getVideo = mysql_query('SELECT * FROM product_videos WHERE selector = "'.$product_selector.'" LIMIT 1');
    $video = mysql_fetch_assoc($getVideo);
    $getCategory = mysql_query('SELECT * FROM product_categories_sub WHERE selector = "'.$product['parent'].'"');
    $category = mysql_fetch_assoc($getCategory);
    //if it's a single breadcrumb, get parent based on product instead of sub-category
    if($product['single_crumb'] == 1) { 
        $getMainCategory = mysql_query('SELECT * FROM product_categories_main WHERE selector = "'.$product['parent'].'"');
    } else {
        $getMainCategory = mysql_query('SELECT * FROM product_categories_main WHERE selector = "'.$category['parent'].'"');
    }
    $mainCategory = mysql_fetch_assoc($getMainCategory);
    ?>
    <div class='slider-container'>
        <div class='slider'>
            <!-- show product slides -->
            <?php slides( 'product', $product_selector, SET_LIMIT_SLIDES ); ?>
        </div>
    </div>
    <div class='selectors-container'>
        <a target="_blank" class='product-slide-link gallery-link' href="<?php echo DIR_ROOT . 'gallery/' . $product_selector ?>">View Gallery <i class='fa fa-angle-right'></i></a>
        <ul class='selectors'>
            <!-- jquery will append the slide selectors -->
        </ul>
    </div>
    <div class='wrapper fs'>
        <div class='left-content'>
            <a class='animate button medium gold get-quote-btn get-quote-plox'>
                <span class='fa fa-paper-plane'></span>
                <span class='hide ten_twenty_four'>Click for a </span>free quote
            </a>
            <?php if($product['id'] == 19) { 
                //special case for highwayman since it has no sub or main page
                ?>  
                <ul class='breadcrumbs' itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
                        <a class='animate' href='<?php echo DIR_ROOT; ?>' itemprop="item">
                            <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                        </a>
                    <meta itemprop="position" content="1" />
                    </li>
                    <li class="lastCrumb"><?php echo $product['name']; ?></li>
                </ul> <?php } else { ?>
                <ul class='breadcrumbs' itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
                        <a class='animate' href='<?php echo DIR_ROOT; ?>' itemprop="item">
                            <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                        </a>
                    <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
                        <a class='animate' href='<?php echo DIR_ROOT . $mainCategory['url']; ?>' itemprop="item"><?php echo $mainCategory['category']; ?> 
                            <i class='fa fa-angle-right'></i>
                        </a>
                    <meta itemprop="position" content="2" />
                    </li>
                    <?php 
                    //if the breadcrumb only goes one level, omit extra crumb
                    if($product['single_crumb'] == 1) { } else { ?>
                        <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
                            <a class='animate' href='<?php echo DIR_ROOT . $category['url']; ?>' itemprop="item"><?php echo $category['name']; ?> 
                                <i class='fa fa-angle-right'></i>
                            </a>
                        <meta itemprop="position" content="3" />
                        </li>
                    <?php } ?>
                    <li class="lastCrumb" ><?php echo $product['name']; ?></li>
                </ul>
            <?php } ?>
            <h1 class='product-header' itemprop='name'>
                <?php
                if($product['is_hot'] == 1){ echo("<span class='hot-item' itemprop='condition' content='hot'>hot</span>"); }
                if($product['is_new'] == 1){ echo("<span class='new-item' itemprop='condition' content='new'>new</span>"); }
                if($product['is_onsale'] == 1){ echo("<span class='sale-item' itemprop='condition' content='sale'>sale</span>"); }
                echo $product['name'];
                ?>
            </h1>
            <ul class='ratings clear'>
                <?php $rating = rating( 'product', $product_selector ); ?>
                <?php printStars( $rating['average'] ); ?>
                <label>
                    <span class='hide four_eighty'>Rated</span> <span itemprop='ratingValue' itemprop='rating'><?php echo $rating['average']; ?></span> out of 5 stars<span class='count hide four_eighty'><span itemprop='reviewCount'><?php echo $rating['ratings']; ?></span> <span class='hide four_eighty'>Votes</span></span>
                </label>
            </ul>
            <!--
            <a class='get-quote animate'><i class='fa fa-lg fa-send'></i>Request a free quote</a>
            -->
            <?php
            //if we want to show video above description
            if($video['video_above_desc'] == 1) {
                showVideo( 'product', $product_selector );
            } 
            galleryImageThumbs('product', $product_selector);
            ?>
            <p class='product-copy four_eighty'>
                <?php echo $product['description']; ?>
            </p>
            <!-- product video -->
            <?php 
            //then don't display the video here
            if($video['video_above_desc'] == 1) { } else {showVideo( 'product', $product_selector ); } ?>
    <?php if($product['has_headers'] == 1) { ?>
        <ul class='header-list'>
    <?php } else { ?>
        <ul class='feature-list'>
        <?php } ?>
        <!-- include feature list -->
        <?php include_once('./_includes/features.php'); ?>
        <!-- include style options -->
        <?php include_once('./_includes/style.php'); ?>
        <?php if($product['has_accessories'] == 1) { 
            //if product has accessories, set session var and display image
            $_SESSION['accessory_selector'] = $product_selector;
            ?>
            <a href="<?php echo DIR_ROOT . 'accessories' . '/' ?>">  <img class="accessory" src="<?php echo DIR_IMAGES . '_accessories' . '/' . $product_selector . '.jpg' ?>">
            </a>
        <?php } ?> 
        <ul class='related-products'>
            <h1>Customers Also Bought <i class='fa fa-lg fa-refresh refresh-list animate'></i></h1>
                <ul class='refresh'>
                    <?php relatedProducts( $product_selector, SET_LIMIT_RELATED_PRODUCTS ); ?>
                </ul>
        </ul>
        <?php // show comments if allowed
        if( SET_COMMENTS == 'true' ) { ?>
            <h1>Comment on this Product</h1>
            <div class='comments' id='disqus_thread'></div>
        <?php } ?>
        <?php
        //if product left side content not long enough, insert spacer to prevent "bouncing" footer issue
        if($product['needs_spacer'] == 1) { ?>
            <div class="leftSpacer"></div>
        <?php } ?>
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
<?php }}} else {} ?>

<?php // include disqus api if commenting is allowed
if( SET_COMMENTS == 'true' ) { ?>
 <!-- include disqus script -->
    <script type="text/javascript">
        var disqus_shortname = 'highwayp';
        (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq); })();
    </script>
<?php } ?>

<?php // include addthis api if sharing is allowed
if( SET_SHARING == 'true' ) { ?>
    <!-- include addthis script -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php } ?>

<?php /* THIS IS THE MAIN HOMEPAGE FROM HERE DOWN */
}else{ ?>

<!-- start main container -->
<div class='container sb'>
    <!-- include main slider -->
    <?php include_once('./_includes/main_slider.php'); ?>
    <!-- start page wrapper - max-width: 1260px -->
    <div class='wrapper fs'>

        <!-- start left content - main container -->
        <div class='left-content'>

            <a class='home-phone' href='tel:+1-800-866-5269'><span class='fa fa-phone'></span>1-800-866-5269</a>

            <!-- introduction copy -->
            <h1><span class='hide four_eighty'>Welcome to </span>Highway Products Inc.</h1>
            <p class='intro-copy'>Highway Products Inc. is proudly one of the world's premier manufacturers of aluminum truck tool boxes, service truck bodies,
            aluminum flatbeds for pickup trucks and accessories for pickup trucks and semi-trucks. Designs are taken to the leading edge
            with the highest quality innovative products available. Our products are designed and built in the U.S.A. and exported globally.
            We will customize anything you can possibly dream up and love taking on a challenge!</p>
            <!-- end introduction copy -->

            <iframe class='intro-video player youtube' height='0' src='https://www.youtube.com/embed/IIi1WeH3zR8?wmode=transparent' allowfullscreen></iframe>

            <!-- customer testimonials -->
            <h1>What <span class='hide four_eighty'>our </span>customers are saying</h1>
            <ul class='testimonials'>
                <!-- load random testimonials, limit: 3 -->
                <?php testimonials( 'all', null, 3); ?>
            </ul>
            <!-- end customer testimonials -->

            <!-- list of featured products -->
           <ul class='related-products'>
                <h1>Featured Products <i class='fa fa-lg fa-refresh refresh-list animate'></i></h1>
                <div class='refresh'>
                    <!-- load random list of featured products, limit: 9 -->
                    <?php featuredProducts(9); ?>
                </div>
            </ul>
            <!-- end list of featured products -->

            <!-- newsletter signup form -->
            <div class='newsletter-signup newsletter-form'>
                <h1>Subscribe To Our Newsletter<i class='fa fa-lg fa-times close-newsletter'></i></h1>
                <p>Enter your email address to subscribe to the Highway Products monthly newsletter.
                Receive special promotional offers, discount opportunities, as well as the latest news and updates from our sales team!</p>
                <form class='newsletter-form aweber-form' data-submit='<?php echo $newsFormID; ?>'>
                    <input required spellcheck='false' class='input-text large animate form-input aweber-input' data-aweber='awf_field-<?php echo $newsEmailID; ?>' name='email' placeholder='Enter your email address' type='text' />
                    <button class='button medium secondary animate submit' type='submit'>Join Newsletter</button>
                </form>
                <div class="AW-Form-<?php echo $newsFormID; ?> aweber-news"></div>
                <script type="text/javascript">(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//forms.aweber.com/form/99/<?php echo $newsFormID; ?>.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, "script", "aweber-wjs-6bhepjf7u"));
</script>
            </div>
            <!-- end newsletter signup form -->

            <h1>Highway Products is trusted by:</h1>
            <img alt="Stanford, U.S. Army, U.S. Department of the Interior, U.S. Forest Service, FBI, FedEx" src='http://www.highwayproducts.com/_assets/_images/highway_products_trust.png' style="width: 100%;" />

        </div>
        <!-- end left content -->

        <!-- start right content -->
        <div class='right-content'>

            <?php // include addthis api if sharing is allowed
            if( SET_SHARING == 'true' ) { ?>
                <h2 class='hide eight_hundred'>Share this page</h2>
                <div class='addthis_sharing_toolbox hide eight_hundred'></div>
                <div class='side-sep small hide eight_hundred'></div>
            <?php } ?>

            <h2>Call us today!</h2>
            <h1>1-800-866-5269</h1>

            <div class='side-sep smaller'></div>

            <h1 class='qa'>Have A Question?</h1>
            <p>If you have any questions about this product, our sales team is more than happy to help!</p>
            <span class='categories'>
                <a class='animate' href='<?php echo DIR_ROOT; ?>contact/'>Contact Our Sales Team</a>
            </span>

            <div class='side-sep'></div>

            <div class='badges'>
                <img alt='Based in Oregon, Highway Products has no sales tax on all purchases!' src='<?php echo DIR_IMAGES; ?>_misc/no-taxes-in-oregon.png' />
                <img alt='Highway Products is a U.S. Veteran owned business' src='<?php echo DIR_IMAGES; ?>_misc/veteran-owned-business.png' />
            </div>

            <div class='side-sep'></div>

            <?php // show facebook like box if allowed
            if( SET_FACEBOOK_LIKES == 'true' ) { ?>
                <!-- facebook likebox -->
                <div class='fb-like-box hide eight_hundred' data-width='347' data-href='https://www.facebook.com/HighwayProducts' data-colorscheme='light' data-show-faces='true' data-header='false' data-stream='false' data-show-border='false'></div>
                <!-- end facebook likebox -->
                <div class='side-sep hide eight_hundred'></div>
            <?php } ?>

            <?php // show twitter feed if allowed
            if( SET_TWITTER_FEED == 'true' ) { ?>
                <!-- twitter news feed -->
                <a class='twitter-timeline hide eight_hundred' style="height: 400px;" href='https://twitter.com/HighwayProducts' data-widget-id="530432710225838080">Tweets by @HighwayProducts</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
                if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                <!-- end twitter news feed -->
                <div class='side-sep hide eight_hundred'></div>
            <?php } ?>

        </div>
        <!-- end right content -->

    </div>
    <!-- end page wrapper -->

<?php // include addthis api if sharing is allowed
if( SET_SHARING == 'true' ) { ?>
    <!-- include addthis script -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php }} ?>

<!-- include the site footer and javascript files -->
<?php include_once('./_includes/footer.inc.php'); ?>
