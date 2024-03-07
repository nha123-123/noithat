<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        form {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
        }
        
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }
        
        button, a.button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>Đăng Nhập</h2>
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="login">Đăng Nhập
           
        </button>
        <a href="dangki.php" class="button">Đăng Kí</a>
    </form>

    <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "noithat";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "Kết nối thành công";
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM noithat WHERE name = ?");
    $stmt->bind_param("s", $name);

    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Chuyển hướng người dùng đến nha32.html
        header("Location: nha32.html");
        exit;
    } else {
        echo "Tên người dùng hoặc mật khẩu không đúng.";
    }

    $stmt->close();
}
$conn->close();
?>


</body>

</html>
