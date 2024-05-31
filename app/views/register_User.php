<div class="container-register">
    <div class="title">Đăng ký</div>
    <div class="content">
        <form action="?page=register_User" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Tài khoản</span>
                    <input name="username" type="text" placeholder="Tài khoản...">
                </div>
                <div class="input-box">
                    <span class="details">Mật khẩu</span>
                    <input name="pass" type="password" placeholder="******">
                </div>
                <div class="input-box">
                    <span class="details">Xác nhận mật khẩu</span>
                    <input name="confirm-pass" type="password" placeholder="******">
                </div>
                <div class="input-box">
                    <span class="details">Tên</span>
                    <input value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>" name="name-user"
                        type="text" placeholder="Tên...">
                </div>
                <div class="input-box">
                    <span class="details">Năm sinh</span>
                    <input value="<?php echo isset($_SESSION['birth_year']) ? $_SESSION['birth_year'] : '' ?>"
                        name="birth_year" type="number" placeholder="2003,...">
                </div>
                <div class="input-box">
                    <span class="details">Quê quán</span>
                    <input value="<?php echo isset($_SESSION['hometown']) ? $_SESSION['hometown'] : '' ?>"
                        name="hometown" type="text" placeholder="Cần thơ,...">
                </div>
            </div>
            <div class="gender-details">
                <span class="gender-title">Giới tính</span>
                <input type="radio" name="gender" value="Nam"
                    <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Nam') echo 'checked'; ?>>
                <span>Nam</span>
                <input type="radio" name="gender" value="Nữ"
                    <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Nữ') echo 'checked'; ?>>
                <span>Nữ</span>
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
    $user_name = trim($_POST['username']);
    $password = $_POST['pass'];
    $confirm_password = $_POST['confirm-pass'];
    $name = trim($_POST['name-user']);
    $birth_year = trim($_POST['birth_year']);
    $hometown = trim($_POST['hometown']);
    $gender = $_POST['gender'];
    $role = $_POST['role'];

    $_SESSION['name'] = $_POST['name-user'];
    $_SESSION['birth_year'] = $_POST['birth_year'];
    $_SESSION['hometown'] = $_POST['hometown'];
    $_SESSION['gender'] = $_POST['gender'];

    // Kiểm tra các trường không được để trống
    if(empty($user_name) || empty($password) || empty($name) || empty($birth_year) || empty($hometown) || empty($gender) || empty($role)){
        echo "<script>
                alert('Không bỏ trống các ô');
                window.location = '?page=register_User';
            </script>"; 
    } else {
        // Kiểm tra xem username và tên đã tồn tại chưa
        $check_query = "SELECT * FROM users WHERE username = '$user_name'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            echo "<script>
                    alert('Đã có tài khoản');
                    window.location = '?page=register_User';
                </script>";            
        } else {
            if ($password === $confirm_password) {
                $password = password_hash($password, PASSWORD_DEFAULT);
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
}
?>