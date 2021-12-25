<?php
/* $imgCount = intval($_POST['imgCount']);
$imgFolder = $_POST['imgFolder'];
$folderIdentificator = $_POST['folderIdentificator'];

$pathToImages = "../../imgs/" . $imgFolder . "/" . $folderIdentificator;
if (!file_exists($pathToImages)) {
  mkdir($pathToImages, 0775, true);
}

for($i = 0; $i < $imgCount; $i++){
  $baseDecoded = base64_decode($_POST["img" . strval($i)]);
  
  $fp = fopen($pathToImages . "/" . $i . ".jpg", "w+");
  fwrite($fp, $baseDecoded);
} */

// 353 273 b
// open image to content
$filename = "test/orig.jpg";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

// b64
// 471 032 b
/* 
$fp = fopen("test/img.b64", "w+");
fwrite($fp, base64_encode($contents));
*/

// png
// 471 032 b
$im = imagecreatefromjpeg("test/orig.jpg");
$quality = 9; //0 - 9 (0= no compression, 9 = high compression)
imagepng($im, 'test/img.png', $quality);  //leave out filename if you want it to output to the buffer
?>
