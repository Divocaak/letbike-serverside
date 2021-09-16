<?php
include_once "../config.php";

$resultArr = [];
$sql = 'SELECT * FROM article;';

if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = [
            "id" => $row[0],
            "title" => $row[1],
            "added" => $row[2]
        ];
    }
    mysqli_free_result($result);
}
mysqli_close($link);

echo json_encode($resultArr);
?>