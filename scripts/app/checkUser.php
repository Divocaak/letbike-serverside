<?php
include_once "../config.php";

$_POST = json_decode(file_get_contents("php://input"), true);
$sql = "SELECT status_id, name, mail FROM users WHERE id='" . $_POST["userId"] . "';";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_row($result)) {
            echo $row[0];
        }
    } else {
        $sql = "INSERT INTO users (id, status_id, name, mail) VALUES ('" . $_POST["userId"] . "', 1, '" . $_POST["name"] . "', '" . $_POST["mail"] . "');";
        if (!mysqli_query($link, $sql)) {
            echo "ERROR";
        } else {
            echo 1;
        }
    }
}else{
    echo "ERROR";
}
mysqli_close($link);
?>