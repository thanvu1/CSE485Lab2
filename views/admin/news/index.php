<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .add-news {
            display: block;
            margin-bottom: 20px;
            text-align: right;
        }
        .add-news a {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .add-news a:hover {
            background: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background: #f1f1f1;
        }
        .action-buttons a {
            margin-right: 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 6px;
        }
        .action-buttons .edit {
            background: #28a745;
        }
        .action-buttons .edit:hover {
            background: #218838;
        }
        .action-buttons .delete {
            background: #dc3545;
        }
        .action-buttons .delete:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage News</h1>
        <div class="add-news">
            <a href="index.php?controller=admin&action=addNews">Add News</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars($item['category_id']); ?></td>
                    <td class="action-buttons">
                        <a href="index.php?controller=admin&action=editNews&id=<?php echo $item['id']; ?>" class="edit">Edit</a>
                        <a href="index.php?controller=admin&action=deleteNews&id=<?php echo $item['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this news?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
