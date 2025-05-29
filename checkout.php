<?php

session_start();
include 'database.php';
include 'orders.php';
include 'cart.php';
include 'payment.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database = new Database();
    $db = $database->getConnection();

   
    $orders = new Orders($db);
    $cart = new Cart($db);
    $pay = new Payment($db);

    $cartId = $_POST['cartId'];
    $serviceId = $_POST['serviceId'];
    $serviceName = $_POST['serviceName'];
    $servicePrice = $_POST['servicePrice'];
    $serviceSide = $_POST['serviceSide'];
    $serviceColour = $_POST['serviceColour'];
    $cusFile = $_POST['cusFile'];
    $noCopies = $_POST['noCopies'];
    $noPages = $_POST['noPages'];
    $notes = $_POST['notes'];
    $cusHp = $_POST['cusHp'];
    $pickupTime = $_POST['pickupTime'];
    $total = $_POST['total'];
    $payMethod = $_POST['payMethod'];

    
    $orders->createOrder($cartId, $serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour, $cusFile, $noCopies, $noPages, $notes, $cusHp, $pickupTime);
    $orderDetails = $orders->getOrderId($cartId);
    $orderId = $orderDetails['orderId'];
    $pay->createPayment($total, $payMethod, $orderId);
    $orderDetails = $cart->deleteCart($cartId);
 
    $db->close();
}

?>