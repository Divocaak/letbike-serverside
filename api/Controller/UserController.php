<?php

class UserController extends BaseController
{
    public function check()
    {
        $this->postMethod(function ($postData) {
            $model = new UserModel();
            
            $id_user = $name = $mail = null;
            $this->dataValidator($id_user, $postData["id_user"]);
            $this->dataValidator($name, $postData["name"]);
            $this->dataValidator($mail, $postData["mail"]);

            return ["id_status" => $model->check($id_user, $name, $mail)];
        });
    }
}
