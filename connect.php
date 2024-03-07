<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "noithat"; // Thay "your_database_name" bằng tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "Kết nối thành công";
}

?>
