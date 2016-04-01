<?php 

/**
 *
 * Global site footer and javascript files.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

?>
<?php include( 'footer_mobile_menu.php' ); ?>
<!-- global site footer -->
<footer class='main-footer'>
    <!-- footer link container -->
    <div class='footer-links'>
        <div class='wrapper'>
            <!-- Get In Touch -->
            <ul class='footer-list'>
                <li><h2 class="footerHeader">Get In Touch</h2></li>
                <li><a class="animate" target="_blank" href="https://www.google.com/maps/place/7905+Agate+Rd,+White+City,+OR+97503/@42.432178,-122.85753,17z/data=!3m1!4b1!4m2!3m1!1s0x54cf62c2a987ab73:0x2ab8a7109ae215a3">7905 Agate Rd.</a></li>
                <li><a class="animate" target="_blank" href="https://www.google.com/maps/place/7905+Agate+Rd,+White+City,+OR+97503/@42.432178,-122.85753,17z/data=!3m1!4b1!4m2!3m1!1s0x54cf62c2a987ab73:0x2ab8a7109ae215a3">White City, OR 97503</a></li>
                <li><a href="mailto:<?php echo META_CONTACT; ?>"><span class='fa fa-envelope-o animate'></span></a><a class="animate" href="mailto:<?php echo META_CONTACT; ?>">sales@highwayproducts.com</a></li>
                <li><span class='fa fa-phone'></span> 1-800-TOOL-BOX (866-5269)</li>
                <li>&nbsp;</li>
                <li><a target="_blank" href="<?php echo DIR_ROOT . 'careers';?>">Join our team!</a></li>
                <li>&nbsp;</li>
            </ul>
            <!-- Follow Us Online -->
            <ul class='footer-list'>
                <li><h2 class="footerHeader">Follow Us Online</h2></li>
                <li><a target="_blank" class="animate" href="http://www.facebook.com/highwayproducts">Facebook</a></li>
                <li><a target="_blank" class="animate" href="http://www.twitter.com/highwayproducts">Twitter</a></li>
                <li><a target="_blank" class="animate" href="https://plus.google.com/103158410682862795477/posts">Google +</a></li>
                <li><a target="_blank" class="animate" href="http://www.youtube.com/user/highwayproducts">Youtube</a></li>
            </ul>
            <!-- See Our Family of Brands -->
            <ul class='footer-list'>
                <li><h2 class="footerHeader">See Our Family of Brands</h2></li>
                <li><a target="_blank" class="animate" href="http://pavati.com/"><img class="familyBrand" src="<?php echo DIR_IMAGES . '_misc/pavati.png'?>"></a></li>
                <li><a target="_blank" class="animate" href="http://www.pavatimarine.com/"><img class="familyBrand" src="<?php echo DIR_IMAGES . '_misc/pavatimarine.png'?>"></a></li>
                <li><a target="_blank" class="animate" href="http://www.800toolbox.com/"><img class="familyBrand" src="<?php echo DIR_IMAGES . '_misc/800toolbox.jpg'?>"></a></li>
            </ul>
            <!-- social media links -->
            <ul class='footer-list large instagram'>
                <li><h2 class="footerHeader">Instagram Feed</h2></li>
                <li><div id='instafeed'></div></li>
            </ul>
        </div>
    </div>
    <!-- end footer link container -->
    <!-- footer sub content - copyright -->
    <div class='sub-footer'>
        <div class='wrapper'>
            <label class='copy-info'><span class='break 800'>Highway Products Inc. </span>7905 Agate Rd. White City, OR 97503. &copy; <?php echo date('Y'); ?>. All rights reserved.</label>
            <!-- <a class='sub-link service-link animate hide eight_sixty' data-service='terms-of-service'>Terms of Service</a> -->
            <a class='sub-link service-link animate hide eight_sixty' data-service='privacy-policy'>Privacy Policy</a>
        </div>
    </div>
    <!-- end footer sub content -->
</footer>
<!-- end site footer -->
</div>
<!-- end content container -->
<!-- import the latest jQuery API -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<!-- import global javascript functions and plugins -->
<script type="text/javascript" src="<?php echo DIR_SCRIPTS . 'script.js?' ?>"></script>
<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
window.__lc = window.__lc || {};
window.__lc.license = 3147512;
(function() {
  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<script type="text/javascript">
    $('.magnific').magnificPopup({
            type: 'image',
        gallery:{
                enabled:true
        }
    });
    $('.mag-feature').magnificPopup({
            type: 'image',  mainClass: 'mfp-feature',
        gallery:{
                enabled:true
        }
    });
</script>
<!-- End of LiveChat code -->
</body>
</html>
