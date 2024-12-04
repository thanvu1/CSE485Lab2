<h1>Thêm tin tức</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nội dung</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label>Danh mục</label>
        <select name="category_id" class="form-control" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Ảnh</label>
        <input type="file" name="image" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
