<?php

class UserController extends BaseController
{
    public function check()
    {
        $e = "";
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
            try {
                $model = new UserModel();
                $userId = $name = $mail = null;
                if (isset($_POST['userId']))
                    $userId = $_POST['userId'];
                else
                    throw new Error("mandatory variable not found (userId)");

                if (isset($_POST['name']))
                    $name = $_POST['name'];
                else
                    throw new Error("mandatory variable not found (name)");

                if (isset($_POST['mail']))
                    $mail = $_POST['mail'];
                else
                    throw new Error("mandatory variable not found (mail)");

                $responseData = json_encode($model->check($userId, $name, $mail));
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
