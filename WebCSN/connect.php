<?php
try {
    // Thông tin kết nối MySQL
    $host = 'localhost';
    $dbname = 'ban_hang';
    $username = 'root';
    $password = '';

    // Tạo kết nối PDO
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4")
    );
    
    // Cấu hình PDO để báo lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Chỉ hiển thị khi cần debug
    // echo "Kết nối CSDL thành công!";
    
} catch(PDOException $e) {
    error_log("Lỗi kết nối CSDL: " . $e->getMessage());
    die("Có lỗi xảy ra, vui lòng thử lại sau.");
}
?>