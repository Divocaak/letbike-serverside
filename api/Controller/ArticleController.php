<?php
class ArticleController extends BaseController
{
    public function list()
    {
        $e = "";
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "GET") {
            try {
                $model = new ArticleModel();
                $responseData = json_encode($model->getArticles());
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

    // NOTE with GET params
    /* public function list()
    {
        $e = "";
        $arrQueryStringParams = $this->getQueryStringParams();
        // TODO is post actually
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "GET") {
            try {
                $userModel = new ItemModel();
                // TODO rest of params
                $limit = $statusId = $soldTo = $sellerId = null;
                if (isset($arrQueryStringParams['limit']))
                    $limit = $arrQueryStringParams['limit'];

                if (isset($arrQueryStringParams['statusId']))
                    $statusId = $arrQueryStringParams['statusId'];

                if (isset($arrQueryStringParams['soldTo']))
                    $soldTo = $arrQueryStringParams['soldTo'];

                if (isset($arrQueryStringParams['sellerId']))
                    $sellerId = $arrQueryStringParams['sellerId'];

                $responseData = json_encode($userModel->getUsers($limit, $statusId, $sellerId, $soldTo));
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
    } */
}
