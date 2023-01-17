<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class ArticleModel extends Database
{
    public function getArticles()
    {
        return $this->select("SELECT id, name, date_added FROM articles WHERE status_id=1 ORDER BY date_added;");
    }
}