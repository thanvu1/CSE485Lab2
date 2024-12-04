<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .forgot-password-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .forgot-password-container h2 {
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
            border-color: #ff6f61;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #ff6f61;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: #e85d54;
        }
        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }
        .success-message {
            color: green;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }
        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }
        .back-to-login a {
            text-decoration: none;
            color: #007bff;
        }
        .back-to-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2>Quên Mật Khẩu</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (isset($message)): ?>
            <p class="success-message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Tài Khoản</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="new_password">Mật Khẩu Mới</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <button type="submit" class="btn-submit">Tạo Lại Mật Khẩu</button>
        </form>
        <div class="back-to-login">
            <a href="index.php?controller=admin&action=login">Quay Về Trang Đăng Nhập</a>
        </div>
    </div>
</body>
</html>
