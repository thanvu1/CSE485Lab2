<?php

// Thông tin kết nối đến cơ sở dữ liệu
$host = 'localhost'; // Máy chủ cơ sở dữ liệu
$dbname = 'tlunews'; // Tên cơ sở dữ liệu
$username = 'root'; // Tên người dùng cơ sở dữ liệu
$password = ''; // Mật khẩu cơ sở dữ liệu

// Thiết lập kết nối PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Thiết lập chế độ lỗi cho PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
} catch (PDOException $e) {
    // Nếu có lỗi xảy ra khi kết nối
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>
