<!DOCTYPE html>
<html>
<head>
    <title>Giỏ hàng - Shop Thời Trang PHuongPhuong</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
            gap: 20px;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        .item-price {
            color: #e44d26;
            font-weight: bold;
            margin: 5px 0;
        }

        .item-size {
            color: #666;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            background: #ff69b4;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .remove-btn {
            background: #ff4444;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cart-total {
            margin-top: 20px;
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
        }

        .checkout-btn {
            background: linear-gradient(145deg, #4CAF50, #45a049);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1.1em;
            margin-top: 20px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            background: linear-gradient(145deg, #45a049, #4CAF50);
            transform: translateY(-2px);
        }

        .empty-cart {
            text-align: center;
            padding: 50px;
            color: #666;
        }

        .continue-shopping {
            display: inline-block;
            background: #ff69b4;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            margin-top: 20px;
        }

        .navigation {
            background: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }

        .nav-link {
            color: #333;
            text-decoration: none;
            padding: 8px 20px;
            margin: 0 10px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: #ff69b4;
            color: white;
        }

        .nav-link.active {
            background: #ff69b4;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Add navigation links at the top -->
    <div class="navigation">
        <a href="index.php" class="nav-link">Trang chủ</a>
        <a href="sanpham.php" class="nav-link">Sản phẩm</a>
        <a href="Giỏhang.php" class="nav-link active">Giỏ hàng</a>
    </div>
    <div class="cart-container">
        <h1>Giỏ hàng của bạn</h1>
        <?php
        session_start();

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo '<div class="empty-cart">
                    <h2>Giỏ hàng trống</h2>
                    <p>Bạn chưa thêm sản phẩm nào vào giỏ hàng.</p>
                    <a href="sanpham.php" class="continue-shopping">Tiếp tục mua sắm</a>
                  </div>';
        } else {
            $total = 0;
            foreach ($_SESSION['cart'] as $key => $item) {
                $subtotal = $item['gia'] * $item['so_luong'];
                $total += $subtotal;
                ?>
                <div class="cart-item">
                    <img src="img/<?php echo $key + 1; ?>.jpg" alt="<?php echo $item['ten_sp']; ?>">
                    <div class="item-details">
                        <div class="item-name"><?php echo $item['ten_sp']; ?></div>
                        <div class="item-price"><?php echo number_format($item['gia'], 0, ',', '.'); ?> VNĐ</div>
                        <div class="item-size">Size: <?php echo $item['size']; ?></div>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateQuantity(<?php echo $key; ?>, 'decrease')">-</button>
                        <input type="number" class="quantity-input" value="<?php echo $item['so_luong']; ?>" 
                               min="1" onchange="updateQuantity(<?php echo $key; ?>, 'input', this.value)">
                        <button class="quantity-btn" onclick="updateQuantity(<?php echo $key; ?>, 'increase')">+</button>
                    </div>
                    <button class="remove-btn" onclick="removeItem(<?php echo $key; ?>)">Xóa</button>
                </div>
                <?php
            }
            ?>
            <div class="cart-total">
                Tổng cộng: <?php echo number_format($total, 0, ',', '.'); ?> VNĐ
            </div>
            <button class="checkout-btn" onclick="window.location.href='thanhtoan.php'">Tiến hành thanh toán</button>
            <?php
        }
        ?>
    </div>

    <script>
        function updateQuantity(key, action, value = null) {
            let url = 'update_cart.php';
            let data = {
                key: key,
                action: action
            };
            
            if (value !== null) {
                data.value = value;
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        }

        function removeItem(key) {
            if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        key: key,
                        action: 'remove'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html><?php
session_start();

// Nhận dữ liệu JSON từ request
$data = json_decode(file_get_contents('php://input'), true);

$response = ['success' => false, 'message' => ''];

if (isset($data['key']) && isset($data['action'])) {
    $key = $data['key'];
    $action = $data['action'];

    if (isset($_SESSION['cart'][$key])) {
        switch ($action) {
            case 'increase':
                $_SESSION['cart'][$key]['so_luong']++;
                $response['success'] = true;
                break;

            case 'decrease':
                if ($_SESSION['cart'][$key]['so_luong'] > 1) {
                    $_SESSION['cart'][$key]['so_luong']--;
                    $response['success'] = true;
                } else {
                    $response['message'] = 'Số lượng không thể nhỏ hơn 1';
                }
                break;

            case 'input':
                if (isset($data['value'])) {
                    $value = intval($data['value']);
                    if ($value > 0) {
                        $_SESSION['cart'][$key]['so_luong'] = $value;
                        $response['success'] = true;
                    } else {
                        $response['message'] = 'Số lượng không hợp lệ';
                    }
                }
                break;

            case 'remove':
                unset($_SESSION['cart'][$key]);
                $response['success'] = true;
                break;
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
<?php
session_start();

// Thay đổi phần xử lý thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    $ten_sp = $_POST['ten_sp'];
    $gia = $_POST['gia'];
    $size = $_POST['size'];
    $so_luong = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;
    $ma_sp = $_POST['ma_sp']; // Thêm mã sản phẩm
    
    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    $product_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['ma_sp'] === $ma_sp && $item['size'] === $size) {
            $item['so_luong'] += $so_luong;
            $product_exists = true;
            break;
        }
    }
    
    // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
    if (!$product_exists) {
        $_SESSION['cart'][] = array(
            'ma_sp' => $ma_sp,
            'ten_sp' => $ten_sp,
            'gia' => $gia,
            'size' => $size,
            'so_luong' => $so_luong
        );
    }
    
    // Chuyển hướng về trang giỏ hàng
    header('Location: Giỏhang.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Giỏ hàng - Shop Thời Trang PHuongPhuong</title>
    <style>
        /* ... existing styles ... */
        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
            gap: 20px;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .item-price {
            color: #e44d26;
            font-weight: bold;
            margin: 5px 0;
        }

        .item-size {
            color: #666;
            margin: 5px 0;
        }

        .item-quantity {
            color: #666;
            margin: 5px 0;
        }

        .subtotal {
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Add navigation links at the top -->
    <div class="navigation">
        <a href="index.php" class="nav-link">Trang chủ</a>
        <a href="sanpham.php" class="nav-link">Sản phẩm</a>
        <a href="Giỏhang.php" class="nav-link active">Giỏ hàng</a>
    </div>
    <div class="cart-container">
        <h1>Giỏ hàng của bạn</h1>
        <?php
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo '<div class="empty-cart">
                    <h2>Giỏ hàng trống</h2>
                    <p>Bạn chưa thêm sản phẩm nào vào giỏ hàng.</p>
                    <a href="sanpham.php" class="continue-shopping">Tiếp tục mua sắm</a>
                  </div>';
        } else {
            $total = 0;
            foreach ($_SESSION['cart'] as $key => $item) {
                $subtotal = $item['gia'] * $item['so_luong'];
                $total += $subtotal;
                ?>
                <div class="cart-item">
                    <img src="img/<?php echo $item['hinh_anh']; ?>" alt="<?php echo $item['ten_sp']; ?>">
                    <div class="item-details">
                        <div class="item-name"><?php echo $item['ten_sp']; ?></div>
                        <div class="item-price">Giá: <?php echo number_format($item['gia'], 0, ',', '.'); ?> VNĐ</div>
                        <div class="item-size">Size: <?php echo $item['size']; ?></div>
                        <div class="item-quantity">
                            Số lượng: 
                            <button onclick="updateQuantity(<?php echo $key; ?>, 'decrease')" class="quantity-btn">-</button>
                            <input type="number" value="<?php echo $item['so_luong']; ?>" 
                                   min="1" class="quantity-input" 
                                   onchange="updateQuantity(<?php echo $key; ?>, 'input', this.value)">
                            <button onclick="updateQuantity(<?php echo $key; ?>, 'increase')" class="quantity-btn">+</button>
                        </div>
                        <div class="subtotal">
                            Thành tiền: <?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ
                        </div>
                    </div>
                    <button class="remove-btn" onclick="removeItem(<?php echo $key; ?>)">Xóa</button>
                </div>
                <?php
            }
            ?>
            <div class="cart-total">
                Tổng cộng: <?php echo number_format($total, 0, ',', '.'); ?> VNĐ
            </div>
            <button class="checkout-btn" onclick="window.location.href='thanhtoan.php'">Tiến hành thanh toán</button>
            <?php
        }
        ?>
    </div>

    <script>
        // ... existing JavaScript functions ...
    </script>
</body>
</html>
