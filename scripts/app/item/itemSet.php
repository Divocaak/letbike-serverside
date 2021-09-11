<?php
header("Content-Type: text/html; charset=utf-8");

include_once "../../config.php";

$itemParamKey = substr(hash('ripemd160', strval(intval($_GET["seller_id"]) * intval($_GET["price"])) . $_GET["name"]), 0, 32);

$sql = 'INSERT INTO item (seller_id, name, description, price, imgs, status, sold_to, param)
VALUES (' . $_GET["seller_id"] . ', "' . $_GET["name"] . '", "' . $_GET["description"] . '", "' . $_GET["price"] . '", ' . $_GET["images"] . ', 0, -1, "' . $itemParamKey . '")';

$canInsertParams = false;
if (mysqli_query($link, $sql)) {
  $canInsertParams = true;
}

if($canInsertParams){
  $sql = "";
  foreach($_GET as $key => $value){
    if($key != "seller_id" && $key != "name" && $key != "description" && $key != "price" && $key != "images"){
      $sql .= 'INSERT INTO param (item, name, value) VALUES ("' . $itemParamKey . '", "' . $key . '", "' . $value . '");';
    } 
  }

  if (mysqli_multi_query($link, $sql)) {
    echo "Inzerát byl úspěšně uložen.";
  } else {
    echo "Někde se stala chyba, zkuste to prosím později.";
  }
  mysqli_close($link);
}
else{
  echo "Někde se stala chyba, zkuste to prosím později.";
}
?>