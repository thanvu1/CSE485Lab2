<?php
require_once 'models/News.php';

class HomeController {
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
            $userModel = new User($db);
            $user = $userModel->getUserByUsername($_POST['username']);
    
            // Kiểm tra tài khoản và mật khẩu
            if ($user && password_verify($_POST['password'], $user['password']) && $user['role'] == 0) {
                session_start();
                $_SESSION['guest'] = $user; 
                header('Location: index.php?controller=home&action=index'); // Điều hướng tới danh sách tin tức
                exit;
            } else {
                $error = "Không Có Tài Khoản Hoặc Mật Khẩu Khả Dụng!";
            }
        }
        require 'views/home/login.php'; 
    }
    
    public function index() {
        $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
        $newsModel = new News($db);
        $news = $newsModel->getAllNews(); // Lấy danh sách tất cả tin tức từ CSDL
        require 'views/home/index.php'; // Hiển thị giao diện danh sách tin tức
    }
    

    // public function search() {
    //     $db = new PDO("mysql:host=localhost;dbname=tintuc", "root", "");
    //     $newsModel = new News($db);
    //     $query = $_GET['query'];
    //     $news = $newsModel->searchNews($query);
    //     require 'views/home/index.php';
    // }

    public function detail() {
        $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
        $newsModel = new News($db);
        $id = $_GET['id'] ?? 0;
        $news = $newsModel->getNewsById($id); // Lấy chi tiết tin tức từ CSDL
        require 'views/home/detail.php'; // Hiển thị giao diện chi tiết tin tức
    }
    

    public function register() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
            $userModel = new User($db);
    
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
    
            if ($password !== $confirmPassword) {
                $error = "Passwords do not match!";
            } else {
                $success = $userModel->createUser($username, $password, 0); // role = 0: user
                if ($success) {
                    header('Location: index.php?controller=home&action=login');
                    exit;
                } else {
                    $error = "Error creating account!";
                }
            }
        }
        require 'views/home/register.php';
    }
    public function changePassword() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=home&action=login');
            exit;
        }
    
        $error = '';
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
            $userModel = new User($db);
    
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];
    
            $admin = $_SESSION['admin'];
            $user = $userModel->getUserByUsername($admin['username']);
    
            if ($user && password_verify($currentPassword, $user['password'])) {
                if ($newPassword === $confirmPassword) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $stmt = $db->prepare("UPDATE users SET password = ? WHERE username = ?");
                    $stmt->execute([$hashedPassword, $admin['username']]);
                    $message = "Mật Khẩu Đã Được Đổi Thành Công!";
                } else {
                    $error = "Mật Khẩu Mới Không Khớp!";
                }
            } else {
                $error = "Mật Khẩu Cũ Không Đúng!";
            }
        }
        require 'views/home/change_password.php';
    }
    
    public function forgotPassword() {
        $message = '';
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
            $userModel = new User($db);
    
            $username = $_POST['username'];
            $newPassword = $_POST['new_password'];
    
            // Kiểm tra xem người dùng có tồn tại không
            $user = $userModel->getUserByUsername($username);
            if ($user) {
                // Mã hóa mật khẩu mới
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                // Cập nhật mật khẩu mới cho người dùng
                $stmt = $db->prepare("UPDATE users SET password = ? WHERE username = ?");
                $stmt->execute([$hashedPassword, $username]);
                $message = "Password reset successfully!";
            } else {
                $error = "User not found!";
            }
        }
        require 'views/home/forgot_password.php';
    }
    
}
?>
