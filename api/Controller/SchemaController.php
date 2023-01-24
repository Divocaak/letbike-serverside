<?php
class SchemaController extends BaseController
{
    public function schema()
    {
        $this->getMethod(function ($params) {
            return ["schema" => $this->loopAllOptions("general")];
        });
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
