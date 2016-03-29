<?php

/*
 *
 * Include global variables into header so they
 * pass into every page. Define meta values and
 * create site header and main navigation. Load
 * global functions and classes, and connect to
 * the urban circus database.
 *
 * @author  Sebastian Inman
 * @email   inman.sebastian@gmail.com
 * @link    http://www.highwayproducts.com
 * @license http://www.highwayproducts.com/docs/license.txt
 *
 */

include_once('../../_includes/meta.inc.php'); 
$question = $_GET['q']; ?>

<div class='container'>
    <div class='slider-container'>
        <div class='slider'>
            <div class='slide animate slow' data-slide='1'>

                <h1>
                    Highway Products Help & Support<br>
                    <span>Maecenas odio lacus, aliquet ac elementum non, sollicitudin tempus lectus.</span>
                    <!--
                    <form class='help-form'>
                        <input class='help-input' placeholder='Search Highway Products Documentation' type='text'/>
                        <div class='help-selected animate'><label>General Information</label><i class='fa fa-caret-down animate'></i></div>
                        <input class='help-button animate' type='submit' value='Search'/>
                    </form>
                    -->
                </h1>

                <img src='<?php echo DIR_IMAGES; ?>_support/_slides/hpi-support-slide-1.jpg'/>
            </div>
        </div>
    </div>

    <div class='selectors-container'> </div>

    <div class='wrapper'>

        <div class='left-content'>

            <div class='faq-answers'>

            <?php if($question){ ?>

            <?php }else{ ?>

            <h1>Need product support? We're here to help!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque et sapien ac ante pellentesque cursus at ac erat. Cras dignissim eros et laoreet interdum. Aliquam congue dui a sem tincidunt sollicitudin. Integer rutrum lorem sit amet erat mattis, pharetra faucibus tortor ullamcorper. Phasellus at eleifend diam, sit amet euismod arcu. Phasellus luctus, massa vitae rutrum posuere, leo ligula porta ante, eget fringilla elit lacus ullamcorper justo. Quisque tincidunt nisl et felis placerat convallis. Sed mattis bibendum cursus. Duis semper ante nec odio molestie, ut mollis elit blandit. Praesent pharetra vitae est vel varius. Nulla malesuada sem in massa aliquam elementum. Integer imperdiet feugiat accumsan. In rhoncus fringilla augue a sagittis.
<br><br>
Sed quis est massa. Nulla non pharetra ante, nec ornare turpis. Nunc vitae lectus ac mauris varius pulvinar et sed nisl. Maecenas volutpat ligula neque. Curabitur mi arcu, hendrerit vitae justo in, cursus vehicula felis. Nunc a commodo tortor. Fusce non nunc at dolor sodales posuere. Proin dignissim augue in justo venenatis, non laoreet risus consectetur. Maecenas cursus hendrerit tempor. Donec ac sodales velit. Maecenas a tortor dui. Praesent ut elit at tortor porttitor condimentum. Suspendisse ac pretium quam.</p>

            <ul class='sales-team'>

                <li class='sales-member'>
                    <img src='http://www.highwayproducts.com/images/salesmen/jim_thumb.jpg'/>
                </li>

                <li class='sales-member'>
                    <img src='http://www.highwayproducts.com/images/salesmen/obie_thumb.jpg'/>
                </li>

                <li class='sales-member'>
                    <img src='http://www.highwayproducts.com/images/salesmen/mike_thumb.jpg'/>
                </li>

                <li class='sales-member'>
                    <img src='http://www.highwayproducts.com/images/salesmen/bruce_thumb.jpg'/>
                </li>

                <li class='sales-member'>
                    <img src='http://www.highwayproducts.com/images/salesmen/joe_thumb.jpg'/>
                </li>

                <li class='sales-member'>
                    <img src='http://www.highwayproducts.com/images/salesmen/new_1.jpg'/>
                </li>

                <li class='sales-member'>
                    <img src='http://www.highwayproducts.com/images/salesmen/new_2.jpg'/>
                </li>

            </ul>

            <?php } ?>

            </div>

        </div>

        <div class='right-content'>

            <?php // include addthis api if sharing is allowed
            if( SET_SHARING == 'true' ) { ?>
                <h2>Share this page</h2>
                <div class="addthis_sharing_toolbox"></div>
                <div class='side-sep'></div>
            <?php } ?>

            <h1 class='qa'>Have A Question?</h1>
            <p>If you have any questions about our products or services, our sales team is happy to help!</p>
            <span class='categories'>
                <a class='animate'>Ask A Question</a>
            </span>

            <div class='side-sep'></div>

            <h1>Frequently Asked Questions</h1>
            <ul class='faq-questions'>
                <li><a class='animate faq-question' data-question='order'>How to place an order</a></li>
                <li><a class='animate faq-question' data-question='materials'>What materials do we use?</a></li>
                <li><a class='animate faq-question' data-question='warranty'>Highway Products Warranty Information</a></li>
                <li><a class='animate faq-question' data-question='returns'>Can I return or exchange my purchase?</a></li>
                <li><a class='animate faq-question' data-question='dealers'>How to become a Highway Products dealer</a></li>
            </ul>

        </div>

    </div>

<?php // include addthis api if sharing is allowed
if( SET_SHARING == 'true' ) { ?>
    <!-- include addthis script -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php } ?>

<?php include_once('../../_includes/footer.inc.php'); ?>
<?php if($question){ ?>
<script type="text/javascript">openQuestion("<?php echo $question; ?>");</script>
<?php } ?>