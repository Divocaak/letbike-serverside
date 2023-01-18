<?php

class ItemController extends BaseController
{
    public function list()
    {
        $e = "";
        $_POST = json_decode(file_get_contents("php://input"), true);
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
            try {
                $model = new ItemModel();
                $limit = $statusId = $soldTo = $sellerId = null;
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
}
