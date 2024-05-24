<?php 
    require "app/components/role_Admin.php";
    require "app/components/log_out.php";
?>

<div class="main-content">
    <a href="?page=list_member_Admin">DANH SÁCH HỘI VIÊN</a>
    <a href="?page=list_evaluation_Admin">DANH SÁCH BẢNG YÊU CẦU ĐÁNH GIÁ TIÊU CHUẨN</a>
    <a href="?page=list_quantity_Admin">BẢNG SỐ LƯỢNG THỐNG KÊ KẾT QUẢ</a>
    <a href="user.php">Vào trang User</a>
    <form action="admin.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>
<style>
.main-content a {
    font-size: x-large;
    border: 1px solid #333;
    padding: 10px;
    margin-right: 20px;
}
</style>