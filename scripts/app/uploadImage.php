<?php
/* $_POST['imgCount'] = 1;
$_POST['imgFolder'] = "items";
$_POST['folderIdentificator'] = "BklPG3VYHrdhQAsJctROOxC5rRx1348648223";
 */
$imgCount = intval($_POST['imgCount']);
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
}
?>