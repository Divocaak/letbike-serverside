<?php
include "config.php";

$from = $_GET["from"];
$to = $_GET["to"];

$resultArr = [];
$sql = 'SELECT from_id, to_id, message, img FROM message WHERE (item_id=' . $_GET["itemId"] . ') AND (from_id=' . $from . ' OR 
    from_id=' . $to . ') AND (to_id=' . $from . ' OR to_id=' . $to . ') ORDER BY id;';
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = ["from_id" => $row[0], "to_id" => $row[1], "message" => $row[2], "img" => $row[3]];
    }
    mysqli_free_result($result);
}
mysqli_close($link);

echo json_encode($resultArr, JSON_PRETTY_PRINT, JSON_FORCE_OBJECT);
?>