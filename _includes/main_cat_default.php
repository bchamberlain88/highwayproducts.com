    <div class='slider-container'>
            <div class='slider'>
                <!-- show product slides -->
                <?php slides( 'category', $product_selector, SET_LIMIT_SLIDES ); ?>
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
                        <i class='home-icon fa fa-home'></i> <span itemprop="name">Highway Products</span> <i class='fa fa-angle-right'></i>
                    </a>
                    <meta itemprop="position" content="1" />
                    </li>
                    <li><?php echo $mainCat['category']; ?></li>
                </ul>

                <h1 class='product-header' itemprop='name'>
                    <?php echo $mainCat['category']; ?>
                </h1>

                <p class='product-copy four_eighty'>
                    <?php echo $mainCat['copy']; ?>
                </p>

                <ul class='sub-products-list'>
                <?php 
                //since custom-fabrication doesn't play by the rules
                if($mainCat['selector'] == 'custom-fabrication') {
                     $getCatItems = mysql_query("SELECT * FROM product_categories_items WHERE parent = '".$mainCat['selector']."'");
                        while($subItem = mysql_fetch_assoc($getCatItems)){
                            echo "<li class='sub-product-list-item'>";
                            echo "<div class='sub-product-thumb'>";
                            echo "<img src='".DIR_IMAGES."_products/".$subItem['parent']."/".$subItem['selector']."/".$subItem['selector']."-thumb.jpg"."' />";
                            echo "</div>";
                            echo "<div class='sub-product-info'>";
                            echo "<h2><a class='animate' href='".DIR_ROOT.$subItem['selector']."'>".$subItem['name']."</a></h2>";
                            echo "<p>".$subItem['description']."</p>";
                            echo "</div>";
                            echo "</li>";
                            }
                } elseif($mainCat['selector'] == 'trucks-semi') {
                     $getCatItems = mysql_query("SELECT * FROM product_categories_items WHERE parent = '".$mainCat['selector']."'");
                        while($subItem = mysql_fetch_assoc($getCatItems)){
                            echo "<li class='sub-product-list-item'>";
                            echo "<div class='sub-product-thumb'>";
                            echo "<img src='".DIR_IMAGES."_products/".$subItem['parent']."/".$subItem['selector']."/".$subItem['selector']."-thumb.jpg"."' />";
                            echo "</div>";
                            echo "<div class='sub-product-info'>";
                            echo "<h2><a class='animate' href='".DIR_ROOT.$subItem['selector']."'>".$subItem['name']."</a></h2>";
                            echo "<p>".$subItem['description']."</p>";
                            echo "</div>";
                            echo "</li>";
                            }
                } else{
                $getCatSubs = mysql_query("SELECT * FROM product_categories_sub WHERE parent = '".$mainCat['selector']."'");
                while($catSub = mysql_fetch_assoc($getCatSubs)){
                    $catSubCat = mysql_query("SELECT * FROM product_categories_main WHERE selector = '".$catSub['parent']."'");
                    $subCat = mysql_fetch_assoc($catSubCat);
                    $firstSubItem = mysql_query("SELECT * FROM product_categories_items WHERE parent = '".$catSub['selector']."' LIMIT 1");
                    $subItem = mysql_fetch_assoc($firstSubItem);

                    echo "<li class='sub-product-list-item'>";
                        echo "<div class='sub-product-thumb'>";
                            echo "<img src='".DIR_IMAGES."_products/".$catSub['parent']."/".$catSub['selector']."/".$subItem['selector']."/".$subItem['selector']."-thumb.jpg"."' />";
                        echo "</div>";
                        echo "<div class='sub-product-info'>";
                            echo "<h2><a class='animate' href='".DIR_ROOT.$catSub['url']."'>".$catSub['name']."</a></h2>";
                            echo "<p>".$catSub['copy']."</p>";
                        echo "</div>";
                    echo "</li>";
                }
                } ?>
                </ul>

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
                    <form class='newsletter-form sidebar-news aweber-form' data-submit='<?php echo $aweber_id; ?>'>
                        <input required autocorrect='off' spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $input_id; ?>' name='email' placeholder='Enter your email address' type='text' />
                        <button class='button large secondary animate submit' type='submit'>Subscribe To Newsletter</button>
                    </form>

                    <div class="sidebar-aweber AW-Form-<?php echo $aweber_id; ?>"></div>
                    <script type="text/javascript">(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//forms.aweber.com/form/05/<?php echo $aweber_id; ?>.js";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, "script", "aweber-wjs-<?php echo $aweber_js; ?>"));
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