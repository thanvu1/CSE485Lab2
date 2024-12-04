<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .news-item {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
        .news-item:last-child {
            border-bottom: none;
        }
        .news-title {
            font-size: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .news-title:hover {
            text-decoration: underline;
        }
        .news-content {
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>News List</h1>
        <?php foreach ($news as $item): ?>
            <div class="news-item">
                <a href="index.php?controller=home&action=detail&id=<?php echo $item['id']; ?>" class="news-title">
                    <?php echo htmlspecialchars($item['title']); ?>
                </a>
                <p class="news-content">
                    <?php echo substr(htmlspecialchars($item['content']), 0, 100); ?>...
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
