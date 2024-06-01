<?php 
    require "app/components/role_Admin.php";
    require "app/components/log_out.php";
?>

<div class="container-admin">
    <h1>ADMIN</h1>
    <div class="link-user d-flex">
        <a class="mb" href="?page=list_member_Admin">DANH SÁCH HỘI VIÊN</a>
        <a class="mb" href="?page=list_evaluation_Admin">DANH SÁCH ĐÁNH GIÁ CỦA HỘI VIÊN</a>
        <a class="mb" href="?page=list_detail_standard">DANH SÁCH TIÊU CHUẨN</a>
        <a class="mb" href="?page=list_quantity_Admin">DANH SÁCH THỐNG KÊ KẾT QUẢ</a>
        <a style="color: #ff3131;" class="mb" href="user.php">Vào trang User</a>
    </div>
    <form class="log_out" action="admin.php" method="post">
        <button class="btn_log_out" type="submit" name="logout">Logout</button>
    </form>
</div>

<style>
.container-admin {
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0px 1px 15px 10px rgba(0, 0, 0, 0.4);
}

.container-admin h1 {
    color: #333;
    font-weight: 500;
    text-align: center;
    padding: 40px 0 20px;
}
</style>