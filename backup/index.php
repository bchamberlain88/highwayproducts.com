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
if($_GET['q']){
$product_selector = $_GET['q']; 
}
include_once('./_includes/meta.inc.php');
include_once('./_includes/quote.php');
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
    <a class='scroll-slider'>
        <span class='fa fa-arrow-down'></span>
    </a>
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

        <!-- custom-fabrication -->

        <?php } elseif($product_selector == 'custom-aluminum-fabrication') { ?>
<div class='wrapper fs'>
            <div class='menu-content'>
                <?php include( './_includes/dropdown_custom_fabrication.php' ); ?>
             </div>
        </div>

        <!-- specialty-products -->

        <?php } elseif($product_selector == 'specialty-products') {
        header("Location: " . DIR_ROOT . "specialty-products"); /* Redirect browser */
        exit();

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

        <!-- law-enforcement -->

        <?php } elseif($product_selector == 'aluminum-law-enforcement-accessories') { ?>
            <div class='wrapper fs'>
                <div class='menu-content'>
                    <?php include( './_includes/dropdown_law_enforcement.php' ); ?>
                </div>
            </div>

        <!-- pickup-packs -->

        <?php } elseif($product_selector == 'pickup-packs') { ?>
            <div class='wrapper fs'>
                <div class='menu-content'>
                    <?php include( './_includes/dropdown_pickup_packs.php' ); ?>
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
            <?php if($product['id'] == 19) { ?>  
                <!-- //special case for highwayman since it has no sub or main page -->
                <ul class='breadcrumbs'>
                    <li>
                        <a class='animate' href='<?php echo DIR_ROOT; ?>'>
                            <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                        </a>
                    </li>
                    <li class="lastCrumb"><?php echo $product['name']; ?></li>
                </ul> <?php } else { ?>
                <ul class='breadcrumbs'>
                    <li>
                        <a class='animate' href='<?php echo DIR_ROOT; ?>'>
                            <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                        </a>
                    </li>
                    <li>
                        <a class='animate' href='<?php echo DIR_ROOT . $mainCategory['url']; ?>'><?php echo $mainCategory['category']; ?> 
                            <i class='fa fa-angle-right'></i>
                        </a>
                    </li>
                    <!-- if the breadcrumb only goes one level, omit extra crumb -->
                    <?php if($product['single_crumb'] == 1) { } else { ?>
                        <li>
                            <a class='animate' href='<?php echo DIR_ROOT . $category['url']; ?>'><?php echo $category['name']; ?> 
                                <i class='fa fa-angle-right'></i>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="lastCrumb"><?php echo $product['name']; ?></li>
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
            } ?>
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
            <h1>Product Features</h1>
            <?php
            if($product['is_base'] == 1) { 
                    features( 'base_product', $product_selector, SET_LIMIT_PRODUCT_FEATURES );
                } else {
                    features( 'product', $product_selector, SET_LIMIT_PRODUCT_FEATURES );
                } ?>
            <?php if($product['no_lightweight'] == 1) { } else { ?>
                <li class='feature' data-feature="lightweight" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                    <div class='media-container ft small animate'>
                        <a class="image-container animate">
                            <img class="animate lb lazy" alt="Half the Weight of Steel" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/lightweight.jpg' src='<?php echo DIR_IMAGES; ?>_misc/lightweight.jpg' />
                        </a>
                    </div>
                    <div class='feature-info'>
                        <h2>Half the Weight of Steel</h2>
                        <p>Aluminum is half the weight of steel; allowing a heavier load which gives better fuel economy while carrying additional cargo.</p>
                    </div>
                </li>
            <?php } ?>
            <li class='feature' data-feature="shipping" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                <div class='media-container ft small animate'>
                    <a class="image-container animate">
                        <img class="animate lb lazy" alt="Shipping" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/shipping.jpg' src='<?php echo DIR_IMAGES; ?>_misc/shipping.jpg' />
                    </a>
                </div>
                <div class='feature-info'>
                    <h2>Shipping</h2>
                    <p>Many of our high quality products can be shipped via common carrier truck. We can ship this package to your door or to your favorite up fitter, body shop, or weld shop.</p>
                </div>
            </li>
            <li class='feature' data-feature="alcoa" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                <div class='media-container ft small animate'>
                    <a class="image-container animate">
                        <img class="animate lb lazy" alt="Alcoa Aluminum" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/alcoa.jpg' src='<?php echo DIR_IMAGES; ?>_misc/alcoa.jpg' />
                    </a>
                </div>
                <div class='feature-info'>
                    <h2>Alcoa Aluminum</h2>
                    <p>Highway Products proudly uses premium Alcoa aluminum to build the highest quality American made metal products available.</p>
                </div>
            </li>
            <?php if($product['five_year_warranty'] == 1) { ?>
                <li class='feature' data-feature="warranty" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                    <div class='media-container ft small animate'>
                        <a class="image-container animate">
                            <img class="animate lb lazy" alt="Lifetime Warranty" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/warranty_5year.jpg' src='<?php echo DIR_IMAGES; ?>_misc/warranty_5year.jpg' />
                        </a>
                    </div>
                    <div class='feature-info'>
                        <h2>Five Year Warranty</h2>
                        <p>Our semi truck tool boxes come with a five year warranty against defects in workmanship. Your warranty includes locking mechanisms,
                        hinges, gas props, weather stripping, and any other materials we use.</p>
                    </div>
                </li>
            <?php } else { ?>
                <li class='feature' data-feature="warranty" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                    <div class='media-container ft small animate'>
                        <a class="image-container animate">
                            <img class="animate lb lazy" alt="Lifetime Warranty" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/lifetime-warranty.png' src='<?php echo DIR_IMAGES; ?>_misc/lifetime-warranty.png' />
                        </a>
                    </div>
                    <div class='feature-info'>
                        <h2>Lifetime Warranty</h2>
                        <p>All of our standard products come with a Lifetime Warranty against defects in workmanship. Your warranty includes locking mechanisms,
                        hinges, gas props, weather stripping, and any other materials we use.</p>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <?php if($product['no_style'] == 1) { } else { ?>
            <ul class='product-styles'>
                <h1>Color &amp; Style Options</h1><br />
                <h4>Please click one of the boxes for more information</h4><br />
                <li class='style-option' data-name='Silverback' data-description='Our smooth aluminum finish makes quick work of sliding equipment in and sweeping debris out. Aluminum only requires minimal polishing to keep it looking like brand new.' data-style='silver'>
                    <img alt='Highway Products stlye options: Silverback' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-silverback.jpg' />
                </li>
                <li class='style-option' data-name='Flat Black' data-description='Powder coated Flat Black The flat black finish is a handsome finishing touch, highly respected, and is always a regular choice among lots of semi and pickup truck drivers.' data-style='black'>
                    <img alt='Highway Products stlye options: Flat Black' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-black.jpg' />
                </li>
                <li class='style-option' data-name='Black &amp; Silver' data-description="The new black and silver edition is a popular style.  The finish adds a luxurious touch to your vehicle." data-style='silver_black'>
                    <img alt='Highway Products stlye options: Black and Silver' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-silver-black.jpg' />
                </li>
                <li class='style-option' data-name='Gladiator' data-description='The Gladiator is the newest edition to our arsenal. It offers a baked on powder coated finish with a smooth body and unique dimpled lids.' data-style='gladiator'>
                    <img alt='Highway Products stlye options: Gladiator Style' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-gladiator.jpg' />
                </li>
                <li class='style-option' data-name='Leopard' data-description='The Leopard edition features our trademark (powder coated and shaved) diamond plate finish. Unsurpassed in looks, this finish will turn heads and attract followers with questions. Be prepared!' data-style='leopard'>
                    <img alt='Highway Products stlye options: Leopard Style' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-leopard.jpg' />
                </li>
                <li class='style-option' data-name='Diamond Plate' data-description='Diamond plate, also known as checker plate or tread plate, is a regular pattern of raised diamonds on one side which combines the looks of toughness and durability. Sharp and Clean!' data-style='diamond'>
                    <img alt='Highway Products stlye options: Diamond Plate' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-diamond-plate.jpg' />
                </li>
                <li class='style-option' data-name='Custom Colors' data-description="Please call us at 1-800-866-5269 to discuss exactly what you have in mind. We cater for any customized fabrication you need, just drop us a line and ask for our sales manager and explain in detail your ideas and dreams; we'll make it a reality." data-style='custom'>
                    <span class='fa fa-eyedropper'></span>
                    <div class='custom-colors'></div>
                </li>
                <div class='selected-style'></div>
            </ul>
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
            <h2 class='hide eight_hundred'>Share this page</h2>
            <div class='addthis_sharing_toolbox hide eight_hundred'></div>
            <div class='side-sep hide eight_hundred'></div>
        <?php } ?>

        <?php // show facebook like box if allowed
        if( SET_FACEBOOK_LIKES == 'true' ) { ?>
            <!-- facebook likebox -->
            <div class='fb-like hide eight_hundred' data-href='<?php echo DIR_URL; ?>' data-layout='standard' data-action='like' data-show-faces='true' data-share='false'></div>
            <!-- end facebook likebox -->
            <div class='side-sep hide eight_hundred'></div>
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
        <!-- load product gallery thumbnails - limit: 15 -->
        <h1>Image Gallery</h1>
        <?php galleryThumbs( 'product', $product_selector, SET_LIMIT_GALLERY_THUMBS ); ?>
        <div class='side-sep'></div>
        <div class='testimonials'>
            <h1>Customer Testimonials</h1>
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
            <form class='newsletter-form sidebar-news aweber-form' data-submit='718137999'>
                <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75703552' name='email' placeholder='Enter your email address' type='text' />
                <button class='button large secondary animate submit' type='submit'>Subscribe To Newsletter</button>
            </form>
            <div class="aweber AW-Form-718137999"></div>
            <!-- newsletter script -->
            <script type="text/javascript">(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//forms.aweber.com/form/99/718137999.js";
                fjs.parentNode.insertBefore(js, fjs);
                }(document, "script", "aweber-wjs-6bhepjf7u"));
            </script>
            <div id="hideSep" class='side-sep'></div>
            <h1 class="interProd">Interested in this product?</h1>
            <p>Click the button below to fill out a form and get a free quote from one of our sales representitves!</p>
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
    <a class='scroll-slider'>
        <span class='fa fa-arrow-down'></span>
    </a>
    <!-- start slider container -->
    <div class='slider-container'>
        <!-- slider wrapper -->

        <div class='slider'>

         <div class='slide animate slow' data-slide='1'>
            
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                        <h1 class="main-product-slide-cat">Truck Accessories</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>aluminum-pickup-truck-accessories">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
            
                <h1 class='product-slide-header'>HPI Specializes in the Fabrication Of Toolboxes, Service Bodies, Flatbeds, Transfer Tanks, Tonneau Covers / Truck Bed Caps And More...</h1>
                <a href="<?php echo DIR_ROOT; ?>aluminum-pickup-truck-accessories"><img class='now' alt="Custom aluminum fabrication projects deserve special attention and our team is dedicated to you and your needs." src="<?php echo DIR_IMAGES.'_home/_slides/custom-pickup-truck-fabrication-by-highway-products-slide-1b.jpg'; ?>"/></a>
            </div>

            <div class='slide animate slow' data-slide='2'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                    <h1 class="main-product-slide-cat">Aluminum Service Bodies - Standard &amp; Custom</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>aluminum-truck-service-bodies">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                    </div><!-- product-slide-buttons -->
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>HPI manufactures a full line of Service Bodies that are half the weight of steel and do not rust.</h1>
                <a href="<?php echo DIR_ROOT; ?>aluminum-truck-service-bodies"><img alt="HPI manufactures a full line of Service Bodies that are half the weight of steel and do not rust." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES.'_home/_slides/aluminum-service-bodies-utility-bodies-by-highway-products-slide-2a.jpg'; ?>'/></a>
            </div>

            <div class='slide animate slow' data-slide='3'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                    <h1 class="main-product-slide-cat">Aluminum Flatbeds - Standard &amp; Custom</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>aluminum-truck-flatbeds">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>HPI Aluminum Flatbeds carry more cargo, look great, and add fuel efficiency to any make &amp; model of pickup truck.</h1>
                <a href="<?php echo DIR_ROOT; ?>aluminum-truck-flatbeds"><img alt="Every business is unique. Why shouldn't the biggest tool...your service body, be unique as well?" class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES; ?>_home/_slides/aluminum-flatbeds-pickup-trucks-by-highway-products-slide-3a.jpg'/></a>
            </div>
            <div class='slide animate slow' data-slide='4'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                        <h1 class="main-product-slide-cat">Semi Truck Accessories</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>aluminum-semi-truck-accessories">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>                
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>HPI has built its reputation on manufacturing the toughest semi truck and trailer Underbody Tool Boxes on the planet.</h1>
                <a href="<?php echo DIR_ROOT; ?>aluminum-semi-truck-accessories"><img alt="HPI Aluminum Flatbeds carry more cargo, look great, and add fuel efficiency to any make & model of pickup truck." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES.'_home/_slides/semi-truck-accessories-underbody-boxes-by-highway-products-slide-4a.jpg'; ?>'/></a>
            </div>

            <div class='slide animate slow' data-slide='5'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                    <h1 class="main-product-slide-cat">Pickup Packs&trade;</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>pickup-packs">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>The HPI Pickup Pack&trade; is a unique alternative for companies needing organized storage and lockup security without the cost of a service body.</h1>
                <a href="<?php echo DIR_ROOT; ?>pickup-packs"><img alt="Have something specific you need built? We can fabricate custom top boxes, underbody boxes, transfer tanks and more." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES; ?>_home/_slides/pickup-truck-pickup-packs-by-highway-products-slide-5a.jpg'/></a>
            </div>

            <div class='slide animate slow' data-slide='6'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                    <h1 class="main-product-slide-cat">Truckslide&trade;</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>truckslides">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>The Truckslide&trade; Cargo Slide makes reaching objects in your truck bed easy and eliminates the hassle and strain on your back.</h1>
                <a href="<?php echo DIR_ROOT; ?>truckslides"><img alt="HPI has built its reputation on manufacturing the toughest semi truck and trailer Underbody Tool Boxes on the planet." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES; ?>_home/_slides/truckslide-bed-slide-cargo-tray-by-highway-products-new-slide-6a.jpg'/></a>
            </div>

            <div class='slide animate slow' data-slide='7'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                <h1 class="main-product-slide-cat">Truck Tool Boxes</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>aluminum-truck-tool-boxes">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                    </div><!-- product-slide-buttons -->
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>Made from the toughest materials on the market, HPI Aluminum Truck Tool Boxes provide lockable storage for your tools and work supplies.</h1>
                <a href="<?php echo DIR_ROOT; ?>aluminum-truck-tool-boxes"><img alt="The Truckslide™ Cargo Slide makes reaching objects in your truck bed easy and eliminates the hassle and strain on your back." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES; ?>_home/_slides/pickup-truck-tool-boxes-by-highway-products-slide-7a.jpg'/></a>
            </div>

            <div class='slide animate slow' data-slide='8'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                        <h1 class="main-product-slide-cat">Headache Racks / Cab Guards</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>aluminum-headache-racks">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>HPI Aluminum Headache racks are not only stylish but they add functionality to your pickup truck.</h1>
                <a href="<?php echo DIR_ROOT; ?>aluminum-headache-racks"><img alt="The HPI Pickup Pack™ is a unique alternative for companies needing organized storage and lockup security without the cost of a service body." src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" class='delayLoad lazy' data-original='<?php echo DIR_IMAGES; ?>_home/_slides/pickup-truck-headache-racks-cab-guards-by-highway-products-slide-8a.jpg'/></a>
            </div>

            <div class='slide animate slow' data-slide='9'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                     <h1 class="main-product-slide-cat">Fuel Transfer Tanks</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>fuel-tanks">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>Aluminum transfer tanks are very convenient when you need to transport extra fuel to a worksite or while you are travelling.</h1>
                <a href="<?php echo DIR_ROOT; ?>fuel-tanks"><img alt="HPI Aluminum Headache racks are not only stylish but they add functionality to your pickup truck." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES; ?>_home/_slides/pickup-truck-fuel-transfer-tanks-by-highway-products-slide-9a.jpg'/></a>
            </div>

            <div class='slide animate slow' data-slide='10'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                        <h1 class="main-product-slide-cat">Fire Truck Bodies</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>fire-truck-service-body">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>The strength and integrity of any fire truck is built on it's foundation. HPI's are built on the understructure of our Strongback&trade; flatbeds.</h1>
                <a href="<?php echo DIR_ROOT; ?>fire-truck-service-body"><img alt="Made from the toughest materials on the market, HPI Aluminum Truck Tool Boxes provide lockable storage for your tools and work supplies." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES; ?>_home/_slides/pickup-truck-fire-truck-bodies-brush-trucks-by-highway-products-slide-10a.jpg'/></a>
            </div>

            <div class='slide animate slow' data-slide='11'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                     <h1 class="main-product-slide-cat">Law Enforcement</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>aluminum-law-enforcement-accessories">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>Law Enforcement Agencies use our lockup boxes to keep firearms, ammunition, explosives, bulletproof vests, and raid gear in.</h1>
                <a href="<?php echo DIR_ROOT; ?>aluminum-law-enforcement-accessories"><img alt="Made from the toughest materials on the market, HPI Aluminum Truck Tool Boxes provide lockable storage for your tools and work supplies." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES; ?>_home/_slides/law-enforcement-vehicle-accessories-by-highway-products-slide-11a.jpg'/></a>
            </div>

            <div class='slide animate slow' data-slide='12'>
                <div class="product-slide-info">
                    <div class="product-slide-buttons">
                    <h1 class="main-product-slide-cat">Highwayman&trade; RV Hauler</h1>
                        <a class="product-slide-link" href="<?php echo DIR_ROOT; ?>highwayman-rv-hauler-tow-body">More Information <i class="fa fa-angle-right"></i></a>
                        <a class="product-slide-link fill get-quote-plox">Get a Quote <i class="fa fa-angle-right"></i></a>
                
                    </div><!-- product-slide-buttons -->
                
                </div><!--product-slide-info-->
                <h1 class='product-slide-header'>Highwayman&trade; RV Hauler - The classic Highwayman&trade; is a stylish RV Hauler for pulling fifth wheel trailers, travel trailers and horse trailers.</h1>
                <a href="<?php echo DIR_ROOT; ?>highwayman-rv-hauler-tow-body"><img alt="The strength and integrity of any fire truck is built on it's foundation. HPI's are built on the understructure of our Strongback™ flatbeds." class='delayLoad lazy' src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-original='<?php echo DIR_IMAGES; ?>_home/_slides/highwayman-rv-hauler-rv-tow-bodies-by-highway-products-slide-12a.jpg'/></a>
            </div>

        </div>

        <!-- end slider wrapper -->
    </div>
    <!-- end slider container -->

    <!-- slider controls -->
    <div class='selectors-container'>
            <ul class='selectors'>
                <!-- jquery will append the slide selectors -->
            </ul>
        </div>
    <!-- end slider controls -->

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
                <form class='newsletter-form aweber-form' data-submit='1640328137'>
                    <input spellcheck='false' class='input-text large animate form-input aweber-input' data-aweber='awf_field-69124843' name='email' placeholder='Enter your email address' type='text' />
                    <button class='button medium secondary animate submit' type='submit'>Join Newsletter</button>
                </form>
                <div class="AW-Form-1640328137 aweber-news"></div>
                <script type="text/javascript">(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "http://forms.aweber.com/form/37/1640328137.js";
                    fjs.parentNode.insertBefore(js, fjs);
                    }(document, "script", "aweber-wjs-uzw2gkatx"));
                </script>
            </div>
            <!-- end newsletter signup form -->

            <h1>Highway Products is trusted by:</h1>
            <img alt="Stanford, U.S. Army, U.S. Department of the Interior, U.S. Forest Service, FBI, FedEx" src='http://www.highwayproducts.com/images/homepage/highway_products_trust.png' style="width: 100%;" />

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
