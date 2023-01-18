<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class ItemModel extends Database
{
    public function getItems($limit, $statusId, $sellerId = null, $soldTo = null)
    {
        // TODO params
        // TODO buyer
        $stmt = "SELECT i.id, i.id_seller, i.id_buyer, i.id_status, i.date_added, i.date_sold, i.name, i.description, i.price i.imgs,
            u.name AS seller_name, u.mail AS seller_mail, b.name AS buyer_name, b.mail AS buyer_name
            FROM item i LEFT JOIN user b ON i.id_buyer=b.id INNER JOIN user u ON i.id_seller=u.id WHERE i.id_status=?" . ($sellerId != null ? " AND i.id_seller=?" : "") . ($soldTo != null ? " AND i.id_buyer=?" : "") . " ORDER BY i.date_added DESC LIMIT ?;";

        $types = "i";
        $params = [$statusId];

        if($sellerId != null){
            $types .= "s";
            $params[] = $sellerId;
        }

        if($soldTo != null){
            $types .= "s";
            $params[] = $soldTo;
        }

        $types .= "i";
        $params[] = $limit;

        /* json["id"],
        Person.fromJson(json["seller"]),
        json["buyer"] != null ? Person.fromJson(json["buyer"]) : null,
        json["name"],
        json["description"],
        json["price"],
        json["dateStart"],
        json["dateEnd"],
        json["imgs"],
        json["status"],
        getParams(json["params"] ?? {})

        Person(json["id"], json["name"], json["mail"]); */

        $returned = $this->select($stmt, $types, $params);
        $toRet = [];

        return $toRet;
    }
}