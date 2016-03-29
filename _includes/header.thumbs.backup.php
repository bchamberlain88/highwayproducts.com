<?php

/**
 *
 * Universal site header and navigation
 *
 * @author    Sebastian Inman @sebastian_inman
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2014
 *
 */

?>

<!-- global site header and navigation -->

<a class='animate hide seven_hundred button medium gold fixed-quote-button'>Click for a Free Quote</a>

<header class='visible'>
    <nav class='top-navigation'>
        <ul class='wrapper'>

            <?php // show font changers if allowed
            if( SET_FONT_CHANGE == 'true' ) { ?>
                <li class='top-link font-size' id='fs-16'>
                    <a class='change-font-size' id='size-16'>
                        <i class='fa fa-font'></i>
                    </a>
                </li>
                <li class='top-link font-size' id='fs-14'>
                    <a class='change-font-size' id='size-14'>
                        <i class='fa fa-font'></i>
                    </a>
                </li>
                <li class='top-link font-size' id='fs-12'>
                    <a class='change-font-size' id='size-12'>
                        <i class='fa fa-font'></i>
                    </a>
                </li>
            <?php } ?>
            
            <li class='top-link social' id='instagram'>
                <a href='http://instagram.com/highwayproductsinc' target='new'>
                    <i class='fa fa-instagram'></i>
                </a>
            </li>
            <li class='top-link social' id='youtube'>
                <a href='https://www.youtube.com/user/HighwayProducts?sub_confirmation=1' target='new'>
                    <i class='fa fa-youtube-play'></i>
                </a>
            </li>
            <li class='top-link social' id='google-plus'>
                <a href='https://plus.google.com/110704383787139163333/posts' target='new'>
                    <i class='fa fa-google-plus'></i>
                </a>
            </li>
            <li class='top-link social' id='twitter'>
                <a href='https://twitter.com/HighwayProducts' target='new'>
                    <i class='fa fa-twitter'></i>
                </a>
            </li>
            <li class='top-link social' id='facebook'>
                <a href='https://www.facebook.com/HighwayProducts' target='new'>
                    <i class='fa fa-facebook'></i>
                </a>
            </li>
            <li class='top-link hide six_hundred'>
                <i class='fa fa-envelope-o'></i>
                <?php echo META_CONTACT; ?>
            </li>
            <li class='top-link'>
                <i class='fa fa-phone'></i>
                1-800-866-5269
            </li>
        </ul>
    </nav>
    <nav class='main-navigation'>
        <div class='wrapper'>
        
            <a class='nav-logo' href='<?php echo DIR_ROOT; ?>'>
                <img alt='Highway Products Inc.' class='' src='<?php echo DIR_IMAGES; ?>highway-logo-silver.png'/>
            </a>

            <button class='toggle-mobile-nav'>
                <i class='fa fa-bars'></i>
            </button>

            <?php // show sister links if allowed
            if( SET_SISTER_LINKS == 'true' ) { ?>        
                <a class='site-dropper animate'>
                    <i class='fa fa-caret-down'></i>
                </a>
            <?php } ?>

            <ul class='nav-links'>

                <li class='nav-link'>
                    <a class='animate' href='<?php echo DIR_ROOT; ?>'>
                        Home
                    </a>
                </li>

                <li class='nav-link'>

                    <a class='animate expand'>
                        Product Directory<i class='fa fa-angle-down'></i>
                    </a>

                    <ul class='nav-list'>

                        <nav class='list-navigation'>
                            <div class='wrapper'>
                                <ul class='center-list-nav'>
                                <?php $getCats = mysql_query('SELECT * FROM product_categories_main');
                                  while($cat = mysql_fetch_assoc($getCats)){

                                  if($cat['is_visible'] == 1){

                                  if($cat['default'] == 1){ ?>
                                      <li class='active list-toggle' data-category='<?php echo $cat['selector']; ?>' id='toggle-<?php echo $cat['selector']; ?>'>
                                        <?php echo $cat['category']; ?>
                                      </li>
                                  <?php }else{ ?>
                                      <li class='list-toggle' data-category='<?php echo $cat['selector']; ?>' id='toggle-<?php echo $cat['selector']; ?>'>
                                        <?php echo $cat['category']; ?>
                                      </li>
                                  <?php }
                                    } else {
                                        
                                    }
                                    } ?>
                                  <li class='list-toggle' id='toggle-all'>
                                    <a href='<?php echo DIR_ROOT; ?>products/'>View All Products</a>
                                  </li>
                                  <ul class='list-view-options'>
                                    <li class='animate list-view active' data-view='thumbs'>
                                        <span class='fa fa-th-large'></span>
                                    </li>
                                    <li class='animate list-view' data-view='list'>
                                        <span class='fa fa-th-list'></span>
                                    </li>
                                </ul>
                              </ul>
                            </div>
                        </nav>

                        <?php $getCats = mysql_query('SELECT * FROM product_categories_main ORDER BY oid ASC');
                          while($cat = mysql_fetch_assoc($getCats)){
                          if($cat['default'] == 1){ ?>
                              <div class='list active' data-list='<?php echo $cat['selector']; ?>' id='list-<?php echo $cat['selector']; ?>'>
                          <?php }else{ ?>
                              <div class='list' data-list='<?php echo $cat['selector']; ?>' id='list-<?php echo $cat['selector']; ?>'>
                          <?php } ?>

                                   <div class='wrapper items'>

                                        <?php 

                                        if($cat['selector'] == 'trucks-pickup'){

                                        $getSubs = mysql_query('SELECT * FROM product_categories_sub WHERE parent = "'.$cat['selector'].'" ORDER BY oid ASC');
                                        $num_items = mysql_num_rows($getSubs);
                                        while($sub = mysql_fetch_assoc($getSubs)){
                                            $getItemThumb = mysql_query("SELECT * FROM product_categories_items WHERE parent = '".$sub['selector']."' LIMIT 1");
                                            $itemThumb = mysql_fetch_assoc($getItemThumb); ?>
                                            <a class='items-block one-fourth' id='<?php echo $sub['selector']; ?>'>
                                                <div class='item-block-content'>
                                                    <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' . $sub['parent'] . '/' . $sub['selector'] . '/' .  $itemThumb['selector'] . '/' . $itemThumb['thumbnail']; ?>' />
                                                    <label><?php echo $sub['name']; ?></label>
                                                </div>
                                            </a>
                                            <div class='items-listings' id='<?php echo $sub['selector']; ?>'>
                                                <a class='hide-listings'><span class='fa fa-angle-left'></span>Back</a>
                                                <h2><?php echo $sub['name']; ?></h2>
                                                <?php $getListItems = mysql_query("SELECT * FROM product_categories_items WHERE is_visible = 1 AND parent = '".$sub['selector']."'");
                                                while($listItem = mysql_fetch_assoc($getListItems)){ 
                                                    $getItemParent = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$listItem['parent']."'");
                                                    $listItemParent = mysql_fetch_assoc($getItemParent); ?>
                                                    <a class='items-block item one-fourth' href='<?php echo DIR_ROOT; ?>products/<?php echo $listItem['selector']; ?>' id='<?php echo $listItem['selector']; ?>'>
                                                        <div class='item-block-content'>
                                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' . $listItemParent['parent'] . '/' . $listItemParent['selector'] . '/' .  $listItem['selector'] . '/' . $listItem['thumbnail']; ?>' />
                                                            <label><?php echo $listItem['name']; ?></label>
                                                        </div>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        <?php }}elseif($cat['selector'] == 'trucks-semi'){

                                            $getSemiProducts = mysql_query("SELECT * FROM product_categories_items WHERE is_visible = 1 AND parent = 'semi-truck-tool-boxes' OR parent = 'semi-truck-accessories'");
                                            while($semiProduct = mysql_fetch_assoc($getSemiProducts)){ ?>
                                                <a class='items-block item one-fourth' href='<?php echo DIR_ROOT; ?>products/<?php echo $semiProduct['selector']; ?>' id='<?php echo $semiProduct['selector']; ?>'>
                                                    <div class='item-block-content'>
                                                        <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/trucks-semi/' . $semiProduct['parent'] . '/' .  $semiProduct['selector'] . '/' . $semiProduct['thumbnail']; ?>' />
                                                        <label><?php echo $semiProduct['name']; ?></label>
                                                    </div>
                                                </a>
                                            <?php }

                                        }elseif($cat['selector'] == 'law-enforcement'){

                                            $getLawProducts = mysql_query("SELECT * FROM product_categories_items WHERE is_visible = 1 AND parent = 'boxes-lockup' OR parent = 'boxes-explosive'");
                                            while($lawProduct = mysql_fetch_assoc($getLawProducts)){ ?>
                                                <a class='items-block item one-fourth' href='<?php echo DIR_ROOT; ?>products/<?php echo $lawProduct['selector']; ?>' id='<?php echo $lawProduct['selector']; ?>'>
                                                    <div class='item-block-content'>
                                                        <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/law-enforcement/' . $lawProduct['parent'] . '/' .  $lawProduct['selector'] . '/' . $lawProduct['thumbnail']; ?>' />
                                                        <label><?php echo $lawProduct['name']; ?></label>
                                                    </div>
                                                </a>
                                            <?php }

                                        }elseif($cat['selector'] == 'hunting-accessories'){

                                            $getHuntProducts = mysql_query("SELECT * FROM product_categories_items WHERE is_visible = 1 AND parent = 'cases-gun' OR parent = 'atv-accessories' OR parent = 'boxes-kennel'");
                                            while($huntProduct = mysql_fetch_assoc($getHuntProducts)){ ?>
                                                <a class='items-block item one-fourth' href='<?php echo DIR_ROOT; ?>products/<?php echo $huntProduct['selector']; ?>' id='<?php echo $huntProduct['selector']; ?>'>
                                                    <div class='item-block-content'>
                                                        <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/hunting-accessories/' . $huntProduct['parent'] . '/' .  $huntProduct['selector'] . '/' . $huntProduct['thumbnail']; ?>' />
                                                        <label><?php echo $huntProduct['name']; ?></label>
                                                    </div>
                                                </a>
                                            <?php }

                                        }elseif($cat['selector'] == 'custom-fabrication'){ ?>

                                            <div class='custom-row'>
                                                <div class='custom-thumb'>
                                                    <img alt='Highway Products Inc. Custom Fire Trucks' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-firetruck.jpg' />
                                                    <label>Custom Fire Trucks</label>
                                                </div>

                                                <div class='custom-thumb'>
                                                    <img alt='Highway Products Inc. Custom Flatbeds' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-flatbed.jpg' />
                                                    <label>Custom Flatbeds</label>
                                                </div>

                                                <div class='custom-thumb'>
                                                    <img alt='Highway Products Inc. Custom Hunting Solutions' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-hunting-solution.jpg' />
                                                    <label>Custom Hunting Solutions</label>
                                                </div>
                                            </div>

                                            <div class='custom-row'>
                                                <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>products/tool-box-custom'>
                                                    <img alt='Highway Products Inc. Custom Service Bodies' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-service-body.jpg' />
                                                    <label>Custom Service Bodies</label>
                                                </a>

                                                <div class='custom-thumb'>
                                                    <img alt='Highway Products Inc. Custom Tool Boxes' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-toolbox.jpg' />
                                                    <label>Custom Tool Boxes</label>
                                                </div>

                                                <div class='custom-thumb'>
                                                    <img alt='Highway Products Inc. Custom Lockup Boxes' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-lockup-box.jpg' />
                                                    <label>Custom Lockup Boxes</label>
                                                </div>
                                            </div>

                                        <?php } ?>

                                    </div>

                              </div>

                          <?php } ?>

                    </ul>

                </li>

                
                <li class='nav-link'>
                    <a class='animate expand'>
                        Packages<i class='fa fa-angle-down'></i>
                    </a>
                    <ul class='nav-list'>
                        <div class='list packages active' data-list='packages' id='list-packages'>
                            <div class='wrapper'>
                                <div class='custom-row'>
                                    <div class='custom-thumb'>
                                        <img src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-firetruck.jpg' />
                                        <label>Custom Fire Trucks</label>
                                    </div>

                                    <div class='custom-thumb'>
                                        <img src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-flatbed.jpg' />
                                        <label>Custom Flatbeds</label>
                                    </div>

                                    <div class='custom-thumb'>
                                        <img src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-hunting-solution.jpg' />
                                        <label>Custom Hunting Solutions</label>
                                    </div>
                                </div>

                                <div class='custom-row'>
                                    <div class='custom-thumb'>
                                        <img src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-service-body.jpg' />
                                        <label>Custom Service Bodies</label>
                                    </div>

                                    <div class='custom-thumb'>
                                        <img src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-toolbox.jpg' />
                                        <label>Custom Toolboxes</label>
                                    </div>

                                    <div class='custom-thumb'>
                                        <img src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-lockup-box.jpg' />
                                        <label>Custom Lockup Boxes</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </li>
                

                <!--
                <li class='nav-link'>
                    <a class='animate' href='<?php echo DIR_ROOT; ?>media/'>
                        Media
                    </a>
                </li>
                -->

                <!--
                <li class='nav-link'>
                    <a class='animate' href='<?php echo DIR_ROOT; ?>news/'>
                        News
                    </a>
                </li>
                -->

                <li class='nav-link'>
                    <a class='animate' href='<?php echo DIR_ROOT; ?>about/'>
                        About Us
                    </a>
                </li>

                <!--
                <li class='nav-link'>
                    <a class='animate' href='<?php echo DIR_ROOT; ?>support/'>
                        Product Support
                    </a>
                </li>
                -->

                <li class='nav-link'>
                    <a class='animate' href='<?php echo DIR_ROOT; ?>contact/'>
                        Contact Us
                    </a>
                </li>

                <?php // show cart button if allowed
                if( SET_CART_BUTTON == 'true' ) { ?>                
                    <li class='nav-link'>
                        <a class='animate'>
                            <i class='fa fa-lg fa-shopping-cart'></i>
                            <span class='cart-items'>0</span>
                        </a>
                    </li>
                <?php } ?>

                <li class='nav-link search'>
                    <a class='animate'>
                        <i class='fa fa-search'></i> Search Products
                    </a>
                </li>

            </ul>
            <form class='nav-search'>
                <i class='close-nav-search fa fa-lg fa-times'></i>
                <span class='result-load'><i class='fa fa-cog fa-spin'></i></span>
                <input placeholder='Search all products e.g. "Headache Racks"' type='text' />
                <div class='search-results'>
                    <h2>Search Results:<span class='result-count'></span></h2>
                    <ul class='results'></ul>
                </div>
            </form>
        </div>
    </nav>
