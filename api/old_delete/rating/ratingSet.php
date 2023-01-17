<?php
header("Content-Type: text/html; charset=utf-8");
include_once "../../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);
$sql = 'INSERT INTO ratings (user_id, value, text) VALUES
("'. $_POST["userId"] . '", '. $_POST["val"] . ', "' . $_POST["text"] . '");';

if (!mysqli_query($link, $sql)) {
  echo "ERROR";
}

mysqli_close($link);
?>