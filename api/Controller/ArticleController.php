<?php
class ArticleController extends BaseController
{
    public function list()
    {
        $this->getMethod(function($params){
            $model = new ArticleModel();
            return ["articles" => $model->getArticles()];
        });
    }
}
