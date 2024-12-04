<?php
session_start();
require 'models/News.php';
require 'controllers/NewsController.php';

// Định tuyến đơn giản
$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, '/admin/news/add') !== false) {
    (new NewsController())->add();
} elseif (strpos($uri, '/admin/news/edit') !== false) {
    $id = explode('/', $uri)[4];
    (new NewsController())->edit($id);
} elseif (strpos($uri, '/admin/news/delete') !== false) {
    $id = explode('/', $uri)[4];
    (new NewsController())->delete($id);
} else {
    (new NewsController())->index();
}
