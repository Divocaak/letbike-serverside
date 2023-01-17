<?php
class SchemaController extends BaseController
{
    public function schema()
    {
        $e = "";
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "GET") {
            try {
                $responseData = json_encode($this->loopAllOptions("general"));
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

    private function loopAllOptions($path)
    {
        $json = json_decode(file_get_contents(PROJECT_ROOT_PATH . "/params/" . $path . ".json"), true);
        foreach ($json as &$val) {
            $this->loopOneOption($val);
        }
        return $json;
    }

    private function loopOneOption(&$arr)
    {
        if (!isset($arr["isSwitch"]) && is_array($arr["values"])) {
            foreach ($arr["values"] as &$val) {
                $this->loopMoreOption($val);
            }
        }
    }

    private function loopMoreOption(&$arr)
    {
        if (isset($arr["file"])) {
            $arr["options"] = $this->loopAllOptions($arr["file"]);
        }
    }
}
