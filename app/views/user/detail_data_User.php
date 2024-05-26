<?php
    require "app/components/user/update_data_detail_User.php"; 
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
            }
    ?>
<div class="container-detail-user">
    <h1>Chỉnh sửa thông tin</h1>
    <form class="log_out" method="post" action="?page=detail_data_User">
        <!-- Hiển thị các trường thông tin người dùng -->
        <div class="inf-detail">
            <div class="text-start inf-item">
                <p>Tài khoản</p>
                <input type="text" name="username" value="<?php echo $username; ?>" readonly>
            </div>

            <div class="text-start inf-item">
                <p>Tên</p>
                <input class="cursor" type="text" name="name" value="<?php echo $name; ?>" required>
            </div>

            <div class="text-start inf-item">
                <p>Giới tính</p>
                <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?> required>
                Male
                <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>
                    required>
                Female
            </div>

            <div class="text-start inf-item">
                <p>Năm sinh</p>
                <input class="cursor" type="number" name="birth_year" value="<?php echo $birth_year; ?>" required>
            </div>

            <div class="text-start inf-item">
                <p>Quê quán</p>
                <input class="cursor" type="text" name="hometown" value="<?php echo $hometown; ?>" required>
            </div>
        </div>

        <button class="btn_log_out" type="submit" name="update_data">Cập nhật</button>
    </form>

    <?php
        }
    ?>
</div>