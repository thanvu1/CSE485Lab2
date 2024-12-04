<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Detail</title>
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
        .news-title {
            font-size: 24px;
            color: #007bff;
        }
        .news-content {
            color: #555;
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($news['title']); ?></h1>
        <p class="news-content"><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
    </div>
</body>
</html>
