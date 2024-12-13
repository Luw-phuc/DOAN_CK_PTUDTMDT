<?php
session_start(); // Bắt đầu session

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Kiểm tra nếu là yêu cầu POST
    // Lấy thông tin email và mật khẩu từ form
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        require_once "db.inc.php"; // Kết nối cơ sở dữ liệu

        // Truy vấn để tìm tài khoản với email đó
        $query = "SELECT * FROM account WHERE email = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Lấy kết quả truy vấn

        if ($result) { // Nếu tài khoản tồn tại
            // Kiểm tra mật khẩu
            if ($password == $result["password"]) {
                // Nếu mật khẩu đúng, lưu thông tin người dùng vào session
                $_SESSION["user_id"] = $result["id"];
                $_SESSION["user_name"] = $result["firstname"] . " " . $result["lastname"];

                // Kiểm tra vai trò của người dùng (admin hay người dùng thường)
                if ($result['role'] == 'admin') {
                    // Nếu là admin, chuyển hướng đến trang quản lý người dùng
                    header("Location: ../user-management.php");
                } else {
                    // Nếu là người dùng thường, chuyển hướng đến trang chủ
                    header("Location: ../index.php");
                }
                exit(); // Dừng script và thực hiện chuyển hướng
            } else {
                die("Invalid password."); // Nếu mật khẩu sai, hiển thị lỗi
            }
        } else {
            die("Account not found."); // Nếu không tìm thấy tài khoản, hiển thị lỗi
        }
    } catch (Exception $e) {
        die("Query failed: " . $e->getMessage()); // Nếu có lỗi trong quá trình truy vấn, hiển thị lỗi
    } finally {
        // Giải phóng tài nguyên
        $pdo = null;
        $stmt = null;
    }
} else {
    // Nếu không phải POST, chuyển hướng về trang chủ
    header("Location: ../index.php");
    die();
}