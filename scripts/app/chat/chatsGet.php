<?php
include_once "../../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);
$sql = 'SELECT m.from_id, u.name, u.mail FROM messages m INNER JOIN users u ON m.from_id=u.id 
WHERE m.item_id=' . $_POST["itemId"] . ' AND m.to_id="' . $_POST["sellerId"] . '" GROUP BY m.from_id;';
if ($result = mysqli_query($link, $sql)) {
    $resultArr = [];
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = ["id" => $row[0], "name" => $row[1], "mail" => $row[2]];
    }
    mysqli_free_result($result);
    echo json_encode($resultArr);
}else{
    echo "ERROR";
}
mysqli_close($link);
?>