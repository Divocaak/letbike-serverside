<?php
include_once "../../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);
$sql = 'SELECT from_id FROM messages WHERE item_id=' . $_POST["itemId"] . ' AND to_id="' . $_POST["sellerId"] . '" GROUP BY from_id;';
if ($result = mysqli_query($link, $sql)) {
    $resultArr = [];
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = $row[0];
    }
    mysqli_free_result($result);
    echo json_encode($resultArr);
}else{
    echo "ERROR";
}
mysqli_close($link);
?>