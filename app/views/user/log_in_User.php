<div class="container-register">
    <div class="title">Login</div>
    <div class="content">
        <form action="?page=log_in_User" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Username</span>
                    <input name="username" type="text" placeholder="Enter your Username" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input name="pass" type="password" placeholder="Enter your Password" required>
                </div>
            </div>
            <div class="button">
                <input name="login" type="submit">
            </div>
        </form>
        <a href="?page=register_User">Register now</a>
    </div>
</div>

<?php
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["login"])) {
    $user_name = $_POST['username'];
    $password = $_POST['pass'];

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
                // Chuyển hướng đến trang detailUser.php
                header("Location: ?page=detail_User");
            }
        } else {
            echo "<script>
                      alert('Password incorrect');
                        window.location = '?page=log_in_User';
                    </script>";
        }
    } else {
        echo "<script>
                      alert('Username does not exist');
                        window.location = '?page=log_in_User';
                    </script>";
    }
}
?>