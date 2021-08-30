<?php
header("Content-Type: text/html; charset=utf-8");

include "config.php";

$sql = 'INSERT INTO rating (user_id, value, text ) VALUES
('. $_GET["userId"] . ', '. $_GET["ratingVal"] . ', "' . $_GET["ratingText"] . '");';

if (mysqli_query($link, $sql)) {
  echo "Ohodnoceno.";
} else {
  echo "Někde se stala chyba, zkuste to prosím později.";
}
mysqli_close($link);
?>