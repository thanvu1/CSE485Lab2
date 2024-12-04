<!DOCTYPE html>
<html>
<head>
    <title>Tin Tức</title>
</head>
<body>
    <h1>Danh sách tin tức</h1>
    <?php foreach ($news as $item): ?>
        <h2><a href="index.php?controller=news&action=detail&id=<?php echo $item['id']; ?>"><?php echo $item['title']; ?></a></h2>
        <p><?php echo substr($item['content'], 0, 100); ?>...</p>
    <?php endforeach; ?>
</body>
</html>
