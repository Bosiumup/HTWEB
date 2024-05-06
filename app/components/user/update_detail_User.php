<?php
use Cloudinary\Api\Upload\UploadApi;
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["update"])) {
    // Lấy dữ liệu từ form và xử lý ảnh
    $username = $_SESSION['user_name'];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Băm password mới
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $birth_year = $_POST["birth_year"];
    $hometown = $_POST["hometown"];
    // Xử lý tải lên và lưu trữ hình ảnh vào thư mục tạm
    $newAvatar = $_FILES['avatar'];
    // Tải lên hình ảnh lên Cloudinary
    $data = (new UploadApi())->upload($newAvatar['tmp_name']);
    // Lưu URL và Public ID vào cơ sở dữ liệu người dùng
    $url = $data['secure_url'];
    $publicId = $data['public_id'];

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $sql_update_data = "UPDATE users SET public_id = '$publicId', avatar_url = '$url', password = '$hashed_password', name = '$name', gender = '$gender', birth_year = '$birth_year', hometown = '$hometown' WHERE username = '$username'";

    if ($conn->query($sql_update_data) === TRUE) {
        echo "Cập nhật thông tin người dùng thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>