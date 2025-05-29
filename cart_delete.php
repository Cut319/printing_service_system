<?php

session_start();
include 'Database.php';
include 'Cart.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $cartId = $_GET['cartId'];

    $database = new Database();
    $db = $database->getConnection();

    $cart = new Cart($db);
    $cart->deleteCart($cartId);

    $db->close();
}