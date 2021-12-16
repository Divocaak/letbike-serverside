<?php
include_once "../../config.php";
$_POST = json_decode(file_get_contents("php://input"), true);

$resultArr = [];
$sql = 'SELECT value, text, date_added FROM ratings WHERE user_id="' . $_POST["userId"] . '";';
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = [
            "val" => checkVal($row[0]),
            "text" => checkVal($row[1]),
            "date" => checkVal($row[2])
        ];
    }
    mysqli_free_result($result);
}
mysqli_close($link);

echo json_encode($resultArr);
?>