<?php

class ItemController extends BaseController
{
    public function list()
    {
        // TODO DRY, something like postRequestBody
        $e = "";
        $_POST = json_decode(file_get_contents("php://input"), true);
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
            try {
                $model = new ItemModel();
                $limit = $statusId = $soldTo = $sellerId = null;

                // TODO DRY, data validator
                if (isset($_POST['limit']))
                    $limit = $_POST['limit'];
                else
                    throw new Error("mandatory variable not found (limit)");

                if (isset($_POST['statusId']))
                    $statusId = $_POST['statusId'];
                else
                    throw new Error("mandatory variable not found (statusId)");

                if (isset($_POST['soldTo']))
                    $soldTo = $_POST['soldTo'];

                if (isset($_POST['sellerId']))
                    $sellerId = $_POST['sellerId'];

                $responseData = json_encode($model->getItems($limit, $statusId, $sellerId, $soldTo));
            } catch (Error $err) {
                $e = $err->getMessage();
                $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $e = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }

        if (!$e) {
            $this->sendOutput(
                $responseData,
                ["Content-Type: application/json", "HTTP/1.1 200 OK"]
            );
        } else {
            $this->sendOutput(
                json_encode(["error" => $e]),
                ["Content-Type: application/json", $strErrorHeader]
            );
        }
    }

    public function add(){
        $e = "";
        $_POST = json_decode(file_get_contents("php://input"), true);
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
            try {
                $model = new ItemModel();

                $id_user = $name = $description = $price = $imgs = $params = null;
                if (isset($_POST['id_user']))
                    $id_user = $_POST['id_user'];
                else
                    throw new Error("mandatory variable not found (id_user)");

                if (isset($_POST['name']))
                    $name = $_POST['name'];
                else
                    throw new Error("mandatory variable not found (name)");

                if (isset($_POST['description']))
                    $description = $_POST['description'];
                else
                    throw new Error("mandatory variable not found (description)");

                if (isset($_POST['price']))
                    $price = $_POST['price'];
                else
                    throw new Error("mandatory variable not found (price)");

                if (isset($_POST['imgs']))
                    $imgs = $_POST['imgs'];
                else
                    throw new Error("mandatory variable not found (imgs)");

                if (isset($_POST['params']))
                    $params = $_POST['params'];
                else
                    throw new Error("mandatory variable not found (params)");

                $responseData = json_encode($model->addItem($id_user, $name, $description, $price, $imgs, $params));
            } catch (Error $err) {
                $e = $err->getMessage();
                $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $e = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }

        if (!$e) {
            $this->sendOutput(
                $responseData,
                ["Content-Type: application/json", "HTTP/1.1 200 OK"]
            );
        } else {
            $this->sendOutput(
                json_encode(["error" => $e]),
                ["Content-Type: application/json", $strErrorHeader]
            );
        }
    }
}
