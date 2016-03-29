<?php

/**
 *
 * Include global variables into header so they
 * pass into every page. Define meta values and
 * include site header and main navigation. Load
 * global functions and classes, and connect to
 * the primary database.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

// require global variables
require_once('globals.inc.php'); 
$product_selector = $_GET['q'];
$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
checkForRedirects($host);
if($product_selector){
    pageExists('product', $product_selector);
} ?>

<!DOCTYPE html>
<html lang='en'>
<head>
<!--squeezr script-->
<script type="text/javascript" id="squeezr" data-breakpoints-images="480,768,1024,1366,1920">(function(a){function h(){for(var f,a=0,b=d.cookie.split(";"),c=/^\ssqueezr\.([^=]+)=(.*?)\s*$/,e={};b.length>a;++a)(f=b[a].match(c))&&(e[f[1]]=f[2]);return e}function i(a){a=Math.max(parseFloat(a||1,10),.01);var c=d.documentElement,f=function(){var a=d.createElement("div"),b={width:"1px",height:"1px",display:"inline-block"};for(var c in b)a.style[c]=b[c];return a},g=d.createElement("div"),h=g.appendChild(f());g.appendChild(f()),c.appendChild(g);for(var i=g.clientHeight,j=Math.floor(e/i),k=j/2,l=0,m=[j];1e3>l++&&(Math.abs(k)>a||g.clientHeight>i);)j+=k,h.style.width=j+"em",k/=(g.clientHeight>i?1:-1)*(k>0?-2:2),m.push(j);return c.removeChild(g),j}function j(a){for(var g,c=0,d=(a||"").split(","),e=/(\d+(?:\.\d+)?)(px)?/i,f=[];d.length>c;++c)(g=d[c].match(e))&&f.push(parseFloat(g[1],10));return f.sort(function(a,b){return a-b})}function k(){return"devicePixelRatio"in a?a.devicePixelRatio:"deviceXDPI"in a&&"logicalXDPI"in a?a.deviceXDPI/a.logicalXDPI:1}if(navigator.cookieEnabled)for(var b="squeezr",c=";path=/",d=document,e=a.innerWidth,f=screen.width,g=screen.height,m=0,n=d.getElementsByTagName("script");n.length>m;++m)if(n[m].id==b){var o=k(),p="-";if(d.cookie=b+".screen="+f+"x"+g+"@"+o+c,!n[m].getAttribute("data-disable-images")){var q=j(n[m].getAttribute("data-breakpoints-images")),r=Math.max(f,g),s=null;do{if(r>(s=q.pop()))break;p=s*o+"px"}while(q.length)}d.cookie=b+".images="+p+c;var t=h(),u=t.css||"-";if(!("css"in t&&t.css&&"-"!=t.css||n[m].getAttribute("data-disable-css"))){var v=e/i(parseFloat(n[m].getAttribute("data-em-precision")||.5,10)/100);u=f+"x"+g+"@"+Math.round(10*v)/10}d.cookie=b+".css="+u+c;break}})(this);</script>

<script type="text/javascript">
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
    //stop window loading to prevent flash of content
    //check if it's IE
    if(window.ActiveXObject || "ActiveXObject" in window){
        document.execCommand("Stop");} else {
        window.stop();
    }
    //remove quote cookie and redirect to successful send page
    createCookie("quote_sent", "", -1, '/');
    //set url structure depending on whether we are looking at a product
    window.location = "<?php if(isset($product_selector)){echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . "&quote=sent"; } else {
        echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . "?quote=sent";
    } ?>"
}
</script>
<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "Highway Products",
    "logo": "http://www.highwayproducts.com/_assets/_images/highway-logo-silver.png",
    "url": "http://www.highwayproducts.com",
    "sameAs": [
        "https://www.facebook.com/highwayproducts",
        "https://twitter.com/highwayproducts",
        "https://www.instagram.com/highwayproductsinc",
        "https://www.youtube.com/channel/UCHWLMm-DEWR2lFC4OFq_JPQ"
    ],
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "(800) 866-5269",
        "contactType": "Sales",
        "contactOption": "TollFree",
        "areaServed": "",
        "availableLanguage": "English"
    },
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "United States",
        "addressLocality": "White City",
        "addressRegion": "OR",
        "postalCode": "97503",
        "streetAddress": "7905 Agate Rd"
    }
}</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '769528483148690');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=769528483148690&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<!--

All code and resources are copyright to Highway Products Inc.

@website  www.highwayproducts.com
@facebook www.facebook.com/HighwayProducts
@twitter  www.twitter.com/HighwayProducts                                                                                                                                
-->

    <!-- generic meta -->
    <meta charset='UTF-8'>
    <title>
    <?php 
    //check if title for page is set, otherwise show set default
    $rTitle = titleExists($product_selector);
    if(empty($rTitle)) { 
        echo META_TITLE;
         } else {
        echo $rTitle;
         }
    ?>
    </title>
    <meta name='robots' content='index, follow'>
    <base href='<?php echo META_BASE; ?>'>
    <meta name='author' content='<?php echo META_AUTHOR; ?>'>
    <meta name='description' content="
    <?php 
    //check if description for page is set, otherwise show set default
    $rDesc = descExists($product_selector);
    if(empty($rDesc)) { 
        echo META_DESCRIPTION;
         } else {
        echo $rDesc;
         }
    ?>">
    <meta name='keywords' content='<?php echo META_KEYWORDS; ?>'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- google site verification -->
    <meta name='google-site-verification' content='<?php echo GOOGLE_VERIFY; ?>' />

    <!-- twitter meta -->
    <meta name='twitter:card' content='<?php echo TWITTER_CARD; ?>'>
    <meta name='twitter:site' content='<?php echo TWITTER_OWNER; ?>'>
    <meta name='twitter:creator' content='<?php echo TWITTER_CREATOR; ?>'>
    <meta name='twitter:title' content='<?php echo TWITTER_TITLE; ?>'>
    <meta name='twitter:description' content='<?php echo TWITTER_DESCRIPTION; ?>'>
    <meta name='twitter:url' content='<?php echo META_BASE; ?>'>
    <meta name='twitter:image:src' content='<?php echo TWITTER_IMAGE; ?>'>

    <!-- facebook meta -->
    <meta name='og:title' content='<?php echo FACEBOOK_TITLE; ?>'>
    <meta name='og:image' content='<?php echo FACEBOOK_IMAGE; ?>'>
    <meta name='og:url' content='<?php echo META_BASE; ?>'>
    <meta name='og:site-name' content='<?php echo FACEBOOK_TITLE; ?>'>
    <meta name='og:description' content='<?php echo FACEBOOK_DESCRIPTION; ?>'>

    <!-- desktop and mobile favicons -->
    <meta name='msapplication-TileColor' content='#2e373c'>
    <meta name='msapplication-TileImage' content='mstile-144x144.png'>
    <meta name="msapplication-config" content="<?php echo DIR_IMAGES; ?>_misc/_favicons/browserconfig.xml">
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-192x192.png' sizes='192x192'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-160x160.png' sizes='160x160'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-96x96.png' sizes='96x96'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-16x16.png' sizes='16x16'>
    <link rel='icon' type='image/png' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon-32x32.png' sizes='32x32'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-57x57.png' sizes='57x57'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-114x114.png' sizes='114x114'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-72x72.png' sizes='72x72'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-144x144.png' sizes='144x144'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-60x60.png' sizes='60x60'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-120x120.png' sizes='120x120'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-76x76.png' sizes='76x76'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-152x152.png' sizes='152x152'>
    <link rel='apple-touch-icon' href='<?php echo DIR_IMAGES; ?>_misc/_favicons/apple-touch-icon-180x180.png' sizes='180x180'>
    <link rel="shortcut icon" href="<?php echo DIR_IMAGES; ?>_misc/_favicons/favicon.ico">

    <!--[if lt IE 9]>
        <script src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->

    <!-- import Font Awesome by Dave Gandy - http://fontawesome.io -->
    <link href='//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' rel='stylesheet'  type='text/css'>
    <!-- import Google fonts :: Open Sans :: Light, Regular, Bold, Extra Bold -->
    <link href='http://fonts.googleapis.com/css?family=Reenie+Beanie%7COpen+Sans:200,400,700,800' rel='stylesheet' type='text/css'>
    <!-- import reset, all global page styles, and lightbox styles -->
    <link href='<?php echo DIR_STYLES.'style.min.css?' ?>' rel='stylesheet' type='text/css'>

</head>

<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5RNFRC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5RNFRC');</script>
<!-- End Google Tag Manager -->

<?php // include the global header
if($_GET['view'] == 'list'){
    include_once('header.backup.php');
}elseif($_GET['view'] == 'thumbs'){
    include_once('header.thumbs.backup.php');
}else{
    include_once('header.inc.php');
} ?>