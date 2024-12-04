<?php

class Category {
    private $id;
    private $name;

    // Constructor
    public function __construct($id = null, $name = null) {
        $this->id = $id;
        $this->name = $name;
    }

    // Getter and Setter methods
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Phương thức để lấy tất cả danh mục
    public static function getAllCategories($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Phương thức để thêm danh mục mới vào cơ sở dữ liệu
    public function save($pdo) {
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->bindParam(':name', $this->name);
        $stmt->execute();
    }

    // Phương thức để cập nhật danh mục theo ID
    public function update($pdo) {
        $stmt = $pdo->prepare("UPDATE categories SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    // Phương thức để xóa danh mục theo ID
    public function delete($pdo) {
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }
}
