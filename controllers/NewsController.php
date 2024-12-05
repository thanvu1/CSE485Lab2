<?php
require_once APP_ROOT.'/services/NewsService.php';
class NewsController {
    public function index() {
        $newsService = new NewsService();
        $news = $newsService->getAllNews();
        include APP_ROOT . '/views/admin/news/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $image = $_FILES['image']['name'];

            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");

            $newsModel = new News();
            $newsModel->addNews($title, $content, $image, $category_id);

            header('Location: /tlunews/admin/news');
            exit();
        }

        // Lấy danh sách danh mục từ model Category
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        // Truyền $categories vào View
        include 'views/admin/news/add.php';
    }


    public function edit($id) {
        $newsModel = new News();
        $news = $newsModel->getById($id); // Lấy tin tức theo ID

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $image = $_FILES['image']['name'];

            if (!empty($image)) {
                move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
            } else {
                $image = $news['image'];
            }

            $newsModel->updateNews($id, $title, $content, $image, $category_id);
            header('Location: /tlunews/admin/news');
            exit();
        }

        // Lấy danh sách danh mục từ model Category
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        // Truyền $news và $categories vào View
        include 'views/admin/news/edit.php';
    }


    public function delete($id) {
        $newsModel = new News();
        $newsModel->deleteNews($id);
        header('Location: /tlunews/admin/news');
        exit();
    }
}
