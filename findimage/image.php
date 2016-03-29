<?php include("./connect.php");


// get predefined image properties

$result = $_GET['result']; $extension = $_GET['extension']; $directory = $_GET['path'];
$number = $_GET['number']; $width = $_GET['width']; $height = $_GET['height'];


// create the image container and set headers based on the images extension

if($extension == "jpeg"){ $image = imagecreatefromjpeg($directory.$result.".".$extension); header("Content-type: image/jpeg"); }
if($extension == "JPEG"){ $image = imagecreatefromjpeg($directory.$result.".".$extension); header("Content-type: image/jpeg"); }
if($extension == "jpg"){ $image = imagecreatefromjpeg($directory.$result.".".$extension); header("Content-type: image/jpeg"); }
if($extension == "JPG"){ $image = imagecreatefromjpeg($directory.$result.".".$extension); header("Content-type: image/jpeg"); }
if($extension == "png"){ $image = imagecreatefrompng($directory.$result.".".$extension); header("Content-type: image/png"); }
if($extension == "gif"){ $image = imagecreatefromgif($directory.$result.".".$extension); header("Content-type: image/gif"); }


// define some text settings

$font_family = "./fonts/opensans.ttf";
$font_color = imagecolorallocate($image, 255,255,255); 
$font_shadow = imagecolorallocate($image,0,0,0);
$intro = str_replace("/","", str_replace("./","",str_replace("Images","",$directory)));
$string = "HP ".$number;


// write the text to the image

imagettftext($image,25,0,23,($height - 23),$font_shadow,$font_family,$string); // add shadow to text
imagettftext($image,25,0,25,($height - 25),$font_color,$font_family,$string); // apply color to text


// send the image to the browser and save changes

if($extension == "jpeg"){ imagejpeg($image); imagejpeg($image, $directory."saved/".$result.".".$extension); } 
if($extension == "JPEG"){ imagejpeg($image); imagejpeg($image, $directory."saved/".$result.".".$extension); }
if($extension == "jpg"){ imagejpeg($image); imagejpeg($image, $directory."saved/".$result.".".$extension); } 
if($extension == "JPG"){ imagejpeg($image); imagejpeg($image, $directory."saved/".$result.".".$extension); }
if($extension == "png"){ imagepng($image); imagepng($image, $directory."saved/".$result.".".$extension); } 
if($extension == "gif"){ imagegif($image); imagegif($image, $directory."saved/".$result.".".$extension); }

imagedestroy($image); // clear the image cache

?>