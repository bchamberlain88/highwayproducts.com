<?php

/**
 *
 * Highway Products product directory and pages.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

include_once('../_includes/meta.inc.php'); 
$product_selector = $_GET['p']; 

?>

<?php // include facebook api if allowed
if( SET_FACEBOOK_LIKES == 'true' ) { ?>
    <!-- include facebook likebox script -->
    <div id='fb-root'></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = '//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=823890097631011&version=v2.0';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- end facebook likebox script -->
<?php } ?>

<div class='container sb' itemscope itemtype='http://data-vocabulary.org/Product'>

    <?php if($product_selector){

    /*
     *
     * Visitor is viewing an individual product.
     * Load all information for the selected product.
     *
     */

    $getProduct = mysql_query('SELECT * FROM product_custom WHERE selector = "'.$product_selector.'"');
    $product = mysql_fetch_assoc($getProduct);

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

            <ul class='breadcrumbs hide seven_hundred'>
                <li><a class='animate' href='<?php echo DIR_ROOT; ?>'>
                    <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                </a></li>
                <li><a class='animate' href='<?php echo DIR_ROOT; ?>products/'>Products <i class='fa fa-angle-right'></i></a></li>
                <li><a class='animate' href='<?php echo DIR_ROOT; ?>products/'><?php echo $category['name']; ?> <i class='fa fa-angle-right'></i></a></li>
                <li><?php echo $product['name']; ?></li>
            </ul>

            <h1 class='product-header' itemprop='name'><?php 
                if($product['is_hot'] == 1){ echo("<span class='hot-item' itemprop='condition' content='hot'>hot</span>"); }
                if($product['is_new'] == 1){ echo("<span class='new-item' itemprop='condition' content='new'>new</span>"); }
                if($product['is_onsale'] == 1){ echo("<span class='sale-item' itemprop='condition' content='sale'>sale</span>"); }
                echo $product['name']; 
            ?></h1>

            <label class='categories hide four_eighty'></label>

            <!--
            <a class='get-quote animate'><i class='fa fa-lg fa-send'></i>Request a free quote</a>
            -->
            <?php echo $product['content']; ?>

            <!-- product video -->
            <?php showVideo( 'product', $product_selector ); ?>

            <ul class='feature-list'>
                <h1>Product Features</h1>
                <?php features( 'product', $product_selector, SET_LIMIT_PRODUCT_FEATURES ); ?>
                <li class='feature warranty'>
                    <div class='media-container ft small animate warranty'>
                        <img alt='Highway Products Inc. Lifetime Warranty' src='<?php echo DIR_IMAGES; ?>_misc/lifetime-warranty.png' />
                    </div>
                    <div class='feature-info'>
                        <h2>Lifetime Warranty</h2>
                        <p>All of our standard products come with a Lifetime Warranty against defects in workmanship. Your warranty includes locking mechanisms, 
                        hinges, gas props, weather stripping, and any other materials we use.</p>
                    </div>
                </li>
            </ul>

            <ul class='product-styles'>

                <h1>Color &amp; Style Options</h1>

                <li class='style-option' data-name='Silverback' data-description='Our Aluminum finish features a smooth texture so gear easily slides in and debris is easily swept out and/or hosed off. Aluminum never rusts and just needs a little polishing now and then to keep its brand new sharp appearance.' data-style='silver'>
                    <img src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-silverback.jpg' />
                </li>
                <li class='style-option' data-name='Flat Black' data-description='Powder coated Flat Black The flat black finish is a handsome finishing touch, highly respected, and is always a regular choice among lots of semi and pickup truck drivers.' data-style='black'>
                    <img src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-black.jpg' />
                </li>
                <li class='style-option' data-name='Black &amp; Silver' data-description="The new Black and Silver edition is beautifully crafted and matches perfectly with today's popular black and silver truck wheels. This finish is something to consider as it will add an luxurious touch to your vehicle." data-style='silver_black'>
                    <img src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-silver-black.jpg' />
                </li>
                <li class='style-option' data-name='Gladiator' data-description='The Gladiator is the newest edition to our arsenal. It offers a baked on powder coated finish with a smooth body and unique dimpled lids.' data-style='gladiator'>
                    <img src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-gladiator.jpg' />
                </li>
                <li class='style-option' data-name='Leopard' data-description='The Leopard edition features our trademark (powder coated and shaved) diamond plate finish. Unsurpassed in looks, this finish will turn heads and attract followers with questions. Be prepared!' data-style='leopard'>
                    <img src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-leopard.jpg' />
                </li>
                <li class='style-option' data-name='Diamond Plate' data-description='Diamond plate, also known as checker plate or tread plate, is a regular pattern of raised diamonds on one side which combines the looks of toughness and durability. Sharp and Clean!' data-style='diamond'>
                    <img src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-diamond-plate.jpg' />
                </li>
                <li class='style-option' data-name='Custom Colors' data-description="Please call us at 1-800-866-5269 to discuss exactly what you have in mind. We cater for any customized fabrication you need, just drop us a line and ask for our sales manager and explain in detail your ideas and dreams; we'll make it a reality." data-style='custom'>
                    <span class='fa fa-eyedropper'></span>
                    <div class='custom-colors'></div>
                </li>

                <div class='selected-style'></div>

            </ul>

            <?php // show comments if allowed
            if( SET_COMMENTS == 'true' ) { ?>
                <h1>Comment on this Product</h1>
                <div class='comments' id='disqus_thread'></div>
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
                <a class='animate' href='<?php echo DIR_ROOT; ?>support/'>Read All Q&A</a>
                <a class='animate'>Ask A Question</a>
            </span>

            <div class='side-sep'></div>

            <ul class='callout-features'>
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
                    100% hand made in the United States
                </li>
            </ul>

            <div class='side-sep'></div>

            <div class='badges'>
                <img src='<?php echo DIR_IMAGES; ?>_misc/no-taxes-in-oregon.png' />
                <img src='<?php echo DIR_IMAGES; ?>_misc/veteran-owned-business.png' />
            </div>

            <div class='side-sep'></div>

            <!-- load product gallery thumbnails - limit: 15 -->
            <h1>Image Gallery</h1>
            <?php galleryThumbs( 'custom', $product_selector, SET_LIMIT_GALLERY_THUMBS ); ?>
            
            <div class='side-sep'></div>

            <div class='testimonials'>
            <h1>Customer Reviews</h1>
            <!-- load the products testimonials - limit: 3 -->
            <?php productTestimonials( $product_selector, SET_LIMIT_PRODUCT_TESTIMONIALS ); ?>
            </div>

        </div>

    </div>

    <?php }else{

    /*
     *
     * Visitor has not selected a product yet.
     * Display the master list of categorized products.
     */

    ?>

    <div class='all-products'>
        <div class='wrapper'>
            <?php allProducts(); ?>
        </div>
    </div>

    <?php } ?>

<?php // include disqus api if commenting is allowed
if( SET_COMMENTS == 'true' ) { ?>
    <!-- include disqus script -->
    <script type="text/javascript">
        var disqus_shortname = 'highwayproducts';
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

<?php include_once('../_includes/footer.inc.php'); ?>
<?php if($product_selector){ ?> 
<script type='text/javascript'>
    currentProduct("", "custom-fabrication");
</script> 
<?php } ?>
