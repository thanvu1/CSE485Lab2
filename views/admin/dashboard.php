<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f9;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .nav a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 16px;
        }
        .nav a:hover {
            background: #0056b3;
        }
        .dashboard-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            flex: 1;
            min-width: 200px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .card h3 {
            font-size: 18px;
            color: #555;
        }
        .card a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="nav">
            <a href="index.php?controller=admin&action=manageNews">Manage News</a>
            <a href="index.php?controller=admin&action=logout">Logout</a>
        </div>
        <div class="dashboard-section">
            <div class="card">
                <h3>Total News</h3>
                <p><?php echo htmlspecialchars($totalNews); ?></p>
                <a href="index.php?controller=admin&action=manageNews">View All News</a>
            </div>
            <div class="card">
                <h3>New Categories</h3>
                <p><?php echo htmlspecialchars($totalCategories); ?></p>
                <a href="#">View Categories</a>
            </div>
        </div>
    </div>
</body>
</html>
