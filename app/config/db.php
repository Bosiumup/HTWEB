<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlhv";
  
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
?>