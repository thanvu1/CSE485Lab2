<?php
    require_once('../../config/database.php');
    require_once('../../controllers/CategoryController.php');

    $CategoryController = new CategoryController($pdo);

    $categories = $CategoryController->index();

?>

<!-- views/category.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1 class="text-center text-upercase text-success py-3">Quản Lý Danh Mục</h1>

    <!-- Nút để thêm mới danh mục -->
    <a href="create.php" class="button">Thêm Mới Danh Mục</a>

    <div class="form-container">
        <h2>Danh Sách Danh Mục</h2>

        <!-- Bảng hiển thị danh sách các danh mục -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Sửa</th>
                    <th>Xoá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['name']; ?></td>
                        <td><a href="edit.php?id=<?= $category['id']; ?>"><i class="fa-regular fa-pen-to-square"></i> Sửa</a></td>
                        <td>
                            <form action="delete.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $category['id']; ?>">
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                                    Xóa
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
