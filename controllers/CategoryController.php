<?php

require_once(__DIR__ . '/../models/Category.php'); // Nhúng mô hình Category

class CategoryController {
    // Hiển thị tất cả danh mục
    public function index($pdo)
    {
        $categories = Category::getAllCategories($pdo);
        include '../views/categories/index.php';  // Trả về view danh mục
    }

    // Hiển thị form thêm mới danh mục
    public function create()
    {
        include '../views/categories/create.php';  // Trả về form tạo danh mục
    }

    // Lưu danh mục mới
    public function store($pdo)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];

            $category = new Category(null, $name);
            $category->save($pdo);

            header('Location: index.php?controller=category&action=index');
            exit;
        }
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit($pdo, $id)
    {
        $category = Category::getCategoryById($pdo, $id);
        include '../views/categories/edit.php';  // Trả về form chỉnh sửa
    }

    // Cập nhật danh mục
    public function update($pdo, $id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];

            $category = new Category($id, $name);
            $category->update($pdo);

            header('Location: index.php?controller=category&action=index');
            exit;
        }
    }

    // Xóa danh mục
    public function destroy($pdo, $id)
    {
        $category = new Category($id);
        $category->delete($pdo);

        header('Location: index.php?controller=category&action=index');
        exit;
    }
}
