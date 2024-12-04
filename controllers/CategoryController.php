
<?php

require_once(__DIR__ . '/../models/Category.php'); 

class CategoryController {
    private $pdo;

    // Constructor - Kết nối PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // 1. index: Hiển thị danh sách tin tức
    public function index() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM categories");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Ghi log lỗi hoặc hiển thị thông báo
            error_log($e->getMessage());
            return [];
        }
        require_once __DIR__ . '/../views/categories/index.php'; // Gọi giao diện danh sách
    }

    // 2. show: Hiển thị chi tiết một tin tức
    public function show($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    // 3. create: Hiển thị form tạo tin tức mới
    public function create() {
        require_once __DIR__ . '/../views/categories/create.php';; // Gọi giao diện tạo mới
    }

    // 4. store: Lưu tin tức mới vào cơ sở dữ liệu
    public function store($data) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
            $stmt->bindParam(':name', $data['name']);
            $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    // 5. edit: Hiển thị form chỉnh sửa tin tức
    public function edit($id) {
        return $this->show($id); // Sử dụng lại phương thức show để lấy thông tin danh mục
    }

    // 6. update: Cập nhật thông tin tin tức
    public function update($id, $data) {
        try {
            $stmt = $this->pdo->prepare("UPDATE categories SET name = :name WHERE id = :id");
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    // 7. destroy: Xóa một tin tức
    public function destroy($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
    //Lấy ra dữ liệu theo id
    public function find($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}
