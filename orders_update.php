<?php
include 'Database.php';
include 'Orders.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database = new Database();
    $db = $database->getConnection();

    $orders = new Orders($db);

    echo $_POST['orderId'];
    echo $_POST['orderStatus'];

    $orderId = $_POST['orderId'];
    $orderStatus = $_POST['orderStatus'];

    $orders->updateOrder($orderStatus, $orderId);

    $db->close();
}
?>
