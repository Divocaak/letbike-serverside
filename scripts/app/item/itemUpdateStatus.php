<?php
header("Content-Type: text/html; charset=utf-8");

include_once "../../config.php";

$sql = 'UPDATE item SET status=' . $_GET["status"] . ', sold_to=' . $_GET["soldTo"] . ' WHERE id=' . $_GET["id"] . ';';

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_query($link, $sql)) {
        echo "Stav předmětu byl změněn.";
    } else {
        echo "Někde se stala chyba, zkuste to prosím později.";
    }
}
mysqli_close($link);
?>