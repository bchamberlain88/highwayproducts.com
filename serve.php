<?php

include_once("./_includes/globals.inc.php");

function createimagefromfile($image_path) {
    list($image_width, $image_height, $image_type) = getimagesize($image_path);
    switch($image_type) {
        case IMAGETYPE_GIF: return imagecreatefromgif($image_path); break;
        case IMAGETYPE_PNG: return imagecreatefrompng($image_path); break;
        case IMAGETYPE_JPEG: return imagecreatefromjpeg($image_path); break;
        default: return ""; break;
    }
}

/* load the original image into memory */
//$image = createimagefromfile(image_crypt("decrypt", $_GET["source"]).image_crypt("decrypt", $_GET["image"]));
$image = createimagefromfile($_GET["source"].$_GET["image"]);
if(!$image) die("There was an issue opening this image");

if(!$_GET["thumb"]) {
    /* load the watermark into memory */
    $watermark = createimagefromfile(DIR_IMAGES."_misc/highway-products-watermark_1024.png");
    $watermark_pos_x = (imagesx($image) - imagesx($watermark))/2;
    $watermark_pos_y = (imagesy($image) - imagesy($watermark))/2;
} else {
    /* load the watermark into memory */
    $watermark = createimagefromfile(DIR_IMAGES."_misc/highway-products-watermark-small.png");
    /* set the x and y position of the watermark on the original image */
    $watermark_pos_x = imagesx($image) - imagesx($watermark) - 20;
    $watermark_pos_y = 20;
}

if(!$watermark) die("There was an issue generating the watermark");

/* merge the watermark to the original image */
imagecopy($image, $watermark,  $watermark_pos_x, $watermark_pos_y, 0, 0,
    imagesx($watermark), imagesy($watermark));

/* output the watermarked image */
header("Content-Type: image/jpeg");
imagejpeg($image, "", 100);

/* remove the images from memory */
imagedestroy($image);
imagedestroy($watermark);

?>