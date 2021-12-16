<?php
header("Content-Type: text/html; charset=utf-8");

$_POST = json_decode(file_get_contents("php://input"), true);
include_once "../../config.php";

$sql = 'UPDATE items SET status_id=' . $_POST["newStatus"] . ($_POST["soldTo"] != null ? (', sold_to=' . $_POST["soldTo"]) : "") . ' WHERE id=' . $_POST["itemId"] . ';';
if ($result = mysqli_query($link, $sql)) {
    if (!mysqli_query($link, $sql)) {
        echo "ERROR";
    }
}
mysqli_close($link);
?>