<?php

/**
 *
 * Highway Products product packages
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

include_once('../_includes/meta.inc.php'); 
$package_selector = $_GET['p']; ?>

<div class='container'>

    <?php if($package_selector){

    /*
     *
     * Visitor is viewing an individual package.
     * Load all information for the selected package.
     *
     */

    $getPackage = mysql_query('SELECT * FROM product_packages WHERE selector = "'.$package_selector.'"');
    $package = mysql_fetch_assoc($getPackage);

    ?>

    <!-- show financing banner if available -->
    <?php isFinanced( $package['is_financed'] ); ?>
    <div class='slider-container'>
        <div class='slider'>
            <!-- show package slides -->
            <?php slides( 'package', $package_selector, 0 ); ?>
        </div>
    </div>
    <div class='selectors-container'>
        <ul class='selectors'>
            <!-- jquery will append the slide selectors -->
        </ul>
    </div>
    <div class='wrapper'>

        <div class='left-content'>

            <h1 class='product-header'><?php 
                if($package['is_hot'] == 1){ echo("<span class='hot-item'>hot</span>"); }
                if($package['is_new'] == 1){ echo("<span class='new-item'>new</span>"); }
                if($package['is_onsale'] == 1){ echo("<span class='sale-item'>sale</span>"); }
                echo $package['name']; 
            ?></h1>
            <ul class='ratings clear'>
                <?php $rating = rating( 'package', $package_selector ); ?>
                <?php printStars( $rating['average'] ); ?>
                <label>Rated <?php echo $rating['average']; ?> out of 5 stars<span><?php echo $rating['ratings']; ?> Votes</span></label>
            </ul>

            <label class='categories'>
                <h3>Categories: </h3>
                <?php categories( $package['categories'] ); ?>
            </label>

            <a class='get-quote animate'><i class='fa fa-lg fa-send'></i>Request a free quote</a>

            <p><?php echo $package['description']; ?></p>

            <!-- package video -->
            <?php showVideo( 'package', $package_selector ); ?>

            <ul class='feature-list'>
                <h1>package Features</h1>
                <?php features( 'package', $package_selector, 0 ); ?>
            </ul>

            <!-- start disqus comments -->
            <h1>Comment on this package</h1>
            <div class='comments' id='disqus_thread'></div>
            <!-- end disqus comments -->

        </div>

        <div class='right-content'>

            <h2>Share this page</h2>
            <div class="addthis_sharing_toolbox"></div>

            <div class='side-sep'></div>

            <h1 class='qa'>Have A Question?</h1>
            <p>If you have any questions about this package, our sales team is more than happy to help!</p>
            <span class='categories'>
                <a class='animate' href='<?php echo DIR_ROOT; ?>support/faq/'>Read All Q&A</a>
                <a class='animate'>Ask A Question</a>
            </span>

            <div class='side-sep'></div>

            <ul class='callout-features'>
                <?php 

                // check if package has financing available
                if( $package['is_financed'] == 1 ) { ?>
                    <li class='callout-feature'>
                        <i class='circle fa fa-check'></i>
                        Financing now available!
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
                    100% hand made in the United States
                </li>
            </ul>

            <div class='side-sep'></div>

            <!-- load package gallery thumbnails - limit: 15 -->
            <h1>Image Gallery</h1>
            <?php galleryThumbs( 'package', $package_selector, 15 ); ?>
            
            <div class='side-sep'></div>

        </div>

    </div>

    <?php }else{

    /*
     *
     * Visitor has not selected a package yet.
     * Display the master list of categorized packages.
     */

    ?>

    <div class='wrapper'>
        List of packages
    </div>

    <?php } ?>

<script type="text/javascript">
var disqus_shortname = 'highwayproducts';
(function() {
var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq); })();
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php include_once('../_includes/footer.inc.php'); ?>