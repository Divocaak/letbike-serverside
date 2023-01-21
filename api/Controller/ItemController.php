<?php

class ItemController extends BaseController
{
    public function list()
    {
        $this->postMethod(function ($postData) {
            $model = new ItemModel();

            $limit = $id_status = $id_buyer = $id_seller = null;
            $this->dataValidator($limit, $postData["limit"]);
            $this->dataValidator($id_status, $postData["id_status"]);
            $this->dataValidator($id_buyer, $postData["id_buyer"] ?? null, false);
            $this->dataValidator($id_seller, $postData["id_seller"] ?? null, false);

            return ["items" => $model->getItems($limit, $id_status, $id_seller, $id_buyer)];
        });
    }

    public function add()
    {
        $this->postMethod(function ($postData) {
            $model = new ItemModel();

            $id_user = $name = $description = $price = $imgs = $params = null;
            $this->dataValidator($id_user, $postData["id_user"]);
            $this->dataValidator($name, $postData["name"]);
            $this->dataValidator($description, $postData["description"]);
            $this->dataValidator($price, $postData["price"]);
            $this->dataValidator($imgs, $postData["imgs"]);
            $this->dataValidator($params, $postData["params"]);

            return ["status" => $model->addItem($id_user, $name, $description, $price, $imgs, $params)];
        });
    }

    public function updateStatus()
    {
        $this->postMethod(function ($postData) {
            $model = new ItemModel();

            $id_item = $id_status = $id_buyer = null;
            $this->dataValidator($id_item, $postData["id_item"]);
            $this->dataValidator($id_status, $postData["id_status"]);
            $this->dataValidator($id_buyer, $postData["id_buyer"] ?? null, false);

            return ["status" => $model->updateStatus($id_item, $id_status, $id_buyer)];
        });
    }
}
