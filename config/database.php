<?php
global $conn;

function connectDatabase($servername, $username, $password, $dbname) {
    global $conn; // Sử dụng biến $conn toàn cục
    try {
        // Tạo kết nối
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

        // Thiết lập chế độ báo lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Kết nối thành công!<br>";
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}

function disconnectDatabase() {
    global $conn; // Sử dụng biến $conn toàn cục
    $conn = null; // Đóng kết nối
    echo "Đã đóng kết nối!<br>";
}
$servername = "localhost"; // Địa chỉ máy chủ
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "tlunews"; // Tên cơ sở dữ liệu
$conn = connectDatabase($servername, $username, $password, $dbname);
?>
