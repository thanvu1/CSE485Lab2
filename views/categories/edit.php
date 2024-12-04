<?php
require_once('../../config/database.php');
require_once('../../controllers/CategoryController.php');

$CategoryController = new CategoryController($pdo);

// Lấy ID danh mục từ URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Lấy thông tin danh mục theo ID
$category = $CategoryController->find($id);

if (!$category) {
    die("Danh mục không tồn tại!");
}

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $CategoryController->update($id, ['name' => $name]);
        header('Location: index.php'); // Chuyển hướng về danh sách
        exit();
    } else {
        $error = "Tên danh mục không được để trống!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Danh Mục</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 8px;
            width: 300px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        button {
            padding: 8px 12px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Sửa Danh Mục</h1>
    <form method="POST" action="">
        <label for="name">Tên Danh Mục:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($category['name']); ?>" required><br><br>
        <button type="submit">Cập Nhật</button>
    </form>

    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <br>
    <a href="index.php">Quay lại danh sách</a>
</body>
</html>
