<?php
include_once "../../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);
$sql = "SELECT value FROM saves WHERE item_id=" . $_POST["itemId"] . " AND user_id='" . $_POST["userId"] . "';";
if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    $sql = "UPDATE saves SET value=" . $_POST["val"] . " WHERE item_id=" . $_POST["itemId"] . " AND user_id='" . $_POST["userId"] . "';";
    if (!mysqli_query($link, $sql)) {
      echo "ERROR";
    } else {
      echo "Inzerát uložen na později.";
    }
  } else {
    $sql = "INSERT INTO saves (item_id, user_id, value) VALUES (" . $_POST["itemId"] . ",'" . $_POST["userId"] . "'," . $_POST["val"] . ")";
    if (!mysqli_query($link, $sql)) {
      echo "ERROR";
    } else {
      echo "Inzerát uložen na později.";
    }
  }
}
mysqli_close($link);
?>