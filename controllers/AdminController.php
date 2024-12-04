<?php
require_once 'models/User.php';

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

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
            exit;
        }

        echo "Welcome to the admin dashboard!";
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
                $error = "Passwords do not match!";
            } else {
                $success = $userModel->createUser($username, $password, 0); // role = 0: user
                if ($success) {
                    header('Location: index.php?controller=admin&action=login');
                    exit;
                } else {
                    $error = "Failed to create account!";
                }
            }
        }
        require 'views/admin/register.php';
    }

    public function forgotPassword() {
        $message = '';
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
                $message = "Password reset successfully!";
            } else {
                $message = "User not found!";
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
                    $message = "Password changed successfully!";
                } else {
                    $error = "New passwords do not match!";
                }
            } else {
                $error = "Current password is incorrect!";
            }
        }
        require 'views/admin/change_password.php';
    }
    
    
}
?>
