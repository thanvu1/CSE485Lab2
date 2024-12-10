<?php
require_once('./config/config.php');


//$newsController = new NewsController();
//$newsController->index();
$controller = $_GET['controller'] ?? 'news';
$action = $_GET['action'] ?? 'index';

if ($controller == 'news') {
    require_once APP_ROOT . '/controllers/NewsController.php';
    $newsController = new NewsController();
    $newsController->index();
}


