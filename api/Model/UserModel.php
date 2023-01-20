<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database
{
    public static function returnSerialised($id, $name, $mail)
    {
        return (isset($id) && isset($name) && isset($mail)) ?
        [
            "id" => $id,
            "name" => $name,
            "mail" => $mail
        ] : null;
    }

    public function check($userId, $name, $mail)
    {
        $returnVal = $this->select("SELECT id_status FROM user WHERE id=?;", "s", [$userId]);
        if ($returnVal != null) {
            return $returnVal[0];
        } else {
            return $this->insert("INSERT INTO user (id, name, mail) VALUES (?, ?, ?);", "sss", [$userId, $name, $mail]) ? ["id_status" => 1] : throw new Error("insert error");
        }
    }
}
