<?php
header("Content-Type: text/html; charset=utf-8");

include_once "../../config.php";

$canRegister = false;
$outputMessage = "";
$sql = 'SELECT id FROM user WHERE email=' . $_GET["email"] . ';';
if (!mysqli_query($link, $sql)) {
    $canRegister = true;
}
else{
    $outputMessage = "Zadaný email nebo uživatelské jméno je již zaregistrováno!";
}
$sql = 'INSERT INTO logs (log) VALUES (register: "' . $_GET["username"] . '", "' . $_GET["email"] . '", "' . $passHash . '");'; 
if (mysqli_query($link, $sql)) {
    $logged = true;
}

if($canRegister){
    $passHash = password_hash($_GET["password"], PASSWORD_DEFAULT);
    $sql = 'INSERT INTO user (username, email, password, score, status) VALUES ("' . $_GET["username"] . '", "' . $_GET["email"] . '", "' . $passHash . '", 0, 0);'; 
    if (mysqli_query($link, $sql)) {
        $outputMessage = "Byl jste úspěšně zaregistrován, přihlaste se.";
    } else {
        $outputMessage = "Někde se stala chyba, zkuste to prosím později.";
    }
}
mysqli_close($link);

echo $outputMessage;
?>