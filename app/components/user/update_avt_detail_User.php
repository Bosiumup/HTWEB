<?php
use Cloudinary\Api\Upload\UploadApi;
if (isset($_SERVER["REQUEST_METHOD"]) && isset($_POST["update_avt"])) {
    $username = $_SESSION['user_name'];
    // Xử lý tải lên và lưu trữ hình ảnh vào thư mục tạm
    $newAvatar = $_FILES['avatar'];
    // Tải lên hình ảnh lên Cloudinary với thư mục QLHV trên cloud
    $data = (new UploadApi())->upload($newAvatar['tmp_name'], ['folder' => 'QLHV']);
    // Lưu URL và Public ID vào cơ sở dữ liệu người dùng
    $url = $data['secure_url'];
    $publicId = $data['public_id'];

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $sql_update_data = "UPDATE users SET public_id = '$publicId', avatar_url = '$url' WHERE username = '$username'";

    if ($conn->query($sql_update_data) === TRUE) {
        echo "<script>
                alert('Đã tải ảnh đại diện.');
                window.location = '?';
            </script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>