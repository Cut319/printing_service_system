<?php
include 'database.php';
include 'cart.php';

$database = new Database();
$db = $database->getConnection();

$cart = new Cart($db);

$cart->createCart($_POST['serviceId'], $_POST['serviceName'], $_POST['servicePrice'], $_POST['serviceSide'], $_POST['serviceColour'], $_POST['cusFile'], $_POST['noCopies'], $_POST['noPages'], $_POST['notes'], $_POST['cusHp']);

$db->close();

?>