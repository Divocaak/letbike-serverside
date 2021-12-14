<?php
include_once "../config.php";

$resultArr = [];
$sql = 'SELECT id, name, date_added FROM articles WHERE status_id=1;';
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = [
            "id" => $row[0],
            "name" => $row[1],
            "dateAdded" => $row[2]
        ];
    }
    mysqli_free_result($result);
}
mysqli_close($link);

echo json_encode($resultArr);
?>