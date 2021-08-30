<?php
include "config.php";

$resultArr = [];
$sql = 'SELECT u.username, u.email, u.id FROM user u JOIN message m
    ON u.id = m.from_id WHERE m.item_id=' . $_GET["itemId"] . ' GROUP BY u.username;';
if ($result = mysqli_query($link, $sql)) {
    if(mysqli_num_rows($result) == 0){
        $resultArr[] = ["email" => "Pocet chatu", "username" => "0"];
    }
    else{
        while ($row = mysqli_fetch_row($result)) {
            $resultArr[] = ["email" => $row[0], "username" => $row[1], "id" => $row[2]];
        }
    }
    mysqli_free_result($result);
}
mysqli_close($link);

echo json_encode($resultArr, JSON_PRETTY_PRINT, JSON_FORCE_OBJECT);
?>