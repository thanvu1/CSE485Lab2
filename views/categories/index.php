<?php
    require_once('../../config/database.php');
    require_once('../../controllers/CategoryController.php');
?>

<!-- views/category.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .button {
            padding: 8px 12px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .button-danger {
            background-color: #dc3545;
        }

        .button:hover {
            opacity: 0.8;
        }

        .form-container {
            margin-top: 30px;
        }

        .form-container input[type="text"] {
            padding: 8px;
            width: 300px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .form-container button {
            padding: 8px 12px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Quản Lý Danh Mục</h1>

    <!-- Nút để thêm mới danh mục -->
    <a href="index.php?controller=category&action=create" class="button">Thêm Mới Danh Mục</a>

    <div class="form-container">
        <h2>Danh Sách Danh Mục</h2>

        <!-- Bảng hiển thị danh sách các danh mục -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo $category['id']; ?></td>
                        <td><?php echo $category['name']; ?></td>
                        <td>
                            <!-- Liên kết để chỉnh sửa và xóa danh mục -->
                            <a href="index.php?controller=category&action=edit&id=<?php echo $category['id']; ?>" class="button">Sửa</a>
                            <a href="index.php?controller=category&action=destroy&id=<?php echo $category['id']; ?>" class="button button-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
