<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #28a745;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background: #218838;
        }
        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }
        .link-container {
            margin-top: 20px;
            text-align: center;
        }
        .link-container a {
            text-decoration: none;
            color: #007bff;
            margin: 0 5px;
        }
        .link-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Người Dùng</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php?controller=home&action=login">
            <div class="form-group">
                <label for="username">Tài Khoản</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Đăng Nhập</button>
        </form>
        <div class="link-container">
            <a href="index.php?controller=home&action=register">Tạo Tài Khoản Mới</a> |
            <a href="index.php?controller=home&action=forgotPassword">Quên Mật Khẩu?</a> |
            <a href="index.php?controller=home&action=changePassword">Đổi Mật Khẩu</a>
        </div>
    </div>
</body>
</html>
