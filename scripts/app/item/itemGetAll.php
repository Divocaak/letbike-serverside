<?php
include_once "../../config.php";
$_POST = json_decode(file_get_contents("php://input"), true);

$items = [];
$sql = "SELECT i.id, i.seller_id, i.sold_to, i.name, i.description, i.price, i.date_added, i.date_sold, i.imgs, i.status_id, u.name, u.mail 
    FROM items i INNER JOIN users u ON i.seller_id=u.id WHERE i.status_id=" . $_POST["status"] .
    ($_POST["sellerId"] != null ? (" AND i.seller_id='" . $_POST["sellerId"] . "'") : "") .
    ($_POST["soldTo"] != null ? (" AND i.sold_to='" . $_POST["soldTo"] . "'") : "") . " ORDER BY i.date_added;";
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $items[] = [
            "id" => $row[0],
            "sellerId" => $row[1],
            "soldTo" => $row[2],
            "name" => $row[3],
            "description" => $row[4],
            "price" => $row[5],
            "dateStart" => $row[6],
            "dateEnd" => $row[7],
            "imgs" => $row[8],
            "status" => $row[9],
            "sellerName" => $row[10],
            "sellerMail" => $row[11]
        ];
    }
    mysqli_free_result($result);

    for($i = 0; $i < count($items); $i++){
        $sql = 'SELECT name, value FROM params WHERE item_id=' . $items[$i]["id"] . ';';
        if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_row($result)) {
                $items[$i]["params"][$row[0]] = $row[1];
            }
            mysqli_free_result($result);
        }
    }
    
    if ($_POST["params"] != null) {
        for($i = 0; $i < count($items); $i++){
            $canReturn = false;
            foreach($_POST["params"] as $key => $value){
                $canReturn = checksWithParams($items[$i]["params"][$key], $value);
            }
            
            if(!$canReturn){
                unset($items[$i]);
            }
        }
    }
    mysqli_close($link);
}
echo json_encode($items);

function checksWithParams($itemParam, $value){
    if(!isset($itemParam) || $itemParam == $value){
        return true;
    } else if (isset($itemParam) || $itemParam != $value){
        return false;
    }
}
?>