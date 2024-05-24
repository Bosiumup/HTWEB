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
    <form method="post" action="?page=detail_User" enctype="multipart/form-data">
        <!-- Hiển thị avatar người dùng -->
        <div class="file-upload">
            <input type="file" id="avatar" name="avatar">
            <img src="<?php echo $avt_url; ?>" style="width: 300px; height: 300px;" id="avatar-preview" alt="Avatar">
        </div>
        <button type="submit" name="update_avt">Cập nhật</button></br>
        <label for="avatar">Hình ảnh đại diện:</label>
    </form>
    <style>
    .file-upload {
        display: inline-block;
        position: relative;
        width: 300px;
        height: 300px;
        border: 1px solid #000;
        border-radius: 50%;
        overflow: hidden;
    }

    .file-upload input[type='file'] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .file-upload::before {
        content: 'Tải ảnh lên';
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-size: 24px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .file-upload:hover::before {
        opacity: 1;
    }
    </style>
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

    <!-- Hiển thị các trường thông tin người dùng -->
    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo $username; ?>" readonly><br><br>

    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $name; ?>" readonly><br><br>

    <label>Gender:</label>
    <input type="text" name="gender" value="<?php echo $gender ?>" readonly><br><br>

    <label for="birth_year">Birth Year:</label>
    <input type="number" name="birth_year" value="<?php echo $birth_year; ?>" readonly><br><br>

    <label for="hometown">Hometown:</label>
    <input type="text" name="hometown" value="<?php echo $hometown; ?>" readonly><br><br>

    <a href="?page=detail_data_User">Cập nhật thông tin</a>
    <a href="?page=detail_pass_User">Đổi mật khẩu</a>
    <?php 
        if($role == "1") {
            ?>
    <a href="?page=detail_table_evaluations">Đánh giá tiêu chuẩn</a>
    <form action="user.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    <?php
        }
        else {
            ?>
    <a href="admin.php">Về trang admin</a>
    <?php
        }
    ?>




</div>