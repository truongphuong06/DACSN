<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Cấu hình database
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); 
define('DB_PASS', '');
define('DB_NAME', 'ban_hang');

// Kết nối CSDL
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Sau khi đã có kết nối, thực hiện các truy vấn
// Lấy danh sách người dùng
$sql = "SELECT * FROM nguoi_dung ORDER BY ngaytao DESC";
$result = $conn->query($sql);
$danhSachNguoiDung = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Lấy danh sách sản phẩm
$sql = "SELECT * FROM san_pham ORDER BY id DESC";
$result = $conn->query($sql);
$san_pham_list = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Lấy danh sách đơn hàng
$sql = "SELECT dh.*, nd.hoten as ten_khach_hang 
        FROM don_hang dh 
        LEFT JOIN nguoi_dung nd ON dh.id_khach_hang = nd.id 
        ORDER BY dh.ngay_tao DESC";
$result = $conn->query($sql);
$don_hang_list = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Thêm hàm uploadImage ở đầu file
function uploadImage($file) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;
    
    // Kiểm tra định dạng file
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($file_extension, $allowed_types)) {
        throw new Exception("Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG, GIF");
    }
    
    // Kiểm tra kích thước file (giới hạn 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        throw new Exception("File ảnh không được vượt quá 5MB");
    }
    
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $target_file;
    } else {
        throw new Exception("Có lỗi xảy ra khi upload file");
    }
}
// Thêm vào đầu file PHP
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}
chmod('uploads', 0777);

