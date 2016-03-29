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

include_once('../_includes/meta.inc.php'); 
include_once('../_includes/quote.php'); ?>

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

        <ul class='breadcrumbs'>
            <li><a class='animate' href='<?php echo DIR_ROOT; ?>'>
                <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
            </a></li>
            <li class="lastCrumb">Contact</li>
        </ul>

        <h1>Contact Highway Products Inc.</h1>
        <a href="tel:+1-800-866-5269"><img style="width: 100%;" src="<?php echo DIR_IMAGES. '_misc/how_to_buy.png' ?>" alt='How to buy' /></a>
        <p>Do you have any questions or comments about our products or services? Don't hold back! Our sales team is happy
        to help with any concerns you may have. Just fill out the form below and press the submit button to send your message
        off to us, and we will respond to your message as soon as we can!</p>
        
        <ul class='sales-team hide six_hundred'>

            <?php
            $i = 1;
            $getSales = mysql_query("SELECT * FROM sales_team");
            while($sales = mysql_fetch_assoc($getSales)){
                echo "<li class='sales-member'>";
                    echo "<img title='Contact Highway Products " . $i . "' alt='Highway Products Sales Team Member: ".$sakes['name']."' src='".DIR_IMAGES."_misc/_sales/_team/".$sales['picture']."'/>";
                echo "</li>";
                $i++;
            }

            ?>

        </ul>

        <form class='contact-form aweber-form' data-submit='1082506812' name='contact-form' method='post'>
            <h1>Send us a message</h1>
            <div class='form-msg'></div>

            <div class='form-row'>
                <input required class='aweber-input form-input three' data-aweber='awf_field-77798206' name='name' placeholder='Full Name' type='text' />
                <input required autocorrect='off' spellcheck='false' class='aweber-input form-input three' data-aweber='awf_field-77798207' name='email' placeholder='Email Address' type='email' />
                <input required autocorrect='off' spellcheck='false' class='aweber-input form-input three' data-aweber='awf_field-77798208' name='phone' placeholder='Phone Number' type='tel' />
            </div><!-- form-row -->
            <div class='form-row'>
                <textarea required class='aweber-input form-textarea' data-aweber='awf_field-77798209' name='message' placeholder='Enter your message'></textarea>
            </div><!-- form-row -->
            <input class='button medium secondary animate submit-form' name='contact' type='submit' value='Submit Form' />
        </form>

        <div class='aweber AW-Form-1082506812'></div>
        <div class='slider-container'>
        <div class='slider'>
            <div class='map slide nolines animate slow' data-slide='1'>
                <div class='map-cover'></div>
                <iframe width='100%' height='100%' frameBorder='0' src='https://a.tiles.mapbox.com/v4/sebastian-hpi.k9a8km80/attribution.html?access_token=pk.eyJ1Ijoic2ViYXN0aWFuLWhwaSIsImEiOiJQYnJFNDBNIn0.QCNYkrj_TfNEL6MU5_Ec_Q'></iframe>
          </div><!-- map slide nolines animate slow -->
        </div><!-- slider -->
        </div><!-- slider-container -->
        <div class='selectors-container'></div>
        <form class='newsletter-form aweber-form' data-submit='773120635' name='contact-form' method='post'>
        <div class='newsletter-signup'>
            <h1>Subscribe To Our Newsletter <i class='fa fa-lg fa-times close-newsletter'></i></h1>
            <p>Enter your email address to subscribe to the Highway Products monthly newsletter.
            Receive special promotional offers, discount opportunities, as well as the latest news and updates from our sales team!</p>
            <input required class='aweber-input input-text large animate' data-aweber='awf_field-79713815' placeholder='Enter your email address' type='text' />
            <button class='button medium secondary animate'>Join Newsletter</button>
            </form>
            <div class="aweber AW-Form-773120635"></div>
        </div><!-- newsletter-signup -->
    </div><!-- left-content -->

    <div class='right-content'>

        <?php // include addthis api if sharing is allowed
        if( SET_SHARING == 'true' ) { ?>
            <h2>Share this page</h2>
            <div class="addthis_sharing_toolbox"></div>
            <div class='side-sep'></div>
        <?php } ?>

        <?php // show facebook like box if allowed
            if( SET_FACEBOOK_LIKES == 'true' ) { ?>
                <!-- facebook likebox -->
                <div class='fb-like-box hide eight_hundred' data-width='347' data-href='https://www.facebook.com/HighwayProducts' data-colorscheme='light' data-show-faces='true' data-header='false' data-stream='false' data-show-border='false'></div>
                <!-- end facebook likebox -->
                <div class='side-sep hide eight_hundred'></div>
            <?php } ?>

        <ul class='callout-features'>

            <h2>Contact Information</h2>
            <li class='callout-feature'>
                <i class='circle fa fa-lg fa-map-marker'></i>
                7905 Agate Rd. White City, OR 97503
            </li>

            <li class='callout-feature'>
                <i class='circle fa fa-envelope'></i>
                <a class='animate' href='mailto:sales@highwayproducts.com'>sales@highwayproducts.com</a>
            </li>

            <li class='callout-feature'>
                <i class='circle fa fa-phone'></i>
                1-800-tool-box (866-5269)
            </li>

        </ul>

        <div class="side-sep small"></div>

        <ul class='callout-features'>

            <h2>Follow Us Online</h2>
            <li class='callout-feature'>
                <i class='circle fa fa-facebook'></i>
                <a target="_blank" href="http://www.facebook.com/highwayproducts" class='animate'>www.facebook.com/highwayproducts</a>
            </li>

            <li class='callout-feature'>
                <i class='circle fa fa-twitter'></i>
                <a target="_blank" href="http://www.twitter.com/highwayproducts" class='animate'>www.twitter.com/highwayproducts</a>
            </li>

            <li class='callout-feature'>
                <i class='circle fa fa-youtube'></i>
                <a target="_blank" href="http://www.youtube.com/user/highwayproducts" class='animate'>www.youtube.com/user/highwayproducts</a>
            </li>

        </ul>

    </div>

    </div>

<?php // include addthis api if sharing is allowed
if( SET_SHARING == 'true' ) { ?>
    <!-- include addthis script -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php } ?>

<!-- contact form script -->
<script type='text/javascript'>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'http://forms.aweber.com/form/12/1082506812.js';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'aweber-wjs-fm5h6cf1v'));
</script>

<!-- newsletter script -->
<script type="text/javascript">(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//forms.aweber.com/form/99/773120635.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, "script", "aweber-wjs-6bhepjf7u"));
</script>

<?php include_once('../_includes/footer.inc.php'); ?>