<?php
    require "app/components/user/update_pass_detail_User.php";   
?>
<div class="container-detail-user">
    <form method="post" action="?page=detail_pass_User">
        <!-- Hiển thị các trường thông tin người dùng -->
        <label for="old-pass">Old PassWord:</label>
        <input type="password" name="old-pass" required><br><br>

        <label for="new-pass">New PassWord:</label>
        <input type="password" name="new-pass" required><br><br>

        <label for="confirm-new-pass">Confirm New PassWord:</label>
        <input type="password" name="confirm-new-pass" required><br><br>

        <input type="submit" name="update_pass" value="Cập Nhật">
    </form>
</div>