<?php
$json = prepareGeneral("general");

function prepareGeneral($path, $pathPrefix = null)
{
    $file = "params/" . ($pathPrefix != null ? $pathPrefix . "/" : "") . $path . ".json";
    echo $file;
    echo "<br>";
    $json = json_decode(file_get_contents($file), true);
    foreach ($json as $key => &$val) {
        if (!str_contains($key, "_switch")) {
            loopOptions($val, $path == "general");
        }
    }
    return $json;
}

function loopOptions(&$arr, $isGeneral)
{
    foreach ($arr as $key => &$val) {
        if ($key == "values") {
            loopValues($val, $isGeneral);
        }
    }
}

function loopValues(&$arr, $boolIsGeneral)
{
    foreach ($arr as $key => &$val) {
        if (isset($val["key"])) {
            $val["options"] = prepareGeneral($val["key"], isset($isGeneral) ? $val["key"] : null);
        }
    }
}

echo "<pre>";
echo json_encode($json);
echo "</pre>";
