<?php
include_once "../../config.php";
$_POST = json_decode(file_get_contents("php://input"), true);

/* $_POST["status"] = 1;
$_POST["params"]["usedSwitch"] = "true"; */

$_POST["status"] = 1;
$items = [];
$stmt = $link->prepare("SELECT i.id, i.seller_id, i.sold_to, i.name, i.description, i.price, i.date_added, i.date_sold, i.imgs, i.status_id, u.name AS sellerName, u.mail AS sellerMail
    FROM items i INNER JOIN users u ON i.seller_id=u.id WHERE i.status_id=? ORDER BY i.date_added DESC;");
$stmt->bind_param("i", $_POST["status"]);
$stmt->execute();
if ($result = $stmt->get_result()) {
    while ($row = $result->fetch_assoc()) {
        $item = [
            "id" => $row["id"],
            "seller" => [
                "id" => $row["seller_id"],
                "name" => $row["sellerName"],
                "mail" => $row["sellerMail"]
            ],
            "soldTo" => $row["sold_to"],
            "name" => $row["name"],
            "description" => $row["description"],
            "price" => $row["price"],
            "dateStart" => $row["date_added"],
            "dateEnd" => $row["date_sold"],
            "imgs" => $row["imgs"],
            "status" => $row["status_id"],
        ];

        // TODO filtrování
        $stmt = $link->prepare("SELECT key_name, value FROM params WHERE item_id=?;");
        $stmt->bind_param("i", $row["id"]);
        $stmt->execute();
        if ($resultParams = $stmt->get_result()) {
            while ($rowParam = $resultParams->fetch_assoc()) {
                $file = "";
                $label = $value = "";
                $keySplit = explode("-", $rowParam["key_name"]);
                $file = (count($keySplit) == 2) ? $keySplit[0] : $keySplit[0] . "/" . $keySplit[1];
                $params = json_decode(file_get_contents("../params/" . $file . ".json"), true);
                foreach ($params as $param) {
                    if ($param["key"] == $rowParam["key_name"]) {
                        $label = $param["label"];
                        $value = (isset($param["isSwitch"]) && $param["isSwitch"])
                            ? $param["values"][$rowParam["value"]]
                            : (isset($param["values"][$rowParam["value"]]["label"])
                                ? $param["values"][$rowParam["value"]]["label"]
                                : $param["values"][$rowParam["value"]]);
                        break;
                    }
                }
                $item["params"][$label] = $value;
            }
        }
    }

    $items[] = $item;
}

echo json_encode($items);
