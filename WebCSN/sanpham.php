<!DOCTYPE html>
<html>
<head>
  <title>Shop Thời Trang PHuongPhuong</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Style chung */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    /* Header */
    header {
        text-align: center;
        margin-bottom: 30px;
        padding: 20px;
        background: linear-gradient(135deg, #ff9a9e, #fecfef);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 15px;
    }

    header h1 {
        font-size: 3.5em;
        color: #ff69b4;
        font-weight: bold;
        text-shadow: 3px 3px 6px rgba(0,0,0,0.2);
        margin: 0;
        transition: color 0.3s ease, transform 0.3s ease;
        font-family: 'Comic Sans MS', cursive, sans-serif;
    }

    header h1 a {
        text-decoration: none;
        color: inherit;
    }

    header h1 a:hover {
        color: #ff1493;
        transform: scale(1.05);
    }

    header .container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    header .home-link a {
        font-size: 1.5em;
        color: #ff69b4;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease, transform 0.3s ease;
        display: inline-block;
        padding: 10px 20px;
        border-radius: 50px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    header .home-link a:hover {
        color: #ff1493;
        transform: scale(1.1);
        background-color: #f8f9fa;
    }

    /* Container sản phẩm */
    section {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
    }

    .product-container {
        width: calc(20% - 16px);
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #f8f9fa;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        border: 2px solid #ff69b4;
    }

    .product-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        background: #ffe4e1;
    }

    /* Hình ảnh sản phẩm */
    .product-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
        border-bottom: 1px solid #eee;
    }

    .product-container:hover .product-image {
        transform: scale(1.05);
    }

    /* Thông tin sản phẩm */
    .product-info {
        padding: 15px;
        position: relative;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        text-align: center;
    }

    h3 {
        margin: 10px 0;
        color: #333;
        font-size: 1.1em;
        font-weight: 600;
    }

    .product-price {
        color: #e44d26;
        font-weight: bold;
        margin: 12px 0;
        font-size: 1.2em;
    }

    .btn {
        background: linear-gradient(145deg, #4CAF50, #45a049);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        width: 100%;
        font-weight: 600;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 0.9em;
        letter-spacing: 0.5px;
    }

    .btn:hover {
        background: linear-gradient(145deg, #45a049, #4CAF50);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        transform: translateY(-2px);
    }

    /* Giỏ hàng */
    .cart {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        max-width: 300px;
        z-index: 1000;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .cart-total {
        margin-top: 15px;
        font-weight: bold;
        color: #e44d26;
    }

    /* Input số lượng sản phẩm */
    .quantity-input {
        width: 60px; /* Giảm chiều rộng */
        padding: 5px;
        font-size: 0.9em; /* Giảm kích thước font */
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center; /* Căn giữa văn bản */
        margin-right: 10px; /* Khoảng cách giữa input và nút */
    }

    .quantity-input:focus {
        outline: none;
        border-color: #ff69b4; /* Màu viền khi focus */
        box-shadow: 0 0 5px rgba(255, 105, 180, 0.2);
    }

    .remove-btn {
        background: #ff4444;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        line-height: 20px;
        text-align: center;
        cursor: pointer;
        font-size: 12px;
        margin-left: 10px;
        padding: 0;
    }

    .remove-btn:hover {
        background: #cc0000;
    }

    /* Thêm style cho rating */
    .rating {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        margin: 10px 0;
    }

    .stars {
        display: flex;
        gap: 2px;
    }

    .star {
        color: #ffd700;
        font-size: 20px;
        cursor: pointer;
    }

    .star:hover,
    .star.active {
        color: #ffb700;
    }

    .rating-count {
        font-size: 0.9em;
        color: #666;
        margin-left: 5px;
    }

    /* Thêm styles mới */
    .form-group {
        margin-bottom: 20px;
        padding: 15px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-group h3 {
        margin-top: 0;
        color: #333;
        font-size: 1.2em;
    }

    .payment-methods {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .payment-method {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .payment-method:hover {
        background: #f8f9fa;
    }

    .payment-method input[type="radio"] {
        margin-right: 10px;
    }

    .banking-info, .momo-info {
        margin-top: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 5px;
        font-size: 0.9em;
    }

    .banking-info p, .momo-info p {
        margin: 5px 0;
        color: #666;
    }

    /* Thêm style cho trang xác nhận đơn hàng */
    .order-confirmation {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-top: 20px;
    }

    .order-confirmation h3 {
        color: #333;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .payment-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-top: 10px;
    }

    .payment-info p {
        margin: 5px 0;
    }

    /* Thêm style cho QR code */
    .qr-code {
        max-width: 200px;
        margin: 10px auto;
        display: block;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background: white;
    }

    .payment-method {
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .payment-method:hover {
        background: #f8f9fa;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .banking-info, .momo-info, .vnpay-info {
        margin-top: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        text-align: center;
    }
</style>
</head>
<body>
  <header>
    <h1><a href="index.php" style="text-decoration: none; color: inherit;">Sản phẩm</a></h1>
    <div class="container">
      <div class="home-link">
        <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
      </div>
    </div>
    <!-- Thêm bộ lọc -->
    <div class="filter-container">
        <input type="text" id="nameFilter" placeholder="Nhập tên sản phẩm cần tìm..." onkeyup="filterProducts()" list="productNames">
        <datalist id="productNames">
            <option value="Áo hoodie">
            <option value="Áo somi">
            <option value="Noar Blanc">
            <option value="Áo kimono">
            <option value="Áo tơ bèo">
            <option value="Áo hai dây buộc nơ">
            <option value="Áo sơ mi dạ Tweed">
            <option value="Váy trễ vai Tafla">
            <option value="Váy">
            <option value="Áo from rộng">
            <option value="Áo croptop">
            <option value="Đầm lụa">
            <option value="Mysterious grey">
            <option value="Đầm dạ hội">
            <option value="Áo">
            <option value="Đầm đen họa tiết">
            <option value="Đầm cổ yếm đính đá">
            <option value="Áo thun cổ V">
            <option value="Đầm">
            <option value="Đồ bộ">
        </datalist>
        <select id="priceFilter" onchange="filterProducts()">
            <option value="">Tất cả giá</option>
            <option value="0-100000">Dưới 100.000₫</option>
            <option value="100000-200000">100.000₫ - 200.000₫</option>
            <option value="200000-500000">200.000₫ - 500.000₫</option>
            <option value="500000-1000000">500.000₫ - 1.000.000₫</option>
            <option value="1000000-">Trên 1.000.000₫</option>
        </select>
    </div>
  </header>


  <main>
    <section>
    <div class="product-container">
                <img src="img/1.jpg" alt="Áo hoodie" class="product-image">
                <div class="product-info">
                    <h3>Áo hoodie</h3>
                    <p class="product-price">150.000 VNĐ</p>
                    
                    <form action="giohang.php" method="POST">
                        <input type="hidden" name="ten_sp" value="Áo hoodie">
                        <input type="hidden" name="gia" value="150000">
                        <div class="size-selector">
                            <select name="size" required class="size-input">
                                <option value="">Chọn size</option>
                                <option value="S">S (45-48kg)</option>
                                <option value="M">M (48-52kg)</option>
                                <option value="L">L (52-55kg)</option>
                            </select>
                        </div>
                        <div class="purchase-controls">
                            <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                            <button class="btn" onclick="addToCart('Áo hoodie', 150000)">Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="product-container">
                <img src="img/2.jpg" alt="Áo somi" class="product-image">
                <div class="product-info">
                    <h3>Áo somi</h3>
                    <p class="product-price">160.000 VNĐ</p>
                   
                    <form action="giohang.php" method="POST">
                        <input type="hidden" name="ten_sp" value="Áo somi">
                        <input type="hidden" name="gia" value="160000">
                        <div class="size-selector">
                            <select name="size" required class="size-input">
                                <option value="">Chọn size</option>
                                <option value="S">S (45kg-50kg)</option>
                                <option value="M">M (50kg-55kg)</option>
                                <option value="L">L (55kg-60kg)</option>
                                <option value="XL">XL (60kg-65kg)</option>
                            </select>
                        </div>
                        <div class="purchase-controls">
                            <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                            <button class="btn" onclick="addToCart('Áo somi', 160000)">Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="product-container">
                <img src="img/3.jpg" alt="Noar Blanc" class="product-image">
                <div class="product-info">
                    <h3>Noar Blanc</h3>
                    <p class="product-price">2.000.000 VNĐ</p>
                    <form action="giohang.php" method="POST">
                      <input type="hidden" name="ten_sp" value="Noar Blanc">
                        <input type="hidden" name="gia" value="2000000">
                        <div class="size-selector">
                            <select name="size" required class="size-input">
                                <option value="">Chọn size</option>
                                <option value="S">S (45kg-50kg)</option>
                                <option value="M">M (50kg-55kg)</option>
                                <option value="L">L (55kg-60kg)</option>
                                <option value="XL">XL (60kg-65kg)</option>
                            </select>
                        </div>
                        <div class="purchase-controls">
                            <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                            <button class="btn" onclick="addToCart('Áo Noar Blanc', 2000000)">Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="product-container">
                <img src="img/4.jpg" alt="Áo kimono" class="product-image">
                <div class="product-info">
                    <h3>Áo kimono</h3>
                    <p class="product-price">170.000 VNĐ</p>
                   
                    <form action="giohang.php" method="POST">
                        <input type="hidden" name="ten_sp" value="Áo kimono">
                        <input type="hidden" name="gia" value="170000">
                        <div class="size-selector">
                            <select name="size" required class="size-input">
                                <option value="">Chọn size</option>
                                <option value="S">S (40kg-45kg)</option>
                                <option value="M">M (45kg-50kg)</option>
                                <option value="L">L (50kg-54kg)</option>
                                <option value="XL">XL (55kg-60kg)</option>
                            </select>
                        </div>
                        <div class="purchase-controls">
                            <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                            <button class="btn" onclick="addToCart('Áo kimono', 170000)">Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="product-container">
                <img src="img/5.jpg" alt="Áo tơ bèo" class="product-image">
                <div class="product-info">
                    <h3>Áo tơ bèo</h3>
                    <p class="product-price">190.000 VNĐ</p>
                    
                    <form action="giohang.php" method="POST">
                         <input type="hidden" name="ten_sp" value="Áo tơ bèo">
                        <input type="hidden" name="gia" value="190000">
                        <div class="size-selector">
                            <select name="size" required class="size-input">
                                <option value="">Chọn size</option>
                                <option value="S">S (40kg-45kg)</option>
                                <option value="M">M (45kg-50kg)</option>
                                <option value="L">L (50kg-54kg)</option>
                                <option value="XL">XL (55kg-58kg)</option>
                            </select>
                        </div>
                        <div class="purchase-controls">
                            <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                            <button class="btn" onclick="addToCart('Áo tơ bèo', 190000)">Thêm vào giỏ hàng</button>
                        </div>
                    </form>
                </div>
            </div>

<div class="product-container">
    <img src="img/6.jpg" alt="Áo hai dây buộc nơ" class="product-image">
    <div class="product-info">
        <h3>Áo hai dây buộc nơ</h3>
        <p class="product-price">60.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Áo hai dây buộc nơ">
            <input type="hidden" name="gia" value="60000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (45kg-55kg)</option>
                    <option value="L">L (55kg-58kg)</option>
                    <option value="XL">XL (58kg-60kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Áo hai dây buộc nơ', 60000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/7.jpg" alt="Áo sơ mi dạ Tweed" class="product-image">
    <div class="product-info">
        <h3>Áo sơ mi dạ Tweed</h3>
        <p class="product-price">150.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Áo sơ mi dạ Tweed">
            <input type="hidden" name="gia" value="150000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (45kg-55kg)</option>
                     <option value="L">L (55kg-58kg)</option>
                    <option value="XL">XL (58kg-60kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Áo sơ mi dạ Tweed', 160000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/8.jpg" alt="váy trễ vay Tafla" class="product-image">
    <div class="product-info">
        <h3>váy trễ vay Tafla</h3>
        <p class="product-price">165.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Váy trễ vay Tafla">
            <input type="hidden" name="gia" value="165000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (43kg-50kg)</option>
                    <option value="L">L (50kg-55kg)</option>
                    <option value="XL">XL (55kg-60kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Áo Váy trễ vay Tafla', 165000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/9.jpg" alt="Váy" class="product-image">
    <div class="product-info">
        <h3>váy</h3>
        <p class="product-price">175.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Váy">
            <input type="hidden" name="gia" value="175000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (43kg-50kg)</option>
                    <option value="L">L (50kg-55kg)</option>
                    <option value="XL">XL (55kg-65kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Váy', 175000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/10.jpg" alt="Áo from rộng" class="product-image">
    <div class="product-info">
        <h3>Áo from rộng</h3>
        <p class="product-price">90.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Áo from rộng">
            <input type="hidden" name="gia" value="90000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (43kg-50kg)</option>
                    <option value="L">L (50kg-55kg)</option>
                    <option value="XL">XL (55kg-65kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Áo from rộng', 90000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/11.jpg" alt="Áo croptop" class="product-image">
    <div class="product-info">
        <h3>Áo croptop</h3>
        <p class="product-price">45.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Áo croptop">
            <input type="hidden" name="gia" value="45000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-55kg)</option>
                    <option value="XL">XL (55kg-60kg)</option>
                </select>
              </div>
              <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Áo croptop', 450000)">Thêm vào giỏ hàng</button>
              </div>
            </form>
          </div>
        </div>

        <div class="product-container">
          <img src="img/12.jpg" alt="Đầm lụa" class="product-image">
          <div class="product-info">
            <h3>Đầm lụa</h3>
            <p class="product-price">400.000 VNĐ</p>
           
            <form action="giohang.php" method="POST">
              <input type="hidden" name="ten_sp" value="Đầm lụa">
              <input type="hidden" name="gia" value="400000">
              <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-55kg)</option>
                    <option value="XL">XL (55kg-60kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                 <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                 <button class="btn" onclick="addToCart('Đầm lụa', 400000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/13.jpg" alt="Mysterious" class="product-image">
    <div class="product-info">
        <h3>Mysterious grey</h3>
        <p class="product-price">150.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Mysterious">
            <input type="hidden" name="gia" value="150000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-55kg)</option>
                    <option value="XL">XL (55kg-60kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Áo mysterious grey', 150000)">Thêm vào giỏ hàng</button>
            </div> 
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/14.jpg" alt="Đầm dạ hội" class="product-image">
    <div class="product-info">
        <h3>Đầm dạ hội</h3>
        <p class="product-price">1.500.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Đầm dạ hội">
            <input type="hidden" name="gia" value="1500000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-53kg)</option>
                    <option value="XL">XL (53kg-60kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Đầm dạ hội', 1500000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/15.jpg" alt="Áo" class="product-image">
    <div class="product-info">
        <h3>Áo</h3>
        <p class="product-price">400.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Áo">
            <input type="hidden" name="gia" value="400000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (44kg-50kg)</option>
                    <option value="L">L (51kg-53kg)</option>
                    <option value="XL">XL (53kg-60kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Áo ', 400000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

        <div class="product-container">
          <img src="img/16.jpg" alt="Đầm đen họa tiết" class="product-image">
          <div class="product-info">
            <h3>Đầm đen họa tiết</h3>
            <p class="product-price">150.000 VNĐ</p>
           
            <form action="giohang.php" method="POST">
              <input type="hidden" name="ten_sp" value="Đầm đen họa tiết">
              <input type="hidden" name="gia" value="150000">
              <div class="size-selector">
                <select name="size" required class="size-input">
                  <option value="">Chọn size</option>
                  <option value="S">S (40kg-43kg)</option>
                  <option value="M">M (42kg-48kg)</option>
                  <option value="L">L (48kg-53kg)</option>
                  <option value="XL">XL (53kg-56kg)</option>
                </select>
              </div>
              <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Đầm đen họa tiết', 150000)">Thêm vào giỏ hàng</button>
              </div>
            </form>
          </div>
        </div>

        <div class="product-container">
          <img src="img/17.jpg" alt="Đầm cổ yếm đính đá" class="product-image">
          <div class="product-info">
            <h3>Đầm cổ yếm đính đá</h3>
            <p class="product-price">700.000 VNĐ</p>
           
            <form action="giohang.php" method="POST">
              <input type="hidden" name="ten_sp" value="Đầm cổ yếm đính đá">
              <input type="hidden" name="gia" value="700000">
              <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-43kg)</option>
                    <option value="M">M (42kg-48kg)</option>
                    <option value="L">L (48kg-53kg)</option>
                    <option value="XL">XL (53kg-56kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
            <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
            <button class="btn" onclick="addToCart('Đầm cổ yếm đính đá', 700000)">Thêm vào giỏ hàng</button>
            </div>
            </form>
    </div>
</div>

<div class="product-container">
    <img src="img/18.jpg" alt="Áo thun cổ V" class="product-image">
    <div class="product-info">
        <h3>Áo thun cổ V</h3>
        <p class="product-price">65.000 VNĐ</p>
        
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Áo thun cổ V">
            <input type="hidden" name="gia" value="65000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-45kg)</option>
                    <option value="M">M (45kg-48kg)</option>
                    <option value="L">L (48kg-53kg)</option>
                    <option value="XL">XL (53kg-56kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Áo thun cổ V', 65000)">Thêm vào giỏ hàng</button>
            </div>
        </form>
    </div>
</div>

<div class="product-container">
    <img src="img/19.jpg" alt="Đầm" class="product-image">
    <div class="product-info">
        <h3>Đầm </h3>
        <p class="product-price">300.000 VN</p>
       
        <form action="giohang.php" method="POST">
            <input type="hidden" name="ten_sp" value="Đầm">
            <input type="hidden" name="gia" value="300000">
            <div class="size-selector">
                <select name="size" required class="size-input">
                    <option value="">Chọn size</option>
                    <option value="S">S (40kg-45kg)</option>
                    <option value="M">M (45kg-48kg)</option>
                    <option value="L">L (48kg-53kg)</option>
                    <option value="XL">XL (53kg-56kg)</option>
                </select>
            </div>
            <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Đầm', 300000)">Thêm vào giỏ hàng</button>
              </div>
            </form>
          </div>
        </div>

        <div class="product-container">
          <img src="img/20.jpg" alt="Đồ bộ" class="product-image">
          <div class="product-info">
            <h3>Đồ bộ</h3>
            <p class="product-price">75.000 VNĐ</p>
            
            <form action="giohang.php" method="POST">
              <input type="hidden" name="ten_sp" value="Đồ bộ">
              <input type="hidden" name="gia" value="75000">
              <div class="size-selector">
                <select name="size" required class="size-input">
                  <option value="">Chọn size</option>
                   <option value="S">S (40kg-45kg)</option>
                  <option value="M">M (45kg-48kg)</option>
                  <option value="L">L (48kg-53kg)</option>
                  <option value="XL">XL (53kg-58kg)</option>
                </select>
              </div>
              <div class="purchase-controls">
                <input type="number" name="so_luong" value="1" min="1" class="quantity-input">
                <button class="btn" onclick="addToCart('Đồ bộ', 75000)">Thêm vào giỏ hàng</button>
              </div>
            </form>
            </div>
        </div>
      </div>
    </section>
  </main
 <div id="checkout-form" style="display: none;">
    <h2>Thông tin thanh toán</h2>
    <form>
        <div class="form-group">
            <h3>Thông tin người nhận</h3>
            <label for="name">Tên:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required>
            
            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div class="form-group">
            <h3>Phương thức thanh toán</h3>
            <div class="payment-methods">
                <div class="payment-method">
                    <input type="radio" id="cod" name="payment" value="cod" checked>
                    <label for="cod">Thanh toán khi nhận hàng (COD)</label>
                </div>
                
                <div class="payment-method">
                    <input type="radio" id="banking" name="payment" value="banking">
                    <label for="banking">Chuyển khoản ngân hàng</label>
                    <div class="banking-info" style="display: none;">
                        <p>Ngân hàng: VietComBank</p>
                        <p>Số tài khoản: 1234567890</p>
                        <p>Chủ tài khoản: SHOP THỜI TRANG PHUONGPHUONG</p>
                        <p>Nội dung: [Tên của bạn] thanh toán đơn hàng</p>
                        <img src="qr/banking-qr.jpg" alt="QR Ngân hàng" class="qr-code">
                    </div>
                </div>
                
                <div class="payment-method">
                    <input type="radio" id="momo" name="payment" value="momo">
                    <label for="momo">Ví MoMo</label>
                    <div class="momo-info" style="display: none;">
                        <p>Số điện thoại: 0123456789</p>
                        <p>Tên: SHOP THỜI TRANG PHUONGPHUONG</p>
                        <p>Nội dung: [Tên của bạn] thanh toán đơn hàng</p>
                        <img src="qr/momo-qr.jpg" alt="QR MoMo" class="qr-code">
                    </div>
                </div>

                <div class="payment-method">
                    <input type="radio" id="vnpay" name="payment" value="vnpay">
                    <label for="vnpay">VNPay</label>
                    <div class="vnpay-info" style="display: none;">
                        <p>Quét mã QR để thanh toán qua VNPay</p>
                        <img src="qr/vnpay-qr.jpg" alt="QR VNPay" class="qr-code">
                    </div>
                </div>
            </div>
        </div>

        <button class="btn" onclick="checkout()">Xác nhận thanh toán</button>
    </form>
</div>
<div id="checkout-info" style="display: none;">
    <h2>Thông tin đơn hàng</h2>
    <p id="name-display"></p>
    <p id="phone-display"></p>
    <p id="address-display"></p>
    <div id="order-details"></div>
    <p id="order-total"></p>
</div>

<div class="cart">
    <h2>Giỏ hàng</h2>
    <div id="cartItems"></div>
    <div class="cart-total">Tổng: <span id="cartTotal">0 VNĐ</span></div>
    <button class="btn" onclick="showCheckoutForm()">Thanh toán</button>
</div>

<script>
    var cartItems = [];

    function addToCart(productName, price) {
        event.preventDefault();
        
        var form = event.target.closest('form');
        var sizeSelect = form.querySelector('select[name="size"]');
        var quantityInput = form.querySelector('input[name="so_luong"]');
        
        var selectedSize = sizeSelect.value;
        var quantity = parseInt(quantityInput.value);
        
        if (!selectedSize) {
            alert('Vui lòng chọn size trước khi thêm vào giỏ hàng');
            return;
        }
        
        if (quantity < 1) {
            alert('Số lượng phải lớn hơn 0');
            return;
        }
        
        cartItems.push({ 
            name: productName, 
            price: price,
            size: selectedSize,
            quantity: quantity
        });
        updateCart();
        alert('Đã thêm sản phẩm vào giỏ hàng!');
    }

    function updateCart() {
        var cartItemsElement = document.getElementById("cartItems");
        var cartTotalElement = document.getElementById("cartTotal");

        cartItemsElement.innerHTML = "";
        var total = 0;

        for (var i = 0; i < cartItems.length; i++) {
            var item = cartItems[i];
            var itemTotal = item.price * item.quantity;
            var itemElement = document.createElement("div");
            itemElement.classList.add("cart-item");
            itemElement.innerHTML = `
                ${item.name} - Size ${item.size} - Số lượng: ${item.quantity} - ${formatPrice(itemTotal)} VNĐ
                <button class="remove-btn" onclick="removeFromCart(${i})">X</button>
            `;
            cartItemsElement.appendChild(itemElement);

            total += itemTotal;
        }

        cartTotalElement.textContent = formatPrice(total) + " VNĐ";
    }

    function formatPrice(price) {
        return price.toLocaleString("vi-VN");
    }

    function showCheckoutForm() {
        var form = document.getElementById("checkout-form");
        form.style.display = "block";
    }

    function checkout() {
        event.preventDefault(); // Ngăn form submit mặc định
        
        var name = document.getElementById("name").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var paymentMethod = document.querySelector('input[name="payment"]:checked').value;

        // Kiểm tra thông tin đầu vào
        if (!name || !phone || !address) {
            alert("Vui lòng điền đầy đủ thông tin!");
            return;
        }

        // Kiểm tra giỏ hàng
        if (cartItems.length === 0) {
            alert("Giỏ hàng của bạn đang trống!");
            return;
        }

        // Tạo object chứa thông tin đơn hàng
        var orderData = {
            customerInfo: {
                name: name,
                phone: phone,
                address: address,
                paymentMethod: paymentMethod
            },
            items: cartItems,
            total: calculateTotal()
        };

        // Gửi đơn hàng đến server
        fetch('process_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Hiển thị thông báo thành công
                alert("Đặt hàng thành công! Mã đơn hàng của bạn là: " + data.orderCode);
                
                // Xóa giỏ hàng
                cartItems = [];
                updateCart();
                
                // Ẩn form thanh toán
                document.getElementById("checkout-form").style.display = "none";
                
                // Hiển thị thông tin đơn hàng
                showOrderConfirmation(orderData);
            } else {
                alert("Có lỗi xảy ra: " + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Có lỗi xảy ra khi xử lý đơn hàng!");
        });
    }

    function calculateTotal() {
        return cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    function showOrderConfirmation(orderData) {
        const confirmationDiv = document.getElementById("checkout-info");
        confirmationDiv.style.display = "block";
        
        let paymentInfo = "";
        switch(orderData.customerInfo.paymentMethod) {
            case 'cod':
                paymentInfo = "Thanh toán khi nhận hàng (COD)";
                break;
            case 'banking':
                paymentInfo = `Chuyển khoản ngân hàng<br>
                              Ngân hàng: VietComBank<br>
                              Số tài khoản: 1234567890<br>
                              Chủ tài khoản: SHOP THỜI TRANG PHUONGPHUONG<br>
                              Nội dung: ${orderData.customerInfo.name} thanh toán đơn hàng`;
                break;
            case 'momo':
                paymentInfo = `Thanh toán qua Ví MoMo<br>
                              Số điện thoại: 0123456789<br>
                              Tên: SHOP THỜI TRANG PHUONGPHUONG<br>
                              Nội dung: ${orderData.customerInfo.name} thanh toán đơn hàng`;
                break;
        }

        confirmationDiv.innerHTML = `
            <h2>Đơn hàng đã được đặt thành công!</h2>
            <div class="order-confirmation">
                <h3>Thông tin người nhận:</h3>
                <p>Tên: ${orderData.customerInfo.name}</p>
                <p>Số điện thoại: ${orderData.customerInfo.phone}</p>
                <p>Địa chỉ: ${orderData.customerInfo.address}</p>
                
                <h3>Chi tiết đơn hàng:</h3>
                ${orderData.items.map(item => `
                    <p>${item.name} - Size ${item.size} - Số lượng: ${item.quantity} - ${formatPrice(item.price * item.quantity)} VNĐ</p>
                `).join('')}
                
                <h3>Tổng tiền: ${formatPrice(orderData.total)} VNĐ</h3>
                
                <h3>Phương thức thanh toán:</h3>
                <div class="payment-info">
                    ${paymentInfo}
                </div>
            </div>
        `;
    }

    // Hàm lọc sản phẩm
    function filterProducts() {
        var nameFilter = document.getElementById("nameFilter").value.toLowerCase();
        var priceRange = document.getElementById("priceFilter").value;
        
        var productContainers = document.getElementsByClassName("product-container");
        
        for (var i = 0; i < productContainers.length; i++) {
            var container = productContainers[i];
            var productName = container.querySelector("h3").textContent.toLowerCase();
            var priceText = container.querySelector(".product-price").textContent;
            var price = parseInt(priceText.replace(/[^\d]/g, '')); // Chuyển đổi giá thành số
            
            var showProduct = true;
            
            // Lọc theo tên
            if (nameFilter && !productName.includes(nameFilter)) {
                showProduct = false;
            }
            
            // Lọc theo khoảng giá
            if (priceRange) {
                var [minPrice, maxPrice] = priceRange.split('-').map(p => p ? parseInt(p) : null);
                if (maxPrice && (price < minPrice || price > maxPrice)) {
                    showProduct = false;
                } else if (!maxPrice && price < minPrice) {
                    showProduct = false;
                }
            }
            
            container.style.display = showProduct ? "block" : "none";
        }
    }

    function removeFromCart(index) {
        cartItems.splice(index, 1);
        updateCart();
    }

    // Thêm hàm xử lý rating
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo rating cho tất cả sản phẩm
        const ratingContainers = document.querySelectorAll('.rating');
        
        ratingContainers.forEach(container => {
            const stars = container.querySelectorAll('.star');
            const ratingCount = container.querySelector('.rating-count');
            let currentRating = 0;
            let totalRatings = 0;
            
            // Xử lý hover
            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const rating = this.dataset.rating;
                    highlightStars(stars, rating);
                });
                
                star.addEventListener('mouseout', function() {
                    highlightStars(stars, currentRating);
                });
                
                // Xử lý click
                star.addEventListener('click', function() {
                    const rating = this.dataset.rating;
                    currentRating = rating;
                    totalRatings++;
                    ratingCount.textContent = `(${totalRatings})`;
                    highlightStars(stars, rating);
                    
                    // Có thể thêm AJAX call để lưu rating vào database
                    saveRating(container.dataset.productId, rating);
                });
            });
        });
    });

    function highlightStars(stars, rating) {
        stars.forEach(star => {
            const starRating = star.dataset.rating;
            if (starRating <= rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }

    function saveRating(productId, rating) {
        // Giả lập lưu rating
        console.log(`Saved rating ${rating} for product ${productId}`);
        // Trong thực tế, bạn sẽ gửi AJAX request đến server
        // để lưu rating vào database
    }

    // Thêm hàm mới để xử lý hiển thị thông tin thanh toán
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethods = document.querySelectorAll('input[name="payment"]');
        const bankingInfo = document.querySelector('.banking-info');
        const momoInfo = document.querySelector('.momo-info');
        const vnpayInfo = document.querySelector('.vnpay-info');

        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                // Ẩn tất cả thông tin thanh toán
                bankingInfo.style.display = 'none';
                momoInfo.style.display = 'none';
                vnpayInfo.style.display = 'none';

                // Hiển thị thông tin tương ứng
                if (this.value === 'banking') {
                    bankingInfo.style.display = 'block';
                } else if (this.value === 'momo') {
                    momoInfo.style.display = 'block';
                } else if (this.value === 'vnpay') {
                    vnpayInfo.style.display = 'block';
                }
            });
        });
    });
</script>