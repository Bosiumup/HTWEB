<?php
    require "app/components/user/update_avt_detail_User.php"; 
    require "app/components/log_out.php";
    
        if (isset($_SESSION['user_name'])) { 
            // Lấy dữ liệu cũ từ cơ sở dữ liệu
            $username = $_SESSION['user_name']; // Đặt username của người dùng cần cập nhật
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $avt_url = $row["avatar_url"];
                $name = $row["name"];
                $gender = $row["gender"];
                $birth_year = $row["birth_year"];
                $hometown = $row["hometown"];
                $role = $row["role"];
            }
        }
    ?>
<div class="container-detail-user">
    <h1>Thông tin cá nhân</h1>

    <!-- Hiển thị avatar người dùng -->
    <form method="post" action="?" enctype="multipart/form-data">
        <div class="upload-avt">
            <div class="file-upload">
                <input type="file" id="avatar" name="avatar">
                <img src="<?php echo $avt_url; ?>" id="avatar-preview">
            </div>
            <button class="btn" type="submit" name="update_avt">Tải ảnh</button>
        </div>
    </form>


    <!-- Hiển thị các trường thông tin người dùng -->
    <div class="inf-detail">
        <div class="inf-item">
            <p>Tài khoản</p>
            <input type="text" name="username" value="<?php echo $username; ?>" readonly>
        </div>

        <div class="inf-item">
            <p>Tên</p>
            <input type="text" name="name" value="<?php echo $name; ?>" readonly>
        </div>

        <div class="inf-item">
            <p>Giới tính</p>
            <input type="text" name="gender" value="<?php echo $gender ?>" readonly>
        </div>

        <div class="inf-item">
            <p>Năm sinh</p>
            <input type="number" name="birth_year" value="<?php echo $birth_year; ?>" readonly>
        </div>

        <div class="inf-item">
            <p>Quê quán</p>
            <input type="text" name="hometown" value="<?php echo $hometown; ?>" readonly>
        </div>
    </div>

    <!-- Chuyển link và đăng xuất -->
    <div style="text-align: center;" class="link-user">
        <a href="?page=detail_data_User">Cập nhật thông tin</a>
        <a href="?page=detail_pass_User">Đổi mật khẩu</a>
        <?php 
        if($role == "1") {
            ?>
        <a href="?page=detail_table_evaluations">Đánh giá tiêu chuẩn</a>
        <?php
        }
        else {
            ?>
        <a style="color: #ff3131;" href="admin.php">Về trang admin</a>
        <?php
        }
    ?>
    </div>
    <?php
    if($role == "1") {
            ?>
    <form class="log_out" action="user.php" method="post">
        <button class="btn_log_out" type="submit" name="logout">Logout</button>
    </form>
    <?php
        }
        ?>
</div>

<script>
document.getElementById('avatar').addEventListener('change', function() {
    var file = this.files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(e) {
        document.getElementById('avatar-preview').src = e.target.result;
    }
});
</script>