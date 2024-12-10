<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Quản lý tin tức</title>
</head>
<body>
<div class="container">
    <h1 class="text-center text-uppercase text-success my-3">Danh sách tin tức</h1>
    <a href="<?= DOMAIN . '/views/admin/news/add.php';?>" class="btn btn-primary">Thêm tin tức</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Ảnh</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($news as $new): ?>
            <tr>
                <td><?= $new->getId(); ?></td>
                <td><?= $new->getTitle(); ?></td>
                <td><?= $new->getCategoryId(); ?></td>
                <td><?= $new->getImage(); ?></td>
                <td><?= $new->getCreatedAt(); ?></td>
                <td>
                    <a href="<?= DOMAIN . '/views/admin/news/edit.php?id=' .$new->getId() ?>" class="btn btn-warning">Sửa</a>
                    <a  class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>