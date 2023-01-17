<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class ItemModel extends Database
{
    public function getItems($limit, $statusId, $sellerId = null, $soldTo = null)
    {
        $stmt = "SELECT i.id, i.seller_id, i.sold_to, i.name, i.description, i.price, i.date_added, i.date_sold, i.imgs, i.status_id, u.name AS sellerName, u.mail AS sellerMail
        FROM items i INNER JOIN users u ON i.seller_id=u.id WHERE i.status_id=?" . ($sellerId != null ? " AND i.seller_id=?" : "") . ($soldTo != null ? " AND i.sold_to=?" : "") . " ORDER BY i.date_added DESC LIMIT ?;";

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

        return $this->select($stmt, $types, $params);
    }
}