<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database
{
    public function check($userId, $name, $mail)
    {
        $returnVal = $this->select("SELECT id_status FROM user WHERE id=?;", "s", [$userId]);
        if ($returnVal != null) {
            return $returnVal[0];
        } else {
            return $this->insert("INSERT INTO user (id, name, mail) VALUES (?, ?, ?);", "sss", [$userId, $name, $mail]) ? ["status_id" => 1] : ["error" => "insert returned false"];
        }
    }
}