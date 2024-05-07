<?php
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["update_pass"])) {
    // Lấy dữ liệu từ form
    $username = $_SESSION['user_name'];
    $old_pass = $_POST['old-pass'];
    $new_pass = $_POST["new-pass"];
    $hash_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
    $confirm_new_pass = $_POST["confirm-new-pass"];

    // Kiểm tra xem người dùng có tồn tại trong database hay không
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // Nếu người dùng tồn tại, lấy dữ liệu từ bản ghi đầu tiên
        $user_data = $check_result->fetch_assoc();
        // Nếu mật khẩu nhập vào khớp với mật khẩu từ database
        if (password_verify($old_pass, $user_data['password'])) {
            if (password_verify($confirm_new_pass, $hash_new_pass)) {
                // Cập nhật pass người dùng trong cơ sở dữ liệu
                $sql_update_data = "UPDATE users SET password = '$hash_new_pass' WHERE username = '$username'";

                if ($conn->query($sql_update_data) === TRUE) {
                    echo "<script>
                      alert('Cập nhật pass người dùng thành công.');
                        window.location = '?page=log_in_User';
                    </script>";
                } else {
                    echo "Lỗi: " . $conn->error;
                }
            }
            else {
                echo "<script>
                      alert('Pass mới không giống nhau.');
                        window.location = '?page=detail_pass_User';
                    </script>";
            }
        }
        else {
            echo "<script>
                      alert('Pass cũ không đúng.');
                        window.location = '?page=detail_pass_User';
                    </script>";
        }
    }
}
?>