<?php

session_start();
include 'database.php';
include 'customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

$customer->createCustomer($_POST['cusHp'], $_POST['cusName'], $_POST['cusPw']);

$db->close();

?>