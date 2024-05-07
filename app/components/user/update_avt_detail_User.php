<?php
use Cloudinary\Api\Upload\UploadApi;
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["update_avt"])) {
    // Xử lý tải lên và lưu trữ hình ảnh vào thư mục tạm
    $newAvatar = $_FILES['avatar'];
    // Tải lên hình ảnh lên Cloudinary
    $data = (new UploadApi())->upload($newAvatar['tmp_name']);
    // Lưu URL và Public ID vào cơ sở dữ liệu người dùng
    $url = $data['secure_url'];
    $publicId = $data['public_id'];

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $sql_update_data = "UPDATE users SET public_id = '$publicId', avatar_url = '$url' WHERE username = '$username'";

    if ($conn->query($sql_update_data) === TRUE) {
        echo "Cập nhật thông tin người dùng thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>