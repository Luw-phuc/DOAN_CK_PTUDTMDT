<?php
    $dsn = "mysql:host=206.189.41.183;port=3306;dbname=usbibracelet";
    $dbusername = "root";
    $dbpassword = "Admin@123";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
    }
?>