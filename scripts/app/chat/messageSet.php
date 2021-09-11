<?php
include_once "../../config.php";

$sql = 'INSERT INTO message (item_id, from_id, to_id, message, img) VALUES
    (' . $_GET["itemId"] . ', ' . $_GET["from"] . ', ' . $_GET["to"] . ', "' . $_GET["message"] . '", ' . $_GET["img"] . ');';
if (mysqli_query($link, $sql)) {
    echo "sent";
} else {
    echo "err";
}
mysqli_close($link);
?>