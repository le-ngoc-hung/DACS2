<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include_once 'includes.php';

$db = new Database();

$myId = $_SESSION['userId'] ?? null;
// Kiểm tra vai trò trong session
if (isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'quan_ly') {
    // Nhúng file admin nếu vai trò là quản lý
    include_once './view/common/admin.php';
} else {
    // Nhúng file user nếu không phải quản lý
    include_once './view/common/user.php';
}
?>
