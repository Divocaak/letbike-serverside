<?php
include_once "../../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);
$sql = "INSERT INTO items (seller_id, name, description, price, imgs, status_id)
VALUES ('" . $_POST["userId"] . "', '" . $_POST["name"] . "', '" . $_POST["desc"] . "', " . $_POST["price"] . ", '" . $_POST["imgs"] . "', 1);";
if (!mysqli_query($link, $sql)) {
  echo "ERROR";
} else {
  $sql = "";
  foreach ($_POST["params"] as $key => $value) {
    $sql .= '(' . mysqli_insert_id($link) . ', "' . $key . '", "' . $value . '")' . ($key === array_key_last($_POST["params"]) ? ";" : ", ");
  };

  if ($sql == "") {
    echo "ERROR";
  } else {
    $sql = "INSERT INTO params (item_id, name, value) VALUES " . $sql;
    if (!mysqli_query($link, $sql)) {
      echo "ERROR";
    }
  }
}
mysqli_close($link);
