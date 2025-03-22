<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentMethod = $_POST["paymentMethod"];
    $cardHolderName = $_POST['card-holder-name'];
    $cardNumber = $_POST['card-number'];
    $cardExpiry = $_POST['card-expiry'];
    $cardCvv = $_POST['card-cvv'];
    if ($_SESSION['order_id'] == null) {
        header("Location: ../login.php");
        exit();
    }
    require_once "db.inc.php";
    $status = 'successed';
    try {
        $updateOrder = "UPDATE `order` SET paymentMethod = :paymentMethod, status = :status WHERE id = :id;";
        $stmtOrder = $pdo->prepare($updateOrder);
        $stmtOrder->bindParam(":id", $_SESSION['order_id']);
        $stmtOrder->bindParam(":paymentMethod", $paymentMethod);
        $stmtOrder->bindParam(":status", $status);
        $stmtOrder->execute();

        if ($paymentMethod == "visa") {
            if (isset($_POST["save-info"]) && $_POST["save-info"] == "on") {
                $stmtCard = $pdo->prepare("INSERT INTO card (account_id, card_number, cardholder_name, expiry, cvv) VALUES (:account_id, :card_number, :cardholder_name, :expiry, :cvv)");
                $stmtCard->bindParam(":account_id", $_SESSION["user_id"]);
                $stmtCard->bindParam(":card_number", $cardNumber);
                $stmtCard->bindParam(":cardholder_name", $cardHolderName);
                $stmtCard->bindParam(":expiry", $cardExpiry);
                $stmtCard->bindParam(":cvv", $cardCvv);
                $stmtCard->execute() ;
            } else {
                $stmtCard = $pdo->prepare("UPDATE account SET credential = null WHERE id = :id");
                $stmtCard->bindParam(":id", $_SESSION["user_id"]);
                $stmtCard->execute() ;
            }
        }

        header("Location: ../checkout-success.php");
        unset($_SESSION["cart"]);
        die();
    } catch (Exception $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $stmtOrder = null;
    }
} else {
    header("Location: ../index.php");
    die();
}

?>