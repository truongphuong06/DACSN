<?php
require_once 'connect.php';
try {
    // Thông tin kết nối MySQL
    $host = 'localhost';
    $dbname = 'ban_hang';
    $username = 'root';
    $password = '';

    // Tạo kết nối PDO với các options bổ sung
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
    
} catch(PDOException $e) {
    error_log("Lỗi Cơ sở dữ liệu: " . $e->getMessage());
    die("Lỗi kết nối: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Thời Trang Phương Phương</title>
    <style>
        body {
            background: linear-gradient(120deg, #fff0f6 0%, #fff5f7 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(255, 143, 171, 0.15);
        }
        
        h1 {
            color: #ff8fab;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
            font-family: 'Comic Sans MS', cursive;
            text-shadow: 2px 2px 4px rgba(255, 143, 171, 0.2);
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin: 30px 0;
        }
        
        .contact-item {
            padding: 25px;
            background: #fff8fa;
            border-radius: 15px;
            border-left: 5px solid #ffc2d1;
            transition: transform 0.3s ease;
        }
        
        .contact-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(255, 143, 171, 0.2);
        }
        
        .contact-item p {
            margin: 12px 0;
            font-size: 1.1em;
        }
        
        .contact-item strong {
            color: #ff8fab;
            font-size: 1.2em;
        }
        
        .notice-box {
            background: #fff8fa;
            padding: 25px;
            border-radius: 15px;
            margin: 30px 0;
            border: 2px dashed #ffc2d1;
            position: relative;
            overflow: hidden;
        }
        
        .notice-box:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #ff8fab, #ffc2d1);
        }
        
        .notice-box h3 {
            color: #ff8fab;
            margin-bottom: 15px;
        }
        
        .notice-box li {
            padding: 8px 0;
            position: relative;
            padding-left: 25px;
        }
        
        .notice-box li:before {
            content: '•';
            color: #ff8fab;
            position: absolute;
            left: 8px;
        }
        
        .nav-links {
            margin-top: 30px;
            text-align: center;
        }
        
        .nav-links a {
            display: inline-block;
            padding: 12px 25px;
            color: #ff8fab;
            text-decoration: none;
            border: 2px solid #ffc2d1;
            border-radius: 25px;
            margin: 0 10px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            background: linear-gradient(45deg, #ff8fab, #ffc2d1);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 143, 171, 0.3);
        }
        
        .social-media {
            background: linear-gradient(135deg, #fff8fa, #fff0f6);
        }
        
        .map-container {
            margin: 30px 0;
            padding: 20px;
            background: #fff8fa;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(255, 143, 171, 0.1);
        }
        
        .map-container h3 {
            color: #ff8fab;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .contact-info {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <img src="img/logo.jpg" alt="Logo" width="200" height="70">
    </nav>
    
    <div class="container">
        <h1>� Liên Hệ Với Chúng Tôi ✨</h1>
        
        <div class="contact-info">
            <div class="contact-item">
                <p><strong>💖 Shop Thời Trang PHƯƠNG PHƯƠNG 💖</strong></p>
                <div class="contact-section">
        <h3>Thông tin liên hệ</h3>
        <p>Nếu bạn có bất kỳ câu hỏi hoặc yêu cầu hỗ trợ, xin vui lòng liên hệ với chúng tôi:</p>
        <div class="contact-info">
            <i class="fas fa-phone"></i>
            <p>📞Số điện thoại: 0325048679</p>
                <p>📍 Địa chỉ: Bến Nố, Tân Hiệp, Trà Cú, Trà Vinh</p>
                <p>⏰ Giờ mở cửa: 8:00 - 21:00 (Thứ 2 - Chủ nhật)</p>
                <p>📧 Email: phuongphuongshop@gmail.com</p>
            </div>
            
            <div class="contact-item social-media">
                <p><strong>🌟 Kết Nối Với Chúng Tôi 🌟</strong></p>
                <p>📱 Facebook: Shop Thời Trang Phương Phương</p>
                <p>📸 Instagram: @phuongphuong.fashion</p>
                <p>🎵 TikTok: @phuongphuong.shop</p>
            </div>
        </div>

        <div class="notice-box">
            <h3>✨ Thông Tin Cần Lưu Ý:</h3>
            <ul>
                <li>Vui lòng đặt hàng trực tiếp tại cửa hàng hoặc qua hotline</li>
                <li>Chính sách đổi trả linh hoạt trong vòng 7 ngày</li>
                <li>Tư vấn miễn phí 24/7 qua hotline</li>
                <li>Giao hàng nhanh chóng trong khu vực</li>
                <li>Nhận đặt may theo yêu cầu</li>
            </ul>
        </div>

        <div class="map-container">
            <h3>🗺️ Bản Đồ Cửa Hàng</h3>
            <iframe 
                src="https://www.google.com/maps/embed?pb=..." 
                width="100%" 
                height="300" 
                style="border:0; border-radius: 15px;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>

        <div class="nav-links">
        <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
        </div>
    </div>
</body>
</html>