<?php
include "config.php";

$resultArr = [];
$sql = 'SELECT value, text FROM rating WHERE user_id=' . $_GET["userId"] . ';';

if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = [
            "ratingVal" => checkVal($row[0]),
            "ratingText" => checkVal($row[1])
        ];
    }
    mysqli_free_result($result);
}
mysqli_close($link);

echo json_encode($resultArr);
?>