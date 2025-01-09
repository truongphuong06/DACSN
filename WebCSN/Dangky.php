<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ban_hang");

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = mysqli_real_escape_string($conn, $_POST['hoten']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tendangnhap = mysqli_real_escape_string($conn, $_POST['tendangnhap']);
    $matkhau = mysqli_real_escape_string($conn, $_POST['matkhau']);
    $xacnhanmatkhau = mysqli_real_escape_string($conn, $_POST['xacnhanmatkhau']);
    
    // Kiểm tra mật khẩu xác nhận
    if ($matkhau !== $xacnhanmatkhau) {
        $loi = "Mật khẩu xác nhận không khớp!";
    } else {
        // Kiểm tra tên đăng nhập
        $check_tendangnhap = mysqli_query($conn, "SELECT * FROM nguoi_dung WHERE tendangnhap='$tendangnhap'");
        if (mysqli_num_rows($check_tendangnhap) > 0) {
            $loi = "Tên đăng nhập đã tồn tại!";
        } else {
            // Kiểm tra email
            $check_email = mysqli_query($conn, "SELECT * FROM nguoi_dung WHERE email='$email'");
            if (mysqli_num_rows($check_email) > 0) {
                $loi = "Email đã được sử dụng!";
            } else {
                // Câu lệnh INSERT
                $sql = "INSERT INTO nguoi_dung (hoten, email, tendangnhap, matkhau) 
                VALUES ('$hoten', '$email', '$tendangnhap', '$matkhau')";
                
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['thanhcong'] = "Đăng ký thành công!";
                    header("Location: dangnhap.php");
                    exit();
                } else {
                    $loi = "Đăng ký thất bại: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Đăng ký tài khoản</h2>
            <?php if(isset($loi)) { ?>
                <div style="color: red; margin-bottom: 10px; text-align: center;">
                    <?php echo $loi; ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="hoten">Họ và tên:</label>
                <input type="text" id="hoten" name="hoten" required 
                    value="<?php echo isset($_POST['hoten']) ? htmlspecialchars($_POST['hoten']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="tendangnhap">Tên đăng nhập:</label>
                <input type="text" id="tendangnhap" name="tendangnhap" required
                    value="<?php echo isset($_POST['tendangnhap']) ? htmlspecialchars($_POST['tendangnhap']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="matkhau">Mật khẩu:</label>
                <input type="password" id="matkhau" name="matkhau" required>
            </div>
            <div class="form-group">
                <label for="xacnhanmatkhau">Xác nhận mật khẩu:</label>
                <input type="password" id="xacnhanmatkhau" name="xacnhanmatkhau" required>
            </div>
            <button type="submit">Đăng ký</button>
            <p style="text-align: center; margin-top: 20px;">
                Đã có tài khoản? <a href="dangnhap.php">Đăng nhập</a>
            </p>
        </form>
    </div>
</body>
</html>