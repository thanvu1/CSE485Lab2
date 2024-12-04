<?php

class Category {
    private $id;
    private $name;
    private $pdo; // Kết nối PDO

    // Constructor
    public function __construct($pdo, $id = null, $name = null) {
        $this->pdo = $pdo;
        $this->id = $id;
        $this->name = $name;
    }

    // Getter và Setter cho ID
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter và Setter cho Name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // 1. index: Hiển thị danh sách tin tức
    public function index() {
        $stmt = $this->pdo->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. show: Hiển thị chi tiết một tin tức
    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Gán dữ liệu vào đối tượng hiện tại
        if ($data) {
            $this->setId($data['id']);
            $this->setName($data['name']);
        }

        return $data;
    }

    // 3. store: Lưu tin tức mới vào cơ sở dữ liệu
    public function store() {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        $stmt->execute();
        $this->id = $this->pdo->lastInsertId(); // Lưu ID mới tạo vào thuộc tính
        return $this->id;
    }

    // 4. update: Cập nhật thông tin tin tức
    public function update() {
        $stmt = $this->pdo->prepare("UPDATE categories SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    // 5. destroy: Xóa một tin tức
    public function destroy() {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
