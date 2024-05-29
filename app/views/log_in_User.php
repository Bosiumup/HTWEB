<?php 
if (isset($_SESSION["user_name"])) {
    $username = $_SESSION["user_name"];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $check_login = $conn->query($sql);
    if ($check_login->num_rows > 0) {
        $account_data = $check_login->fetch_assoc();
        if ($account_data["role"] == "0") {
            header("location: admin.php");
        }
        else {
            header("location: user.php");
        }
    }
}
?>

<div class="container-register">
    <div class="title">Đăng nhập</div>
    <div class="content">
        <form action="?page=log_in_User" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Tài khoản</span>
                    <input name="username" type="text" placeholder="Tài khoản...">
                </div>
                <div class="input-box">
                    <span class="details">Mật khẩu</span>
                    <input name="pass" type="password" placeholder="******">
                </div>
            </div>
            <div class="button">
                <input name="login" type="submit" value="Đăng nhập">
            </div>
        </form>
        <a href="?page=register_User">Đăng ký ngay</a>
    </div>
</div>

<?php
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["login"])) {
    $user_name = trim($_POST['username']);
    $password = $_POST['pass'];

    // Kiểm tra xem các trường có được để trống hay không
    if(empty($user_name) || empty($password)){
        echo "<script>
                alert('Vui lòng không bỏ trống các ô');
                window.location = '?page=log_in_User';
            </script>"; 
    } else {
        // Kiểm tra xem người dùng có tồn tại trong database hay không
        $check_query = "SELECT * FROM users WHERE username = '$user_name'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            // Nếu người dùng tồn tại, lấy dữ liệu từ bản ghi đầu tiên
            $user_data = $check_result->fetch_assoc();
            // Nếu mật khẩu nhập vào khớp với mật khẩu từ database
            if (password_verify($password, $user_data['password'])) {
                if ($user_data["role"] == "0") {
                    $_SESSION['user_name'] = $_POST['username'];
                    $_SESSION['user_name_role'] = "0";
                    // Chuyển hướng đến trang admin
                    header("Location: admin.php");
                } 
                elseif ($user_data["role"] == "1") {
                    $_SESSION['user_name'] = $_POST['username'];
                    $_SESSION['user_name_role'] = "1";
                    // Chuyển hướng đến trang user
                    header("Location: user.php");
                }
            } 
            else {
                echo "<script>
                        alert('Sai mật khẩu');
                        window.location = '?';
                    </script>";
                // header("Location: ?");
            }
        } else {
            echo "<script>
                    alert('Không có tài khoản');
                    window.location = '?';
                </script>";
            // header("Location: ?");
        }
    }
}
?>