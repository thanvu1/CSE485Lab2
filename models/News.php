<?php

class News {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tintuc', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT news.*, categories.name AS category_name 
            FROM news 
            LEFT JOIN categories ON news.category_id = categories.id
            ORDER BY news.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addNews($title, $content, $image, $category_id) {
        $stmt = $this->db->prepare("
            INSERT INTO news (title, content, image, created_at, category_id) 
            VALUES (?, ?, ?, NOW(), ?)
        ");
        $stmt->execute([$title, $content, $image, $category_id]);
    }

    public function updateNews($id, $title, $content, $image, $category_id) {
        $stmt = $this->db->prepare("
            UPDATE news 
            SET title = ?, content = ?, image = ?, category_id = ? 
            WHERE id = ?
        ");
        $stmt->execute([$title, $content, $image, $category_id, $id]);
    }

    public function deleteNews($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = ?");
        $stmt->execute([$id]);
    }
}
