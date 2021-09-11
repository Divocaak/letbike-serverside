<?php
header("Content-Type: text/html; charset=utf-8");

include_once "../../config.php";

$id = $_GET["id"];
$passCurr = $_GET["currPass"];
$passNew = $_GET["newPass"];
$passSaved = "";
$sql = 'SELECT password FROM user WHERE id=' . $id . ';';
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $passSaved = $row[0];
    }
    mysqli_free_result($result);
}

if(password_verify($passCurr, $passSaved)){

    $sql = 'UPDATE user SET password="' . password_hash($passNew, PASSWORD_DEFAULT) . '" WHERE id=' . $id . ';';
    if ($result = mysqli_query($link, $sql)) {
        if (mysqli_query($link, $sql)) {
            echo "Údaje byly změněny.";
        } else {
            echo "Někde se stala chyba, zkuste to prosím později.";
        }
    }
}
else{
    echo "Zadané heslo se neshoduje s heslem v databázi";
}
mysqli_close($link);
?>