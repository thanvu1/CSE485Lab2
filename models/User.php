<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Lấy thông tin người dùng bằng username
    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo người dùng mới
    public function createUser($username, $password, $role = 0) {
        $hashedPassword = password_hash($password, algo: PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $role]);
    }
}
?>
