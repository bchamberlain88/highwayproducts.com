<?php
include_once('_includes/connect.inc.php');
//set what to match to indicate gallery path
$gallerySuffix = '/_gallery/.';
//iterate through the gallery directories for filenames
$it = new RecursiveDirectoryIterator("../highwayproducts.com/_assets/_images/_products/");
foreach(new RecursiveIteratorIterator($it) as $location) {
  if(substr($location, -11) === $gallerySuffix) {
    //trim location string to fit source attribue
    $trimBeginningLocation = substr($location, 23);
    $trimmedLocation = rtrim($trimBeginningLocation, ".");
    $handle = opendir( $location );
    while (false !== ($image = readdir($handle))) {
      //as long as the image filename doesn't contain...
      if( $image != '.' && $image != '..' && $image != "Thumbs.db" && $image != "_notes" && $image != "_thumbnails" && $image != "_gallery" && $image !="") {
        $random = mt_rand(100000, 999999);
        $checkExisting = mysql_query( "SELECT * FROM gallery_images WHERE filename = '" . $image . "'" );
        //if image has already been inserted, move on to the next one
        if(mysql_num_rows($checkExisting)>0) { continue; }
        $checkRandom = mysql_query( "SELECT * FROM gallery_images WHERE random = '" . $random . "'" );
        //if the random number is a duplicate, reroll
        if(mysql_num_rows($checkRandom)>0) { $random = mt_rand(100000, 999999); }
      mysql_query("INSERT INTO gallery_images (filename, image_path, random) VALUES (\"$image\",\"$trimmedLocation\",'".$random."')"); 
      }
    }
  }
}
echo 'Gallery identifiers created.'
?>