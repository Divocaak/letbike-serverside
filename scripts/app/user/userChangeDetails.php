<?php
header("Content-Type: text/html; charset=utf-8");

include_once "../../config.php";

$sql = 'UPDATE user SET f_name="' . $_GET["fName"] . '", l_name="' . $_GET["lName"] . '",
    phone=' . $_GET["phone"] . ', address_a="' . $_GET["addA"] . '", address_b="' . $_GET["addB"] . '",
    address_c="' . $_GET["addC"] . '", postal=' . $_GET["postal"] . ' WHERE id=' . $_GET["id"] . ';';

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_query($link, $sql)) {
        echo "Údaje byly změněny.";
    } else {
        echo "Někde se stala chyba, zkuste to prosím později.";
    }
}
mysqli_close($link);
?>