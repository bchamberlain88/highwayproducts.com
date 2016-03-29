<?php

/**
 *
 * Contact a sales representative or find us online
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

$product_selector = $_GET['q'];
include_once('../_includes/meta.inc.php');
include_once('../_includes/quote.php');
if($product_selector){
    //check if it's a base-level page (prevents duplicate items based on selector)
    $getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $product_selector . "' AND is_base = 1" );
    $product = mysql_fetch_assoc( $getProduct );
    //if it isn't one, select as an individual product
    if($product === false) {
        $getProduct = mysql_query( "SELECT * FROM product_categories_items WHERE selector = '" . $product_selector . "'" );
        $product = mysql_fetch_assoc( $getProduct );
    }
    // get the products parent information
    $getParent = mysql_query( "SELECT * FROM product_categories_sub WHERE selector = '" . $product['parent'] . "'" );
    $parent = mysql_fetch_assoc( $getParent );
    // if it's a sub item
    if($product === false) {
        $getSubItem = mysql_query( "SELECT * FROM product_categories_sub WHERE url = '" . $product_selector . "'" );
        $subItem = mysql_fetch_assoc( $getSubItem );
    }
     //get gallery videos
    $getGalVids = mysql_query( "SELECT * FROM product_videos WHERE selector = '" . $product_selector . "' AND gallery_video = 1" );
    $GalVids = mysql_fetch_assoc( $getGalVids );
} ?>

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
<?php } ?>

<div class='container sb'>
    <div class='wrapper fs'>
        <div class='left-content'>
            <ul class='breadcrumbs' itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"><a class='animate' href='<?php echo DIR_ROOT; ?>' itemprop="item">
                        <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                    </a>
                <meta itemprop="position" content="1" />
                </li>
                <?php if($product_selector){
                    //set breadcrumb
                    if($product === false) {
                    //if it's a sub-item
                    echo "<li itemprop='itemListElement' itemscope
      itemtype='http://schema.org/ListItem'>". "<a href='" . DIR_ROOT . $subItem['url']."' itemprop='item'>" . $subItem['name'] . "</a><meta itemprop='position' content='2' /><i class='fa fa-angle-right galArrow'></i></li>";
                    echo "<li class='topMargin'>Gallery</li>";
                    } else {
                    echo "<li itemprop='itemListElement' itemscope
      itemtype='http://schema.org/ListItem'>". "<a href='" . DIR_ROOT . $product['selector']."' itemprop='item'>" . $product['name'] . "</a><meta itemprop='position' content='2' /><i class='fa fa-angle-right galArrow'></i></li>";
                    echo "<li class='topMargin'>Gallery</li>";
                    }
                }else{
                    echo "<li>Gallery</li>";
                } ?>
            </ul>
        <?php
        // echo out gallery videos if there are any
        $getGalVids = mysql_query( "SELECT * FROM product_videos WHERE selector = '" . $product_selector . "' AND gallery_video = 1" );
        if(mysql_num_rows($getGalVids)>0) {
            while ($rGetGalVids = mysql_fetch_assoc( $getGalVids )) {
                echo "<a class='side-gallery-vid dv-3'>";
                echo "<div class='image animate'>";
                echo "<iframe style='border: 0;' class='player youtube' height='0' src='//www.youtube.com/embed/" . $rGetGalVids['code'] . "?rel=0&wmode=transparent' allowfullscreen></iframe>";
                echo "</div>";
                echo "</a>";
            }
        }
        if($product_selector){
            //set opendir path
            if($product['is_base'] == 1) {
                //remove duplicate directory level if "base" gallery
                $path = '../_assets/_images/_products/' . $product['parent'] . '/' . $product['selector'] . '/_gallery/';
                $convPath2 = '/_assets/_images/_products/' . $product['parent'] . '/' . $product_selector . '/_gallery/';
                $thumbPath = '/_assets/_images/_products/' . $product['parent'] . '/' . $product_selector . '/_gallery/_thumbnails/';
            } else {
                $path = '../_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $product_selector . '/_gallery/';
                $convPath2 = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $product_selector . '/_gallery/';
                $thumbPath = '/_assets/_images/_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $product_selector . '/_gallery/_thumbnails/';

            }
            //if it's a sub item
            if($product === false) {
                $path = '../_assets/_images/_products/' . $subItem['parent'] . '/' . $subItem['selector'] . '/_gallery/';
                $convPath2 = '/_assets/_images/_products/' . $subItem['parent'] . '/' . $subItem['selector'] . '/_gallery/';
                $thumbPath = '/_assets/_images/_products/' . $subItem['parent'] . '/' . $subItem['selector'] . '/_gallery/_thumbnails/';
            }
            if( is_dir( $path ) ) {
                // the path exists - show the gallery
                // set image counter to zero
                $i = 0;
                // open the directory
                $handle = opendir( $path );
                
                // perform a check for each file found in the directory
                while ($files[] = readdir($handle));
                natsort($files);
                foreach ($files as $image) {
                //while( $image = $files ) {
                    // check if image is a file we want
                    if( $image != '.' && $image != '..' && $image != "Thumbs.db" && $image != "_notes" && $image != "_thumbnails" && $image != "_gallery") {
                        //set random var for gallery identifier
                        $random = mt_rand(100000, 999999);
                        //trim path to be used for image source
                        $trimmedLocation = substr($path, 3);
                        //if image is already in db, display its identifier
                        $checkExisting = mysql_query( "SELECT * FROM gallery_images WHERE filename = '" . $image . "'" );
                        $rExisting = mysql_fetch_assoc( $checkExisting );
                        if(mysql_num_rows($checkExisting)>0) { 
                            $label = $rExisting['random']; 
                        } else {
                            $checkRandom = mysql_query( "SELECT * FROM gallery_images WHERE random = '" . $label . "'" );
                            //if the random number is a duplicate, reroll
                            if(mysql_num_rows($checkRandom)>0) { 
                                    $label = mt_rand(100000, 999999);
                                }
                                //insert new gallery identifier
                            mysql_query("INSERT INTO gallery_images (filename, image_path, random) VALUES (\"$image\",\"$trimmedLocation\",'".$label."')"); 
                        }
                        $dirCheck = BASE_THUMBNAIL . $thumbPath;
                        //create directory if it doesn't exist
                        if (!file_exists($dirCheck)) {
                            mkdir($dirCheck, 0755, true);
                        }
                        //get sha1 hash of image
                        $currentHash = (sha1_file($path . $image));
                        //separate parts of image name
                        $thumbImage =  $image;
                        $path_parts = pathinfo($thumbImage);
                        $matchedImageName = $path_parts['filename'];
                        //if there's no filename, move to next loop
                        if ($matchedImageName == '') { continue;}
                        //set rest of thumbnail conversion path
                        $smallThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize 97x68 ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_sm' . '.' .         $path_parts['extension'];       
                        $medThumb = '/usr/bin/convert' . ' ' . BASE_THUMBNAIL . $convPath2 . $image . ' -resize 265x199 ' . BASE_THUMBNAIL . $thumbPath . $path_parts['filename'] . '_med' . '.' .         $path_parts['extension'];
                        $checkHash = mysql_query( "SELECT * FROM thumbnail_compare WHERE thumbhash = '" . $currentHash . "' and imgname = '" . $matchedImageName . "' and selector = '" . $product_selector . "'" );
                        if(mysql_num_rows($checkHash)>0) {
                           //matched with hash, do nothing
                        } else {
                           //convert image to thumbnails
                           exec($smallThumb);
                           exec($medThumb);
                           $addHash = mysql_query("INSERT INTO thumbnail_compare (thumbhash, selector, imgname) VALUES ('$currentHash','$product_selector','$matchedImageName')");
                        }
                        // initialize counter
                        $i++;
                        // make sure we don't output past the set limit
                        if( $i <= $limit || $limit == 0 ) {
                            // we haven't passed the limit - output the image
                            // set the images source
                            if($product['is_base'] == 1) {
                                //if it's a base gallery
                                $imgsrc = DIR_IMAGES . '_products/' . $product['parent'] . '/' . $product['selector'] . '/_gallery/' . $image;
                                $image_dir = DIR_IMAGES . '_products/' . $product['parent'] . '/' . $product['selector'] . '/_gallery/';
                            } else {
                                $imgsrc = DIR_IMAGES . '_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $product_selector . '/_gallery/' . $image;
                                $image_dir = DIR_IMAGES . '_products/' . $parent['parent'] . '/' . $product['parent'] . '/' . $product_selector . '/_gallery/';
                            }
                            if($product === false) {
                                $imgsrc = DIR_IMAGES . '_products/' . $subItem['parent'] . '/' . $subItem['selector'] . '/_gallery/' . $image;
                                $image_dir = DIR_IMAGES . '_products/' . $subItem['parent'] . '/' . $subItem['selector'] . '/_gallery/';
                            }
                            // get the images extension
                            $ext = '.' . end( explode( '.', $image ) );
                            // set the images alt tag without the extension
                            $imgalt =  str_replace( $ext, '', str_replace( '-', ' ', $image ) );
                            // check if the number of images returned is divisble by 3
                            if( $limit % 3 == 0 ) {
                                // is divisible by 3 - smaller thumbnails
                                $size = 'dv-3';
                            } else {
                                // check if the number of images is divisible by 2
                                if( $limit % 2 == 0 ) {
                                    // is divisble by 2 - larger thumbnails
                                    $size = 'dv-2';
                                } else {
                                    // not divisible by 2 or 3 - fall back to thirds
                                    $size = 'dv-3';
                                }
                            }
                            // echo out the images
                            echo "<a class='side-gallery-img ";
                            echo $size;
                            if($i == 1) 
                                { echo " clear-left"; } 
                            echo "'>";
                            echo "<div class='image animate'>";
                            echo "<img title='" . $product['meta_keywords'] . ' ' . $i . "' alt='" . $imgalt . "' class='animate lb magnific";
                            if( SET_LAZY_LOAD == 'true' ) {
                                echo " lazy";
                            }
                            echo "' data-group='" . $product_selector . "' data-id='" . $i . "' data-source='../serve.php?source=".$image_dir."&amp;image=".$image."&amp;thumb=1' itemprop='image' data-mfp-src='".$path.$image."' src='" . $path . '_thumbnails/' . $path_parts['filename'] . '_med' . '.' . $path_parts['extension'] ."' />";
                            echo "<div class='galleryLabel'>" . $label . "</div>";
                            echo "</div>";
                            echo "</a>";
                        } else {
                            // we've gone past the limit - stop output
                        }
                    } else {
                    // unwanted file
                    }
                }
                // close the directory
                closedir( $handle );
                // check if there are more images than the limit allows
                if( $i > $limit ) {
                    if( $limit == 0 ) {
                        // no image limit no need for a link
                    } else {
                        // there are still more images - show link to them
                        echo "<span class='categories'>
                        <a class='animate' href='" . DIR_ROOT . "'>View More Images</a>
                        </span>";
                    }
                } else {
                    // that's all the images - no link
                }
            } else {
                // the path doesn't exist - no gallery to show
            }
            // no images
            if( $i == 0 ) {
                echo "<p>Sorry, there aren't any images at this time. We're out taking some right now!</p>";
                //add spacer div to make left content same length as right
                echo '<div class="leftSpacer"></div>';
            }

        }

    ?>
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
    <div class='sidebar-signup'>
        <h1>Newsletter Signup</h1>
        <p>Receive special promotional offers, discount opportunities, and news updates!</p>
        <form class='newsletter-form sidebar-news aweber-form' data-submit='718137999'>
            <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75703552' name='email' placeholder='Enter your email address' type='text' />
            <button class='button large secondary animate submit' type='submit'>Subscribe To Newsletter</button>
        </form>
        <div class="aweber AW-Form-718137999"></div>
        <script type="text/javascript">(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//forms.aweber.com/form/99/718137999.js";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, "script", "aweber-wjs-6bhepjf7u"));
        </script>
        <div id="hideSep" class='side-sep'></div>
        <h1>Interested in this product?</h1>
        <p>Click the button below to fill out a form and get a free quote from one of our sales representitves!</p>
        <button class='button large gold sidebar-quote animate submit get-quote-plox' type='submit'>
            <span class='fa fa-paper-plane'></span>
            Get a free quote
        </button>
    </div>
</div>
</div>
<?php // include addthis api if sharing is allowed
if( SET_SHARING == 'true' ) { ?>
    <!-- include addthis script -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php } ?>
<script type='text/javascript'>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'http://forms.aweber.com/form/12/1082506812.js';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'aweber-wjs-fm5h6cf1v'));
</script>
<script type='text/javascript'>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'http://forms.aweber.com/form/37/1640328137.js';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'aweber-wjs-c1utc17xn'));
</script>
<?php include_once('../_includes/footer.inc.php'); ?>