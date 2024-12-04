<?php
require_once 'models/User.php';
require_once 'models/Category.php';
require_once 'models/News.php';


class AdminController {
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
            $userModel = new User($db);

            $user = $userModel->getUserByUsername($_POST['username']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                session_start();
                $_SESSION['admin'] = $user;
                header('Location: index.php?controller=admin&action=dashboard');
                exit;
            } else {
                $error = "Không có tài khoản hoặc mật khẩu khả dụng!";
            }
        }
        require 'views/admin/login.php';
    }
    public function manageNews() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
            exit;
        }
    
        $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
        $newsModel = new News($db);
        $news = $newsModel->getAllNews();
        require 'views/admin/news/index.php';
    }
    
    public function addNews() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
            exit;
        }
    
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
            $newsModel = new News($db);
    
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
    
            if ($newsModel->addNews($title, $content, $category_id)) {
                header('Location: index.php?controller=admin&action=manageNews');
            } else {
                $error = "Failed to add news!";
            }
        }
    
        require 'views/admin/news/add.php';
    }
    
    public function editNews() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
            exit;
        }
    
        $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
        $newsModel = new News($db);
    
        $id = $_GET['id'] ?? 0;
        $news = $newsModel->getNewsById($id);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
    
            if ($newsModel->updateNews($id, $title, $content, $category_id)) {
                header('Location: index.php?controller=admin&action=manageNews');
            } else {
                $error = "Failed to update news!";
            }
        }
    
        require 'views/admin/news/edit.php';
    }
    
    public function deleteNews() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
            exit;
        }
    
        $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
        $newsModel = new News($db);
    
        $id = $_GET['id'] ?? 0;
        if ($newsModel->deleteNews($id)) {
            header('Location: index.php?controller=admin&action=manageNews');
        } else {
            echo "Failed to delete news!";
        }
    }
    

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
            exit;
        }
    
        $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
        $newsModel = new News($db);
        $totalNews = count($newsModel->getAllNews());
    
        $categoryModel = new Category($db);
        $totalCategories = count($categoryModel->getAllCategories());
    
        require 'views/admin/dashboard.php';
    }
    

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=admin&action=login');
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
                $error = "Mật Khẩu Không Đúng!";
            } else {
                $success = $userModel->createUser($username, $password, 0); // role = 0: user
                if ($success) {
                    header('Location: index.php?controller=admin&action=login');
                    exit;
                } else {
                    $error = "Tạo Tài Khoản Thất Bại!";
                }
            }
        }
        require 'views/admin/register.php';
    }

    public function forgotPassword() {
        $message = '';
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new PDO("mysql:host=localhost;dbname=tlunews", "root", "22072004");
            $userModel = new User($db);
    
            $username = $_POST['username'];
            $newPassword = $_POST['new_password'];
    
            $user = $userModel->getUserByUsername($username);
            if ($user) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt = $db->prepare("UPDATE users SET password = ? WHERE username = ?");
                $stmt->execute([$hashedPassword, $username]);
                $message = "Mật Khẩu Được Đặt Lại Thành Công!";
            } else {
                $error = "Người Dùng không Khả Dụng!";
            }
        }
        require 'views/admin/forgot_password.php';
    }
    
    
    public function changePassword() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
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
        require 'views/admin/change_password.php';
    }
    
    
    
}
?>
