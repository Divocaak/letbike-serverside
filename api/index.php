<?php
require __DIR__ . "/inc/bootstrap.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// TODO zeefektivnit if else
if (!isset($uri[4]) || !isset($uri[5])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

if ($uri[4] == 'item') {
    require PROJECT_ROOT_PATH . "/Controller/ItemController.php";
    $objFeedController = new ItemController();
    $objFeedController->{$uri[5]}();
} else if ($uri[4] == "article") {
    require PROJECT_ROOT_PATH . "/Controller/ArticleController.php";
    $objFeedController = new ArticleController();
    $objFeedController->{$uri[5]}();
} else if ($uri[4] == "schema") {
    require PROJECT_ROOT_PATH . "/Controller/SchemaController.php";
    $objFeedController = new SchemaController();
    $objFeedController->{$uri[5]}();
} else if ($uri[4] == "user") {
    require PROJECT_ROOT_PATH . "/Controller/UserController.php";
    $objFeedController = new UserController();
    $objFeedController->{$uri[5]}();
}
