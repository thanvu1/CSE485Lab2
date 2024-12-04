<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
</head>
<body>
    <form method="POST" action="">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required><br><br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($news['content']); ?></textarea><br><br>
        <label for="category_id">Category:</label>
        <input type="number" id="category_id" name="category_id" value="<?php echo htmlspecialchars($news['category_id']); ?>" required><br><br>
        <button type="submit">Update News</button>
    </form>
</body>
</html>
