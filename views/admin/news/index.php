<h1>Danh sách tin tức</h1>
<a href="/tlunews/admin/news/add" class="btn btn-primary">Thêm tin tức</a>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Danh mục</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($newsList as $news): ?>
        <tr>
            <td><?= $news['id'] ?></td>
            <td><?= $news['title'] ?></td>
            <td><?= $news['category_name'] ?></td>
            <td><?= $news['created_at'] ?></td>
            <td>
                <a href="/tlunews/admin/news/edit/<?= $news['id'] ?>" class="btn btn-warning">Sửa</a>
                <a href="/tlunews/admin/news/delete/<?= $news['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
