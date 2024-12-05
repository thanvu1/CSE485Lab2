<?php
require_once('./config/config.php');
require_once APP_ROOT . '/controllers/NewsController.php';

$newsController = new NewsController();
$newsController->index();



