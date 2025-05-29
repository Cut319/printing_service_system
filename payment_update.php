<?php

include 'Database.php';
include 'Payment.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database = new Database();
    $db = $database->getConnection();

    $pay = new Payment($db);

    $orderId = $_POST['orderId'];
    $payStatus = $_POST['payStatus'];

    $pay->updatePayment($orderId, $payStatus);

    $db->close();
}
?>
