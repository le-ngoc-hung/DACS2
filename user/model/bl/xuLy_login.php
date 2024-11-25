<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$con = mysqli_connect("localhost", "root", "123456", "doancoso2");
if (!$con) {
    die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra định dạng form nhập
    if (strpos($username, ' ') !== false || strpos($password, ' ') !== false) {
        redirectWithError("http://localhost:8282/DACS2/user/index.php/?lay=login", 'Tên đăng nhập hoặc mật khẩu không được chứa khoảng trắng.');
    }

    // Truy vấn kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = ?";
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        die("Lỗi khi chuẩn bị truy vấn: " . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_array($result)) {
        if (password_verify($password, $user['mat_khau'])) {
            // Đăng nhập thành công
            $_SESSION['message'] = 'Đăng nhập thành công';
            $_SESSION['userId'] = $user['ma_nguoi_dung'];
            $_SESSION['userNamee'] = $user['ten_dang_nhap'];
            $_SESSION['userRole'] = $user['vai_tro'];
            
            header("Location: http://localhost:8282/DACS2/user/index.php");
            exit();
        } else {
            // Sai mật khẩu
            redirectWithError("http://localhost:8282/DACS2/user/index.php/?lay=login", 'Tên đăng nhập hoặc mật khẩu không đúng.');
        }
    } else {
        // Không tìm thấy người dùng
        redirectWithError("http://localhost:8282/DACS2/user/index.php/?lay=login", 'Tên đăng nhập hoặc mật khẩu không đúng.');
    }
}

function redirectWithError($url, $message) {
    $_SESSION['error'] = $message;
    header("Location: $url");
    exit();
}
?>
