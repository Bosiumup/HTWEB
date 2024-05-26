<?php
    require "app/components/user/update_pass_detail_User.php";   
?>
<div class="container-detail-user">
    <h1>Chỉnh sửa mật khẩu</h1>
    <form class="log_out" method="post" action="?page=detail_pass_User">
        <div class="inf-detail">
            <div class="text-start inf-item">
                <p>Mật khẩu cũ</p>
                <input class="cursor" type="password" name="old-pass" placeholder="******" required>
            </div>
            <div class="text-start inf-item">
                <p>Mật khẩu mới</p>
                <input class="cursor" type="password" name="new-pass" placeholder="******" required>
            </div>
            <div class="text-start inf-item">
                <p>Nhập lại mật khẩu mới</p>
                <input class="cursor" type="password" name="confirm-new-pass" placeholder="******" required>
            </div>
        </div>

        <button class="btn_log_out" type="submit" name="update_pass">Cập nhật</button>
    </form>
</div>