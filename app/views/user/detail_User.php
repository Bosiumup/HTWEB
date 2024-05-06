<?php
    require "app/components/user/update_detail_User.php"; 
        if (isset($_SESSION['user_name'])) { 
            // Lấy dữ liệu cũ từ cơ sở dữ liệu
            $username = $_SESSION['user_name']; // Đặt username của người dùng cần cập nhật
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $avt_url = $row["avatar_url"];
                $password = $row["password"];
                $name = $row["name"];
                $gender = $row["gender"];
                $birth_year = $row["birth_year"];
                $hometown = $row["hometown"];
            }
    ?>
<div class="container-detail-user">
    <form method="post" action="?page=detail_User" enctype="multipart/form-data">
        <!-- Hiển thị avatar người dùng -->
        <img style="width: 50px; height: 50px;" src="<?php echo $avt_url; ?>" alt="Avatar">
        <label for="avatar">Hình ảnh đại diện:</label>
        <input type="file" id="avatar" name="avatar">

        <!-- Hiển thị các trường thông tin người dùng -->
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>" readonly><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $password; ?>" required><br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required><br><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?> required> Male
        <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?> required>
        Female<br><br>

        <label for="birth_year">Birth Year:</label>
        <input type="number" name="birth_year" value="<?php echo $birth_year; ?>" required><br><br>

        <label for="hometown">Hometown:</label>
        <input type="text" name="hometown" value="<?php echo $hometown; ?>" required><br><br>

        <input type="submit" name="update" value="Cập Nhật">
    </form>

    <?php
        }
    ?>

    <form action="?page=log_out_User" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>