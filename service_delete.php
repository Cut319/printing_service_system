<?php

session_start();

    if(!isset($_SESSION['adminId']))
{
    header('Location: admin_login.php');
    exit();
}
include 'Database.php';
include 'Service.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $serviceId = $_GET['serviceId'];

    $database = new Database();
    $db = $database->getConnection();

    $service = new Service($db);
    $service->deleteService($serviceId);

    $db->close();
}