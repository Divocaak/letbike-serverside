<?php
include_once "../config.php";

echo"post id: " . $_POST["pls"] . "<br>";
$sql = "SELECT status_id FROM users WHERE id='" . $_POST["id"] . "';";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_row($result)) {
            echo $row[0];
        }
    } else {
        $sql = "INSERT INTO users (id, status_id) VALUES ('" . $_POST["id"] . "', 1);";
        if (!mysqli_query($link, $sql)) {
            echo "ins";
        } else {
            echo 1;
        }
    }
}else{
    echo "ERROR";
}
mysqli_close($link);
