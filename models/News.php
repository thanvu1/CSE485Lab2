<?php
class News {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllNews() {
        $stmt = $this->db->prepare("SELECT * FROM news");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id) {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNews($title, $content, $image, $category_id) {
        $stmt = $this->db->prepare("INSERT INTO news (title, content, image, created_at, category_id) VALUES (?, ?, ?, NOW(), ?)");
        return $stmt->execute([$title, $content, $image, $category_id]);
    }

    public function updateNews($id, $title, $content, $image, $category_id) {
        $stmt = $this->db->prepare("UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $image, $category_id, $id]);
    }

    public function deleteNews($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
