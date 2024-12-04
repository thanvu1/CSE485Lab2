<?php
require_once 'models/News.php';

class HomeController {
    public function index() {
        $db = new PDO("mysql:host=localhost;dbname=tintuc", "root", "22072004");
        $newsModel = new News($db);
        $news = $newsModel->getAllNews();
        require 'views/home/index.php';
    }
}
?>
