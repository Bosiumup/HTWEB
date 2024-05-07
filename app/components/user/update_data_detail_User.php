<?php
use Cloudinary\Api\Upload\UploadApi;
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["update_data"])) {
    // Lấy dữ liệu từ form và xử lý ảnh
    $username = $_SESSION['user_name'];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $birth_year = $_POST["birth_year"];
    $hometown = $_POST["hometown"];

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $sql_update_data = "UPDATE users SET name = '$name', gender = '$gender', birth_year = '$birth_year', hometown = '$hometown' WHERE username = '$username'";

    if ($conn->query($sql_update_data) === TRUE) {
        echo "Cập nhật thông tin người dùng thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>