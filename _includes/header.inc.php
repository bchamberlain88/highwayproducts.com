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

//check if a quote has been submitted
    if(isset($_GET['quote'])) {
        echo "<div class='message-sent'><i class='fa fa-times close-message'></i>Thank you for contacting us! Your quote request has been received and will be responded to within one business day.</div>";
    }
    if(isset($_GET['newsletter'])) {
        echo "<div class='message-sent'><i class='fa fa-times close-message'></i>Thank you for subscribing!</div>";
    }
     if(isset($_GET['contact'])) {
        echo "<div class='message-sent'><i class='fa fa-times close-message'></i>Thank you for contacting us! Your correspondence has been received.</div>";
    }
?>
<div data-id="TTKxxMh_w9X" class="livechat_button">
    <a href="http://www.livechatinc.com/?partner=lc_3147512&amp;utm_source=chat_button"></a>
</div>
<a class='animate hide seven_hundred button medium gold fixed-quote-button'>Click for a Free Quote</a>
<header class='main-header visible'>
    <nav class='main-navigation'>
        <div class='wrapper'>
            <a class='nav-logo' href='<?php echo DIR_ROOT; ?>'>
                <img alt='Highway Products Inc.' class='' src='<?php echo DIR_IMAGES . 'highway-logo-silver.png?' . filemtime_remote(DIR_IMAGES . 'highway-logo-silver.png') ; ?>'/>
            </a>
            <button class='toggle-mobile-nav'>
                <p>Menu</p>
            </button>
            <?php // show sister links if allowed
            if( SET_SISTER_LINKS == 'true' ) { ?>
                <a class='site-dropper animate'>
                    <i class='fa fa-caret-down'></i>
                </a>
            <?php } ?>
            <ul class='nav-links main'>
                <li>
                    <a href='<?php echo DIR_ROOT; ?>'>
                        <img alt="Call 1-800-TOOLBOX for a free quote!" class='header-phone-large' src='<?php echo DIR_IMAGES . '1-800-toolbox-dark-number.png?' . filemtime_remote(DIR_IMAGES . '1-800-toolbox-dark-number.png'); ?>'/>
                    </a>
                </li>
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
                    <a class='animate' href='<?php echo DIR_ROOT; ?>warranty/'>
                        Warranty
                    </a>
                </li>
                <li class='nav-link nav'>
                    <a class='animate' href='<?php echo DIR_ROOT; ?>reviews/'>
                        Reviews
                    </a>
                </li>
                <li class='nav-link nav'>
                    <a class='animate' href='<?php echo DIR_ROOT; ?>about/'>
                        About Us
                    </a>
                </li>
            </ul>
            <form name="search-bar" class='nav-search' method="GET" action="<?php echo DIR_ROOT ?>search.php">
                <i class='close-nav-search fa fa-lg fa-times'></i>
                <input class="search-input" name="p" placeholder='Search all products e.g. "Headache Racks"' type='text' />
                <input class="search-submit" value="Submit" type="submit">
            </form>
            <ul class='nav-links thumbs'>
                <li class='nav-link drop'>
                    <a class='nav-img animate expand' href="<?php echo DIR_ROOT; ?>aluminum-pickup-truck-accessories">
                        <img alt="Truck Accessories" src='<?php echo DIR_IMAGES; ?>_header/truck-accessories-1-rollover.png'/>
                        <h2>
                            <span class="hide eleven-twenty">Truck Accessories</span><span class="show eleven-twenty">Pickup</span>
                        </h2>
                    </a>
                    <?php include( 'dropdown_truck_acc.php' ); ?>
                </li>
                <!-- service bodies -->
                <li class='nav-link drop'>
                    <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-truck-service-bodies'>
                        <img alt="Service Bodies" src='<?php echo DIR_IMAGES; ?>_header/service-bodies-2-rollover.png'/>
                        <h2>Service Bodies</h2>
                    </a>
                    <?php include( 'dropdown_service_bodies.php' ); ?>
                </li>
                <!-- aluminum flatbeds -->
                <li class='nav-link drop'>
                    <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-truck-flatbeds'>
                        <img alt="Aluminum Flatbeds" src='<?php echo DIR_IMAGES; ?>_header/aluminum-flatbeds-3-rollover.png'/>
                        <h2>
                            <span class="hide eleven-twenty">Aluminum </span>Flatbeds
                        </h2>
                    </a>
                    <?php include( 'dropdown_aluminum_flatbeds.php' ); ?>
                </li>
                <!-- pickup packs -->
                <li class='nav-link'>
                    <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>pickup-packs'>
                        <img alt="Pickup Packs" src='<?php echo DIR_IMAGES; ?>_header/pickup-pack-8-rollerover.png'/>
                    <h2>Pickup Packs</h2>
                    </a>
                    <?php include( 'dropdown_pickup_packs.php' ); ?>
                </li>
                <!-- semi accessories -->
                <li class='nav-link drop'>
                    <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-semi-truck-accessories'>
                        <img alt="Semi Accessories" src='<?php echo DIR_IMAGES; ?>_header/semi-accessories-4-rollover.png'/>
                        <h2>Semi Accessories</h2>
                    </a>
                    <?php include( 'dropdown_semi_trucks.php' ); ?>
                </li>
                <!-- custom fabrication -->
                <li class='nav-link drop'>
                    <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>custom-aluminum-fabrication'>
                        <img alt="Custom Fabrication" src='<?php echo DIR_IMAGES; ?>_header/custom-fabrication-5-rollover.png'/>
                        <h2>Custom<span class="hide eleven-twenty"> Fabrication</span></h2>
                    </a>
                    <?php include( 'dropdown_custom_fabrication.php' ); ?>
                </li>
                <!-- rv tow bodies -->
                <li class='nav-link drop'>
                    <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-tow-bodies'>
                        <img alt="RV Tow Bodies" src='<?php echo DIR_IMAGES; ?>_header/RV-tow-bodies-6-rollover.png'/>
                        <h2>RV Tow Bodies</h2>
                    </a>
                    <?php include( 'dropdown_tow_bodies.php' ); ?>
                </li>
                <!-- law enforcement -->
                <li class='nav-link drop'>
                    <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-law-enforcement-accessories'>
                        <img alt="Law Enforcement" src='<?php echo DIR_IMAGES; ?>_header/law-enforcement-7-rollover.png'/>
                        <h2>Law Enforcement</h2>
                    </a>
                    <?php include( 'dropdown_law_enforcement.php' ); ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- end global site header and navigation -->
<!-- include mobile menu -->
<?php include( 'mobile_menu.php' ); ?>