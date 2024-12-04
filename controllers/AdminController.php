<?php
require_once 'models/User.php';

class AdminController {
    // Hàm đăng nhập
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
            $userModel = new User($db);

            // Lấy thông tin người dùng
            $user = $userModel->getUserByUsername($_POST['username']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                // Nếu xác thực thành công, lưu thông tin vào session
                session_start();
                $_SESSION['admin'] = $user;
                header('Location: index.php?controller=admin&action=dashboard');
                exit;
            } else {
                // Lỗi đăng nhập
                $error = "Invalid username or password!";
            }
        }
        // Tải giao diện đăng nhập
        require 'views/admin/login.php';
    }

    // Hàm hiển thị dashboard
    public function dashboard() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
            exit;
        }

        // Hiển thị giao diện dashboard
        echo "Welcome to the admin dashboard!";
    }

    // Hàm đăng xuất
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=admin&action=login');
    }
}
?>