// Thêm các API endpoints
if (isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    switch ($_POST['action']) {
        case 'xoa_nguoi_dung':
            try {
                $id = (int)$_POST['id'];
                $sql = "DELETE FROM nguoi_dung WHERE id = ? AND tendangnhap != 'quantrivien'";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    throw new Exception("Không thể xóa người dùng");
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;
            
            case 'lay_san_pham':
                try {
                    $id = (int)$_GET['id'];
                    $sql = "SELECT * FROM san_pham WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $sanPham = $result->fetch_assoc();
                    
                    echo json_encode($sanPham);
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                }
                exit;
            
        case 'them_san_pham':
        case 'sua_san_pham':
            try {
                $id = isset($_POST['chua_id']) ? (int)$_POST['chua_id'] : null;
                $tenSanPham = trim($_POST['ten_san_pham']);
                $danhMuc = trim($_POST['danh_muc']); 
                $gia = (float)$_POST['gia'];
                $soLuong = (int)$_POST['so_luong'];
                $moTa = trim($_POST['mo_ta']);
                $trangThai = (int)$_POST['trang_thai'];

                // Validate dữ liệu
                if (empty($tenSanPham) || empty($danhMuc) || $gia <= 0 || $soLuong < 0) {
                    throw new Exception("Vui lòng điền đầy đủ thông tin hợp lệ");
                }
                
                $hinhAnh = null;
                if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === 0) {
                    $hinhAnh = uploadImage($_FILES['hinh_anh']);
                }
                
                if ($id) {
                    // Cập nhật
                    $sql = "UPDATE san_pham SET 
                            ten_san_pham = ?, danh_muc = ?, gia = ?, 
                            so_luong = ?, mo_ta = ?, trang_thai = ?
                            " . ($hinhAnh ? ", hinh_anh = ?" : "") . "
                            WHERE id = ?";
                            
                    $stmt = $conn->prepare($sql);
                    if ($hinhAnh) {
                        $stmt->bind_param("ssdiissi", $tenSanPham, $danhMuc, $gia, $soLuong, $moTa, $trangThai, $hinhAnh, $id);
                    } else {
                        $stmt->bind_param("ssdissi", $tenSanPham, $danhMuc, $gia, $soLuong, $moTa, $trangThai, $id);
                    }
                } else {
                    // Thêm mới
                    $sql = "INSERT INTO san_pham (ten_san_pham, danh_muc, gia, so_luong, mo_ta, hinh_anh, trang_thai, ngay_tao) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssdiisi", $tenSanPham, $danhMuc, $gia, $soLuong, $moTa, $hinhAnh, $trangThai);
                }
                
                if ($stmt->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    throw new Exception("Không thể lưu sản phẩm: " . $stmt->error);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;
            
        case 'xoa_san_pham':
            try {
                $id = (int)$_POST['id'];
                $sql = "DELETE FROM san_pham WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    throw new Exception("Không thể xóa sản phẩm");
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;
            
        case 'cap_nhat_trang_thai_don_hang':
            try {
                $id = (int)$_POST['id'];
                $trangThai = (int)$_POST['trang_thai'];
                
                $sql = "UPDATE don_hang SET trang_thai = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $trangThai, $id);
                
                if ($stmt->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    throw new Exception("Không thể cập nhật trạng thái");
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;
    }
}

// Xử lý đăng xuất
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: dangnhapAdmin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Trị - Bán Hàng</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
/* Reset và biến CSS */
:root {
    --primary-color: #4a90e2;
    --secondary-color: #f5f6fa;
    --danger-color: #e74c3c;
    --success-color: #2ecc71;
    --warning-color: #f1c40f;
    --text-color: #2c3e50;
    --border-color: #e1e8ef;
    --sidebar-width: 250px;
    --header-height: 60px;
    --border-radius: 8px;
    --transition: all 0.3s ease;
    --box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

/* Cập nhật style cho container chính */
.table-container {
    padding: 20px;
    margin: 20px;
    background: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

/* Cập nhật header section */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--border-color);
}

.section-header h2 {
    font-size: 24px;
    color: var(--text-color);
    margin: 0;
}

/* Cập nhật bảng dữ liệu */
.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 10px;
}

.data-table thead th {
    background: var(--primary-color);
    color: #fff;
    padding: 15px;
    font-weight: 600;
    text-align: left;
    font-size: 14px;
    border: none;
    position: sticky;
    top: 0;
    z-index: 10;
}

.data-table td {
    padding: 12px 15px;
    font-size: 14px;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
}

/* Cập nhật style cho buttons */
.btn {
    padding: 8px 16px;
    border-radius: var(--border-radius);
    font-weight: 500;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: var(--transition);
    border: none;
}

/* Nút thêm mới */
.btn-add-san-pham {
    background: var(--success-color);
    color: white;
}

.btn-add-san-pham:hover {
    background: #27ae60;
    transform: translateY(-2px);
}

/* Nút sửa */
.btn-warning {
    background: var(--warning-color);
    color: #000;
}

.btn-warning:hover {
    background: #f39c12;
}

/* Nút xóa */
.btn-danger {
    background: var(--danger-color);
    color: white;
}

.btn-danger:hover {
    background: #c0392b;
}

/* Style cho select trong bảng */
.trang-thai-san-pham {
    padding: 6px 10px;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    font-size: 14px;
    background: white;
    min-width: 120px;
}

/* Style cho ô tìm kiếm */
.search-container {
    position: relative;
}

.search-input {
    padding: 8px 12px 8px 35px;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    font-size: 14px;
    width: 250px;
    transition: var(--transition);
}

.search-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
    outline: none;
}

.search-icon {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-color);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .section-header {
        flex-direction: column;
        gap: 15px;
    }
    
    .search-input {
        width: 100%;
    }
    
    .data-table {
        display: block;
        overflow-x: auto;
    }
}
/* Thêm style cho modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.modal-content {
    position: relative;
    background-color: #fff;
    margin: 50px auto;
    padding: 20px;
    width: 90%;
    max-width: 600px;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.modal-title-container {
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border-color);
}

.form-container {
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    font-size: 14px;
}

.form-group textarea {
    min-height: 100px;
}

.form-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    margin-top: 20px;
}

.image-preview {
    margin-top: 10px;
    max-width: 200px;
}

.image-preview img {
    max-width: 100%;
    height: auto;
}

.required {
    color: var(--danger-color);
    margin-left: 3px;
}

.action-buttons {
    display: flex;
    gap: 10px;
    align-items: center;
}

.btn-info {
    background: var(--primary-color);
    color: white;
}

.btn-info:hover {
    background: #357abd;
    transform: translateY(-2px);
}

</style>   
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="admin-avatar">
            <i class="fas fa-user-shield"></i>
        </div>
        <h2>Quản Trị Viên</h2>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="index.php">
                <i class="fas fa-home"></i>
                <span>Trang chủ</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="?action=logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</div>

<div class="table-container">
    <!-- Bảng quản lý người dùng -->
<div class="table-container">
    <div class="section-header">
        <h2>Quản lý người dùng</h2>
        <div class="search-container">
            <input type="text" id="timKiemNguoiDung" class="search-input" placeholder="Tìm kiếm người dùng">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Tên đăng nhập</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($danhSachNguoiDung as $nguoiDung): ?>
            <tr>
                <td><?php echo htmlspecialchars($nguoiDung['tendangnhap']); ?></td>
                <td><?php echo htmlspecialchars($nguoiDung['hoten']); ?></td>
                <td><?php echo htmlspecialchars($nguoiDung['email']); ?></td>
                <td><?php echo $nguoiDung['tendangnhap'] == 'quantrivien' ? 'Quản trị viên' : 'Người dùng'; ?></td>
                <td><?php echo isset($nguoiDung['ngaytao']) ? date('d/m/Y H:i', strtotime($nguoiDung['ngaytao'])) : ''; ?></td>
                <td>
                    <?php if($nguoiDung['tendangnhap'] != 'quantrivien'): ?>
                        <button class="btn btn-danger xoa-nguoi-dung" data-id="<?php echo $nguoiDung['id']; ?>">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="table-container">
<!-- HTML structure -->
<!-- Bảng quản lý sản phẩm -->
<div class="table-container">
    <div class="section-header">
        <h2>Quản lý sản phẩm</h2>
        <div class="action-buttons">
            <a href="sanpham.php" class="btn btn-info">
                <i class="fas fa-eye"></i> Xem trang sản phẩm
            </a>
            <button class="btn btn-primary btn-add-san-pham">
                <i class="fas fa-plus"></i> Thêm sản phẩm
            </button>
        </div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($san_pham_list as $san_pham): ?>
            <tr>
                <td><?php echo htmlspecialchars($san_pham['ten_san_pham']); ?></td>
                <td><?php echo htmlspecialchars($san_pham['danh_muc']); ?></td>
                <td><?php echo number_format($san_pham['gia'], 0, ',', '.'); ?>đ</td>
                <td><?php echo htmlspecialchars($san_pham['so_luong']); ?></td>
                <td class="content-text"><?php echo htmlspecialchars($san_pham['mo_ta']); ?></td>
                <td>
                    <?php if($san_pham['hinh_anh']): ?>
                        <img src="<?php echo htmlspecialchars($san_pham['hinh_anh']); ?>" alt="Sản phẩm" class="product-image">
                    <?php endif; ?>
                </td>
                <td>
                    <select class="trang-thai-san-pham" data-id="<?php echo $san_pham['id']; ?>">
                        <option value="1" <?php echo $san_pham['trang_thai'] == 1 ? 'selected' : ''; ?>>Còn hàng</option>
                        <option value="0" <?php echo $san_pham['trang_thai'] == 0 ? 'selected' : ''; ?>>Hết hàng</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-warning sua-san-pham" data-id="<?php echo $san_pham['id']; ?>">
                        <i class="fas fa-edit"></i> Sửa
                    </button>
                    <button class="btn btn-danger xoa-san-pham" data-id="<?php echo $san_pham['id']; ?>">
                        <i class="fas fa-trash"></i> Xóa
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modalChua" class="modal">
    <div class="modal-content">
        <div class="modal-title-container">
            <h2 id="modalTitle">Thêm/Sửa sản phẩm</h2>
        </div>
        
        <div class="form-container">
        <form id="formChua" enctype="multipart/form-data">
    <input type="hidden" id="chua_id" name="chua_id">
    
    <div class="form-group">
        <label>Tên sản phẩm:<span class="required">*</span></label>
        <input type="text" id="ten_san_pham" name="ten_san_pham" required>
    </div>

    <div class="form-group">
        <label>Danh mục:<span class="required">*</span></label>
        <input type="text" id="danh_muc" name="danh_muc" required>
    </div>

    <div class="form-group">
        <label>Giá:<span class="required">*</span></label>
        <input type="number" id="gia" name="gia" required>
    </div>

    <div class="form-group">
        <label>Số lượng:<span class="required">*</span></label>
        <input type="number" id="so_luong" name="so_luong" required>
    </div>

    <div class="form-group">
        <label>Mô tả:</label>
        <textarea id="mo_ta" name="mo_ta"></textarea>
    </div>

    <div class="form-group">
        <label>Hình ảnh:</label>
        <div class="image-upload-container">
            <input type="file" id="hinh_anh" name="hinh_anh" accept="image/*">
            <div id="image-preview" class="image-preview"></div>
        </div>
    </div>

    <div class="form-group">
        <label>Trạng thái:</label>
        <select id="trang_thai" name="trang_thai" class="form-control">
            <option value="1" selected>Còn hàng</option>
            <option value="0">Hết hàng</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary" id="btnSave">
            <i class="fas fa-save"></i> Lưu
        </button>
        <button type="button" id="remove-image" class="btn btn-danger" style="display: none;">
            <i class="fas fa-trash"></i> Xóa ảnh
        </button>
        <button type="button" class="btn btn-secondary close-modal">
            <i class="fas fa-times"></i> Hủy
        </button>
    </div>
</form>
        </div>
    </div>
</div>

<!-- B���ng quản lý đơn hàng -->
<div class="table-container">
    <div class="section-header">
        <h2>Quản lý đơn hàng</h2>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($don_hang_list as $don_hang): ?>
            <tr>
                <td><?php echo htmlspecialchars($don_hang['ma_don_hang']); ?></td>
                <td><?php echo htmlspecialchars($don_hang['ten_khach_hang']); ?></td>
                <td class="content-text"><?php echo htmlspecialchars($don_hang['san_pham']); ?></td>
                <td><?php echo number_format($don_hang['tong_tien'], 0, ',', '.'); ?>đ</td>
                <td><?php echo date('d/m/Y H:i', strtotime($don_hang['ngay_tao'])); ?></td>
                <td>
                    <select class="trang-thai-don-hang" data-id="<?php echo $don_hang['id']; ?>">
                        <option value="1" <?php echo $don_hang['trang_thai'] == 1 ? 'selected' : ''; ?>>Chờ xử lý</option>
                        <option value="2" <?php echo $don_hang['trang_thai'] == 2 ? 'selected' : ''; ?>>Đang giao</option>
                        <option value="3" <?php echo $don_hang['trang_thai'] == 3 ? 'selected' : ''; ?>>Đã giao</option>
                        <option value="4" <?php echo $don_hang['trang_thai'] == 4 ? 'selected' : ''; ?>>Đã hủy</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-warning xem-chi-tiet" data-id="<?php echo $don_hang['id']; ?>">
                        <i class="fas fa-eye"></i> Chi tiết
                    </button>
                    <button class="btn btn-danger huy-don-hang" data-id="<?php echo $don_hang['id']; ?>">
                        <i class="fas fa-times"></i> Hủy
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
// Khai báo các biến toàn cục
const modal = $("#modalChua");
const form = $("#formChua");
const fileInput = $("#hinh_anh");
const imagePreview = $("#image-preview");
const removeImageBtn = $("#remove-image");
let isProcessing = false;

function khoiTaoQuanLyNguoiDung() {
    // Xử lý xóa người dùng
    $('.xoa-nguoi-dung').click(function() {
        const id = $(this).data('id');
        if (confirm('Bạn có chắc muốn xóa người dùng này?')) {
            $.post('quantrivien.php', {
                action: 'xoa_nguoi_dung',
                id: id
            }).done(function(response) {
                if (response.success) {
                    toastr.success('Đã xóa người dùng');
                    location.reload();
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            });
        }
    });
}

function khoiTaoQuanLySanPham() {
    // Xử lý thêm/sửa sản phẩm
    $('.btn-add-san-pham').click(function() {
        form[0].reset();
        $('#chua_id').val('');
        imagePreview.empty();
        removeImageBtn.hide();
        modal.show();
    });

    $('.sua-san-pham').click(function() {
        const id = $(this).data('id');
        // Lấy thông tin sản phẩm qua AJAX và điền vào form
        $.get('quantrivien.php', {
            action: 'lay_san_pham',
            id: id
        }).done(function(data) {
            $('#chua_id').val(data.id);
            $('#ten_san_pham').val(data.ten_san_pham);
            $('#danh_muc').val(data.danh_muc);
            $('#gia').val(data.gia);
            $('#so_luong').val(data.so_luong);
            $('#mo_ta').val(data.mo_ta);
            $('#trang_thai').val(data.trang_thai);
            
            if (data.hinh_anh) {
                imagePreview.html(`<img src="${data.hinh_anh}" alt="Preview">`);
                removeImageBtn.show();
            }
            
            modal.show();
        });
    });

   // Trong phần JavaScript
form.submit(function(e) {
    e.preventDefault();
    if (isProcessing) return;
    
    isProcessing = true;
    const formData = new FormData(this);
    
    // Thêm action vào formData
    const action = $('#chua_id').val() ? 'sua_san_pham' : 'them_san_pham';
    formData.append('action', action);
    
    // Log để kiểm tra dữ liệu gửi đi
    console.log('Action:', action);
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    $.ajax({
        url: 'quantrivien.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Response:', response); // Log response
            try {
                const result = typeof response === 'string' ? JSON.parse(response) : response;
                if (result.success) {
                    toastr.success('Đã lưu sản phẩm thành công');
                    $('.modal').css('display', 'none'); // Sửa cách đóng modal
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(result.message || 'Có lỗi xảy ra');
                }
            } catch (e) {
                console.error('Parse error:', e); // Log lỗi parse
                toastr.error('Có lỗi xảy ra khi xử lý phản hồi');
            }
        },
        error: function(xhr, status, error) {
            // Log chi tiết lỗi
            console.error('Ajax error:', {
                status: status,
                error: error,
                response: xhr.responseText
            });
            toastr.error('Có lỗi xảy ra khi gửi yêu cầu');
        },
        complete: function() {
            isProcessing = false;
        }
    });
});
    // Xử lý xóa sản phẩm
    $('.xoa-san-pham').click(function() {
        const id = $(this).data('id');
        if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
            $.post('quantrivien.php', {
                action: 'xoa_san_pham',
                id: id
            }).done(function(response) {
                if (response.success) {
                    toastr.success('Đã xóa sản phẩm');
                    location.reload();
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            });
        }
    });
}

$(document).ready(function() {
    // Xử lý sự kiện click nút "Thêm sản phẩm"
    $('.btn-add-san-pham').click(function() {
        $('#formChua')[0].reset(); // Reset form
        $('#chua_id').val(''); // Xóa giá trị ID nếu có
        $('#image-preview').empty(); // Xóa preview ảnh
        $('#remove-image').hide(); // Ẩn nút xóa ảnh
        $('.modal').css('display', 'block'); // Hiển thị modal
    });

    // Xử lý đóng modal
    $('.close-modal').click(function() {
        $('.modal').css('display', 'none');
    });

    // Đóng modal khi click bên ngoài
    $(window).click(function(event) {
        if ($(event.target).hasClass('modal')) {
            $('.modal').css('display', 'none');
        }
    });
});

function khoiTaoQuanLyDonHang() {
    // Xử lý cập nhật trạng thái đơn hàng
    $('.trang-thai-don-hang').change(function() {
        const id = $(this).data('id');
        const trangThai = $(this).val();
        
        $.post('quantrivien.php', {
            action: 'cap_nhat_trang_thai_don_hang',
            id: id,
            trang_thai: trangThai
        }).done(function(response) {
            if (response.success) {
                toastr.success('Đã cập nhật trạng thái');
            } else {
                toastr.error(response.message || 'Có lỗi xảy ra');
                location.reload();
            }
        });
    });

    // Xử lý hủy đơn hàng
    $('.huy-don-hang').click(function() {
        const id = $(this).data('id');
        if (confirm('Bạn có chắc muốn hủy đơn hàng này?')) {
            $.post('quantrivien.php', {
                action: 'cap_nhat_trang_thai_don_hang',
                id: id,
                trang_thai: 4 // Trạng thái hủy
            }).done(function(response) {
                if (response.success) {
                    toastr.success('Đã hủy đơn hàng');
                    location.reload();
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            });
        }
    });
}

$(document).ready(function() {
    // Cấu hình thông báo toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "1000"
    };

    // Khởi tạo các chức năng quản lý
    khoiTaoQuanLyNguoiDung();
    khoiTaoQuanLySanPham();
    khoiTaoQuanLyDonHang();
    
    // Xử lý đóng modal
    $('.close-modal').click(function() {
        modal.hide();
    });
    
    // Xử lý preview ảnh
    fileInput.change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.html(`<img src="${e.target.result}" alt="Preview">`);
                removeImageBtn.show();
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Xử lý xóa ảnh
    removeImageBtn.click(function() {
        fileInput.val('');
        imagePreview.empty();
        $(this).hide();
    });
});
</script>

<?php
$conn->close();
?>

</body>
</html>