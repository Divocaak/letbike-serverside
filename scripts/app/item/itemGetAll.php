<?php
include_once "../../config.php";
$_POST = json_decode(file_get_contents("php://input"), true);

/* $_POST["status"] = 1;
$_POST["params"]["usedSwitch"] = "true"; */

$items = [];
$sql = "SELECT i.id, i.seller_id, i.sold_to, i.name, i.description, i.price, i.date_added, i.date_sold, i.imgs, i.status_id, u.name, u.mail 
    FROM " . ($_POST["saverId"] != null ? "saves s INNER JOIN items i ON s.item_id=i.id " : "items i ") . "INNER JOIN users u ON i.seller_id=u.id 
    WHERE " . ($_POST["saverId"] != null ? "s.value=1 AND s.user_id='" . $_POST["saverId"] . "' AND " : "") . "i.status_id=" . $_POST["status"] .
    ($_POST["sellerId"] != null ? (" AND i.seller_id='" . $_POST["sellerId"] . "'") : "") .
    ($_POST["soldTo"] != null ? (" AND i.sold_to='" . $_POST["soldTo"] . "'") : "") . " ORDER BY i.date_added DESC;";
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

    for ($i = 0; $i < count($items); $i++) {
        $sql = 'SELECT name, value FROM params WHERE item_id=' . $items[$i]["id"] . ';';
        if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_row($result)) {
                $items[$i]["params"][] = [
                    "key" => $row[0],
                    "value" => $row[1]
                ];
            }
            mysqli_free_result($result);
        }
    }

    if ($_POST["params"] != null) {
        $filtered = [];
        for ($i = 0; $i < count($items); $i++) {
            $canReturn = false;
            foreach ($_POST["params"] as $key => $value) {
                $canReturn = checksWithParams($items[$i]["params"][$key], $value);
            }

            if ($canReturn) {
                $filtered[] = $items[$i];
            }
        }
    }
    mysqli_close($link);
}
echo json_encode($_POST["params"] != null ? $filtered : $items);

function checksWithParams($itemParam, $value)
{
    if (!isset($itemParam) || $itemParam == $value) {
        return true;
    } else if (isset($itemParam) || $itemParam != $value) {
        return false;
    }
}
?>