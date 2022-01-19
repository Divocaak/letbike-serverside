<?php
include_once "../../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$sql = "SELECT value FROM saves WHERE item_id=" . $_POST["itemId"] . " AND user_id='" . $_POST["userId"] . "';";
if ($result = mysqli_query($link, $sql)) {
  while ($row = mysqli_fetch_row($result)) {
    echo $row[0];
  }
} else {
  echo "ERROR";
}
mysqli_close($link);
?>