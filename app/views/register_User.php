<div class="container-register">
    <div class="title">Đăng ký</div>
    <div class="content">
        <form action="?page=register_User" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Tài khoản</span>
                    <input name="username" type="text" placeholder="Tài khoản..." required>
                </div>
                <div class="input-box">
                    <span class="details">Mật khẩu</span>
                    <input name="pass" type="password" placeholder="******" required>
                </div>
                <div class="input-box">
                    <span class="details">Xác nhận mật khẩu</span>
                    <input name="confirm-pass" type="password" placeholder="******" required>
                </div>
                <div class="input-box">
                    <span class="details">Tên</span>
                    <input value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>" name="name-user"
                        type="text" placeholder="Tên..." required>
                </div>
                <div class="input-box">
                    <span class="details">Năm sinh</span>
                    <input value="<?php echo isset($_SESSION['birth_year']) ? $_SESSION['birth_year'] : '' ?>"
                        name="birth_year" type="number" placeholder="2003,..." required>
                </div>
                <div class="input-box">
                    <span class="details">Quê quán</span>
                    <input value="<?php echo isset($_SESSION['hometown']) ? $_SESSION['hometown'] : '' ?>"
                        name="hometown" type="text" placeholder="Cần thơ,..." required>
                </div>
            </div>
            <div class="gender-details">
                <span class="gender-title">Giới tính</span>
                <input type="radio" name="gender" value="Male"
                    <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') echo 'checked'; ?> required>
                <span>Nam</span>
                <input type="radio" name="gender" value="Female"
                    <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') echo 'checked'; ?>
                    required> <span>Nữ</span>
            </div>

            <!-- role : 1 -> user -->
            <input type="hidden" name="role" value="1">

            <div class="button">
                <input name="register" type="submit" value="Đăng ký">
            </div>
        </form>
        <a href="?page=log_in_User">Đăng nhập ngay</a>
    </div>
</div>

<?php
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["register"])) {
    $user_name = $_POST['username'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm-pass'];
    $name = $_POST['name-user'];
    $birth_year = $_POST['birth_year'];
    $hometown = $_POST['hometown'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];

    $_SESSION['name'] = $_POST['name-user'];
    $_SESSION['birth_year'] = $_POST['birth_year'];
    $_SESSION['hometown'] = $_POST['hometown'];
    $_SESSION['gender'] = $_POST['gender'];

    // Kiểm tra xem username và tên đã tồn tại chưa
    $check_query = "SELECT * FROM users WHERE username = '$user_name'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "<script>
                alert('Đã có tài khoản');
                window.location = '?page=register_User';
            </script>";            
    } else {
        if (password_verify($confirm_password, $password)) {
            $sql = "INSERT INTO users (username, password, name, gender, birth_year, hometown, role) values ('$user_name', '$password', '$name', '$gender', '$birth_year', '$hometown', '$role')";

            if ($conn->query($sql)) {
                echo "<script>
                        alert('Tạo tài khoản thành công');
                        window.location = '?page=log_in_User';
                    </script>";
            }
        } else {
            echo "<script>
                    alert('Mật khẩu không khớp');
                    window.location = '?page=register_User';
                </script>";
        }
    }
}
?>