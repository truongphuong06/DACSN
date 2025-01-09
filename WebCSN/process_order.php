<?php
header('Content-Type: application/json');

try {
    // Nhận dữ liệu từ request
    $orderData = json_decode(file_get_contents('php://input'), true);
    
    // Kết nối database
    $conn = new mysqli("localhost", "username", "password", "database_name");
    
    if ($conn->connect_error) {
        throw new Exception("Kết nối database thất bại");
    }
    
    // Bắt đầu transaction
    $conn->begin_transaction();
    
    try {
        // Tạo mã đơn hàng
        $orderCode = 'DH' . time();
        
        // Lưu thông tin khách hàng
        $stmt = $conn->prepare("INSERT INTO orders (order_code, customer_name, phone, address, payment_method, total_amount, status, payment_status) VALUES (?, ?, ?, ?, ?, ?, 'pending', 'unpaid')");
        $stmt->bind_param("sssssd", 
            $orderCode,
            $orderData['customerInfo']['name'],
            $orderData['customerInfo']['phone'],
            $orderData['customerInfo']['address'],
            $orderData['customerInfo']['paymentMethod'],
            $orderData['total']
        );
        $stmt->execute();
        $orderId = $conn->insert_id;
        
        // Tạo payment URL nếu thanh toán online
        $paymentUrl = null;
        if ($orderData['customerInfo']['paymentMethod'] === 'online') {
            // Tạo URL thanh toán (ví dụ với VNPay)
            $paymentUrl = createPaymentUrl([
                'orderId' => $orderCode,
                'amount' => $orderData['total'],
                'orderInfo' => "Thanh toan don hang " . $orderCode
            ]);
            
            // Cập nhật payment_url vào database
            $stmt = $conn->prepare("UPDATE orders SET payment_url = ? WHERE id = ?");
            $stmt->bind_param("si", $paymentUrl, $orderId);
            $stmt->execute();
        }
        
        // Lưu chi tiết đơn hàng
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, size, quantity, price) VALUES (?, ?, ?, ?, ?)");
        
        foreach ($orderData['items'] as $item) {
            $stmt->bind_param("issid",
                $orderId,
                $item['name'],
                $item['size'],
                $item['quantity'],
                $item['price']
            );
            $stmt->execute();
        }
        
        // Commit transaction
        $conn->commit();
        
        // Trả về kết quả thành công
        echo json_encode([
            'success' => true,
            'orderCode' => $orderCode,
            'paymentUrl' => $paymentUrl,
            'message' => 'Đặt hàng thành công'
        ]);
        
    } catch (Exception $e) {
        // Rollback nếu có lỗi
        $conn->rollback();
        throw $e;
    }
    
} catch (Exception $e) {
    // Trả về lỗi
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?> 