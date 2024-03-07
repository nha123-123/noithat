<?php
// Khởi tạo phiên
session_start();

// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "noithat";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Từ khóa tìm kiếm từ form gửi lên
$keyword = $_POST['keyword'];

// Truy vấn SQL để tìm kiếm sản phẩm
$sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%'";

// Thực hiện truy vấn
$result = $conn->query($sql);

// Kiểm tra và hiển thị kết quả
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Tên sản phẩm: " . $row["product_name"]. " - Giá: " . $row["price"]. "<br>";
    }
} else {
    echo "Không tìm thấy sản phẩm";
}

// Đóng kết nối
$conn->close();
?>
