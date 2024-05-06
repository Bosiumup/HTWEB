<?php
if (isset($_POST['logout'])) {
    // Hủy toàn bộ phiên làm việc
    session_destroy();

    // Chuyển hướng người dùng về trang main.php
    header("Location: ?");
    exit;
}