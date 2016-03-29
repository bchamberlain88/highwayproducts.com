    <div class='slider-container'>
            <div class='slider'>
                <!-- show product slides -->
                <?php slides( 'sub', $product_selector, SET_LIMIT_SLIDES ); ?>
            </div>
        </div>
        <div class='selectors-container'>
            <ul class='selectors'>
                <!-- jquery will append the slide selectors -->
            </ul>
        </div>

        <div class='wrapper fs'>
            <div class='left-content'>

                <ul class='breadcrumbs' itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"><a class='animate' href='<?php echo DIR_ROOT; ?>' itemprop="item">
                        <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                    </a>
                    <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"><a class='animate' href='<?php echo DIR_ROOT . $returnSubCat['url'] ?>' itemprop="item"><?php echo $returnSubCat['category']; ?> <i class='fa fa-angle-right'></i></a>
                    <meta itemprop="position" content="2" />
                    </li>
                    <li><?php echo $sub['name']; ?></li>
                </ul>

                <h1 class='product-header' itemprop='name'>
                    <?php echo $sub['name']; ?>
                </h1>

                <p class='product-copy four_eighty'>
                    <?php echo $sub['copy']; ?>
                </p>

                <!-- product video -->
                <?php showVideo( 'sub', $product_selector ); ?>

                <ul class='sub-products-list'>
                    <?php $getProducts = mysql_query("SELECT * FROM product_categories_items WHERE is_visible = 1 AND parent = '".$sub['selector']."'");
                    while($subProduct = mysql_fetch_assoc($getProducts)){
                        echo "<li class='sub-product-list-item'>";
                            echo "<div class='sub-product-thumb'>";
                                echo "<img src='".DIR_IMAGES."_products/".$sub['parent']."/".$sub['selector']."/".$subProduct['selector']."/".$subProduct['selector']."-thumb.jpg"."' />";
                                echo "<ul class='ratings search-rating'>";
                                    $rating = rating( 'product', $subProduct['selector'] );
                                    printStars( $rating['average'] );
                                echo "</ul>";
                            echo "</div>";
                            echo "<div class='sub-product-info'>";
                                echo "<h2><a class='animate' href='".DIR_ROOT.$subProduct['selector']."'>".$subProduct['name']."</a></h2>";
                                //if we want to limit the displayed content on sub pages to one paragraph of the description
                                if($subProduct['one_paragraph_limit'] == 1) {
                                echo "<p>".$subProduct['one_paragraph']."</p>";
                                } else {
                                echo "<p>".$subProduct['description']."</p>";
                                }
                            echo "</div>";
                        echo "</li>";
                } 
                if($sub['selector'] == 'truck-tool-boxes') {
                    //add these to the truck tool boxes sub page to prevent duplicate items coming up on search
                         echo "<li class='sub-product-list-item'>";
                            echo "<div class='sub-product-thumb'>";
                                echo "<img src='".DIR_IMAGES."_products/trucks-pickup/fifth-wheel-tool-boxes/fifth-wheel-tool-boxes_thumb.jpg"."' />";
                                echo "<ul class='ratings search-rating'>";
                                    $rating = rating( 'product', 'tool-box-gullwing' );
                                    printStars( $rating['average'] );
                                echo "</ul>";
                            echo "</div>";
                            echo "<div class='sub-product-info'>";
                                echo "<h2><a class='animate' href='".DIR_ROOT. 'fifth-wheel-tool-boxes' ."'>".'5th Wheel Tool Boxes'."</a></h2>";
                                echo "<p>In 1980 Highway Products invented the 5th Wheel Tool Box because customers wanted a box that they could place against the truck cab and still be able to open it. The back of the box is notched so the back of the lid has a place to go as you open it. This space saving flush mount truck tool box secures to the bed of your truck and sits flush with the side rails. A few years later came the matching 5th Wheel Partner Box.</p>";
                            echo "</div>";
                        echo "</li>";
                         echo "<li class='sub-product-list-item'>";
                            echo "<div class='sub-product-thumb'>";
                                echo "<img src='".DIR_IMAGES."_products/trucks-pickup/fuel-tanks/fuel-tanks_thumb.jpg"."' />";
                                echo "<ul class='ratings search-rating'>";
                                    $rating = rating( 'product', 'tool-box-gullwing' );
                                    printStars( $rating['average'] );
                                echo "</ul>";
                            echo "</div>";
                            echo "<div class='sub-product-info'>";
                                echo "<h2><a class='animate' href='".DIR_ROOT. 'fuel-tanks' ."'>".'Fuel Tanks'."</a></h2>";
                                echo "<p>Aluminum transfer tanks are very convenient when you need to transport diesel, bio-diesel or water to your worksite. We have four different transfer tanks to choose from or you can customize a fuel tank that will meet your needs. We use 3/16 inch marine grade aluminum and Heliarc® all transfer tank shells. All transfer tanks for pickup trucks and custom transfer tanks come with a Lifetime Warranty.</p>";
                            echo "</div>";
                        echo "</li>";
                    }
                ?>
                </ul>
                <?php if($sub['needs_spacer'] == 1) { ?>
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

                <!-- load product gallery thumbnails - limit: 15 -->
                <h1>Image Gallery</h1>
                <?php galleryThumbs( 'category', $product_selector, SET_LIMIT_GALLERY_THUMBS ); ?>

                <div class='side-sep'></div>

                <div class='sidebar-signup'>
                    <h1>Newsletter Signup</h1>
                    <p>Receive special promotional offers, discount opportunities, and news updates!</p>
                    <form class='newsletter-form sidebar-news aweber-form' data-submit='<?php echo $newsFormID; ?>'>
                        <input required autocorrect='off' spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $newsEmailID; ?>' name='email' placeholder='Enter your email address' type='text' />
                        <button class='button large secondary animate submit' type='submit'>Subscribe To Newsletter</button>
                    </form>

                    <div class="sidebar-aweber AW-Form-<?php echo $newsFormID; ?>"></div>
                    <script type="text/javascript">(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//forms.aweber.com/form/99/<?php echo $newsFormID; ?>.js";
                    fjs.parentNode.insertBefore(js, fjs);
                    }(document, "script", "aweber-wjs-6bhepjf7u"));
                    </script>

                    <div class='side-sep'></div>
                    <h1>Interested in this product?</h1>
                    <p>Click the button below to fill out a form and get a free quote from one of our sales representitves!</p>
                    <button class='button large gold sidebar-quote animate submit get-quote-plox' type='submit'>
                        <span class='fa fa-paper-plane'></span>
                        Get a free quote
                    </button>
                </div>

            </div>
        </div>