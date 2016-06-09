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
<style type="text/css">
.message-sent {
    background: #7CB83B;
    color: #fff;
    font-weight: 700;
    height: auto;
    left: 0;
    right: 0;
    padding: 40px 0;
    position: fixed;
    text-align: center;
    top: 35%;
    width: 80%;
    z-index: 9999999999999999999;
    margin: 5% auto;
}
.close-message {
    float: right;
    top: -30px;
    position: relative;
    right: 10px;
    font-size: 20px;
}
</style>
<?php 
if(isset($_GET['quote'])) {
        echo "<div class='message-sent'><i class='fa fa-times close-message'></i>Thank you for contacting us! Your quote request has been received and will be responded to within one business day.</div>";
    }
?>


<!-- Aweber Lightbox -->

<script type="text/javascript">var hide_awf_Form = true;</script>

<!-- global site header and navigation -->

<script type="text/javascript">
var __lc = {};
__lc.license = 3147512;
__lc.group = 3;

(function() {
    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<div data-id="77251367b4" class="livechat_button"><a href="http://www.livechatinc.com/?partner=lc_3147512&amp;utm_source=chat_button"></a></div>
<header class='main-header visible'>
    <nav class='main-navigation'>
        <div class='wrapper'>


            <ul class='nav-links thumbs'>

            <!-- truck accessories -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href="<?php echo DIR_ROOT; ?>aluminum-pickup-truck-accessories">
                    <img src='<?php echo DIR_IMAGES; ?>_header/truck-accessories-1-rollover.png'/>
                    <h2><span class="hide eleven-twenty">Truck </span>Accessories</h2>
                </a>

            </li>

            <!-- service bodies -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-truck-service-bodies'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/service-bodies-2-rollover.png'/>
                    <h2>Service Bodies</h2>
                </a>

            </li>

            <!-- aluminum flatbeds 1 -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-truck-flatbeds'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/aluminum-flatbeds-3-rollover.png'/>
                    <h2><span class="hide eleven-twenty">Aluminum </span>Flatbeds</h2>
                </a>

            </li>

            <!-- pickup packs -->
            <li class='nav-link'>

            <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>pickup-packs'>
                <img src='<?php echo DIR_IMAGES; ?>_header/pickup-pack-8-rollerover.png'/>
                <h2>Pickup Packs</h2>
            </a>

            </li>

            <!-- semi accessories -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-semi-truck-accessories'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/semi-accessories-4-rollover.png'/>
                    <h2>Semi Accessories</h2>
                </a>

            </li>

            <!-- custom fabrication -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>custom-aluminum-fabrication'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/custom-fabrication-5-rollover.png'/>
                    <h2>Custom<span class="hide eleven-twenty"> Fabrication</span></h2>
                </a>

            </li>

            <!-- rv tow bodies -->
            <li class='nav-link'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-tow-bodies'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/RV-tow-bodies-6-rollover.png'/>
                    <h2>RV Tow Bodies</h2>
                </a>

            </li>

     <!-- law enforcement -->
    <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-law-enforcement-accessories'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/law-enforcement-7-rollover.png'/>
                    <h2>Law Enforcement</h2>
                </a>

            </li>

</ul>


        </div>
    </nav>
</header>
<!-- end global site header and navigation -->
<aside class='mobile-nav'>
    <a class='m_number' href='<?php echo PHONE_NUMBER_LINK ?>'>
        <span class='fa fa-phone'></span><?php echo PHONE_NUMBER ?>
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
                                                echo "<a href='" . DIR_ROOT . $m_item['selector'] . "'>";
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