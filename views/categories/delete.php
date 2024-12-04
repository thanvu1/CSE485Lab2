<?php
require_once('../../config/database.php');
require_once('../../controllers/CategoryController.php');

$CategoryController = new CategoryController($pdo);

// Kiểm tra phương thức HTTP POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id > 0) {
        $CategoryController->destroy($id);
        header("Location: index.php"); // Chuyển hướng về trang danh sách
        exit();
    } else {
        die("ID danh mục không hợp lệ!");
    }
} else {
    die("Yêu cầu không hợp lệ!");
}
