<?php
$json = loopAllOptions("general");

echo "<pre>";
echo json_encode($json);
echo "</pre>";

function loopAllOptions($path)
{
    $json = json_decode(file_get_contents("params/" . $path . ".json"), true);
    foreach ($json as &$val) {
        loopOneOption($val);
    }
    return $json;
}

function loopOneOption(&$arr)
{
    if (!isset($arr["isSwitch"]) && is_array($arr["values"])) {
        foreach ($arr["values"] as &$val) {
            loopMoreOption($val);
        }
    }
}

function loopMoreOption(&$arr)
{
    if(isset($arr["file"])){
        $arr["options"] = loopAllOptions($arr["file"]);
    }
}
?>
