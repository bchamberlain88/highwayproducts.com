<?php

/**
 *
 * Include global variables into header so they
 * pass into every page. Define meta values and
 * create site header and main navigation. Load
 * global functions and classes, and connect to
 * the urban circus database.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

include_once('../_includes/meta.inc.php'); 
$q = $_GET['q']; ?>

<div class='container sb'>
    <div class='slider-container'>
        <div class='slider'>
            <div class='slide animate slow' data-slide='1'>
                <img class='lazy' src='<?php echo DIR_IMAGES; ?>_support/_slides/hpi-support-slide-1.jpg'/>
            </div>
        </div>
    </div>

    <div class='selectors-container'> </div>

    <div class='wrapper fs'>

        <div class='left-content'>

            <ul class='breadcrumbs hide seven_hundred'>
                <li><a class='animate' href='<?php echo DIR_ROOT; ?>'>
                    <i class='home-icon fa fa-home'></i> Highway Products <i class='fa fa-angle-right'></i>
                </a></li>
                <?php if( $q ) {
                    echo "<li><a class='animate' href='" . DIR_ROOT . "support/'>
                    Product Support <i class='fa fa-angle-right'></i></a></li>";
                    echo "<li class='current-page'>" . ucfirst( $q ) . "</li>";
                } else {
                    echo "<li>Product Support</li>";
                } ?>
            </ul>

            <div class='faq-answers'>

            <?php if( $q ) { ?>

            <?php } else { ?>

            <h1>Need product support? We're here to help!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque et sapien ac ante pellentesque cursus at ac erat. Cras dignissim eros et laoreet interdum. 
            Aliquam congue dui a sem tincidunt sollicitudin. Integer rutrum lorem sit amet erat mattis, pharetra faucibus tortor ullamcorper. Phasellus at eleifend diam, 
            sit amet euismod arcu. Phasellus luctus, massa vitae rutrum posuere, leo ligula porta ante, eget fringilla elit lacus ullamcorper justo. Quisque tincidunt nisl et 
            felis placerat convallis. Sed mattis bibendum cursus. Duis semper ante nec odio molestie, ut mollis elit blandit. Praesent pharetra vitae est vel varius. Nulla 
            malesuada sem in massa aliquam elementum. Integer imperdiet feugiat accumsan. In rhoncus fringilla augue a sagittis.
            <br><br>
            Sed quis est massa. Nulla non pharetra ante, nec ornare turpis. Nunc vitae lectus ac mauris varius pulvinar et sed nisl. Maecenas volutpat ligula neque. Curabitur 
            mi arcu, hendrerit vitae justo in, cursus vehicula felis. Nunc a commodo tortor. Fusce non nunc at dolor sodales posuere. Proin dignissim augue in justo venenatis, 
            non laoreet risus consectetur. Maecenas cursus hendrerit tempor. Donec ac sodales velit. Maecenas a tortor dui. Praesent ut elit at tortor porttitor condimentum. 
            Suspendisse ac pretium quam.</p>
            <h1 class='hand'>Select a topic from the right!</h1>

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
                <?php $getQuestions = mysql_query('SELECT * FROM product_support WHERE is_visible = 1');
                while($question = mysql_fetch_assoc($getQuestions)){
                    echo "<li><a class='animate faq-question' data-question='" . $question['selector'] ."'>" . $question['question'] . "</a></li>";
                } ?>
            </ul>

        </div>

    </div>

<?php // include addthis api if sharing is allowed
if( SET_SHARING == 'true' ) { ?>
    <!-- include addthis script -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php } ?>

<?php include_once('../_includes/footer.inc.php'); ?>
<?php if( $q ) { ?>
<script type="text/javascript">openQuestion( "<?php echo $q; ?>" );</script>
<?php } ?>