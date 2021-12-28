<?php
$pathToImages = "../../imgs/" . $_POST['imgFolder'] . "/" . $_POST['folderIdentificator'];
if (!file_exists($pathToImages)) {
  mkdir($pathToImages, 0775, true);
}

for($i = 0; $i < intval($_POST['imgCount']); $i++){
  imagejpeg(imagecreatefromstring(base64_decode($_POST["img" . strval($i)])), $pathToImages . "/" . $i . ".jpg", 20);
}
?>
