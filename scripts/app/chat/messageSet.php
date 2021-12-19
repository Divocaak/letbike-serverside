<?php
include_once "../../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);
$sql = 'INSERT INTO messages (item_id, from_id, to_id, message, img) VALUES
    (' . $_POST["itemId"] . ', "' . $_POST["from"] . '", "' . $_POST["to"] . '", "' . $_POST["message"] . '", ' . $_POST["img"] . ');';
if (!mysqli_query($link, $sql)) {
    echo "ERROR";
}
mysqli_close($link);
?>