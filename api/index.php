<?php
require __DIR__ . "/inc/bootstrap.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if (!isset($uri[4]) || !isset($uri[5])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$objFeedController = null;
switch($uri[4]){
    case "item":{
        require PROJECT_ROOT_PATH . "/Controller/ItemController.php";
        $objFeedController = new ItemController();
        break;
    }
    case "article":{
        require PROJECT_ROOT_PATH . "/Controller/ArticleController.php";
        $objFeedController = new ArticleController();
        break;
    }
    case "schema":{
        require PROJECT_ROOT_PATH . "/Controller/SchemaController.php";
        $objFeedController = new SchemaController();
        break;
    }   
    case "user":{
        require PROJECT_ROOT_PATH . "/Controller/UserController.php";
        $objFeedController = new UserController();
        break;
    }
}

if(!isset($objFeedController)){
    header("HTTP/1.1 404 Not Found");
    exit(); 
}

$objFeedController->{$uri[5]}();