</header>
<!-- end global site header and navigation -->
<aside class='mobile-nav'>
    <a class='m_number' href='phone:18008665269'>
        <span class='fa fa-phone'></span>1-800-866-5269
    </a>
    <div class='m_quote'>
        <span class='fa fa-paper-plane'></span>Get a free quote
    </div>
    <nav>
        <ul class='m_master_list'>
            
            <li class='m_master_list_link'>
                <a href='<?php echo DIR_ROOT; ?>'>Home</a>
            </li>

            <li class='m_master_list_link collapsable'>
                <a><span class='fa fa-caret-right'></span>Products</a>

                <ul class='m_master_list_sub_list'>
                    <?php $m_cats = mysql_query('SELECT * FROM product_categories_main');
                    while($m_cat = mysql_fetch_assoc($m_cats)){
                        // can the category be shown to the public?
                        if($m_cat['is_visible'] == 1){
                            echo "<ul class='m_sub_list collapsable'>";
                                echo "<a><span class='fa fa-caret-right'></span>".$m_cat['category']."</a>";
                                $m_subs = mysql_query('SELECT * FROM product_categories_sub WHERE parent = "'.$m_cat['selector'].'" ORDER BY oid ASC');
                                while($m_sub = mysql_fetch_assoc($m_subs)){
                                    echo "<li class='m_sub_list collapsable'>";
                                        echo "<a><span class='fa fa-caret-right'></span>".$m_sub['name']."</a>";
                                        echo "<ul class='m_sub_list items'>";
                                        $m_items = mysql_query("SELECT * FROM product_categories_items WHERE parent='" . $m_sub['selector'] . "'");
                                        while($m_item = mysql_fetch_assoc($m_items)){
                                            echo "<li class='m_sub_item'>";
                                                echo "<a href='" . DIR_ROOT . "products/" . $m_item['selector'] . "'>";
                                                    echo $m_item['name'];
                                                echo "</a>";
                                            echo "</li>";
                                        }
                                        echo "</ul>";
                                    echo "</li>";
                                }
                            echo "</ul>";
                        } else {
                            // the category is not meant to be public - hide it, keep it safe
                        }
                    }?>
                </ul>

            </li>

            <li class='m_master_list_link'>
                <a href='<?php echo DIR_ROOT; ?>about/'>About Us</a>
            </li>

            <!--
            <li class='m_master_list_link'>
                <a href='<?php echo DIR_ROOT; ?>support/'>Product Support</a>
            </li>
            -->

            <li class='m_master_list_link'>
                <a href='<?php echo DIR_ROOT; ?>contact/'>Contact</a>
            </li>

            <ul class='m_socials'>
                <li class='m_social m_facebook'>
                    <a><span class='fa fa-facebook'></span></a>
                </li>
                <li class='m_social m_twitter'>
                    <a><span class='fa fa-twitter'></span></a>
                </li>
                <li class='m_social m_google'>
                    <a><span class='fa fa-google-plus'></span></a>
                </li>
                <li class='m_social m_youtube'>
                    <a><span class='fa fa-youtube'></span></a>
                </li>
            </ul>

        </ul>
    </nav>
</aside>