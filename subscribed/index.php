<script type="text/javascript">
//set function and remove quote cookie
function createCookie(name, value, expires, path, domain) {
  var cookie = name + "=" + escape(value) + ";";

  if (expires) {
    // If it's a date
    if(expires instanceof Date) {
      // If it isn't a valid date
      if (isNaN(expires.getTime()))
       expires = new Date();
    }
    else
      expires = new Date(new Date().getTime() + parseInt(expires) * 1000 * 60 * 60 * 24);

    cookie += "expires=" + expires.toGMTString() + ";";
  }

  if (path)
    cookie += "path=" + path + ";";
  if (domain)
    cookie += "domain=" + domain + ";";

  document.cookie = cookie;
}
if (document.cookie.indexOf("quote_sent") >= 0) {
    createCookie("quote_sent", "", -1, '/');
}
</script>
<style type="text/css">
    a.animate.hide.seven_hundred.button.medium.gold.fixed-quote-button {
    display: none;
    }
</style>
<?php
/**
 *
 * About Highway Products. Telling the story of 
 * the company and the people who work here, including
 * a small timeline showing dates of important events
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */
include_once('../_includes/meta.inc.php');
include_once('../_includes/quote.php'); ?>

<div class='container'>
    <a class='scroll-slider'>
        <span class='fa fa-arrow-down'></span>
    </a>
    <div class='wrapper fs'>
        <div class='full-content'>
            <ul class='breadcrumbs'>
                <li><a class='animate' href='<?php echo DIR_ROOT; ?>'>
                        <i class='home-icon fa fa-home'></i> Highway Products
                    </a>
                </li>
            </ul>
        <p>Oops! It looks like you're already subscribed. Please call us at 1-800-866-5269 or send us an email at <a href="mailto:sales@highwayproducts.com">sales@highwayproducts.com</a> for assistance.</p>
        </div>
    </div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53e12d2343fe8b67"></script>
<?php include_once('../_includes/footer.inc.php'); ?>