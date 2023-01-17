<?php
include_once "../../config.php";
$_POST = json_decode(file_get_contents("php://input"), true);

$resultArr = [];
$sql = 'SELECT message, img, from_id, to_id FROM messages WHERE (item_id=' . $_POST["itemId"] . ') AND (from_id="' . $_POST["meId"] . '" OR 
    from_id="' . $_POST["secondUserId"] . '") AND (to_id="' . $_POST["meId"] . '" OR to_id="' . $_POST["secondUserId"] . '") ORDER BY sent;';
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = ["message" => $row[0], "img" => $row[1], "isMyMessage" => ($_POST["meId"] == $row[2]), "imgPath" => ($row[2] . $row[3])];
    }
    mysqli_free_result($result);
    echo json_encode($resultArr);
}else{
    echo "ERROR";
}
mysqli_close($link);
?>