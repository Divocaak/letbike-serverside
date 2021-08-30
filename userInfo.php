<?php
include "config.php";

$return = [];
$sql = 'SELECT * FROM user WHERE id="' . $_GET["id"] . '";';
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $return = ["id" => checkVal($row[0]),
            "username" => checkVal($row[1]),
            "email" => checkVal($row[2]),
            "password" => checkVal($row[3]),
            "score" => checkVal($row[4]),
            "fName" => checkVal($row[5]),
            "lName" => checkVal($row[6]),
            "addressA" => checkVal($row[7]),
            "addressB" => checkVal($row[8]),
            "addressC" => checkVal($row[9]),
            "postal" => checkVal($row[10]),
            "status" => checkVal($row[11]),
            "phone" => checkVal($row[12])];
            echo json_encode($return, JSON_PRETTY_PRINT, JSON_FORCE_OBJECT);
    }
    mysqli_free_result($result);
}
mysqli_close($link);
?>