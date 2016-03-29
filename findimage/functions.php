<?php error_reporting(E_ALL^E_NOTICE); session_start(); ?>

<?php include_once("../_includes/connect.inc.php");
include_once("../_includes/globals.inc.php");



// get all files within a folder
function list_files($path) {
	$handle = opendir($path); while ($file = readdir($handle)) {
	if($file != '.' && $file != '..') { if(is_dir($path.$file)){

	if($file == "saved"){}else{

		// get files from all sub-directories

		$checkDir = mysql_query("SELECT * FROM ignore_dir WHERE ignore_dir = \"$file\"");
		if(mysql_num_rows($checkDir) == 0){

		if(!file_exists($path.$file."/saved") and !is_dir($path.$file."/saved")){ mkdir($path.$file."/saved"); }else{}
		list_files($path.$file."/");

		}else{}}}else{

	// perform function on each file

	$extensions = array("jpg","jpeg","JPG","JPEG","gif","png");
	$checkFile = mysql_query("SELECT * FROM ignore_file WHERE ignore_file = \"$file\"");


	list($width, $height, $type, $attr) = getimagesize($path.$file);

	$extension = pathinfo($file, PATHINFO_EXTENSION); $file = str_replace(".".$extension, "", $file);

	if(mysql_num_rows($checkFile) == 0){
	if(in_array($extension, $extensions)){

		$checkImage = mysql_query("SELECT * FROM images WHERE picture_dir = '".stripslashes($path)."' AND picture_url = '".$file.".".$extension."'");
		if(mysql_num_rows($checkImage) == 0){ $resultNumber = random(); }else{ $result = mysql_fetch_assoc($checkImage); $resultNumber = $result['picture_code']; }
		if(is_file($path."saved/".$file)){unlink($path."saved/".$file);}else{}

		echo "<div class='result'>
				<a alt='".$resultNumber."' class='result-link' href='".$path."saved/".$file.".".$extension."'>
				  <div class='view'></div>
				  <img src='./image.php?result=".$file."&extension=".$extension."&number=".$resultNumber."&width=".$width."&height=".$height."&path=".$path."' />
				</a>
			  </div>";

		$check = mysql_num_rows(mysql_query("SELECT * FROM images WHERE picture_code = \"$resultNumber\""));
		if($check == 0){ mysql_query("INSERT INTO images (picture_code, picture_dir, picture_url) VALUES (\"$resultNumber\",\"$path\",'".$file.".".$extension."')"); }else{}

	}else{}}else{}} if(is_dir($file)) { echo $file; }}} closedir($handle); }





function directory(){

	$a = mysql_query("SELECT * FROM gallery_images");
	while($b = mysql_fetch_assoc($a)){
		echo "<div class='result' id='".$b['random']."'>
			<a alt='".$b['random']."' class='result-link' data-desc='".$b['random']."' href='". DIR_ROOT . $b['image_path'].$b['filename']."'>
			  <div class='view'></div>
			  <img src='". DIR_ROOT . $b['image_path'].$b['filename']."' />
			  <p class='resultLabel'>" . $b['random'] . "</p>
			</a>
		  </div>";
	}

}

?>