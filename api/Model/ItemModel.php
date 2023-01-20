<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
require_once PROJECT_ROOT_PATH . "/Model/UserModel.php";

class ItemModel extends Database
{
    public function getItems($limit, $id_status, $id_seller = null, $id_buyer = null)
    {
        // TODO params
        $stmt = "SELECT i.id, i.id_seller, i.id_buyer, i.id_status, i.date_added, i.date_sold, i.name, i.description, i.price, i.imgs,
            u.name AS seller_name, u.mail AS seller_mail, b.name AS buyer_name, b.mail AS buyer_mail
            FROM item i LEFT JOIN user b ON i.id_buyer=b.id INNER JOIN user u ON i.id_seller=u.id
            WHERE i.id_status=?" . ($id_seller != null ? " AND i.id_seller=?" : "") . ($id_buyer != null ? " AND i.id_buyer=?" : "") .
            " ORDER BY i.date_added DESC LIMIT ?;";

        $types = "i";
        $params = [$id_status];
        $this->addParamTypePair($params, $types, $id_seller, "s", true);
        $this->addParamTypePair($params, $types, $id_buyer, "s", true);
        $this->addParamTypePair($params, $types, $limit, "i");

        $toRet = [];
        $this->select($stmt, $types, $params, $toRet, function ($arr) {
            $model = new UserModel();
            return [
                "id" => $arr["id"],
                "seller" => $model->returnSerialised($arr["id_seller"], $arr["seller_name"], $arr["seller_mail"]),
                "buyer" => $model->returnSerialised($arr["id_buyer"] ?? null, $arr["buyer_name"] ?? null, $arr["buyer_mail"] ?? null),
                "id_status" => $arr["id_status"],
                "dateAdded" => $arr["date_added"],
                "dateSold" => $arr["date_sold"],
                "name" => $arr["name"],
                "description" => $arr["description"],
                "price" => $arr["price"],
                "imgs" => $arr["imgs"],
            ];
        });

        return $toRet;
    }

    // TODO params
    public function addItem($id_user, $name, $description, $price, $imgs, $params)
    {
        return ($this->insert("INSERT INTO item (id_seller, name, description, price, imgs) VALUES (?, ?, ?, ?, ?);", "sssii", [$id_user, $name, $description, $price, $imgs])) ? ["status" => true] : throw new Error("insert error");
    }

    public function updateStatus($id_item, $id_status, $id_buyer = null)
    {
        $stmt = "UPDATE item SET id_status=?" . (isset($id_buyer) ? ", id_buyer=?" : "") . " WHERE id=?;";

        $types = "i";
        $params = [$id_status];
        $this->addParamTypePair($params, $types, $id_buyer, "s", true);
        $this->addParamTypePair($params, $types, $id_item, "i");

        return $this->update($stmt, $types, $params) ? ["status" => true] : throw new Error("update error");
    }
}
