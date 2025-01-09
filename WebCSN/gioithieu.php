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
    <title>Giới thiệu sản phẩm</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 15px;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 15px auto;
            padding: 12px;
            width: 800px;
            min-height: 320px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .product-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .product-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255,255,255,0.3),
                transparent
            );
            transition: 0.5s;
        }

        .product-container:hover::before {
            left: 100%;
        }

        .product-image {
            width: 240px;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
            margin: 0 15px;
            transition: all 0.4s ease;
            flex-shrink: 0;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 3px solid #fff;
            
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(45deg, #3498db, #e74c3c) border-box;
            border: 3px solid transparent;
        }

        .product-image:hover {
            transform: scale(1.05) translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border-color: transparent;
            
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(45deg, #e74c3c, #3498db) border-box;
        }

        .product-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0) 0%,
                rgba(0,0,0,0.2) 100%
            );
            border-radius: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-image:hover::after {
            opacity: 1;
        }

        @keyframes imageLoad {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .product-image {
            animation: imageLoad 0.5s ease-out forwards;
        }

        .product-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(
                to right,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.3) 100%
            );
            transform: skewX(-25deg);
            transition: 0.75s;
            z-index: 1;
        }

        .product-image:hover::before {
            left: 125%;
        }

        .product-description {
            flex: 1;
            width: 450px;
            max-width: 450px;
            min-height: 300px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        h1, h2, h3, h4 {
            text-align: center;
        }

        h2 {
            color: #2c3e50;
            font-size: 22px;
            margin: 0 0 12px 0;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 50px;
            height: 2px;
            background: #e74c3c;
            transition: width 0.3s ease;
        }

        .product-container:hover h2::after {
            width: 100%;
        }

        .description-list {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
            flex-grow: 1;
        }

        .description-list li {
            margin: 8px 0;
            padding-left: 15px;
            line-height: 1.4;
            position: relative;
            color: #555;
            transition: transform 0.2s ease;
        }

        .description-list li:hover {
            transform: translateX(5px);
        }

        .description-list li:before {
            content: "•";
            color: #3498db;
            position: absolute;
            left: 0;
            transition: color 0.2s ease;
        }

        .description-list li:hover:before {
            color: #e74c3c;
        }

        .links-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: auto;
            padding: 10px 0;
            height: 40px;
        }

        .links-container a {
            color: #fff;
            background-color: #3498db;
            padding: 8px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .links-container a i {
            margin-right: 8px;
            font-size: 16px;
        }

        .links-container a:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .links-container a::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.3) 50%,
                rgba(255,255,255,0) 100%
            );
            transform: rotate(45deg);
            transition: all 0.5s;
            opacity: 0;
        }

        .links-container a:hover::before {
            left: 100%;
            opacity: 1;
        }

        .links-container a:nth-child(1) {
            background-color: #e74c3c;
        }

        .links-container a:nth-child(2) {
            background-color: #2ecc71;
        }

        .links-container a:nth-child(3) {
            background-color: #f39c12;
        }

        .links-container a:nth-child(1):hover {
            background-color: #c0392b;
        }

        .links-container a:nth-child(2):hover {
            background-color: #27ae60;
        }

        .links-container a:nth-child(3):hover {
            background-color: #d35400;
        }

        .home-link {
            text-align: center;
            margin: 12px auto;
        }

        .home-link a {
            font-size: 15px;
            padding: 6px 12px;
            background-color: #3498db;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .home-link a:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Thêm hiệu ứng cho giá */
        h4 {
            color: #e74c3c;
            font-size: 16px;
            height: 25px;
            margin: 8px 0;
            transform: translateX(0);
            transition: transform 0.3s ease;
        }

        .product-container:hover h4 {
            transform: translateX(5px);
        }

        /* Hiệu ứng cho giá */
        p {
            color: #666;
            line-height: 1.5;
            margin: 8px 0;
        }

        /* Animation cho loading */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .product-container {
            animation: fadeIn 0.5s ease-out;
        }

        /* Đảm bảo responsive */
        @media (max-width: 850px) {
            .product-container {
                width: 95%;
                min-height: auto;
            }
            
            .product-image {
                width: 200px;
                height: 250px;
            }
            
            .product-description {
                width: auto;
                min-height: auto;
            }
        }

        /* Animation khi load trang */
        @keyframes slideInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .links-container a {
            animation: slideInUp 0.5s ease forwards;
        }

        .links-container a:nth-child(1) {
            animation-delay: 0.1s;
        }

        .links-container a:nth-child(2) {
            animation-delay: 0.2s;
        }

        .links-container a:nth-child(3) {
            animation-delay: 0.3s;
        }

        /* Thêm hiệu ứng cho giá */
        p:last-of-type {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1em;
        }

        /* Cải thiện typography */
        .product-title {
            font-size: 20px;
            color: #34495e;
            margin: 12px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Text selection */
        ::selection {
            background: #3498db;
            color: white;
        }

        /* Responsive typography */
        @media (max-width: 850px) {
            h2 {
                font-size: 20px;
            }
            
            .product-title {
                font-size: 18px;
            }
            
            p {
                font-size: 14px;
            }
        }

        /* Thêm các style mới */
        .page-header {
            text-align: center;
            padding: 30px 0;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .page-header h1 {
            font-size: 2.5em;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .contact-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin: 30px auto;
            max-width: 800px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .contact-section h3 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }

        .contact-info i {
            color: #3498db;
            font-size: 20px;
        }

        .rating-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin: 30px auto;
            max-width: 800px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .rating-stars {
            color: #f1c40f;
            font-size: 24px;
            margin: 10px 0;
        }

        .customer-review {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #3498db;
        }

        /* Thêm container cho danh sách sản phẩm */
        .products-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 15px;
            justify-content: flex-start;
        }

        .product-container {
            width: calc((100% - 80px) / 5);
            min-height: 450px;
            margin: 0;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .product-image {
            width: 100%;
            height: 250px;
            margin: 0 0 10px 0;
            object-fit: cover;
        }

        .product-description {
            width: 100%;
            flex: 1;
            padding: 10px;
        }

        /* Điều chỉnh responsive */
        @media (max-width: 1200px) {
            .product-container {
                width: calc((100% - 60px) / 4);
            }
        }

        @media (max-width: 992px) {
            .product-container {
                width: calc((100% - 40px) / 3);
            }
        }

        @media (max-width: 768px) {
            .product-container {
                width: calc((100% - 20px) / 2);
            }
        }

        @media (max-width: 480px) {
            .product-container {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="home-link">
    <a href="trangchu.php" class="nav-item"><i class="fas fa-info-circle"></i> Trang chủ</a>
    </div>
    <div class="page-header">
        <h1>Giới thiệu sản phẩm</h1>
    </div>

    <div class="products-grid">
        <div class="product-container">
            <img src="img/1.jpg" alt="Áo hoodie" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 1: Áo hoodie</h2>
                <p>Mô tả sản phẩm:</p>
                <h3 class="product-title">Áo hoodie</h3>
                <ul class="description-list">
                    <li>Chất liệu nỉ bông nhập khẩu cao cấp, vải rất mát sờ mịn tay.</li>
                    <option value="">Kích cỡ</option>
                                <option value="S">S (45kg-50kg)</option>
                                <option value="M">M (50kg-55kg)</option>
                                <option value="L">L (55kg-60kg)</option>
                                <option value="XL">XL (60kg-65kg)</option>
                                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 150.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/2.jpg" alt="Áo somi" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 2: Áo somi</h2>
                <p>Mô tả sản phẩm:</p>
                <h3 class="product-title">Áo somi</h3>
                <ul class="description-list">
                    <li>Áo kiểu đơn giản phù hợp đi học, đi chơi.</li>
                                <option value="">Kích cỡ</option>
                                <option value="S">S (45kg-50kg)</option>
                                <option value="M">M (50kg-55kg)</option>
                                <option value="L">L (55kg-60kg)</option>
                                <option value="XL">XL (60kg-65kg)</option>
                            </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 160.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/3.jpg" alt="Noar Blanc" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 3: Noar Blanc</h2>
                <p>Mô tả sản phẩm:</p>
                <h3 class="product-title">Noar Blanc</h3>
                <p>Thương hiệu Noar Blanc</p>
                <ul class="description-list">
                    <li>Chất liệu: Taffeta</li>
                    <li>Màu sắc: Trắng</li>
                    <li>Họa tiết: Trơn</li>
                    <option value="">Kích cỡ</option>
                                <option value="S">S (45kg-50kg)</option>
                                <option value="M">M (50kg-55kg)</option>
                                <option value="L">L (55kg-60kg)</option>
                                <option value="XL">XL (60kg-65kg)</option>
                            </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 2.000.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/4.jpg" alt="Áo kimono" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 4: Áo kimono</h2>
                <p>Mô tả sản phẩm:</p>
                <h3 class="product-title">Áo kimono</h3>
                <ul class="description-list">
                    <li>Phong cách nữ tính, nhẹ nhàng</li>
                    <li>Nút khâu màu đồng nhất</li>
                    <li>Cổ áo hải quân</li>
                    <li>Không có nhung</li>
                    <option value="">Kích cỡ</option>
                                <option value="S">S (40kg-45kg)</option>
                                <option value="M">M (45kg-50kg)</option>
                                <option value="L">L (50kg-54kg)</option>
                                <option value="XL">XL (55kg-60kg)</option>
                            </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 170.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/5.jpg" alt="Áo tơ bèo" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 5: Áo tơ bèo</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Áo tơ bèo hở vai Lisadress, set áo quần tiểu thư</li>
                    <li>Chất liệu: tơ óng mềm mại, chân váy cùng màu với áo</li>
                    <li>Dài set: 86cm</li>
                    <li>Sản phẩm phù hợp cho đi chơi, đi du lịch, đi biển, hẹn hò</li>
                    <option value="">Kích cỡ</option>
                                <option value="S">S (40kg-45kg)</option>
                                <option value="M">M (45kg-50kg)</option>
                                <option value="L">L (50kg-54kg)</option>
                                <option value="XL">XL (55kg-58kg)</option>
                            </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 190.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/6.jpg" alt="Áo hai dây buộc nơ" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 6: Áo hai dây buộc nơ</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Chất liệu: đũi loại 1</li>
                    <li>Màu sắc: đen, trắng be, hồng, xanh</li>
                    <li>Kỹ thuật may: đường may kỹ lưỡng, chất lượng, không bung xúc</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (45kg-55kg)</option>
                    <option value="L">L (55kg-58kg)</option>
                    <option value="XL">XL (58kg-60kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 60.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
            </div>
        </div>
        </div>

        <div class="product-container">
            <img src="img/7.jpg" alt="Áo dạ Tweed" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 7: Áo dạ Tweed</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Áo dạ tweed dài cao cấp kiểu tiểu thư</li>
                    <li>Cổ tròn cúc ngọc thời trang nữ</li>
                    <li>Thiết kế: Cobe.official</li>
                    <li>Chất liệu: dạ Tweed cao cấp</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (45kg-55kg)</option>
                     <option value="L">L (55kg-58kg)</option>
                    <option value="XL">XL (58kg-60kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 150.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/8.jpg" alt="Váy trễ vai Tafla" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 8: Váy trễ vai Tafla</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Váy trễ vai Tafla bánh bèo</li>
                    <li>Tầng vai dây chéo cổ gắn bươm ngọc dáng chữ A</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (43kg-50kg)</option>
                    <option value="L">L (50kg-55kg)</option>
                    <option value="XL">XL (55kg-60kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 165.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/9.jpg" alt="Váy" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 9: Váy</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Chất vải: lụa</li>
                    <li>Sản phẩm: váy</li>
                    <li>Xuất xứ: được gia công bởi Vielin</li>
                </select>
                <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (43kg-50kg)</option>
                    <option value="L">L (50kg-55kg)</option>
                    <option value="XL">XL (55kg-65kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 175.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/10.jpg" alt="Áo form rộng" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 10: Áo form rộng</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Chất liệu: PREMIUM COTON</li>
                    <li>Mềm, mịn, mát, không đổ lông, chống co rút</li>
                    <li>Màu sắc: đen, kem, hồng</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (43kg-50kg)</option>
                    <option value="L">L (50kg-55kg)</option>
                    <option value="XL">XL (55kg-65kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 90.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/11.jpg" alt="Áo croptop" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 11: Áo croptop</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Chất liệu áo: cotton 100%</li>
                    <li>Croptop: form croptop ôm, ngắn gần vòng 1</li>
                    <li>Body: form ôm body, dáng dài</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-55kg)</option>
                    <option value="XL">XL (55kg-60kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 45.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/12.jpg" alt="Đầm lụa" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 12: Đầm lụa</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Đầm lụa cao cấp, xẻ đùi, chất lụa xinh, không xước</li>
                    <li>Mềm-mịn-mát, không gây kích ứng cho da</li>
                    <li>Chất liệu: lụa cao cấp bóng bẩy và sang trọng</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-55kg)</option>
                    <option value="XL">XL (55kg-60kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 400.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/13.jpg" alt="Mysterious grey" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 13: Mysterious grey</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Áo cardigan cổ V, có túi, phối tay 3 sọc</li>
                    <li>Chất liệu: Len mềm mịn, độ dày vừa phải</li>
                    <li>Mẫu siêu hot, thiết kế đơn giản nhưng có điểm nhấn ở tay</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-55kg)</option>
                    <option value="XL">XL (55kg-60kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 150.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/14.jpg" alt="Đầm dạ hội" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 14: Đầm dạ hội</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Sản phẩm cao cấp, chất lượng, sang trọng, quý phái</li>
                    <li>Ôm body, tôn dáng</li>
                    <li>Chất liệu: lụa cao cấp bóng bẩy và sang trọng</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-53kg)</option>
                    <option value="XL">XL (53kg-60kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 1.500.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/15.jpg" alt="Áo" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 15: Áo</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Sành điệu, vải mượt</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-53kg)</option>
                    <option value="XL">XL (53kg-60kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 400.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/16.jpg" alt="Đầm đen họa tiết" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 16: Đầm đen họa tiết</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Kiểu dáng: đầm xòe</li>
                    <li>Chất liệu: vải taffeta</li>
                    <li>Vải không nhăn, không pha màu</li>
                    <li>Đậm chất quý cô</li>
                    <option value="">Kích cỡ</option>
                  <option value="S">S (40kg-43kg)</option>
                  <option value="M">M (42kg-48kg)</option>
                  <option value="L">L (48kg-53kg)</option>
                  <option value="XL">XL (53kg-56kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 150.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/17.jpg" alt="Đầm lụa yếm đính đá" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 17: Đầm lụa yếm đính đá</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Phong cách gợi cảm</li>
                    <li>Chất liệu thun mềm mại, họa tiết đơn giản nhưng thu hút</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (42kg-48kg)</option>
                    <option value="L">L (48kg-53kg)</option>
                    <option value="XL">XL (53kg-56kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 700.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/18.jpg" alt="Áo thun cổ V" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 18: Áo thun cổ V</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Chất thun thoát mt</li>
                    <li>Dày dặn, mềm mại, co giãn 4 chiều</li>
                    <option value="">Kích cỡ</option>
                    <option value="S">S (40kg-45kg)</option>
                    <option value="M">M (45kg-48kg)</option>
                    <option value="L">L (48kg-53kg)</option>
                    <option value="XL">XL (53kg-56kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 65.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/19.jpg" alt="Đầm" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 19: Đầm</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Thời trang nữ thiết kế made by Flane</li>
                    <option value="">kích cỡ</option>
                    <option value="S">S (40kg-45kg)</option>
                    <option value="M">M (45kg-48kg)</option>
                    <option value="L">L (48kg-53kg)</option>
                    <option value="XL">XL (53kg-56kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 300.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>

        <div class="product-container">
            <img src="img/20.jpg" alt="Đồ bộ" class="product-image">
            <div class="product-description">
                <h2>Sản phẩm 20: Đồ bộ</h2>
                <p>Mô tả sản phẩm:</p>
                <ul class="description-list">
                    <li>Thiết kế: cạp cao gen bụng, tôn dáng kéo dài đôi chân</li>
                    <li>Mềm mát siêu mịn</li>
                    <option value="">Kích cỡ</option>
                   <option value="S">S (40kg-45kg)</option>
                  <option value="M">M (45kg-48kg)</option>
                  <option value="L">L (48kg-53kg)</option>
                  <option value="XL">XL (53kg-58kg)</option>
                </select>
                </ul>
                <h4>Giá sản phẩm:</h4>
                <p>Giá: 75.000 VNĐ</p>
                <div class="links-container">
                <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
                </div>
            </div>
        </div>
    </div>

    <div class="rating-section">
        <h3>Đánh giá của khách hàng</h3>
        <div class="rating-stars">
            ★★★★☆ 4.5/5
        </div>
        <div class="customer-review">
            <p><i class="fas fa-quote-left"></i> Sản phẩm rất tốt, tôi rất hài lòng với chất lượng và hiệu năng của nó. <i class="fas fa-quote-right"></i></p>
        </div>
    </div>

        </div>
    </div>
</body>
</html>
