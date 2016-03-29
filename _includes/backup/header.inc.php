<?php

/**
 *
 * Universal site header and navigation
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

?>

<!--live chat div -->

<div data-id="TTKxxMh_w9X" class="livechat_button"><a href="http://www.livechatinc.com/?partner=lc_3147512&amp;utm_source=chat_button"></a></div>

<!-- global site header and navigation -->

<a class='animate hide seven_hundred button medium gold fixed-quote-button'>Click for a Free Quote</a>

<header class='main-header visible'>
    <nav class='top-navigation'>
        <ul class='wrapper'>

            <?php // show font changers if allowed
            if( SET_FONT_CHANGE == 'true' ) { ?>
                <li class='top-link font-size' id='fs-18'>
                    <a class='change-font-size' id='size-18'>
                        <i class='fa fa-font animate'></i>
                    </a>
                </li>
                <li class='top-link font-size' id='fs-16'>
                    <a class='change-font-size' id='size-16'>
                        <i class='fa fa-font animate'></i>
                    </a>
                </li>
                <li class='top-link font-size' id='fs-14'>
                    <a class='change-font-size' id='size-14'>
                        <i class='fa fa-font animate'></i>
                    </a>
                </li>
            <?php } ?>

            <li class='top-link social' id='instagram'>
                <a href='http://instagram.com/highwayproductsinc' target='new'>
                    <i class='fa fa-instagram animate'></i>
                </a>
            </li>
            <li class='top-link social' id='youtube'>
                <a href='https://www.youtube.com/user/HighwayProducts?sub_confirmation=1' target='new'>
                    <i class='fa fa-youtube-play animate'></i>
                </a>
            </li>
            <li class='top-link social' id='google-plus'>
                <a href='https://plus.google.com/110704383787139163333/posts' target='new'>
                    <i class='fa fa-google-plus animate'></i>
                </a>
            </li>
            <li class='top-link social' id='twitter'>
                <a href='https://twitter.com/HighwayProducts' target='new'>
                    <i class='fa fa-twitter animate'></i>
                </a>
            </li>
            <li class='top-link social' id='facebook'>
                <a href='https://www.facebook.com/HighwayProducts' target='new'>
                    <i class='fa fa-facebook animate'></i>
                </a>
            </li>


            <ul class='left-nav-tops'>
                <!--
                <li class='top-link border-right'>
                    <a href='<?php echo DIR_ROOT; ?>contact/' class='animate top-link-link'>Contact</a>
                </li>
                <li class='top-link'>
                    <a href='<?php echo DIR_ROOT; ?>about/' class='animate top-link-link'>About Us</a>
                </li>
                <li class='top-link border-left'>
                    <a href='<?php echo DIR_ROOT; ?>' class='animate top-link-link'>Home</a>
                </li>
                -->
                <li class='top-link hide six_hundred'>
                    <a id="headerContact" href="mailto:<?php echo META_CONTACT; ?>"><i class='fa fa-envelope-o animate'></i></a>
                    <a id="headerContact" class="animate" href="mailto:<?php echo META_CONTACT; ?>"><?php echo META_CONTACT; ?></a>
                </li>
                <li class='top-link'>
                    <i class='fa fa-phone'></i>
                    1-800-866-5269
                </li>
            </ul>

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

            <ul class='nav-links main'>
            <a href='<?php echo DIR_ROOT; ?>'>
            <img alt="Call 1-800-TOOLBOX for a free quote!" class='header-phone-large' src='<?php echo DIR_IMAGES; ?>1-800-toolbox-dark-number.png'/>
            </a>
            <!--
            <h1 class='header-huge-phone-number'>1-800-TOOLBOX</h1>
            -->

            <li class='nav-link search'>
                <a class='animate'>
                    <i class='fa fa-search'></i>
                    Search Products
                </a>
            </li>
            <li class='nav-link nav'>
                <a class='animate' href='<?php echo DIR_ROOT; ?>contact/'>
                    Contact
                </a>
            </li>
            <li class='nav-link nav'>
                <a class='animate' href='<?php echo DIR_ROOT; ?>news/'>
                    Latest News
                </a>
            </li>
            <li class='nav-link nav'>
                <a class='animate' href='<?php echo DIR_ROOT; ?>about/'>
                    About Us
                </a>
            </li>
            <li class='nav-link nav'>
                <a class='animate' href='<?php echo DIR_ROOT; ?>'>
                    Home
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


            <ul class='nav-links thumbs'>

            <!-- truck accessories -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href="<?php echo DIR_ROOT; ?>pickup-trucks">
                    <img src='<?php echo DIR_IMAGES; ?>_header/truck-accessories-1-rollover.png'/>
                    <h2><span class="hide eleven-twenty">Truck </span>Accessories</h2>
                </a>

                <?php include( 'dropdown_truck_acc.php' ); ?>

            </li>

            <!-- service bodies -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>service-bodies'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/service-bodies-2-rollover.png'/>
                    <h2>Service Bodies</h2>
                </a>

                 <?php include( 'dropdown_service_bodies.php' ); ?>

            </li>

            <!-- aluminum flatbeds -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-flatbeds'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/aluminum-flatbeds-3-rollover.png'/>
                    <h2><span class="hide eleven-twenty">Aluminum </span>Flatbeds</h2>
                </a>

               <?php include( 'dropdown_aluminum_flatbeds.php' ); ?>

            </li>

            <!-- pickup packs -->
            <li class='nav-link'>

            <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>pickup-packs'>
            <img src='<?php echo DIR_IMAGES; ?>_header/pickup-pack-8-rollerover.png'/>
            <h2>Pickup Packs</h2>
            </a>

        
            <?php include( 'dropdown_pickup_packs.php' ); ?>

            </li>

            <!-- semi accessories -->
           <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>semi-trucks'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/semi-accessories-4-rollover.png'/>
                    <h2>Semi Accessories</h2>
                </a>

               <?php include( 'dropdown_semi_trucks.php' ); ?>

            </li>

            <!-- custom fabrication -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>custom-fabrication'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/custom-fabrication-5-rollover.png'/>
                    <h2>Custom<span class="hide eleven-twenty"> Fabrication</span></h2>
                </a>

                <?php include( 'dropdown_custom_fabrication.php' ); ?>

            </li>

            <!-- rv tow bodies -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>tow-bodies'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/RV-tow-bodies-6-rollover.png'/>
                    <h2>RV Tow Bodies</h2>
                </a>

                <?php include( 'dropdown_tow_bodies.php' ); ?>

            </li>

     <!-- law enforcement -->
    <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>law-enforcement'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/law-enforcement-7-rollover.png'/>
                    <h2>Law Enforcement</h2>
                </a>

                <?php include( 'dropdown_law_enforcement.php' ); ?>

            </li>

</ul>


        </div>
    </nav>
</header>
<!-- end global site header and navigation -->
<aside class='mobile-nav'>
    <a class='m_number' href='tel:18008665269'>
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
                    <?php
                        //exclude custom fabrication from m_cats query to prevent duplication
                        $m_cats = mysql_query('SELECT * FROM product_categories_main WHERE NOT id = 1');
                        $m_cf_cats = mysql_query("SELECT * FROM product_categories_items WHERE parent = 'custom-fabrication'");
                         // because custom fab goes directly to items
                            echo "<ul class='m_sub_list collapsable'>";
                            echo "<a><span class='fa fa-caret-right'></span>". 'Custom Fabrication' ."</a>";
                            while($cf_cats = mysql_fetch_assoc($m_cf_cats)){
                                echo "<li class='m_sub_item'>";
                                    echo "<a href='" . DIR_ROOT . $cf_cats['selector'] . "'>";
                                    echo $cf_cats['name'];
                                    echo "</a>";
                                echo "</li>";
                            }
                            //manually add time capsules since it's a different category
                            echo "<li class='m_sub_item'>";
                                    echo "<a href='" . DIR_ROOT . 'time-capsules' . "'>";
                                    echo 'Time Capsules';
                                    echo "</a>";
                                echo "</li>";
                            echo "</ul>";
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
                                                echo "<a href='" . DIR_ROOT . $m_item['selector'] . "'>";
                                                    echo $m_item['name'];
                                                echo "</a>";
                                            echo "</li>";
                                            //add items whose parents don't align with the category
                                        if($m_item['id'] == 7) {
                                            echo "<li class='m_sub_item'>";
                                                echo "<a href='" . DIR_ROOT . 'fifth-wheel-tool-boxes' . "'>";
                                                    echo '5th Wheel Tool Boxes';
                                                echo "</a>";
                                            echo "</li>";
                                            }
                                        if($m_item['selector'] == 'cargo-baskets') {
                                            echo "<li class='m_sub_item'>";
                                                echo "<a href='" . DIR_ROOT . 'custom-drawers' . "'>";
                                                    echo 'Custom Drawers';
                                                echo "</a>";
                                            echo "</li>";
                                            }
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