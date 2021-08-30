<?php
header("Content-Type: text/html; charset=utf-8");

include "config.php";

$sql = 'UPDATE item SET status=' . $_GET["status"] . ', sold_to=' . $_GET["soldTo"] . ' WHERE id=' . $_GET["id"] . ';';

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_query($link, $sql)) {
        echo "Status předmětu byl změněn.";
    } else {
        echo "Někde se stala chyba, zkuste to prosím později.";
    }
}
mysqli_close($link);
?>