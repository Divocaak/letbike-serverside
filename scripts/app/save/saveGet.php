<?php
include_once "../../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);
$sql = "SELECT value FROM saves WHERE item_id=" . $_POST["itemId"] . " AND user_id='" . $_POST["userId"] . "';";
if (!mysqli_query($link, $sql)) {
  echo "ERROR";
} else {
  echo $row[0];
}
mysqli_close($link);
?>