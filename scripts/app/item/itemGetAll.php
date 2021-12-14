<?php
include_once "../../config.php";
$_POST = json_decode(file_get_contents("php://input"), true);

$resultArr = [];
$sql = 'SELECT id, seller_id, name, description, price, score, paid, date_start, date_end, imgs, status, sold_to, param
    FROM item WHERE status=' . $_GET["status"] . ' AND sold_to=' . $_GET["soldTo"] . ' AND seller_id=' . $_GET["id"] . ';';

if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = [
            "id" => resultCheck($row[0]),
            "sellerId" => resultCheck($row[1]),
            "name" => resultCheck($row[2]),
            "description" => resultCheck($row[3]),
            "price" => resultCheck($row[4]),
            "score" => resultCheck($row[5]),
            "paid" => resultCheck($row[6]),
            "dateStart" => resultCheck($row[7]),
            "dateEnd" => resultCheck($row[8]),
            "imgs" => resultCheck($row[9]),
            "status" => resultCheck($row[10]),
            "soldTo" => resultCheck($row[11]),
            "param" => resultCheck($row[12])
        ];
    }
    mysqli_free_result($result);
}

for($i = 0; $i < count($resultArr); $i++) {
    $sql = 'SELECT item, name, value FROM param WHERE item="' . $resultArr[$i]["param"] . '";';
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_row($result)) {
            $resultArr[$i][$row[1]] = $row[2];
        }
        mysqli_free_result($result);
    }
}

$filteredItems = [];
if(count($_GET) > 3){
    $filters = [];
    foreach($_GET as $key => $value){
        if($key != "status" && $key != "soldTo" && $key != "id"){
            $filters[] = [$key, $value];
        } 
    }

    foreach($resultArr as $item){
        $canReturn = false;
        foreach($filters as $filter){
            if(!isset($item[$filter[0]]) || $item[$filter[0]] == $filter[1]){
                $canReturn = true;
            } else if (isset($item[$filter[0]]) || $item[$filter[0]] != $filter[1]){
                $canReturn = false;
            }
        }
        
        if($canReturn){
            $filteredItems[] = $item;
        }
    }
} else {
    $filteredItems = $resultArr;
}

mysqli_close($link);

echo json_encode($filteredItems);

function resultCheck($res){
    return (($res == "") ? "-1" : $res);
}
?>