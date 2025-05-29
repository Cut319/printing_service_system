<?php
include 'Database.php';
include 'Cart.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    $database = new Database();
    $db = $database->getConnection();

    $cart = new Cart($db);

    $cartId = $_POST['cartId'];
    $noCopies = $_POST['noCopies'];
    $noPages = $_POST['noPages'];
    $notes = $_POST['notes'];

    $cart->updateCart($cartId, $noCopies, $noPages, $notes);

    header('Location:cart_view.php');
    exit();

   
    $db->close();
}
?>
